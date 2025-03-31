<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index(Request $request)
    {
        $query = Company::query()
            ->select('id', 'name', 'email', 'phone', 'city', 'country', 'is_active');

        // Reset filters if filter_dialog is open
        if ($request->boolean('filter_dialog')) {
            $request->replace([
                'status' => null,
                'city' => null,
                'country' => null,
            ]);
        }

        // Apply search filter if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%");
            });
        }

        // Apply status filter if provided
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('is_active', $status === 'active');
        }

        // Apply city filter if provided
        if ($request->filled('city')) {
            $city = $request->input('city');
            $query->where('city', 'like', "%{$city}%");
        }

        // Apply country filter if provided
        if ($request->filled('country')) {
            $country = $request->input('country');
            $query->where('country', 'like', "%{$country}%");
        }

        $companies = $query->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('organization/company/index', [
            'companies' => $companies,
            'filters' => $request->only(['search', 'status', 'city', 'country']),
        ]);
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        return Inertia::render('organization/company/create');
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'legal_name' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['owner_id'] = Auth::id();

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $path;
        }

        Company::create($validated);

        return Redirect::route('organization.company.index')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        return Inertia::render('organization/company/show', [
            'company' => $company,
        ]);
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit(Company $company)
    {
        return Inertia::render('organization/company/edit', [
            'company' => $company,
        ]);
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'legal_name' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:50',
            'registration_number' => 'nullable|string|max:50',
            'email' => 'required|email|unique:companies,email,'.$company->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $company->update($validated);

        return Redirect::route('organization.company.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return Redirect::route('organization.company.index')->with('success', 'Company deleted successfully.');
    }

    /**
     * Download the import template for companies.
     */
    public function downloadTemplate()
    {
        $filename = 'company_import_template.xlsx';
        $tempPath = storage_path('app/temp/'.$filename);

        // Ensure the directory exists
        if (! file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        // Create a writer and add the headers
        $writer = SimpleExcelWriter::create($tempPath);

        // Add headers by adding a row with the header values
        $writer->addRow([
            'name' => 'Name*',
            'legal_name' => 'Legal Name',
            'tax_id' => 'Tax ID',
            'registration_number' => 'Registration Number',
            'email' => 'Email*',
            'phone' => 'Phone',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
            'website' => 'Website',
            'description' => 'Description',
            'is_active' => 'Is Active (Yes/No)',
        ]);

        // Add example data
        $writer->addRow([
            'name' => 'ABC Company',
            'legal_name' => 'ABC Corporation Ltd.',
            'tax_id' => 'TX12345',
            'registration_number' => 'REG98765',
            'email' => 'info@abccompany.com',
            'phone' => '+1234567890',
            'address' => '123 Main Street',
            'city' => 'New York',
            'state' => 'NY',
            'postal_code' => '10001',
            'country' => 'USA',
            'website' => 'https://www.abccompany.com',
            'description' => 'A sample company description',
            'is_active' => 'Yes',
        ]);

        // Add notes in additional rows
        $writer->addRow([]);
        $writer->addRow(['Notes:']);
        $writer->addRow(['* Required fields']);
        $writer->addRow(['* Email must be unique']);
        $writer->addRow(['* For Is Active field, use Yes/No, True/False, or 1/0']);

        // Close the writer to save the file
        $writer->close();

        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Process the import file.
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

            $ownerId = Auth::id();

            DB::beginTransaction();

            try {
                $reader->getRows()->each(function (array $row) use (&$importResults, $ownerId) {
                    $importResults['total']++;

                    // Skip header row if it exists
                    if (isset($row['name']) && $row['name'] === 'Name*') {
                        return;
                    }

                    // Skip empty rows
                    if (empty($row['name']) && empty($row['email'])) {
                        return;
                    }

                    // Prepare data for validation and creation
                    $isActive = false;
                    if (isset($row['is_active'])) {
                        $isActiveValue = strtolower(trim($row['is_active']));
                        $isActive = in_array($isActiveValue, ['yes', 'true', '1', 'y']);
                    }

                    $data = [
                        'name' => $row['name'] ?? null,
                        'legal_name' => $row['legal_name'] ?? null,
                        'tax_id' => $row['tax_id'] ?? null,
                        'registration_number' => $row['registration_number'] ?? null,
                        'email' => $row['email'] ?? null,
                        'phone' => $row['phone'] ?? null,
                        'address' => $row['address'] ?? null,
                        'city' => $row['city'] ?? null,
                        'state' => $row['state'] ?? null,
                        'postal_code' => $row['postal_code'] ?? null,
                        'country' => $row['country'] ?? null,
                        'website' => $row['website'] ?? null,
                        'description' => $row['description'] ?? null,
                        'is_active' => $isActive,
                        'owner_id' => $ownerId,
                    ];

                    // Validate row data
                    $rowValidator = Validator::make($data, [
                        'name' => 'required|string|max:255',
                        'legal_name' => 'nullable|string|max:255',
                        'tax_id' => 'nullable|string|max:50',
                        'registration_number' => 'nullable|string|max:50',
                        'email' => 'required|email|unique:companies,email',
                        'phone' => 'nullable|string|max:20',
                        'address' => 'nullable|string',
                        'city' => 'nullable|string|max:100',
                        'state' => 'nullable|string|max:100',
                        'postal_code' => 'nullable|string|max:20',
                        'country' => 'nullable|string|max:100',
                        'website' => 'nullable|url|max:255',
                        'description' => 'nullable|string',
                        'is_active' => 'boolean',
                    ]);

                    if ($rowValidator->fails()) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $data['name'] ?? "Row {$importResults['total']}",
                            'code' => $data['email'] ?? '',
                            'errors' => $rowValidator->errors()->all(),
                        ];

                        return;
                    }

                    try {
                        Company::create($data);
                        $importResults['success']++;
                    } catch (\Exception $e) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $data['name'] ?? "Row {$importResults['total']}",
                            'code' => $data['email'] ?? '',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });

                DB::commit();

                return back()->with([
                    'success' => true,
                    'message' => "Import completed: {$importResults['success']} companies imported successfully, {$importResults['failed']} failed.",
                    'results' => $importResults,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                return back()->with([
                    'success' => false,
                    'message' => 'An error occurred during import: '.$e->getMessage(),
                ]);
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            return back()->with([
                'success' => false,
                'message' => 'Error reading the import file: '.$e->getMessage(),
            ]);
        }
    }
}
