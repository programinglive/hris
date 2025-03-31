<?php

use App\Http\Controllers\Organization\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Landing page route
Route::get('/', function () {
    return redirect()->route('landing-page.installation-wizard');
})->name('landing');

Route::prefix('register-company')->name('register.company.')->group(function () {
    Route::get('/', [CompanyRegistrationController::class, 'showRegistrationForm'])
        ->name('show')
        ->middleware('guest');

    Route::post('/validate-contact', [CompanyRegistrationController::class, 'validateContact'])
        ->name('validate-contact')
        ->middleware('guest');

    Route::post('/verify-code', [CompanyRegistrationController::class, 'verifyCode'])
        ->name('verify-code')
        ->middleware('guest');

    Route::post('/save-details', [CompanyRegistrationController::class, 'saveCompanyDetails'])
        ->name('save-details')
        ->middleware('guest');

    // Keep the original route for backward compatibility
    Route::post('/', [CompanyRegistrationController::class, 'register'])
        ->name('submit')
        ->middleware('guest');
});

// Installation wizard route
Route::get('/installation-wizard', function () {
    return Inertia::render('auth/register-company');
})->name('landing-page.installation-wizard');
