<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\WorkingShift;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class WorkShiftController extends Controller
{
    /**
     * Display a listing of the work shifts.
     */
    public function index(): Response
    {
        $workShifts = WorkingShift::with('company')
            ->orderBy('name')
            ->get();

        return Inertia::render('attendance/working-shift/index', [
            'workShifts' => $workShifts->map(function ($shift) {
                return [
                    ...$shift->toArray(),
                    'working_days_formatted' => $this->formatWorkingDays($shift->working_days),
                ];
            }),
        ]);
    }

    private function formatWorkingDays(array $workingDays): string
    {
        $days = [
            0 => 'Sun',
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
        ];

        return implode(', ', array_map(function ($day) use ($days) {
            return $days[$day];
        }, $workingDays));
    }

    /**
     * Show the form for creating a new work shift.
     */
    public function create(): Response
    {
        $companies = Company::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/working-shift/create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created work shift in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'grace_period_minutes' => 'nullable|integer|min:0|max:60',
            'working_days' => 'required|array',
            'working_days.*' => 'integer|min:0|max:6',
            'is_default' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If this is set as default, unset other defaults for this company
        if ($request->is_default) {
            WorkingShift::where('company_id', $request->company_id)
                ->where('is_default', true)
                ->update(['is_default' => false]);
        }

        WorkingShift::create($validator->validated());

        return redirect()->route('attendance.working-shift.index')
            ->with('success', 'Work shift created successfully.');
    }

    /**
     * Display the specified work shift.
     */
    public function show(WorkingShift $workShift): Response
    {
        $workShift->load('company');

        return Inertia::render('attendance/working-shift/show', [
            'workShift' => $workShift,
        ]);
    }

    /**
     * Show the form for editing the specified work shift.
     */
    public function edit(WorkingShift $workShift): Response
    {
        $companies = Company::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/working-shift/edit', [
            'workShift' => $workShift,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified work shift in storage.
     */
    public function update(WorkingShift $workShift, Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'grace_period_minutes' => 'nullable|integer|min:0|max:60',
            'working_days' => 'required|array',
            'working_days.*' => 'integer|min:0|max:6',
            'is_default' => 'boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // If this is set as default, unset other defaults for this company
        if ($request->is_default) {
            WorkingShift::where('company_id', $request->company_id)
                ->where('is_default', true)
                ->where('id', '!=', $workShift->id)
                ->update(['is_default' => false]);
        }

        $workShift->update($validator->validated());

        return redirect()->route('attendance.working-shift.index')
            ->with('success', 'Work shift updated successfully.');
    }

    /**
     * Remove the specified work shift from storage.
     */
    public function destroy(WorkingShift $workShift): RedirectResponse
    {
        // Check if this work shift is assigned to any users
        if ($workShift->users()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete this work shift as it is assigned to users.');
        }

        $workShift->delete();

        return redirect()->route('attendance.working-shift.index')
            ->with('success', 'Work shift deleted successfully.');
    }
}
