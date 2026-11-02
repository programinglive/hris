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
    public function index(Request $request)
    {
        $query = User::with([
            'roles',
            'brands',
            'workSchedules',
            'userDetails.position',
            'userDetails.department',
            'userDetails.branch',
            'userDetails.company',
        ])
            ->whereHas('roles', function ($builder) {
                $builder->where('name', 'employee');
            });

        if ($search = $request->input('search')) {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('userDetails', function ($details) use ($search) {
                        $details->where('employee_code', 'like', "%{$search}%");
                    });
            });
        }

        if ($status = $request->input('status')) {
            $query->whereHas('userDetails', function ($details) use ($status) {
                $details->where('status', $status);
            });
        }

        return Inertia::render('employee/index', [
            'employees' => $query->paginate(10)->withQueryString(),
            'filters' => $request->only(['search', 'status']),
        ]);
    }

    /**
     * Show the form for creating a new employee.
     */
    public function create()
    {
        return Inertia::render('employee/create', [
            'companies' => \App\Models\Company::select(['id', 'name'])->orderBy('name')->get(),
            'branches' => \App\Models\Branch::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
            'departments' => \App\Models\Department::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
            'positions' => \App\Models\Position::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
            'roles' => \App\Models\Role::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created employee in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            // Employee data lives on user_details, never on users.
            'employee_code' => 'nullable|string|max:64',
            'join_date' => 'nullable|date',
            'status' => 'nullable|in:active,inactive,on_leave,terminated',
            'branch_id' => 'nullable|exists:branches,id',
            'department_id' => 'nullable|exists:departments,id',
            'division_id' => 'nullable|exists:divisions,id',
            'sub_division_id' => 'nullable|exists:sub_divisions,id',
            'position_id' => 'nullable|exists:positions,id',
            'level_id' => 'nullable|exists:levels,id',
            'company_id' => 'nullable|exists:companies,id',
            'phone' => 'nullable|string|max:32',
            'address' => 'nullable|string',
        ]);

        // users has neither a phone nor a company_id column: phone lives on
        // user_details and company membership is resolved through it. Writing
        // them to users threw a SQL error on every create.
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(),
        ]);

        // Without this the create form's employee fields were silently dropped
        // and the new user never appeared in the employee list.
        $user->userDetails()->create([
            'company_id' => $validated['company_id'] ?? auth()->user()?->userDetails?->company_id,
            'employee_code' => $validated['employee_code'] ?? null,
            'status' => $validated['status'] ?? 'active',
            'join_date' => $validated['join_date'] ?? null,
            'branch_id' => $validated['branch_id'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'division_id' => $validated['division_id'] ?? null,
            'sub_division_id' => $validated['sub_division_id'] ?? null,
            'position_id' => $validated['position_id'] ?? null,
            'level_id' => $validated['level_id'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'email' => $validated['email'],
        ]);

        // Assign the employee role. user_roles.company_id is NOT NULL, so the
        // pivot needs the role's company; hardcoding role id 1 also failed
        // whenever the seeded roles had different ids.
        $employeeRole = \App\Models\Role::where('name', 'employee')->orderBy('id')->first();

        if ($employeeRole) {
            $user->roles()->attach($employeeRole->id, [
                'company_id' => $employeeRole->company_id,
            ]);
        }

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
            'employee' => $user->load([
                'roles', 'brands', 'workSchedules', 'userDetails.position',
                'userDetails.department', 'userDetails.branch', 'userDetails.company',
            ]),
            'companies' => \App\Models\Company::select(['id', 'name'])->orderBy('name')->get(),
            'branches' => \App\Models\Branch::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
            'departments' => \App\Models\Department::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
            'positions' => \App\Models\Position::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
            'roles' => \App\Models\Role::select(['id', 'name', 'company_id'])->orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified employee in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|string|unique:users,phone,'.$user->id,
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
