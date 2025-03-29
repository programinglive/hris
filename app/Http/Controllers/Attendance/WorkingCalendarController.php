<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use App\Models\WorkingCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WorkingCalendarController extends Controller
{
    /**
     * Display a listing of the working calendars.
     */
    public function index()
    {
        $workingCalendars = WorkingCalendar::where('company_id', Auth::user()->company_id)
            ->orderBy('start_date', 'desc')
            ->get();

        $holidays = Holiday::where('company_id', Auth::user()->company_id)
            ->orderBy('date')
            ->get();

        return Inertia::render('attendance/working-calendar/index', [
            'pageTitle' => 'Working Calendar Lists',
            'workingCalendars' => $workingCalendars,
            'holidays' => $holidays,
        ]);
    }

    /**
     * Show the form for creating a new working calendar.
     */
    public function create()
    {
        return Inertia::render('attendance/working-calendar/create', [
            'pageTitle' => 'Create Working Calendar',
        ]);
    }

    /**
     * Store a newly created working calendar in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['company_id'] = Auth::user()->company_id;

        WorkingCalendar::create($validated);

        return redirect()->route('attendance.working-calendar.index')
            ->with('success', 'Working calendar created successfully.');
    }

    /**
     * Display the specified working calendar.
     */
    public function show($id)
    {
        $workingCalendar = WorkingCalendar::findOrFail($id);
        
        $holidays = Holiday::where('company_id', Auth::user()->company_id)
            ->whereDate('date', '>=', $workingCalendar->start_date)
            ->whereDate('date', '<=', $workingCalendar->end_date)
            ->orderBy('date')
            ->get();

        return Inertia::render('attendance/working-calendar/show', [
            'pageTitle' => 'Working Calendar Details',
            'workingCalendar' => $workingCalendar,
            'holidays' => $holidays,
        ]);
    }

    /**
     * Show the form for editing the specified working calendar.
     */
    public function edit($id)
    {
        $workingCalendar = WorkingCalendar::findOrFail($id);

        return Inertia::render('attendance/working-calendar/edit', [
            'pageTitle' => 'Edit Working Calendar',
            'workingCalendar' => $workingCalendar,
        ]);
    }

    /**
     * Update the specified working calendar in storage.
     */
    public function update(Request $request, $id)
    {
        $workingCalendar = WorkingCalendar::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $workingCalendar->update($validated);

        return redirect()->route('attendance.working-calendar.index')
            ->with('success', 'Working calendar updated successfully.');
    }

    /**
     * Remove the specified working calendar from storage.
     */
    public function destroy($id)
    {
        $workingCalendar = WorkingCalendar::findOrFail($id);
        $workingCalendar->delete();

        return redirect()->route('attendance.working-calendar.index')
            ->with('success', 'Working calendar deleted successfully.');
    }
}
