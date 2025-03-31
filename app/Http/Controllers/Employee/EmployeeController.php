<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Company;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Department;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Level;
use App\Models\WorkShift;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;

class EmployeeController extends Controller
{
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
    // ... rest of the code remains the same ...
}
