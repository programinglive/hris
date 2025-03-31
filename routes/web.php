<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return Inertia::render('welcome');
})->name('home');

// Include landing page routes (for company registration)
include('module/landingpage.php');

// Sentry test route
Route::get('/sentry-test', function () {
    try {
        throw new \Exception('Sentry test error');
    } catch (\Exception $e) {
        \Sentry\captureException($e);
        throw $e;
    }
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    // Employee routes
    include('module/employee.php');

    // Organization routes
    include('module/organization.php');

    // Attendance routes
    include('module/attendance.php');

    // Base Data routes
    include('module/base-data.php');

    // Assets routes
    include('module/assets.php');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
