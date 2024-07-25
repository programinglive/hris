<?php

use App\Livewire\CompanyPage;

Route::name('master.')->prefix('master')->group(function () {
    Route::get('companies', CompanyPage::class)->name('companies');
});