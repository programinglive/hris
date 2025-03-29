<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $query = Branch::with('company');
        
        // Reset filters if filter_dialog is open
        if ($request->boolean('filter_dialog')) {
            $request->replace([
                'company_id' => null,
                'city' => null,
            ]);
        }
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('company', function ($subQuery) use ($search) {
                      $subQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // Apply company filter if provided
        if ($request->has('company_id') && !empty($request->company_id)) {
            $query->where('company_id', $request->company_id);
        }
        
        // Apply location (city) filter if provided
        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', $request->city);
        }
        
        // Get paginated results
        $branches = $query->paginate(10)->through(function ($branch) {
            return [
                'id' => $branch->id,
                'name' => $branch->name,
                'code' => $branch->code,
                'address' => $branch->address,
                'city' => $branch->city,
                'company' => $branch->company ? [
                    'id' => $branch->company->id,
                    'name' => $branch->company->name,
                ] : null,
                'is_main_branch' => $branch->is_main_branch,
                'is_active' => $branch->is_active,
                'created_at' => $branch->created_at->format('Y-m-d'),
            ];
        });
        
        // Get companies for filter dropdown
        $companies = Company::select('id', 'name')->orderBy('name')->get();
        
        // Get unique cities for filter dropdown
        $cities = Branch::select('city')->distinct()->whereNotNull('city')->orderBy('city')->pluck('city');

        return Inertia::render('organization/branch/index', [
            'branches' => $branches,
            'companies' => $companies,
            'cities' => $cities,
            'filters' => $request->only(['search', 'company_id', 'city']),
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
     * @param  \Illuminate\Http\Request  $request
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:branches,code,' . $id,
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
        if ($request->is_main_branch && (!$branch->is_main_branch || $branch->company_id != $request->company_id)) {
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
        // Create the file
        $filename = 'branch_import_template.xlsx';
        $tempPath = storage_path('app/temp/' . $filename);
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add the headers
        $writer = SimpleExcelWriter::create($tempPath);
        
        // Add headers by adding a row with the header values
        $writer->addRow([
            'name' => 'name',
            'code' => 'code',
            'address' => 'address',
            'city' => 'city',
            'phone' => 'phone',
            'email' => 'email',
            'is_active' => 'is_active'
        ]);
        
        // Add example data
        $writer->addRow([
            'name' => 'Example Branch',
            'code' => 'BR001',
            'address' => '123 Main Street',
            'city' => 'New York',
            'phone' => '555-123-4567',
            'email' => 'branch@example.com',
            'is_active' => 'Yes'
        ]);
        
        // Close the writer to save the file
        $writer->close();
        
        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
    
    /**
     * Process the imported branch file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processImport(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        
        if (!$request->hasFile('file')) {
            return response()->json([
                'success' => false,
                'errors' => ['file' => ['No file was uploaded.']],
            ], 422);
        }
        
        $file = $request->file('file');
        
        // Process the file directly from the uploaded file path
        try {
            $reader = SimpleExcelReader::create($file->getPathname());
            
            $importResults = [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => [],
            ];
            
            DB::beginTransaction();
            
            try {
                $reader->getRows()->each(function(array $row) use (&$importResults) {
                    $importResults['total']++;
                    
                    // Skip header row if it exists
                    if (isset($row['name']) && strtolower($row['name']) === 'name') {
                        return;
                    }
                    
                    // Validate row data
                    $validator = Validator::make($row, [
                        'name' => 'required|string|max:255',
                        'code' => 'required|string|max:50|unique:branches',
                        'address' => 'nullable|string|max:255',
                        'city' => 'nullable|string|max:100',
                        'phone' => 'nullable|string|max:20',
                        'email' => 'nullable|email|max:255',
                        'is_active' => 'nullable|string',
                    ]);
                    
                    if ($validator->fails()) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'code' => $row['code'] ?? 'Unknown',
                            'errors' => $validator->errors()->all(),
                        ];
                        return;
                    }
                    
                    try {
                        // Create branch
                        $isActive = false;
                        if (isset($row['is_active'])) {
                            $isActiveValue = strtolower(trim($row['is_active']));
                            $isActive = in_array($isActiveValue, ['yes', 'true', '1', 'y']);
                        }
                        
                        // Get company for the branch
                        // First try to find the test company, then fallback to the first company
                        $company = \App\Models\Company::where('code', 'TEST')->first();
                        
                        if (!$company) {
                            $company = \App\Models\Company::first();
                        }
                        
                        if (!$company) {
                            throw new \Exception('No company found. Please create a company first.');
                        }
                        
                        Branch::create([
                            'name' => $row['name'],
                            'code' => $row['code'],
                            'address' => $row['address'] ?? null,
                            'city' => $row['city'] ?? null,
                            'phone' => $row['phone'] ?? null,
                            'email' => $row['email'] ?? null,
                            'company_id' => $company->id,
                            'is_active' => $isActive,
                            'is_main_branch' => false,
                        ]);
                        
                        $importResults['success']++;
                    } catch (\Exception $e) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'code' => $row['code'] ?? 'Unknown',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });
                
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Import completed successfully.',
                    'results' => $importResults,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred during import: ' . $e->getMessage(),
                ], 500);
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            return response()->json([
                'success' => false,
                'message' => 'Error reading the import file: ' . $e->getMessage(),
            ], 500);
        }
    }
}
