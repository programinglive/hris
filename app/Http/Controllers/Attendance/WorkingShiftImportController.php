<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WorkingShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class WorkingShiftImportController extends Controller
{
    /**
     * Show the import form
     */
    public function showImportForm()
    {
        return Inertia::render('attendance/working-shift/import');
    }

    /**
     * Download import template
     */
    public function downloadTemplate()
    {
        $fileName = 'working_shift_import_template.xlsx';
        $filePath = Storage::path('templates/' . $fileName);
        
        // Create directory if it doesn't exist
        if (!Storage::exists('templates')) {
            Storage::makeDirectory('templates');
        }
        
        // Create the template file
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add header row
        $writer->addRow([
            'name' => 'Morning Shift',
            'code' => 'SHIFT-MOR',
            'start_time' => '08:00',
            'end_time' => '17:00',
            'break_duration' => '60',
            'description' => 'Standard morning shift with 1-hour lunch break',
            'is_active' => 'yes',
        ]);
        
        // Add another example row
        $writer->addRow([
            'name' => 'Night Shift',
            'code' => 'SHIFT-NGT',
            'start_time' => '22:00',
            'end_time' => '07:00',
            'break_duration' => '45',
            'description' => 'Night shift with 45-minute break',
            'is_active' => 'no',
        ]);
        
        return response()->download($filePath, $fileName);
    }

    /**
     * Process the import file
     */
    public function processImport(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);
        
        // Get the user's company
        $userDetail = Auth::user()->detail;
        if (!$userDetail) {
            return back()->with('error', 'User details not found');
        }
        
        $company = Company::find($userDetail->company_id);
        if (!$company) {
            return back()->with('error', 'Company not found');
        }
        
        // Process the file
        $file = $request->file('file');
        $filePath = $file->getPathname();
        
        try {
            // Start transaction
            DB::beginTransaction();
            
            $reader = SimpleExcelReader::create($filePath);
            
            $rowCount = 0;
            $successCount = 0;
            $errorRows = [];
            
            $reader->getRows()->each(function (array $rowData) use ($company, &$rowCount, &$successCount, &$errorRows) {
                $rowCount++;
                
                // Validate the row data
                $validator = Validator::make($rowData, [
                    'name' => 'required|string|max:255',
                    'code' => 'required|string|max:50',
                    'start_time' => 'required|date_format:H:i',
                    'end_time' => 'required|date_format:H:i',
                    'break_duration' => 'required|integer|min:0|max:480',
                    'description' => 'nullable|string',
                    'is_active' => 'required|in:yes,no,true,false,1,0',
                ]);
                
                if ($validator->fails()) {
                    $errorRows[] = [
                        'row' => $rowCount,
                        'data' => $rowData,
                        'errors' => $validator->errors()->toArray(),
                    ];
                    return;
                }
                
                // Convert is_active to boolean
                $isActive = in_array(strtolower($rowData['is_active']), ['yes', 'true', '1']);
                
                // Check if code already exists for this company
                $existingShift = WorkingShift::where('code', $rowData['code'])
                    ->where('company_id', $company->id)
                    ->first();
                
                if ($existingShift) {
                    // Update existing shift
                    $existingShift->update([
                        'name' => $rowData['name'],
                        'start_time' => $rowData['start_time'],
                        'end_time' => $rowData['end_time'],
                        'break_duration' => $rowData['break_duration'],
                        'description' => $rowData['description'] ?? null,
                        'is_active' => $isActive,
                    ]);
                } else {
                    // Create new shift
                    WorkingShift::create([
                        'name' => $rowData['name'],
                        'code' => $rowData['code'],
                        'start_time' => $rowData['start_time'],
                        'end_time' => $rowData['end_time'],
                        'break_duration' => $rowData['break_duration'],
                        'description' => $rowData['description'] ?? null,
                        'is_active' => $isActive,
                        'company_id' => $company->id,
                    ]);
                }
                
                $successCount++;
            });
            
            // Commit transaction
            DB::commit();
            
            // Return response
            return back()->with([
                'success' => true,
                'message' => "Import completed: {$successCount} working shifts imported successfully, " . count($errorRows) . " rows had errors.",
                'errors' => $errorRows,
            ]);
            
        } catch (\Exception $e) {
            // Rollback transaction
            DB::rollBack();
            
            return back()->with([
                'error' => 'Import failed: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Export working shifts to Excel
     */
    public function export()
    {
        // Get the user's company
        $userDetail = Auth::user()->detail;
        if (!$userDetail) {
            return back()->with('error', 'User details not found');
        }
        
        $company = Company::find($userDetail->company_id);
        if (!$company) {
            return back()->with('error', 'Company not found');
        }
        
        // Get all working shifts for the company
        $workingShifts = WorkingShift::where('company_id', $company->id)->get();
        
        // Create the export file
        $fileName = 'working_shifts_export_' . date('Y-m-d_His') . '.xlsx';
        $filePath = Storage::path('exports/' . $fileName);
        
        // Create directory if it doesn't exist
        if (!Storage::exists('exports')) {
            Storage::makeDirectory('exports');
        }
        
        // Create the Excel file
        $writer = SimpleExcelWriter::create($filePath);
        
        // Add data rows
        foreach ($workingShifts as $shift) {
            $writer->addRow([
                'name' => $shift->name,
                'code' => $shift->code,
                'start_time' => $shift->start_time,
                'end_time' => $shift->end_time,
                'break_duration' => $shift->break_duration,
                'description' => $shift->description ?? '',
                'is_active' => $shift->is_active ? 'yes' : 'no',
            ]);
        }
        
        return response()->download($filePath, $fileName);
    }
}
