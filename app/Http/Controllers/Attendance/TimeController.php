<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Attendance\TimeLog;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TimeController extends Controller
{
    /**
     * Display a listing of the time logs.
     */
    public function index(Request $request): Response
    {
        // Query all time logs
        $query = TimeLog::query();
        
        // Apply filters if provided
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('check_in_time', '>=', $request->input('date_from'));
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('check_in_time', '<=', $request->input('date_to'));
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        
        // Get time logs with pagination
        $timeLogs = $query->with(['user', 'user.detail'])
                      ->orderByDesc('check_in_time')
                      ->paginate(10)
                      ->withQueryString();
        
        // Get users for filter dropdown
        $users = User::with('detail')->whereHas('detail', function($q) {
            $q->whereNotNull('employee_code');
        })->orderBy('name')->get(['id', 'name']);
        
        return Inertia::render('attendance/time/index', [
            'timeLogs' => $timeLogs,
            'users' => $users,
            'filters' => $request->only(['search', 'date_from', 'date_to', 'status']),
        ]);
    }
    
    /**
     * Show the form for creating a new time log.
     */
    public function create(): Response
    {
        $users = User::with('detail')->whereHas('detail', function($q) {
            $q->whereNotNull('employee_code');
        })->orderBy('name')->get(['id', 'name']);
        
        return Inertia::render('attendance/time/create', [
            'users' => $users,
        ]);
    }
    
    /**
     * Store a newly created time log in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date|after:check_in_time',
            'status' => 'required|in:present,late,absent,leave',
            'notes' => 'nullable|string|max:255',
        ]);
        
        TimeLog::create($validated);
        
        return redirect()->route('attendance.time.index')
            ->with('success', 'Time log created successfully.');
    }
    
    /**
     * Display the specified time log.
     */
    public function show(TimeLog $timeLog): Response
    {
        $timeLog->load('user', 'user.detail');
        
        return Inertia::render('attendance/time/show', [
            'timeLog' => $timeLog,
        ]);
    }
    
    /**
     * Show the form for editing the specified time log.
     */
    public function edit(TimeLog $timeLog): Response
    {
        $timeLog->load('user', 'user.detail');
        $users = User::with('detail')->whereHas('detail', function($q) {
            $q->whereNotNull('employee_code');
        })->orderBy('name')->get(['id', 'name']);
        
        return Inertia::render('attendance/time/edit', [
            'timeLog' => $timeLog,
            'users' => $users,
        ]);
    }
    
    /**
     * Update the specified time log in storage.
     */
    public function update(Request $request, TimeLog $timeLog): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'check_in_time' => 'required|date',
            'check_out_time' => 'nullable|date|after:check_in_time',
            'status' => 'required|in:present,late,absent,leave',
            'notes' => 'nullable|string|max:255',
        ]);
        
        $timeLog->update($validated);
        
        return redirect()->route('attendance.time.index')
            ->with('success', 'Time log updated successfully.');
    }
    
    /**
     * Remove the specified time log from storage.
     */
    public function destroy(TimeLog $timeLog): RedirectResponse
    {
        $timeLog->delete();
        
        return redirect()->route('attendance.time.index')
            ->with('success', 'Time log deleted successfully.');
    }
}
