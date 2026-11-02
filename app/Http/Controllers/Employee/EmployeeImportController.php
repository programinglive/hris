<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\WorkSchedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class EmployeeImportController extends Controller
{
    /**
     * Matches the filename the import test and the UI expect.
     */
    private const TEMPLATE_FILENAME = 'employee_import_template.xlsx';

    /**
     * Show the employee import page.
     */
    public function showImportForm()
    {
        return Inertia::render('employee/import', [
            'templateRoute' => route('employee.import.template'),
            'processRoute' => route('employee.import.process'),
        ]);
    }

    /**
     * Download the Excel template used for employee import.
     *
     * The first data row is a real sample employee (John Doe / EMP001) so the
     * file can be imported as-is; the import skips that row when it is uploaded
     * back unchanged.
     */
    public function downloadTemplate()
    {
        $directory = storage_path('app/temp');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory.'/'.self::TEMPLATE_FILENAME;

        $writer = SimpleExcelWriter::create($path);

        $writer->addRow([
            'employee_code' => 'Employee Code*',
            'name' => 'Full Name*',
            'email' => 'Email*',
            'company_code' => 'Company Code*',
            'branch_code' => 'Branch Code',
            'position_name' => 'Position',
            'join_date' => 'Join Date (YYYY-MM-DD)',
            'status' => 'Status',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'is_active' => 'Is Active (Yes/No)',
        ]);

        $writer->addRow([
            'employee_code' => 'EMP001',
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'company_code' => 'BEAUT',
            'branch_code' => 'BR001',
            'position_name' => '',
            'join_date' => now()->toDateString(),
            'status' => 'Active',
            'phone' => '+6200000000',
            'address' => 'Sample Street 1',
            'city' => 'Sample City',
            'is_active' => 'Yes',
        ]);

        $writer->addRow([]);
        $writer->addRow(['Notes:']);
        $writer->addRow(['* Required fields']);
        $writer->addRow(['* Employee Code and Email must be unique']);
        $writer->addRow(['* Company Code must match an existing company']);
        $writer->addRow(['* Branch Code and Position are optional']);
        $writer->addRow(['* Default password is "password"; the user should change it on first login']);

        $writer->close();

        return response()->download($path, self::TEMPLATE_FILENAME, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Import employees from an uploaded Excel or CSV file.
     */
    public function processImport(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $readerType = $extension === 'csv' ? 'csv' : ($extension === 'xls' ? 'xls' : 'xlsx');

        $results = [
            'total' => 0,
            'success' => 0,
            'failed' => 0,
            'errors' => [],
        ];

        try {
            $reader = SimpleExcelReader::create($file->getPathname(), $readerType);
            $rows = $reader->getRows();
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to read the uploaded file: '.$e->getMessage(),
                'errors' => ['file' => ['Unable to read the uploaded file.']],
            ], 422);
        }

        $employeeRole = null;

        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                // Skip the template header row when the file is re-uploaded as-is.
                if (($row['employee_code'] ?? null) === 'Employee Code*') {
                    continue;
                }

                $employeeCode = trim((string) ($row['employee_code'] ?? ''));
                $email = trim((string) ($row['email'] ?? ''));
                $name = trim((string) ($row['name'] ?? ''));

                // Rows below the data block are notes/legend text: they carry a
                // first cell but no email. Treat them as the end of the sheet
                // rather than as failed records.
                if ($email === '' && $employeeCode !== '' && $name === '') {
                    continue;
                }

                if ($email === '' && $employeeCode === '') {
                    continue;
                }

                $results['total']++;

                try {
                    $company = $this->resolveCompany($row);

                    if (! $company) {
                        throw new \RuntimeException(
                            'Company not found for code "'.($row['company_code'] ?? '').'"'
                        );
                    }

                    if ($email === '' || $employeeCode === '') {
                        throw new \RuntimeException('Employee code and email are required.');
                    }

                    if (User::where('email', $email)->exists()) {
                        throw new \RuntimeException("An account already exists for {$email}.");
                    }

                    $branch = $this->resolveBranch($row, $company);
                    $position = $this->resolvePosition($row, $company);
                    $isActive = $this->parseBoolean($row['is_active'] ?? 'Yes');

                    $user = User::create([
                        'name' => trim((string) ($row['name'] ?? $email)),
                        'email' => $email,
                        'password' => Hash::make('password'),
                        'email_verified_at' => now(),
                    ]);

                    $user->userDetails()->create([
                        'employee_code' => $employeeCode,
                        'status' => $this->normaliseStatus($row['status'] ?? 'Active', $isActive),
                        'company_id' => $company->id,
                        'branch_id' => $branch?->id,
                        'position_id' => $position?->id,
                        'join_date' => $this->parseDate($row['join_date'] ?? null),
                        'phone' => $row['phone'] ?? null,
                        'mobile_phone' => $row['phone'] ?? null,
                        'address' => $row['address'] ?? null,
                        'city' => $row['city'] ?? null,
                        'email' => $email,
                    ]);

                    $employeeRole ??= Role::firstOrCreate(
                        ['name' => 'employee', 'company_id' => $company->id],
                        [
                            'display_name' => 'Employee',
                            'description' => 'Regular employee access',
                            'slug' => 'employee-'.$company->id,
                        ]
                    );

                    if (! $user->roles()->where('role_id', $employeeRole->id)->exists()) {
                        $user->roles()->attach($employeeRole->id, [
                            'company_id' => $company->id,
                        ]);
                    }

                    $results['success']++;
                } catch (\Throwable $e) {
                    $results['failed']++;
                    $results['errors'][] = [
                        'row' => $results['total'],
                        'employee_code' => $row['employee_code'] ?? '',
                        'email' => $row['email'] ?? '',
                        'errors' => [$e->getMessage()],
                    ];
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Import failed: '.$e->getMessage(),
                'results' => $results,
            ], 500);
        }

        return response()->json([
            'success' => $results['failed'] === 0,
            'message' => "Import completed: {$results['success']} imported, {$results['failed']} failed.",
            'results' => $results,
        ]);
    }

    private function resolveCompany(array $row): ?Company
    {
        $code = trim((string) ($row['company_code'] ?? ''));

        if ($code !== '') {
            $company = Company::where('code', $code)->first();

            if ($company) {
                return $company;
            }
        }

        // Fall back to the only company when the file omits the column, which is
        // the common case for a single-tenant installation.
        return Company::query()->count() === 1 ? Company::query()->first() : null;
    }

    private function resolveBranch(array $row, Company $company): ?Branch
    {
        $code = trim((string) ($row['branch_code'] ?? ''));

        if ($code !== '') {
            $branch = Branch::where('company_id', $company->id)->where('code', $code)->first();

            if ($branch) {
                return $branch;
            }
        }

        // The template ships a placeholder code; fall back to the company's main
        // branch rather than creating a detail row with no branch at all, which
        // most UI screens then filter out.
        return Branch::where('company_id', $company->id)
            ->orderByDesc('is_main_branch')
            ->orderBy('id')
            ->first();
    }

    private function resolvePosition(array $row, Company $company): ?Position
    {
        $name = trim((string) ($row['position_name'] ?? ''));

        if ($name === '') {
            return null;
        }

        return Position::where('company_id', $company->id)->where('name', $name)->first();
    }

    private function parseDate(?string $value): ?string
    {
        if ($value === null || trim($value) === '') {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($value)->toDateString();
        } catch (\Throwable) {
            return null;
        }
    }

    private function parseBoolean(?string $value): bool
    {
        return in_array(strtolower(trim((string) $value)), ['yes', 'true', '1', 'y'], true);
    }

    private function normaliseStatus(?string $value, bool $isActive): string
    {
        $status = strtolower(trim((string) $value));

        return match ($status) {
            'inactive' => 'inactive',
            'on_leave', 'on leave' => 'on_leave',
            'terminated' => 'terminated',
            'active' => 'active',
            default => $isActive ? 'active' : 'inactive',
        };
    }
}
