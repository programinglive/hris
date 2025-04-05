<?php

use App\Http\Controllers\Organization\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

// Landing page route
Route::get('/', function () {
    return Inertia::render('Landing');
})->name('landing');

// Login route
Route::get('/login', function () {
    return Inertia::render('auth/Login');
})->name('login')->middleware('guest');

// Installation wizard routes
Route::get('/installation-wizard', [CompanyRegistrationController::class, 'showRegistrationForm'])
    ->name('landing-page.installation-wizard')
    ->middleware('guest');

Route::post('/installation-wizard/validate-contact', [CompanyRegistrationController::class, 'validateContact'])
    ->name('landing-page.installation-wizard.validate-contact')
    ->middleware('guest');

Route::post('/installation-wizard/verify-code', [CompanyRegistrationController::class, 'verifyCode'])
    ->name('landing-page.installation-wizard.verify-code')
    ->middleware('guest');

Route::post('/installation-wizard/resend-code', [CompanyRegistrationController::class, 'resendCode'])
    ->name('landing-page.installation-wizard.resend-code')
    ->middleware('guest');

Route::post('/installation-wizard/save-company-details', [CompanyRegistrationController::class, 'saveCompanyDetails'])
    ->name('landing-page.installation-wizard.save-company-details')
    ->middleware('guest');

Route::post('/installation-wizard/complete', [CompanyRegistrationController::class, 'completeRegistration'])
    ->name('landing-page.installation-wizard.complete')
    ->middleware('guest');

// Company registration routes
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

    Route::post('/complete', [CompanyRegistrationController::class, 'completeRegistration'])
        ->name('complete')
        ->middleware('guest');
});
