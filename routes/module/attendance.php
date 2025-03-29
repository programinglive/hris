<?php

use App\Http\Controllers\Attendance\LeaveRequestController;
use App\Http\Controllers\Attendance\LeaveTypeController;
use App\Http\Controllers\Attendance\TimeController;
use App\Http\Controllers\Attendance\UserWorkShiftController;
use App\Http\Controllers\Attendance\WorkingCalendarController;
use App\Http\Controllers\Attendance\WorkShiftController;
use Illuminate\Support\Facades\Route;

Route::prefix('attendance')->name('attendance.')->group(function () {
    // Time routes
    Route::prefix('time')->name('time.')->group(function () {
        Route::get('/', [TimeController::class, 'index'])->name('index');
        Route::get('/create', [TimeController::class, 'create'])->name('create');
        Route::post('/', [TimeController::class, 'store'])->name('store');
        Route::get('/{timeLog}', [TimeController::class, 'show'])->name('show');
        Route::get('/{timeLog}/edit', [TimeController::class, 'edit'])->name('edit');
        Route::put('/{timeLog}', [TimeController::class, 'update'])->name('update');
        Route::delete('/{timeLog}', [TimeController::class, 'destroy'])->name('destroy');
    });

    // Leave Type routes
    Route::prefix('leave-type')->name('leave-type.')->group(function () {
        Route::get('/', [LeaveTypeController::class, 'index'])->name('index');
        Route::get('/create', [LeaveTypeController::class, 'create'])->name('create');
        Route::post('/', [LeaveTypeController::class, 'store'])->name('store');
        Route::get('/{leaveType}', [LeaveTypeController::class, 'show'])->name('show');
        Route::get('/{leaveType}/edit', [LeaveTypeController::class, 'edit'])->name('edit');
        Route::put('/{leaveType}', [LeaveTypeController::class, 'update'])->name('update');
        Route::delete('/{leaveType}', [LeaveTypeController::class, 'destroy'])->name('destroy');
    });

    // Leave Request routes
    Route::prefix('leave')->name('leave.')->group(function () {
        Route::get('/', [LeaveRequestController::class, 'index'])->name('index');
        Route::get('/create', [LeaveRequestController::class, 'create'])->name('create');
        Route::post('/', [LeaveRequestController::class, 'store'])->name('store');
        Route::get('/{leave}', [LeaveRequestController::class, 'show'])->name('show');
        Route::get('/{leave}/edit', [LeaveRequestController::class, 'edit'])->name('edit');
        Route::put('/{leave}', [LeaveRequestController::class, 'update'])->name('update');
        Route::delete('/{leave}', [LeaveRequestController::class, 'destroy'])->name('destroy');
    });

    // Working Calendar routes
    Route::prefix('working-calendar')->name('working-calendar.')->group(function () {
        Route::get('/', [WorkingCalendarController::class, 'index'])->name('index');
        Route::get('/create', [WorkingCalendarController::class, 'create'])->name('create');
        Route::post('/', [WorkingCalendarController::class, 'store'])->name('store');
        Route::get('/{workingCalendar}', [WorkingCalendarController::class, 'show'])->name('show');
        Route::get('/{workingCalendar}/edit', [WorkingCalendarController::class, 'edit'])->name('edit');
        Route::put('/{workingCalendar}', [WorkingCalendarController::class, 'update'])->name('update');
        Route::delete('/{workingCalendar}', [WorkingCalendarController::class, 'destroy'])->name('destroy');
    });

    // Working Shift routes
    Route::prefix('working-shift')->name('working-shift.')->group(function () {
        Route::get('/', [WorkShiftController::class, 'index'])->name('index');
        Route::get('/create', [WorkShiftController::class, 'create'])->name('create');
        Route::post('/', [WorkShiftController::class, 'store'])->name('store');
        Route::get('/{workShift}', [WorkShiftController::class, 'show'])->name('show');
        Route::get('/{workShift}/edit', [WorkShiftController::class, 'edit'])->name('edit');
        Route::put('/{workShift}', [WorkShiftController::class, 'update'])->name('update');
        Route::delete('/{workShift}', [WorkShiftController::class, 'destroy'])->name('destroy');

        // User Working Shift Assignment routes
        Route::prefix('assignment')->name('assignment.')->group(function () {
            Route::get('/', [UserWorkShiftController::class, 'index'])->name('index');
            Route::get('/create', [UserWorkShiftController::class, 'create'])->name('create');
            Route::post('/', [UserWorkShiftController::class, 'store'])->name('store');
            Route::get('/{userWorkShift}', [UserWorkShiftController::class, 'show'])->name('show');
            Route::get('/{userWorkShift}/edit', [UserWorkShiftController::class, 'edit'])->name('edit');
            Route::put('/{userWorkShift}', [UserWorkShiftController::class, 'update'])->name('update');
            Route::delete('/{userWorkShift}', [UserWorkShiftController::class, 'destroy'])->name('destroy');
        });
    });
});
