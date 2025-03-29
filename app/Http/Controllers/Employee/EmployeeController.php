<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class EmployeeController extends Controller
{
    /**
     * Show the import form
     */
    public function showImportForm()
    {
        // Get organization data from database for the template
        $companies = Company::select('id', 'name')->where('is_active', true)->get();
        $branches = Branch::select('id', 'name', 'company_id')->where('is_active', true)->get();
        $brands = Brand::select('id', 'name', 'company_id')->where('is_active', true)->get();
        $departments = Department::select('id', 'name', 'parent_id')->where('status', 'active')->get();
        $divisions = Division::select('id', 'name', 'department_id')->where('status', 'active')->get();
        $subdivisions = SubDivision::select('id', 'name', 'division_id')->where('status', 'active')->get();
        $positionLevels = Level::select('id', 'name')->where('status', 'active')->get();
        
        // Legacy data for backward compatibility
        $departmentNames = ['IT', 'Marketing', 'Finance', 'HR', 'Operations', 'Sales'];
        $positions = ['Manager', 'Specialist', 'Coordinator', 'Assistant', 'Director', 'System Administrator'];
        $statuses = ['Active', 'On Leave', 'Probation', 'Terminated'];
        $genders = ['Male', 'Female', 'Other'];
        $marital = ['Single', 'Married', 'Divorced', 'Widowed'];
        
        return Inertia::render('employee/import', [
            // Organization data
            'companies' => $companies,
            'branches' => $branches,
            'brands' => $brands,
            'departments' => $departments,
            'divisions' => $divisions,
            'subdivisions' => $subdivisions,
            'positionLevels' => $positionLevels,
            
            // Legacy data
            'departmentNames' => $departmentNames,
            'positions' => $positions,
            'statuses' => $statuses,
            'genders' => $genders,
            'maritalStatuses' => $marital,
        ]);
    }
    
    /**
     * Download template for employee import
     */
    public function downloadTemplate()
    {
        $templatePath = storage_path('app/public/templates');
        
        if (!file_exists($templatePath)) {
            mkdir($templatePath, 0755, true);
        }
        
        $filePath = $templatePath . '/employee_import_template.xlsx';
        
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add header row
        $writer->addRow([
            'name' => 'Employee Name',
            'email' => 'Email',
            'password' => 'Password',
            'employee_id' => 'Employee ID',
            'position' => 'Position',
            'department' => 'Department',
            'join_date' => 'Join Date (YYYY-MM-DD)',
            'status' => 'Status',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date (YYYY-MM-DD)',
            'marital_status' => 'Marital Status',
            'phone' => 'Phone',
            'address' => 'Address',
            'emergency_contact_name' => 'Emergency Contact Name',
            'emergency_contact_relationship' => 'Emergency Contact Relationship',
            'emergency_contact_phone' => 'Emergency Contact Phone',
        ]);
        
        // Add sample data
        $writer->addRow([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
            'employee_id' => 'EMP001',
            'position' => 'Manager',
            'department' => 'IT',
            'join_date' => '2023-01-15',
            'status' => 'Active',
            'gender' => 'Male',
            'birth_date' => '1990-05-20',
            'marital_status' => 'Married',
            'phone' => '1234567890',
            'address' => '123 Main St, City',
            'emergency_contact_name' => 'Jane Doe',
            'emergency_contact_relationship' => 'Spouse',
            'emergency_contact_phone' => '0987654321',
        ]);
        
        return response()->download($filePath, 'employee_import_template.xlsx');
    }
    
    /**
     * Process the imported file
     */
    public function processImport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,csv,txt|max:10240', // max 10MB
        ]);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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
                    if (isset($row['name']) && (strtolower($row['name']) === 'name' || strtolower($row['name']) === 'employee name')) {
                        return;
                    }
                    
                    // Validate row data
                    $validator = Validator::make($row, [
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:8',
                        'employee_id' => 'required|string|max:50|unique:user_details',
                        'position' => 'nullable|string|max:100',
                        'department' => 'nullable|string|max:100',
                        'join_date' => 'nullable|date',
                        'status' => 'required|string|max:50',
                        'gender' => 'nullable|string|max:20',
                        'birth_date' => 'nullable|date',
                        'marital_status' => 'nullable|string|max:20',
                        'phone' => 'nullable|string|max:20',
                        'address' => 'nullable|string|max:255',
                        'emergency_contact_name' => 'nullable|string|max:100',
                        'emergency_contact_relationship' => 'nullable|string|max:50',
                        'emergency_contact_phone' => 'nullable|string|max:20',
                    ]);
                    
                    if ($validator->fails()) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'email' => $row['email'] ?? 'Unknown',
                            'errors' => $validator->errors()->all(),
                        ];
                        return;
                    }
                    
                    try {
                        // Create user
                        $user = User::create([
                            'name' => $row['name'],
                            'email' => $row['email'],
                            'password' => Hash::make($row['password']),
                        ]);
                        
                        // Create user details
                        UserDetail::create([
                            'user_id' => $user->id,
                            'employee_id' => $row['employee_id'],
                            'position' => $row['position'] ?? null,
                            'department' => $row['department'] ?? null,
                            'join_date' => $row['join_date'] ?? null,
                            'status' => $row['status'],
                            'gender' => $row['gender'] ?? null,
                            'birth_date' => $row['birth_date'] ?? null,
                            'marital_status' => $row['marital_status'] ?? null,
                            'phone' => $row['phone'] ?? null,
                            'address' => $row['address'] ?? null,
                            'emergency_contact_name' => $row['emergency_contact_name'] ?? null,
                            'emergency_contact_relationship' => $row['emergency_contact_relationship'] ?? null,
                            'emergency_contact_phone' => $row['emergency_contact_phone'] ?? null,
                        ]);
                        
                        $importResults['success']++;
                    } catch (\Exception $e) {
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'email' => $row['email'] ?? 'Unknown',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });
                
                DB::commit();
                
                $successMessage = "Import completed: {$importResults['success']} employees imported successfully, {$importResults['failed']} failed.";
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => $successMessage,
                        'results' => $importResults,
                    ]);
                }
                
                return redirect()->route('employee.index')
                    ->with('success', $successMessage)
                    ->with('importResults', $importResults);
                    
            } catch (\Exception $e) {
                DB::rollBack();
                
                if ($request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to process import file: ' . $e->getMessage(),
                    ], 500);
                }
                
                return redirect()->back()
                    ->with('error', 'Failed to process import file: ' . $e->getMessage())
                    ->withInput();
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error reading the import file: ' . $e->getMessage(),
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Error reading the import file: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users with employee role and their details
        $employees = User::with(['detail', 'detail.department', 'detail.position'])
            ->whereHas('detail')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'employee_id' => $user->detail->employee_id,
                    'position' => $user->detail->position ? $user->detail->position->name : null,
                    'department' => $user->detail->department ? $user->detail->department->name : null,
                    'join_date' => $user->detail->join_date ? $user->detail->join_date->format('Y-m-d') : null,
                    'status' => $user->detail->status,
                ];
            });
            
        return Inertia::render('employee/index', [
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get organization data from database
        $companies = Company::select('id', 'name')->where('is_active', true)->get();
        $branches = Branch::select('id', 'name', 'company_id')->where('is_active', true)->get();
        $brands = Brand::select('id', 'name', 'company_id')->where('is_active', true)->get();
        $departments = Department::select('id', 'name', 'parent_id')->where('status', 'active')->get();
        $divisions = Division::select('id', 'name', 'department_id')->where('status', 'active')->get();
        $subdivisions = SubDivision::select('id', 'name', 'division_id')->where('status', 'active')->get();
        $positionLevels = Level::select('id', 'name')->where('status', 'active')->get();
        
        // Legacy data for backward compatibility
        $departmentNames = ['IT', 'Marketing', 'Finance', 'HR', 'Operations', 'Sales'];
        $positions = ['Manager', 'Specialist', 'Coordinator', 'Assistant', 'Director', 'System Administrator'];
        $statuses = ['Active', 'On Leave', 'Probation', 'Terminated'];
        $genders = ['Male', 'Female', 'Other'];
        $marital = ['Single', 'Married', 'Divorced', 'Widowed'];
        
        return Inertia::render('employee/create', [
            // Organization data
            'companies' => $companies,
            'branches' => $branches,
            'brands' => $brands,
            'departments' => $departments,
            'divisions' => $divisions,
            'subdivisions' => $subdivisions,
            'positionLevels' => $positionLevels,
            
            // Legacy data
            'departmentNames' => $departmentNames,
            'positions' => $positions,
            'statuses' => $statuses,
            'genders' => $genders,
            'maritalStatuses' => $marital,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'employee_id' => 'required|string|max:50|unique:user_details',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'join_date' => 'nullable|date',
            'status' => 'required|string|max:50',
            'gender' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'marital_status' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_relationship' => 'nullable|string|max:50',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'company_id' => 'nullable|exists:companies,id',
            'branch_id' => 'nullable|exists:branches,id',
            'brand_id' => 'nullable|exists:brands,id',
            'department_id' => 'nullable|exists:departments,id',
            'division_id' => 'nullable|exists:divisions,id',
            'sub_division_id' => 'nullable|exists:sub_divisions,id',
            'position_level_id' => 'nullable|exists:levels,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Create user details
            UserDetail::create([
                'user_id' => $user->id,
                'employee_id' => $request->employee_id,
                'position' => $request->position,
                'department' => $request->department,
                'join_date' => $request->join_date,
                'status' => $request->status,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'marital_status' => $request->marital_status,
                'phone' => $request->phone,
                'address' => $request->address,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_relationship' => $request->emergency_contact_relationship,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'profile_image' => $request->profile_image ?? null,
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
                'brand_id' => $request->brand_id,
                'department_id' => $request->department_id,
                'division_id' => $request->division_id,
                'sub_division_id' => $request->sub_division_id,
                'position_level_id' => $request->position_level_id,
            ]);

            DB::commit();

            return redirect()->route('employee.index')
                ->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to create employee. ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with([
            'detail', 
            'detail.department', 
            'detail.position',
            'detail.company',
            'detail.branch',
            'detail.division',
            'detail.subDivision',
            'detail.level'
        ])->findOrFail($id);
        
        // Check if user detail exists
        if (!$user->detail) {
            return redirect()->route('employee.index')
                ->with('error', 'Employee details not found.');
        }
        
        $employee = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'employee_id' => $user->detail->employee_id ?? null,
            'phone' => $user->detail->phone ?? null,
            'address' => $user->detail->address ?? null,
            'position' => $user->detail->position ? $user->detail->position->name : null,
            'department' => $user->detail->department ? $user->detail->department->name : null,
            'division' => $user->detail->division ? $user->detail->division->name : null,
            'sub_division' => $user->detail->subDivision ? $user->detail->subDivision->name : null,
            'level' => $user->detail->level ? $user->detail->level->name : null,
            'company' => $user->detail->company ? $user->detail->company->name : null,
            'branch' => $user->detail->branch ? $user->detail->branch->name : null,
            'join_date' => $user->detail->join_date ? $user->detail->join_date->format('Y-m-d') : null,
            'exit_date' => $user->detail->exit_date ? $user->detail->exit_date->format('Y-m-d') : null,
            'status' => $user->detail->status ?? 'inactive',
            'gender' => $user->detail->gender ?? null,
            'birth_date' => $user->detail->birth_date ? $user->detail->birth_date->format('Y-m-d') : null,
            'marital_status' => $user->detail->marital_status ?? null,
            'profile_image' => $user->detail->profile_image ?? null,
            'emergency_contact' => [
                'name' => $user->detail->emergency_contact_name ?? null,
                'relationship' => $user->detail->emergency_contact_relationship ?? null,
                'phone' => $user->detail->emergency_contact_phone ?? null,
            ],
        ];
        
        return Inertia::render('employee/details', [
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('detail')->findOrFail($id);
        
        // Get organization data from database
        $companies = Company::select('id', 'name')->where('is_active', true)->get();
        $branches = Branch::select('id', 'name', 'company_id')->where('is_active', true)->get();
        $brands = Brand::select('id', 'name', 'company_id')->where('is_active', true)->get();
        $departments = Department::select('id', 'name', 'parent_id')->where('status', 'active')->get();
        $divisions = Division::select('id', 'name', 'department_id')->where('status', 'active')->get();
        $subdivisions = SubDivision::select('id', 'name', 'division_id')->where('status', 'active')->get();
        $positionLevels = Level::select('id', 'name')->where('status', 'active')->get();
        
        // Legacy data for backward compatibility
        $departmentNames = ['IT', 'Marketing', 'Finance', 'HR', 'Operations', 'Sales'];
        $positions = ['Manager', 'Specialist', 'Coordinator', 'Assistant', 'Director', 'System Administrator'];
        $statuses = ['Active', 'On Leave', 'Probation', 'Terminated'];
        $genders = ['Male', 'Female', 'Other'];
        $marital = ['Single', 'Married', 'Divorced', 'Widowed'];
        
        $employee = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'employee_id' => $user->detail->employee_id ?? null,
            'position' => $user->detail->position ?? null,
            'department' => $user->detail->department ?? null,
            'join_date' => $user->detail->join_date ? $user->detail->join_date->format('Y-m-d') : null,
            'exit_date' => $user->detail->exit_date ? $user->detail->exit_date->format('Y-m-d') : null,
            'status' => $user->detail->status ?? null,
            'gender' => $user->detail->gender ?? null,
            'birth_date' => $user->detail->birth_date ? $user->detail->birth_date->format('Y-m-d') : null,
            'marital_status' => $user->detail->marital_status ?? null,
            'phone' => $user->detail->phone ?? null,
            'address' => $user->detail->address ?? null,
            'emergency_contact_name' => $user->detail->emergency_contact_name ?? null,
            'emergency_contact_relationship' => $user->detail->emergency_contact_relationship ?? null,
            'emergency_contact_phone' => $user->detail->emergency_contact_phone ?? null,
            'company_id' => $user->detail->company_id ?? null,
            'branch_id' => $user->detail->branch_id ?? null,
            'brand_id' => $user->detail->brand_id ?? null,
            'department_id' => $user->detail->department_id ?? null,
            'division_id' => $user->detail->division_id ?? null,
            'subdivision_id' => $user->detail->sub_division_id ?? null,
            'position_level_id' => $user->detail->position_level_id ?? null,
        ];

        return Inertia::render('employee/edit', [
            'employee' => $employee,
            // Organization data
            'companies' => $companies,
            'branches' => $branches,
            'brands' => $brands,
            'departments' => $departments,
            'divisions' => $divisions,
            'subdivisions' => $subdivisions,
            'positionLevels' => $positionLevels,
            
            // Legacy data
            'departmentNames' => $departmentNames,
            'positions' => $positions,
            'statuses' => $statuses,
            'genders' => $genders,
            'maritalStatuses' => $marital,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::with('detail')->findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'employee_id' => 'required|string|max:50|unique:user_details,employee_id,' . $user->detail->id,
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'join_date' => 'nullable|date',
            'exit_date' => 'nullable|date|after_or_equal:join_date',
            'status' => 'required|string|max:50',
            'gender' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'marital_status' => 'nullable|string|max:20',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:100',
            'emergency_contact_relationship' => 'nullable|string|max:50',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Update user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // Update user details
            $user->detail->update([
                'employee_id' => $request->employee_id,
                'position' => $request->position,
                'department' => $request->department,
                'join_date' => $request->join_date,
                'exit_date' => $request->exit_date,
                'status' => $request->status,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'marital_status' => $request->marital_status,
                'phone' => $request->phone,
                'address' => $request->address,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_relationship' => $request->emergency_contact_relationship,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'company_id' => $request->company_id,
                'branch_id' => $request->branch_id,
                'brand_id' => $request->brand_id,
                'department_id' => $request->department_id,
                'division_id' => $request->division_id,
                'sub_division_id' => $request->sub_division_id,
                'position_level_id' => $request->position_level_id,
            ]);

            DB::commit();

            return redirect()->route('employee.index')
                ->with('success', 'Employee updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to update employee. ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::with('detail')->findOrFail($id);

        DB::beginTransaction();

        try {
            // Delete user details first (due to foreign key constraint)
            if ($user->detail) {
                $user->detail->delete();
            }
            
            // Delete user
            $user->delete();

            DB::commit();

            return redirect()->route('employee.index')
                ->with('success', 'Employee deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to delete employee. ' . $e->getMessage());
        }
    }
}
