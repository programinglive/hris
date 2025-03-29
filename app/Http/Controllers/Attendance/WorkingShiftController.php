<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\WorkingShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class WorkingShiftController extends Controller
{
    /**
     * Display a listing of the working shifts.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = Auth::user();
        $companyId = $user->detail->company_id ?? null;
        
        $workingShifts = WorkingShift::where('company_id', $companyId)
            ->orderBy('name')
            ->get()
            ->map(function ($shift) {
                return [
                    'id' => $shift->id,
                    'name' => $shift->name,
                    'code' => $shift->code,
                    'start_time' => $shift->formatted_start_time,
                    'end_time' => $shift->formatted_end_time,
                    'break_duration' => $shift->break_duration,
                    'total_hours' => $shift->total_working_hours,
                    'description' => $shift->description,
                    'is_active' => $shift->is_active,
                ];
            });
        
        // If no working shifts exist, add some dummy data
        if ($workingShifts->isEmpty()) {
            $workingShifts = $this->getDummyWorkingShifts();
        }
        
        return Inertia::render('attendance/working-shift/index', [
            'workingShifts' => $workingShifts,
        ]);
    }

    /**
     * Store a newly created working shift in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:working_shifts',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'break_duration' => 'required|integer|min:0|max:240',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $companyId = $user->detail->company_id ?? null;
        
        WorkingShift::create([
            'name' => $request->name,
            'code' => $request->code,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'break_duration' => $request->break_duration,
            'description' => $request->description,
            'is_active' => $request->is_active ?? true,
            'company_id' => $companyId,
        ]);

        return redirect()->route('attendance.working-shift.index')->with('success', 'Working shift created successfully.');
    }

    /**
     * Display the specified working shift.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $companyId = $user->detail->company_id ?? null;
        
        $workingShift = WorkingShift::where('company_id', $companyId)
            ->findOrFail($id);
        
        return Inertia::render('attendance/working-shift/show', [
            'workingShift' => [
                'id' => $workingShift->id,
                'name' => $workingShift->name,
                'code' => $workingShift->code,
                'start_time' => $workingShift->formatted_start_time,
                'end_time' => $workingShift->formatted_end_time,
                'break_duration' => $workingShift->break_duration,
                'total_hours' => $workingShift->total_working_hours,
                'description' => $workingShift->description,
                'is_active' => $workingShift->is_active,
            ],
        ]);
    }

    /**
     * Update the specified working shift in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $companyId = $user->detail->company_id ?? null;
        
        $workingShift = WorkingShift::where('company_id', $companyId)
            ->findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:working_shifts,code,' . $id,
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'break_duration' => 'required|integer|min:0|max:240',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $workingShift->update([
            'name' => $request->name,
            'code' => $request->code,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'break_duration' => $request->break_duration,
            'description' => $request->description,
            'is_active' => $request->is_active ?? $workingShift->is_active,
        ]);

        return redirect()->route('attendance.working-shift.index')->with('success', 'Working shift updated successfully.');
    }

    /**
     * Remove the specified working shift from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $companyId = $user->detail->company_id ?? null;
        
        $workingShift = WorkingShift::where('company_id', $companyId)
            ->findOrFail($id);
        
        $workingShift->delete();

        return redirect()->route('attendance.working-shift.index')->with('success', 'Working shift deleted successfully.');
    }
    
    /**
     * Get dummy working shifts for demonstration purposes.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getDummyWorkingShifts()
    {
        return collect([
            [
                'id' => null,
                'name' => 'Morning Shift',
                'code' => 'SHIFT-MOR',
                'start_time' => '08:00',
                'end_time' => '17:00',
                'break_duration' => 60,
                'total_hours' => 8.0,
                'description' => 'Standard morning shift with 1-hour lunch break',
                'is_active' => true,
            ],
            [
                'id' => null,
                'name' => 'Afternoon Shift',
                'code' => 'SHIFT-AFT',
                'start_time' => '13:00',
                'end_time' => '22:00',
                'break_duration' => 60,
                'total_hours' => 8.0,
                'description' => 'Afternoon to evening shift with 1-hour dinner break',
                'is_active' => true,
            ],
            [
                'id' => null,
                'name' => 'Night Shift',
                'code' => 'SHIFT-NGT',
                'start_time' => '22:00',
                'end_time' => '07:00',
                'break_duration' => 60,
                'total_hours' => 8.0,
                'description' => 'Overnight shift with 1-hour break',
                'is_active' => true,
            ],
            [
                'id' => null,
                'name' => 'Half Day Morning',
                'code' => 'SHIFT-HDM',
                'start_time' => '08:00',
                'end_time' => '12:00',
                'break_duration' => 0,
                'total_hours' => 4.0,
                'description' => 'Half day morning shift with no break',
                'is_active' => true,
            ],
            [
                'id' => null,
                'name' => 'Half Day Afternoon',
                'code' => 'SHIFT-HDA',
                'start_time' => '13:00',
                'end_time' => '17:00',
                'break_duration' => 0,
                'total_hours' => 4.0,
                'description' => 'Half day afternoon shift with no break',
                'is_active' => true,
            ],
            [
                'id' => null,
                'name' => 'Weekend Shift',
                'code' => 'SHIFT-WKD',
                'start_time' => '10:00',
                'end_time' => '16:00',
                'break_duration' => 30,
                'total_hours' => 5.5,
                'description' => 'Weekend shift with 30-minute break',
                'is_active' => false,
            ],
        ]);
    }
}
