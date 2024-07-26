<?php

use App\Livewire\BranchPage;
use App\Livewire\CompanyPage;

Route::name('master.')->prefix('master')->group(function () {
    Route::get('role', CompanyPage::class)->name('role');
    Route::get('permission', BranchPage::class)->name('permission');
});