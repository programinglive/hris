<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance\UserWorkShift;
use App\Models\Attendance\WorkShift;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Inertia\Response;

class UserWorkShiftController extends Controller
{
    /**
     * Display a listing of the user work shifts.
     */
    public function index(): Response
    {
        $userWorkShifts = UserWorkShift::with(['user', 'workShift'])
            ->orderBy('effective_date', 'desc')
            ->paginate(10);

        return Inertia::render('attendance/working-shift/assignment/Index', [
            'userWorkShifts' => $userWorkShifts,
        ]);
    }

    /**
     * Show the form for creating a new user work shift.
     */
    public function create(): Response
    {
        $users = User::with('userDetail')
            ->whereHas('userDetail', function ($query) {
                $query->where('status', 'active');
            })
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        $workShifts = WorkShift::orderBy('name')
            ->get(['id', 'name', 'start_time', 'end_time']);

        return Inertia::render('attendance/working-shift/assignment/Create', [
            'users' => $users,
            'workShifts' => $workShifts,
        ]);
    }

    /**
     * Store a newly created user work shift in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'work_shift_id' => 'required|exists:work_shifts,id',
            'effective_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:effective_date',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if there's an overlapping shift for this user
        $overlapping = UserWorkShift::where('user_id', $request->user_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('effective_date', '<=', $request->effective_date)
                        ->where(function ($q2) use ($request) {
                            $q2->whereNull('end_date')
                                ->orWhere('end_date', '>=', $request->effective_date);
                        });
                })->orWhere(function ($q) use ($request) {
                    if ($request->end_date) {
                        $q->where('effective_date', '<=', $request->end_date)
                            ->where(function ($q2) use ($request) {
                                $q2->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $request->end_date);
                            });
                    } else {
                        $q->where(function ($q2) {
                            $q2->whereNull('end_date')
                                ->orWhere('end_date', '>=', $request->effective_date);
                        });
                    }
                });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()
                ->with('error', 'There is already a work shift assigned to this user for the specified date range.')
                ->withInput();
        }

        UserWorkShift::create($validator->validated());

        return redirect()->route('user-work-shifts.index')
            ->with('success', 'Work shift assigned successfully.');
    }

    /**
     * Display the specified user work shift.
     */
    public function show(UserWorkShift $userWorkShift): Response
    {
        $userWorkShift->load(['user', 'workShift']);
        
        return Inertia::render('attendance/working-shift/assignment/Show', [
            'userWorkShift' => $userWorkShift,
        ]);
    }

    /**
     * Show the form for editing the specified user work shift.
     */
    public function edit(UserWorkShift $userWorkShift): Response
    {
        $userWorkShift->load(['user', 'workShift']);
        
        $users = User::with('userDetail')
            ->whereHas('userDetail', function ($query) {
                $query->where('status', 'active');
            })
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        $workShifts = WorkShift::orderBy('name')
            ->get(['id', 'name', 'start_time', 'end_time']);

        return Inertia::render('attendance/working-shift/assignment/Edit', [
            'userWorkShift' => $userWorkShift,
            'users' => $users,
            'workShifts' => $workShifts,
        ]);
    }

    /**
     * Update the specified user work shift in storage.
     */
    public function update(Request $request, UserWorkShift $userWorkShift): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'work_shift_id' => 'required|exists:work_shifts,id',
            'effective_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:effective_date',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if there's an overlapping shift for this user (excluding this one)
        $overlapping = UserWorkShift::where('user_id', $request->user_id)
            ->where('id', '!=', $userWorkShift->id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('effective_date', '<=', $request->effective_date)
                        ->where(function ($q2) use ($request) {
                            $q2->whereNull('end_date')
                                ->orWhere('end_date', '>=', $request->effective_date);
                        });
                })->orWhere(function ($q) use ($request) {
                    if ($request->end_date) {
                        $q->where('effective_date', '<=', $request->end_date)
                            ->where(function ($q2) use ($request) {
                                $q2->whereNull('end_date')
                                    ->orWhere('end_date', '>=', $request->end_date);
                            });
                    } else {
                        $q->where(function ($q2) {
                            $q2->whereNull('end_date')
                                ->orWhere('end_date', '>=', $request->effective_date);
                        });
                    }
                });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->back()
                ->with('error', 'There is already a work shift assigned to this user for the specified date range.')
                ->withInput();
        }

        $userWorkShift->update($validator->validated());

        return redirect()->route('user-work-shifts.index')
            ->with('success', 'Work shift assignment updated successfully.');
    }

    /**
     * Remove the specified user work shift from storage.
     */
    public function destroy(UserWorkShift $userWorkShift): RedirectResponse
    {
        $userWorkShift->delete();

        return redirect()->route('user-work-shifts.index')
            ->with('success', 'Work shift assignment deleted successfully.');
    }
}
