<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class SubDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        // Query all sub-divisions without company filtering
        $query = SubDivision::query();
        
        // Apply filters if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('division', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        if ($request->filled('division_id')) {
            $query->where('division_id', $request->input('division_id'));
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        // Get sub-divisions with pagination
        $subdivisions = $query->with(['division.department', 'manager'])
                          ->orderBy('name')
                          ->paginate(10)
                          ->withQueryString();
        
        // Get divisions for filter dropdown
        $divisions = Division::with('department')->orderBy('name')->get();
        
        return Inertia::render('organization/subdivision/index', [
            'subdivisions' => $subdivisions,
            'divisions' => $divisions,
            'filters' => $request->only(['search', 'division_id', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|RedirectResponse
    {
        // Get divisions
        $divisions = Division::orderBy('name')->get();
        
        if ($divisions->isEmpty()) {
            return redirect()->route('organization.division.index')
                ->with('error', 'You must create at least one division before creating sub-divisions.');
        }
        
        // Get all potential managers
        $managers = User::all();
        
        return Inertia::render('organization/subdivision/create', [
            'divisions' => $divisions,
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
            'division_id' => 'required|exists:divisions,id',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);
        
        SubDivision::create($validated);
        
        return redirect()->route('organization.subdivision.index')
            ->with('success', 'Sub-division created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubDivision $subdivision): Response
    {
        $subdivision->load(['division.department', 'manager']);
        
        return Inertia::render('organization/subdivision/show', [
            'subdivision' => $subdivision,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubDivision $subdivision): Response
    {
        $subdivision->load(['division.department', 'manager']);
        
        // Get all divisions
        $divisions = Division::orderBy('name')->get();
        
        // Get all potential managers
        $managers = User::all();
        
        return Inertia::render('organization/subdivision/edit', [
            'subdivision' => $subdivision,
            'divisions' => $divisions,
            'managers' => $managers,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubDivision $subdivision): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'division_id' => 'required|exists:divisions,id',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);
        
        $subdivision->update($validated);
        
        return redirect()->route('organization.subdivision.index')
            ->with('success', 'Sub-division updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubDivision $subdivision): RedirectResponse
    {
        // Check if subdivision has positions
        if ($subdivision->positions()->count() > 0) {
            return redirect()->route('organization.subdivision.index')
                ->with('error', 'Cannot delete sub-division with positions. Please delete positions first.');
        }
        
        $subdivision->delete();
        
        return redirect()->route('organization.subdivision.index')
            ->with('success', 'Sub-division deleted successfully.');
    }

    /**
     * Show the import form.
     */
    public function import(): Response
    {
        // Get divisions for filter dropdown
        $divisions = Division::orderBy('name')->get();

        return Inertia::render('organization/subdivision/import', [
            'divisions' => $divisions,
        ]);
    }

    /**
     * Download import template.
     */
    public function downloadTemplate()
    {
        $filename = 'subdivision_import_template.xlsx';
        $path = storage_path('app/temp');
        
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        
        $filepath = $path . '/' . $filename;
        
        $writer = SimpleExcelWriter::create($filepath);
        
        // Add header row
        $writer->addRow([
            'name' => 'name',
            'description' => 'description',
            'division_id' => 'division_id',
            'manager_id' => 'manager_id',
            'status' => 'status'
        ]);
        
        // Add sample data row
        $writer->addRow([
            'name' => 'Sample Sub-Division',
            'description' => 'Sample Description',
            'division_id' => 'Enter Division ID',
            'manager_id' => 'Enter Manager ID (optional)',
            'status' => 'active'
        ]);
        
        // Close the writer
        $writer->close();
        
        return response()->download($filepath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Process the import.
     */
    public function processImport(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
            'division_id' => 'nullable|exists:divisions,id',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $file = $request->file('file');
        $divisionId = $request->input('division_id');
        
        // Process the file
        $path = $file->getRealPath();
        $reader = SimpleExcelReader::create($path);
        
        $total = 0;
        $success = 0;
        $failed = 0;
        $errors = [];
        
        $reader->getRows()->each(function (array $row) use (&$total, &$success, &$failed, &$errors, $divisionId) {
            $total++;
            
            // Skip header row if it exists
            if (isset($row['name']) && $row['name'] === 'name') {
                $total--;
                return;
            }
            
            // Validate row data
            $rowValidator = Validator::make($row, [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'division_id' => 'required_without:' . $divisionId . '|exists:divisions,id',
                'manager_id' => 'nullable|exists:users,id',
                'status' => 'required|in:active,inactive',
            ]);
            
            if ($rowValidator->fails()) {
                $failed++;
                $errors[] = [
                    'row' => $total,
                    'name' => $row['name'] ?? 'Unknown',
                    'errors' => $rowValidator->errors()->all(),
                ];
                return;
            }
            
            try {
                // Create the subdivision
                SubDivision::create([
                    'name' => $row['name'],
                    'description' => $row['description'] ?? null,
                    'division_id' => $divisionId ?: $row['division_id'],
                    'manager_id' => $row['manager_id'] ?? null,
                    'status' => $row['status'],
                ]);
                
                $success++;
            } catch (\Exception $e) {
                $failed++;
                $errors[] = [
                    'row' => $total,
                    'name' => $row['name'] ?? 'Unknown',
                    'errors' => [$e->getMessage()],
                ];
            }
        });
        
        $reader->close();
        
        // Return response based on request type
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Import completed successfully.',
                'results' => [
                    'total' => $total,
                    'success' => $success,
                    'failed' => $failed,
                    'errors' => $errors,
                ],
            ]);
        }
        
        return redirect()->route('organization.subdivision.index')
            ->with('success', "Import completed. {$success} of {$total} sub-divisions imported successfully.");
    }
}
