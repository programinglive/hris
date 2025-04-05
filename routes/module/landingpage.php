<?php

use App\Http\Controllers\Organization\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Landing page route
Route::get('/', function () {
    return Inertia::render('Landing');
})->name('landing');

// Login route
Route::get('/login', function () {
    return Inertia::render('auth/Login');
})->name('login')->middleware('guest');

// Company registration routes
Route::prefix('register-company')->name('register.company.')->group(function () {
    Route::get('/', [CompanyRegistrationController::class, 'showRegistrationForm'])
        ->name('show')
        ->middleware('guest');
});
