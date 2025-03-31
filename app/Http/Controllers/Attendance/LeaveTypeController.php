<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the leave types.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status']);

        $query = LeaveType::query()
            ->with('company')
            ->orderBy('name');

        if (isset($filters['search']) && $filters['search'] !== '') {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('is_active', $filters['status'] === 'active');
        }

        $leaveTypes = $query->paginate(10)
            ->withQueryString();

        $companies = Company::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/leave/type/index', [
            'leaveTypes' => $leaveTypes,
            'companies' => $companies,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new leave type.
     */
    public function create()
    {
        $companies = Company::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/leave/type/create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created leave type in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:10|unique:leave_types,code',
            'description' => 'nullable|string|max:1000',
            'requires_approval' => 'required|boolean',
            'is_paid' => 'required|boolean',
            'default_days_per_year' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        LeaveType::create($validated);

        return redirect()->route('attendance.leave.type.index')
            ->with('success', 'Leave type created successfully.');
    }

    /**
     * Show the specified leave type.
     */
    public function show(LeaveType $type)
    {
        $type->load('company');

        return Inertia::render('attendance/leave/type/show', [
            'leaveType' => $type,
        ]);
    }

    /**
     * Show the form for editing the specified leave type.
     */
    public function edit(LeaveType $type)
    {
        $companies = Company::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/leave/type/edit', [
            'leaveType' => $type,
            'companies' => $companies,
        ]);
    }

    /**
     * Update the specified leave type in storage.
     */
    public function update(Request $request, LeaveType $type)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => [
                'nullable',
                'string',
                'max:10',
                Rule::unique('leave_types')->ignore($type->id),
            ],
            'description' => 'nullable|string|max:1000',
            'requires_approval' => 'required|boolean',
            'is_paid' => 'required|boolean',
            'default_days_per_year' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
            'company_id' => 'required|exists:companies,id',
        ]);

        $type->update($validated);

        return redirect()->route('attendance.leave.type.index')
            ->with('success', 'Leave type updated successfully.');
    }

    /**
     * Remove the specified leave type from storage.
     */
    public function destroy(LeaveType $type)
    {
        // Check if the leave type is being used by any leave requests
        if ($type->leaveRequests()->count() > 0) {
            return redirect()->route('attendance.leave.type.index')
                ->with('error', 'Cannot delete leave type that is being used by leave requests.');
        }

        // Check if the leave type is being used by any leave balances
        if ($type->leaveBalances()->count() > 0) {
            return redirect()->route('attendance.leave.type.index')
                ->with('error', 'Cannot delete leave type that is being used by leave balances.');
        }

        $type->delete();

        return redirect()->route('attendance.leave.type.index')
            ->with('success', 'Leave type deleted successfully.');
    }
}
