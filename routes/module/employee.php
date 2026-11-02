<?php

// Employee routes

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeImportController;
use Illuminate\Support\Facades\Route;

Route::prefix('employee')->name('employee.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::get('/{id}', [EmployeeController::class, 'show'])->name('show');
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    Route::put('/{id}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');

    // Employee Import routes
    Route::get('/import', [EmployeeImportController::class, 'showImportForm'])->name('import');
    Route::get('/import/template', [EmployeeImportController::class, 'downloadTemplate'])->name('import.template');
    Route::post('/import/process', [EmployeeImportController::class, 'processImport'])->name('import.process');

    // Work Shift routes
    Route::prefix('work-shift')->name('work-shift.')->group(function () {
        Route::post('/{user}', [EmployeeController::class, 'assignWorkShift'])->name('store');
        Route::delete('/{user}/{shift}', [EmployeeController::class, 'removeWorkShift'])->name('destroy');
    });

    // Work Schedule routes
    Route::prefix('{id}/work-schedule')->name('work-schedule.')->group(function () {
        Route::post('/', [EmployeeController::class, 'assignWorkSchedule'])->name('store');
        Route::delete('/{scheduleId}', [EmployeeController::class, 'removeWorkSchedule'])->name('destroy');
    });
});
