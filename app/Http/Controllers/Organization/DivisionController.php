<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        // Query all divisions without company filtering
        $query = Division::query();
        
        // Apply filters if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('department', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->filled('department_id')) {
            $query->where('department_id', $request->input('department_id'));
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        // Get divisions with their relationships as a simple array
        // instead of paginated collection since frontend handles pagination
        $divisions = $query->with(['department', 'manager'])
                          ->withCount('subDivisions')
                          ->orderBy('name')
                          ->get();
        
        // Get all departments for filter dropdown
        $departments = Department::orderBy('name')->get();
        
        return Inertia::render('organization/division/index', [
            'divisions' => $divisions,
            'departments' => $departments,
            'filters' => $request->only(['search', 'department_id', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|RedirectResponse
    {
        // Get all departments
        $departments = Department::orderBy('name')->get();
        
        if ($departments->isEmpty()) {
            return redirect()->route('organization.department.index')
                ->with('error', 'You must create at least one department before creating divisions.');
        }
        
        // Get all potential managers
        $managers = User::all();
        
        return Inertia::render('organization/division/create', [
            'departments' => $departments,
            'managers' => $managers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);
        
        Division::create($validated);
        
        return redirect()->route('organization.division.index')
            ->with('success', 'Division created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division): Response
    {
        $division->load(['department', 'manager', 'subDivisions']);
        
        return Inertia::render('organization/division/show', [
            'division' => $division,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division): Response
    {
        $division->load(['department', 'manager']);
        
        // Get all departments
        $departments = Department::orderBy('name')->get();
        
        // Get all potential managers
        $managers = User::all();
        
        return Inertia::render('organization/division/edit', [
            'division' => $division,
            'departments' => $departments,
            'managers' => $managers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);
        
        $division->update($validated);
        
        return redirect()->route('organization.division.index')
            ->with('success', 'Division updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division): RedirectResponse
    {
        // Check if division has sub-divisions
        if ($division->subDivisions()->count() > 0) {
            return redirect()->route('organization.division.index')
                ->with('error', 'Cannot delete division with sub-divisions. Please delete sub-divisions first.');
        }
        
        $division->delete();
        
        return redirect()->route('organization.division.index')
            ->with('success', 'Division deleted successfully.');
    }

    /**
     * Download the import template for divisions.
     */
    public function downloadTemplate()
    {
        // Create the file
        $filename = 'division_import_template.xlsx';
        $tempPath = storage_path('app/temp/' . $filename);
        
        // Ensure the directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        // Create a writer and add the headers
        $writer = SimpleExcelWriter::create($tempPath);
        
        // Add headers by adding a row with the header values
        $writer->addRow([
            'name' => 'Name*',
            'description' => 'Description',
            'department_id' => 'Department ID*',
            'manager_id' => 'Manager ID',
            'status' => 'Status*'
        ]);
        
        // Add example data
        $writer->addRow([
            'name' => 'Example Division',
            'description' => 'Division Description',
            'department_id' => '1',
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
     * Process the imported division file
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
        
        if (!$request->hasFile('file')) {
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
                $reader->getRows()->each(function(array $row) use (&$importResults) {
                    $importResults['total']++;
                    
                    // Skip header row if it exists
                    if (isset($row['name']) && $row['name'] === 'Name*') {
                        return;
                    }
                    
                    // Skip empty rows
                    if (empty($row['name']) && empty($row['department_id'])) {
                        return;
                    }
                    
                    // Validate row data
                    $validator = Validator::make($row, [
                        'name' => 'required|string|max:255',
                        'description' => 'nullable|string',
                        'department_id' => 'required|exists:departments,id',
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
                        $divisionData = [
                            'name' => $row['name'],
                            'description' => $row['description'] ?? null,
                            'department_id' => (int)$row['department_id'],
                            'status' => $row['status'],
                        ];
                        
                        // Only add manager_id if it's not empty
                        if (!empty($row['manager_id'])) {
                            $divisionData['manager_id'] = (int)$row['manager_id'];
                        }
                        
                        // Create division
                        Division::create($divisionData);
                        
                        $importResults['success']++;
                    } catch (\Exception $e) {
                        Log::error('Error creating division: ' . $e->getMessage());
                        $importResults['failed']++;
                        $importResults['errors'][] = [
                            'row' => $importResults['total'],
                            'name' => $row['name'] ?? 'Unknown',
                            'errors' => [$e->getMessage()],
                        ];
                    }
                });
                
                DB::commit();
                
                return back()->with([
                    'success' => true,
                    'message' => "Import completed: {$importResults['success']} divisions imported successfully, {$importResults['failed']} failed.",
                    'results' => $importResults,
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Import transaction error: ' . $e->getMessage());
                
                return back()->with([
                    'success' => false,
                    'message' => 'An error occurred during import: ' . $e->getMessage(),
                ]);
            }
        } catch (\Exception $e) {
            // Handle file reading errors
            Log::error('File reading error: ' . $e->getMessage());
            
            return back()->with([
                'success' => false,
                'message' => 'Error reading the import file: ' . $e->getMessage(),
            ]);
        }
    }
}
