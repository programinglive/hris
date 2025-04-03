<?php

use App\Http\Controllers\Organization\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;

// Landing page route
Route::get('/', function () {
    return redirect()->route('landing-page.installation-wizard');
})->name('landing');

// Installation wizard route
Route::get('/installation-wizard', [CompanyRegistrationController::class, 'showRegistrationForm'])
    ->name('landing-page.installation-wizard')
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
