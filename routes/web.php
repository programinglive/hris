<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Sentry\Sentry;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return Inertia::render('welcome');
})->name('home');

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

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
