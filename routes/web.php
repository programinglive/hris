<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Sentry\Sentry;

// Include landing page routes (for company registration)
include 'module/landingpage.php';

// Test Sentry route
Route::get('/test-sentry', function () {
    try {
        throw new \Exception('This is a test error for Sentry');
    } catch (\Exception $e) {
        \Sentry\SentrySdk::getCurrentHub()->captureException($e);

        return response()->json([
            'message' => 'Error sent to Sentry. Check your Sentry dashboard for the error.',
        ], 500);
    }
});

// Installation routes
Route::middleware(['guest'])->prefix('install')->name('install.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Installation\SystemSetupController::class, 'index'])->name('system');
    Route::post('/system', [\App\Http\Controllers\Installation\SystemSetupController::class, 'store'])->name('system.store');
    
    Route::get('/database', [\App\Http\Controllers\Installation\DatabaseSetupController::class, 'index'])->name('database');
    Route::post('/database', [\App\Http\Controllers\Installation\DatabaseSetupController::class, 'store'])->name('database.store');
    
    Route::get('/company', [\App\Http\Controllers\Installation\CompanySetupController::class, 'index'])->name('company');
    Route::post('/company', [\App\Http\Controllers\Installation\CompanySetupController::class, 'store'])->name('company.store');
    
    Route::get('/admin', [\App\Http\Controllers\Installation\AdminSetupController::class, 'index'])->name('admin');
    Route::post('/admin', [\App\Http\Controllers\Installation\AdminSetupController::class, 'store'])->name('admin.store');
    
    Route::get('/complete', [\App\Http\Controllers\Installation\CompleteController::class, 'index'])->name('complete');
});

// Apply installation wizard check middleware to all guest routes
Route::middleware(['guest', 'check.installation.wizard'])->group(function () {
    // Login route
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Password reset routes
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');
});

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Logout route
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Employee routes
    include 'module/employee.php';

    // Organization routes
    include 'module/organization.php';

    // Attendance routes
    include 'module/attendance.php';

    // Base Data routes
    include 'module/base-data.php';

    // Assets routes
    include 'module/assets.php';

    // Documentation routes
    include 'module/docs.php';
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('logs', [Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
