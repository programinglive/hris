<?php

// Employee routes

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeImportController;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    // Employee Import routes
    Route::get('/import', [EmployeeImportController::class, 'showImportForm'])->name('import');
    Route::get('/import/template', [EmployeeImportController::class, 'downloadTemplate'])->name('import.template');
    Route::post('/import/process', [EmployeeImportController::class, 'processImport'])->name('import.process');

    Route::get('/{user}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::get('/{user}', [EmployeeController::class, 'show'])->name('show');
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    Route::put('/{user}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{user}', [EmployeeController::class, 'destroy'])->name('destroy');

    // Work Shift routes
    Route::prefix('work-shift')->name('work-shift.')->group(function () {
        Route::post('/{user}', [EmployeeController::class, 'assignWorkShift'])->name('store');
        Route::delete('/{user}/{shift}', [EmployeeController::class, 'removeWorkShift'])->name('destroy');
    });

    // Work Schedule routes
    Route::prefix('{user}/work-schedule')->name('work-schedule.')->group(function () {
        Route::post('/', [EmployeeController::class, 'assignWorkSchedule'])->name('store');
        Route::delete('/{scheduleId}', [EmployeeController::class, 'removeWorkSchedule'])->name('destroy');
    });
});
