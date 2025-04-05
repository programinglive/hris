<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Organization\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Sentry\Sentry;

// Include landing page routes
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

// Guest routes
Route::middleware(['guest'])->group(function () {
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

    // Company registration routes
    Route::get('register/company', [CompanyRegistrationController::class, 'create'])
        ->name('register.company');

    Route::post('register/company', [CompanyRegistrationController::class, 'store']);
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
