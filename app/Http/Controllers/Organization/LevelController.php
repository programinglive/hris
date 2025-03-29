<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        // Query all levels without company filtering
        $query = Level::query();
        
        // Apply filters if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        // Get levels with pagination
        $levels = $query->with(['company'])
                      ->orderBy('level_order')
                      ->paginate(10)
                      ->withQueryString();
        
        return Inertia::render('organization/level/index', [
            'levels' => $levels,
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        // Get companies for dropdown
        $companies = Company::orderBy('name')->get();
        
        return Inertia::render('organization/level/create', [
            'companies' => $companies,
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
            'level_order' => 'required|integer|min:0',
            'company_id' => 'required|exists:companies,id',
            'status' => 'required|in:active,inactive',
        ]);
        
        Level::create($validated);
        
        return redirect()->route('organization.level.index')
            ->with('success', 'Level created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level): Response
    {
        $level->load(['company', 'positions']);
        
        return Inertia::render('organization/level/show', [
            'level' => $level,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level): Response
    {
        $level->load(['company']);
        
        // Get companies for dropdown
        $companies = Company::orderBy('name')->get();
        
        return Inertia::render('organization/level/edit', [
            'level' => $level,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level_order' => 'required|integer|min:0',
            'company_id' => 'required|exists:companies,id',
            'status' => 'required|in:active,inactive',
        ]);
        
        $level->update($validated);
        
        return redirect()->route('organization.level.index')
            ->with('success', 'Level updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level): RedirectResponse
    {
        // Check if level has positions
        if ($level->positions()->count() > 0) {
            return redirect()->route('organization.level.index')
                ->with('error', 'Cannot delete level with positions. Please delete positions first.');
        }
        
        $level->delete();
        
        return redirect()->route('organization.level.index')
            ->with('success', 'Level deleted successfully.');
    }

    /**
     * Show the import form.
     */
    public function import()
    {
        // Get companies for dropdown
        $companies = Company::orderBy('name')->get();
        
        // Return JSON response for the dialog component
        return response()->json([
            'companies' => $companies,
        ]);
    }

    /**
     * Download import template.
     */
    public function downloadTemplate()
    {
        $filename = 'level_import_template.xlsx';
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
            'level_order' => 'level_order',
            'company_id' => 'company_id',
            'status' => 'status'
        ]);
        
        // Add sample data row
        $writer->addRow([
            'name' => 'Sample Level',
            'description' => 'Sample Description',
            'level_order' => '1',
            'company_id' => 'Enter Company ID',
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
            'company_id' => 'nullable|exists:companies,id',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $file = $request->file('file');
        $companyId = $request->input('company_id');
        
        // Process the file
        $path = $file->getRealPath();
        $reader = SimpleExcelReader::create($path);
        
        $total = 0;
        $success = 0;
        $failed = 0;
        $errors = [];
        
        $reader->getRows()->each(function (array $row) use (&$total, &$success, &$failed, &$errors, $companyId) {
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
                'level_order' => 'required|integer|min:0',
                'company_id' => 'required_without:' . $companyId . '|exists:companies,id',
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
                // Create the level
                Level::create([
                    'name' => $row['name'],
                    'description' => $row['description'] ?? null,
                    'level_order' => $row['level_order'],
                    'company_id' => $companyId ?: $row['company_id'],
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
        
        return redirect()->route('organization.level.index')
            ->with('success', "Import completed. {$success} of {$total} levels imported successfully.");
    }
}
