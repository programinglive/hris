<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class BranchController extends Controller
{
    /**
     * Display a listing of the branches.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $query = Branch::with(['company'])->select([
            'id',
            'name',
            'code',
            'address',
            'city',
            'company_id',
            'is_main_branch',
            'is_active',
            'created_at',
        ]);

        // Reset filters if filter dialog is opened
        if ($request->has('filter_dialog')) {
            $filters = [
                'search' => null,
                'company_id' => null,
                'city' => null,
            ];
        } else {
            // Apply filters
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                        ->orWhere('code', 'like', '%'.$search.'%')
                        ->orWhere('address', 'like', '%'.$search.'%')
                        ->orWhere('city', 'like', '%'.$search.'%');
                });
            }

            if ($request->has('company_id')) {
                $query->where('company_id', $request->input('company_id'));
            }

            if ($request->has('city')) {
                $query->where('city', 'like', '%'.$request->input('city').'%');
            }

            $filters = [
                'search' => $request->input('search'),
                'company_id' => $request->input('company_id'),
                'city' => $request->input('city'),
            ];
        }

        // Get companies for filter
        $companies = Company::select(['id', 'name'])->get();

        // Get branches with pagination
        $branches = $query->paginate(10);

        return Inertia::render('organization/branch/index', [
            'branches' => $branches,
            'companies' => $companies,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new branch.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $companies = Company::where('is_active', true)
            ->get(['id', 'name']);

        $statuses = ['active', 'inactive'];

        return Inertia::render('organization/branch/create', [
            'companies' => $companies,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created branch in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:branches',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'company_id' => 'required|exists:companies,id',
            'is_main_branch' => 'boolean',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If this is set as main branch, unset any existing main branch for this company
        if ($request->is_main_branch) {
            Branch::where('company_id', $request->company_id)
                ->where('is_main_branch', true)
                ->update(['is_main_branch' => false]);
        }

        Branch::create([
            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone' => $request->phone,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'is_main_branch' => $request->is_main_branch ?? false,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);

        return redirect()->route('organization.branch.index')
            ->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified branch.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $branch = Branch::with('company')->findOrFail($id);

        return Inertia::render('organization/branch/details', [
            'branch' => [
                'id' => $branch->id,
                'name' => $branch->name,
                'code' => $branch->code,
                'address' => $branch->address,
                'city' => $branch->city,
                'state' => $branch->state,
                'postal_code' => $branch->postal_code,
                'country' => $branch->country,
                'phone' => $branch->phone,
                'email' => $branch->email,
                'company' => $branch->company ? [
                    'id' => $branch->company->id,
                    'name' => $branch->company->name,
                ] : null,
                'is_main_branch' => $branch->is_main_branch,
                'is_active' => $branch->is_active,
                'description' => $branch->description,
                'created_at' => $branch->created_at->format('Y-m-d'),
            ],
        ]);
    }

    /**
     * Show the form for editing the specified branch.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $companies = Company::where('is_active', true)
            ->get(['id', 'name']);

        $statuses = ['active', 'inactive'];

        return Inertia::render('organization/branch/edit', [
            'branch' => $branch,
            'companies' => $companies,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Update the specified branch in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:branches,code,'.$id,
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'company_id' => 'required|exists:companies,id',
            'is_main_branch' => 'boolean',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If this is set as main branch, unset any existing main branch for this company
        if ($request->is_main_branch && (! $branch->is_main_branch || $branch->company_id != $request->company_id)) {
            Branch::where('company_id', $request->company_id)
                ->where('is_main_branch', true)
                ->update(['is_main_branch' => false]);
        }

        $branch->update([
            'name' => $request->name,
            'code' => $request->code,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone' => $request->phone,
            'email' => $request->email,
            'company_id' => $request->company_id,
            'is_main_branch' => $request->is_main_branch ?? false,
            'is_active' => $request->is_active,
            'description' => $request->description,
        ]);

        return redirect()->route('organization.branch.index')
            ->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);

        // Check if this is the main branch
        if ($branch->is_main_branch) {
            return redirect()->back()
                ->with('error', 'Cannot delete the main branch. Please set another branch as main first.');
        }

        // Check if the branch has any associated employees or other dependencies
        // Add checks here if needed

        $branch->delete();

        return redirect()->route('organization.branch.index')
            ->with('success', 'Branch deleted successfully.');
    }

    /**
     * Download an Excel template for branch import
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        $filename = 'branch_import_template.xlsx';
        $tempPath = storage_path('app/temp/'.$filename);

        // Ensure the directory exists
        if (! file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        // Create a writer and add the headers
        $writer = SimpleExcelWriter::create($tempPath);

        // Add headers by adding a row with the header values
        $writer->addRow([
            'name' => 'Branch Name*',
            'code' => 'Branch Code*',
            'company_code' => 'Company Code*',
            'company_name' => 'Company Name*',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State/Province',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'phone' => 'Phone',
            'email' => 'Email',
            'is_active' => 'Is Active (Yes/No)',
            'description' => 'Description',
        ]);

        // Add example data
        $writer->addRow([
            'name' => 'Main Branch',
            'code' => 'BR001',
            'company_code' => 'BEAUT',
            'company_name' => 'Test Company',
            'address' => '123 Main Street',
            'city' => 'City Name',
            'state' => 'State',
            'postal_code' => '12345',
            'country' => 'Country',
            'phone' => '+1234567890',
            'email' => 'branch@example.com',
            'is_active' => 'Yes',
            'description' => 'Main branch description',
        ]);

        // Add notes in additional rows
        $writer->addRow([]);
        $writer->addRow(['Notes:']);
        $writer->addRow(['* Required fields']);
        $writer->addRow(['* Branch Code must be unique']);
        $writer->addRow(['* For Is Active field, use Yes/No, True/False, or 1/0']);

        // Close the writer to save the file
        $writer->close();

        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Process the imported branch file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function processImport(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        if (! $request->hasFile('file')) {
            return back()->withErrors(['file' => 'No file was uploaded.']);
        }

        $file = $request->file('file');

        // Process the file directly from the uploaded file path
        try {
            // Get file extension to determine reader type
            $extension = strtolower($file->getClientOriginalExtension());

            // Map extension to reader type
            $readerType = 'xlsx'; // Default
            if ($extension === 'csv') {
                $readerType = 'csv';
            } elseif ($extension === 'xls') {
                $readerType = 'xls';
            }

            $reader = SimpleExcelReader::create($file->getPathname(), $readerType);

            $importResults = [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => [],
            ];

            DB::beginTransaction();

            try {
                $reader->getRows()->each(function (array $row) use (&$importResults) {
                    $importResults['total']++;

                    // Skip header row if it exists
                    if (isset($row['name']) && $row['name'] === 'Branch Name*') {
                        return;
                    }

                    // Skip empty rows
                    if (empty($row['name']) && empty($row['code'])) {
                        return;
                    }

                    try {
                        // Get company using both code and name
                        $company = \App\Models\Company::where(function ($query) use ($row) {
                            $query->where('code', $row['company_code'])
                                ->orWhere('name', $row['company_name']);
                        })->first();

                        if (! $company) {
                            throw new \Exception("Company not found: Code={$row['company_code']}, Name={$row['company_name']}");
                        }

                        // Prepare data for validation and creation
                        $isActive = false;
                        if (isset($row['is_active'])) {
                            $isActiveValue = strtolower(trim($row['is_active']));
                            $isActive = in_array($isActiveValue, ['yes', 'true', '1', 'y']);
                        }

                        $data = [
                            'name' => $row['name'] ?? null,
                            'code' => $row['code'] ?? null,
                            'address' => $row['address'] ?? null,
                            'city' => $row['city'] ?? null,
                            'state' => $row['state'] ?? null,
                            'postal_code' => $row['postal_code'] ?? null,
                            'country' => $row['country'] ?? null,
                            'phone' => $row['phone'] ?? null,
                            'email' => $row['email'] ?? null,
                            'company_id' => $company->id,
                            'is_active' => $isActive,
                            'is_main_branch' => false,
                            'description' => $row['description'] ?? null,
                        ];

                        // Validate row data
                        $rowValidator = Validator::make($data, [
                            'name' => 'required|string|max:255',
                            'code' => 'required|string|max:50|unique:branches',
                            'address' => 'nullable|string|max:255',
                            'city' => 'nullable|string|max:100',
                            'state' => 'nullable|string|max:50',
                            'postal_code' => 'nullable|string|max:20',
                            'country' => 'nullable|string|max:100',
                            'phone' => 'nullable|string|max:20',
                            'email' => 'nullable|email|max:255',
                            'company_id' => 'required|exists:companies,id',
                            'is_active' => 'boolean',
                            'is_main_branch' => 'boolean',
                            'description' => 'nullable|string|max:255',
                        ]);

                        if ($rowValidator->fails()) {
                            throw new \Exception('Validation failed: '.json_encode($rowValidator->errors()->all()));
                        }

                        // Create branch
                        Branch::create($data);
                        $importResults['success']++;

                    } catch (\Exception $e) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? "Row {$importResults['total']}",
                            'code' => $row['code'] ?? '',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });

                DB::commit();

                // Get the updated branches with company_id
                $branches = Branch::with('company')->select([
                    'id',
                    'name',
                    'code',
                    'address',
                    'city',
                    'company_id',
                    'is_main_branch',
                    'is_active',
                    'created_at',
                ])->paginate(10);

                // Get companies for filter
                $companies = Company::select(['id', 'name'])->get();

                return Inertia::render('organization/branch/index', [
                    'branches' => $branches,
                    'companies' => $companies,
                    'filters' => [
                        'search' => null,
                        'company_id' => null,
                        'city' => null,
                    ],
                    'importResults' => $importResults,
                    'importMessage' => "Import completed: {$importResults['success']} branches imported successfully, {$importResults['failed']} failed.",
                    'importStatus' => $importResults['failed'] > 0 ? 'warning' : 'success',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                return Inertia::render('organization/branch/index', [
                    'importResults' => $importResults,
                    'importMessage' => 'An error occurred during import: '.$e->getMessage(),
                    'importStatus' => 'error',
                ]);
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            return Inertia::render('organization/branch/index', [
                'importResults' => null,
                'importMessage' => 'Error reading the import file: '.$e->getMessage(),
                'importStatus' => 'error',
            ]);
        }
    }
}
