<?php

// Employee routes

use App\Http\Controllers\Employee\EmployeeController;
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
    Route::get('/import', [EmployeeController::class, 'showImportForm'])->name('import');
    Route::get('/import/template', [EmployeeController::class, 'downloadTemplate'])->name('import.template');
    Route::post('/import/process', [EmployeeController::class, 'processImport'])->name('import.process');
});