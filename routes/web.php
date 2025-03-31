<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Sentry\Sentry;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    // Check if there are any companies in the database
    $hasCompanies = \App\Models\Company::count() > 0;
    
    if ($hasCompanies) {
        return Inertia::render('welcome');
    }

    return redirect()->route('landing-page.installation-wizard');
})->name('home')->middleware('check.installation.wizard');

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
        ->name('password.store');
});

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
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
