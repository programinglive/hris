<?php

use App\Livewire\BranchPage;
use App\Livewire\CompanyPage;

Route::name('master.')->prefix('master')->group(function () {
    Route::get('companies', CompanyPage::class)->name('companies');
    Route::get('branches', BranchPage::class)->name('branches');
});