<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaveRequestRequest;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the leave requests.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'user_id', 'leave_type_id']);

        $query = LeaveRequest::query()
            ->with(['user', 'leaveType'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if (isset($filters['search']) && $filters['search'] !== '') {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('leaveType', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if (isset($filters['status']) && $filters['status'] !== '') {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['leave_type_id']) && $filters['leave_type_id'] !== '') {
            $query->where('leave_type_id', $filters['leave_type_id']);
        }

        $leaveRequests = $query->paginate(10);

        return Inertia::render('attendance/leave/index', [
            'auth' => Auth::user(),
            'leaveRequests' => $leaveRequests,
            'leaveTypes' => LeaveType::all(),
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new leave request.
     */
    public function create()
    {
        $leaveTypes = LeaveType::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/leave/create', [
            'leaveTypes' => $leaveTypes,
        ]);
    }

    /**
     * Store a newly created leave request in storage.
     */
    public function store(StoreLeaveRequestRequest $request)
    {
        $validated = $request->validated();

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Check leave balance
        $leaveBalance = LeaveBalance::where([
            'user_id' => Auth::id(),
            'leave_type_id' => $validated['leave_type_id'],
            'year' => $startDate->year,
        ])->first();

        if (! $leaveBalance || $leaveBalance->remaining_days < $totalDays) {
            return redirect()->back()->withErrors([
                'leave_type_id' => 'Insufficient leave balance.',
            ]);
        }

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'leave_type_id' => $validated['leave_type_id'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        return redirect()->route('attendance.leave.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    /**
     * Show the specified leave request.
     */
    public function show(LeaveRequest $leave)
    {
        $leave->load(['user', 'leaveType']);

        return Inertia::render('attendance/leave/show', [
            'leave' => $leave,
        ]);
    }

    /**
     * Show the form for editing the specified leave request.
     */
    public function edit(LeaveRequest $leave)
    {
        $leaveTypes = LeaveType::where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return Inertia::render('attendance/leave/edit', [
            'leave' => $leave,
            'leaveTypes' => $leaveTypes,
        ]);
    }

    /**
     * Update the specified leave request in storage.
     */
    public function update(StoreLeaveRequestRequest $request, LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($leaveRequest->status !== 'pending') {
            return redirect()->back()->with('error', 'Cannot edit approved or rejected leave requests.');
        }

        $validated = $request->validated();

        $startDate = Carbon::parse($validated['start_date']);
        $endDate = Carbon::parse($validated['end_date']);
        $totalDays = $startDate->diffInDays($endDate) + 1;

        // Check leave balance
        $leaveBalance = LeaveBalance::where([
            'user_id' => Auth::id(),
            'leave_type_id' => $validated['leave_type_id'],
            'year' => $startDate->year,
        ])->first();

        if (! $leaveBalance || $leaveBalance->remaining_days < $totalDays) {
            return redirect()->back()->withErrors([
                'leave_type_id' => 'Insufficient leave balance.',
            ]);
        }

        $leaveRequest->update([
            'leave_type_id' => $validated['leave_type_id'],
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'reason' => $validated['reason'],
        ]);

        return redirect()->route('attendance.leave.index')
            ->with('success', 'Leave request updated successfully.');
    }

    /**
     * Remove the specified leave request from storage.
     */
    public function destroy(LeaveRequest $leave)
    {
        $leave->delete();

        return redirect()->route('attendance.leave.index')
            ->with('success', 'Leave request deleted successfully.');
    }
}
