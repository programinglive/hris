<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Department::with(['manager', 'company', 'branch']);
        
        // Apply filters
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }
        
        if ($request->has('company_id') && !empty($request->company_id)) {
            $query->where('company_id', $request->company_id);
        }
        
        if ($request->has('branch_id') && !empty($request->branch_id)) {
            $query->where('branch_id', $request->branch_id);
        }
        
        $departments = $query->paginate(10)->withQueryString();
        
        // Transform the data
        $departments->getCollection()->transform(function ($department) {
            return [
                'id' => $department->id,
                'name' => $department->name,
                'description' => $department->description,
                'manager' => $department->manager ? [
                    'id' => $department->manager->id,
                    'name' => $department->manager->name,
                ] : null,
                'company' => $department->company ? [
                    'id' => $department->company->id,
                    'name' => $department->company->name,
                ] : null,
                'branch' => $department->branch ? [
                    'id' => $department->branch->id,
                    'name' => $department->branch->name,
                ] : null,
                'status' => $department->status,
                'created_at' => $department->created_at->format('Y-m-d'),
            ];
        });
        
        // Get companies for filter
        $companies = Company::where('is_active', true)
            ->get()
            ->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                ];
            });
            
        // Get branches for filter
        $branches = Branch::where('is_active', true)
            ->get()
            ->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->name,
                ];
            });
            
        return Inertia::render('organization/department/index', [
            'departments' => $departments,
            'companies' => $companies,
            'branches' => $branches,
            'filters' => $request->only(['search', 'company_id', 'branch_id']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $managers = User::whereHas('detail', function ($query) {
            $query->whereIn('position', ['Manager', 'Director', 'System Administrator']);
        })->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        });
        
        $companies = Company::where('is_active', true)
            ->get()
            ->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                ];
            });
            
        $branches = Branch::where('is_active', true)
            ->get()
            ->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->name,
                    'company_id' => $branch->company_id,
                ];
            });
            
        return Inertia::render('organization/department/create', [
            'managers' => $managers,
            'companies' => $companies,
            'branches' => $branches,
            'statuses' => ['active', 'inactive'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments',
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'branch_id' => 'nullable|exists:branches,id',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Department::create([
                'name' => $request->name,
                'description' => $request->description,
                'manager_id' => $request->manager_id,
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
            ]);

            Log::info('Department created successfully');

            return redirect('/organization/department/index')
                ->with('success', 'Department created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to create department. ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::with(['manager', 'company', 'branch', 'employees.user'])
            ->findOrFail($id);
            
        $departmentData = [
            'id' => $department->id,
            'name' => $department->name,
            'description' => $department->description,
            'manager' => $department->manager ? [
                'id' => $department->manager->id,
                'name' => $department->manager->name,
            ] : null,
            'company' => $department->company ? [
                'id' => $department->company->id,
                'name' => $department->company->name,
            ] : null,
            'branch' => $department->branch ? [
                'id' => $department->branch->id,
                'name' => $department->branch->name,
            ] : null,
            'status' => $department->status,
            'created_at' => $department->created_at->format('Y-m-d'),
            'employees' => $department->employees->map(function ($employee) {
                return [
                    'id' => $employee->user->id,
                    'name' => $employee->user->name,
                    'position' => $employee->position,
                ];
            }),
        ];
        
        return Inertia::render('organization/department/details', [
            'department' => $departmentData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::findOrFail($id);
        
        $managers = User::whereHas('detail', function ($query) {
            $query->whereIn('position', ['Manager', 'Director', 'System Administrator']);
        })->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        });
        
        $companies = Company::where('is_active', true)
            ->get()
            ->map(function ($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                ];
            });
            
        $branches = Branch::where('is_active', true)
            ->get()
            ->map(function ($branch) {
                return [
                    'id' => $branch->id,
                    'name' => $branch->name,
                    'company_id' => $branch->company_id,
                ];
            });
            
        return Inertia::render('organization/department/edit', [
            'department' => [
                'id' => $department->id,
                'name' => $department->name,
                'description' => $department->description,
                'manager_id' => $department->manager_id,
                'company_id' => $department->company_id,
                'branch_id' => $department->branch_id,
                'status' => $department->status,
            ],
            'managers' => $managers,
            'companies' => $companies,
            'branches' => $branches,
            'statuses' => ['active', 'inactive'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:departments,name,' . $id,
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:users,id',
            'company_id' => 'required|exists:companies,id',
            'branch_id' => 'nullable|exists:branches,id',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $department->update([
                'name' => $request->name,
                'description' => $request->description,
                'manager_id' => $request->manager_id,
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
                'status' => $request->status,
            ]);

            Log::info('Department updated successfully');

            return redirect('/organization/department/index')
                ->with('success', 'Department updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update department. ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::findOrFail($id);
        
        try {
            $department->delete();
            return redirect('/organization/department/index')
                ->with('success', 'Department deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete department. ' . $e->getMessage());
        }
    }

    /**
     * Download an Excel template for department import
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadTemplate()
    {
        // Create the file
        $filename = 'department_import_template.xlsx';
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
            'description' => 'description',
            'company_id' => 'company_id',
            'branch_id' => 'branch_id',
            'manager_id' => 'manager_id',
            'status' => 'status'
        ]);
        
        // Add example data
        $writer->addRow([
            'name' => 'Example Department',
            'description' => 'Department Description',
            'company_id' => '1',
            'branch_id' => '1',
            'manager_id' => '',
            'status' => 'active'
        ]);
        
        // Close the writer to save the file
        $writer->close();
        
        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
    
    /**
     * Process the imported department file
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Inertia\Response
     */
    public function processImport(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);
        
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }
            
            return back()->withErrors($validator);
        }
        
        if (!$request->hasFile('file')) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['file' => ['No file was uploaded.']],
                ], 422);
            }
            
            return back()->withErrors(['file' => 'No file was uploaded.']);
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
                        'description' => 'nullable|string',
                        'company_id' => 'required|exists:companies,id',
                        'branch_id' => 'required|exists:branches,id',
                        'manager_id' => 'nullable|exists:users,id',
                        'status' => 'required|in:active,inactive',
                    ]);
                    
                    if ($validator->fails()) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'errors' => $validator->errors()->all(),
                        ];
                        return;
                    }
                    
                    try {
                        // Ensure we have all required fields with proper types
                        $departmentData = [
                            'name' => $row['name'],
                            'description' => $row['description'] ?? null,
                            'company_id' => (int)$row['company_id'],
                            'branch_id' => (int)$row['branch_id'],
                            'status' => $row['status'],
                        ];
                        
                        // Only add manager_id if it's not empty
                        if (!empty($row['manager_id'])) {
                            $departmentData['manager_id'] = (int)$row['manager_id'];
                        }
                        
                        // Create department
                        Department::create($departmentData);
                        
                        $importResults['success']++;
                    } catch (\Exception $e) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });
                
                DB::commit();
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Import completed successfully.',
                        'results' => $importResults,
                    ]);
                }
                
                return redirect()->route('organization.department.index')
                    ->with('success', 'Import completed successfully.')
                    ->with('results', $importResults);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Import transaction error: ' . $e->getMessage());
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'An error occurred during import: ' . $e->getMessage(),
                    ], 500);
                }
                
                return back()->with('error', 'An error occurred during import: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            Log::error('File reading error: ' . $e->getMessage());
            
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error reading the import file: ' . $e->getMessage(),
                ], 500);
            }
            
            return back()->with('error', 'Error reading the import file: ' . $e->getMessage());
        }
    }
}
