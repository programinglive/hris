<?php

use App\Http\Controllers\Organization\CompanyRegistrationController;
use Illuminate\Support\Facades\Route;

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
