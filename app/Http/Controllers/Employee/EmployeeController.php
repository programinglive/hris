<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index()
    {
        $employees = User::with(['roles', 'brands', 'workSchedules'])
            ->whereHas('roles', function ($query) {
                $query->where('name', 'employee');
            })
            ->paginate(10);

        return Inertia::render('employee/index', [
            'employees' => $employees,
            'filters' => request()->only(['search', 'status'])
        ]);
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return Inertia::render('employee/create');
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'company_id' => 'required|exists:companies,id',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_id' => $validated['company_id'],
            'password' => bcrypt($validated['password']),
        ]);

        // Assign employee role
        $user->roles()->attach(1); // Assuming role_id 1 is 'employee'

        return redirect()->route('employee.index')->with('success', 'Employee created successfully');
    }

    /**
     * Display the specified employee.
     */
    public function show(User $user)
    {
        return Inertia::render('employee/show', [
            'employee' => $user->load(['roles', 'brands', 'workSchedules']),
        ]);
    }

    /**
     * Show the form for editing the specified employee.
     */
    public function edit(User $user)
    {
        return Inertia::render('employee/edit', [
            'employee' => $user->load(['roles', 'brands', 'workSchedules']),
        ]);
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|unique:users,phone,' . $user->id,
            'company_id' => 'required|exists:companies,id',
        ]);

        $user->update($validated);

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully');
    }

    /**
     * Remove the specified employee from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully');
    }

    /**
     * Assign a work schedule to an employee.
     */
    public function assignWorkSchedule(Request $request, User $user)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:work_schedules,id',
            'effective_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:effective_date',
        ]);

        // Check if the user already has an active schedule
        if ($user->workSchedules()->wherePivot('is_active', true)->exists()) {
            throw ValidationException::withMessages([
                'schedule_id' => 'The user already has an active work schedule.',
            ]);
        }

        // Assign the work schedule
        $user->workSchedules()->attach($validated['schedule_id'], [
            'effective_date' => $validated['effective_date'],
            'end_date' => $validated['end_date'],
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Work schedule assigned successfully.',
        ]);
    }

    /**
     * Remove a work schedule from an employee.
     */
    public function removeWorkSchedule(Request $request, User $user, WorkSchedule $schedule)
    {
        $user->workSchedules()->detach($schedule->id);

        return response()->json([
            'success' => true,
            'message' => 'Work schedule removed successfully.',
        ]);
    }
}
