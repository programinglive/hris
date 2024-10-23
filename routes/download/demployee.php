<?php

use App\Http\Controllers\EmployeeController;

Route::get('employee', [EmployeeController::class, 'download'])->name('employee');
