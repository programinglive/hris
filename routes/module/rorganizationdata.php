<?php

use App\Livewire\BranchPage;
use App\Livewire\BrandPage;
use App\Livewire\CompanyPage;
use App\Livewire\DepartmentPage;
use App\Livewire\DivisionPage;
use App\Livewire\RolePage;

Route::name('master.')->prefix('master')->group(function () {
    Route::get('companies', CompanyPage::class)->name('companies');
    Route::get('branches', BranchPage::class)->name('branches');
    Route::get('departments', DepartmentPage::class)->name('departments');
    Route::get('divisions', DivisionPage::class)->name('divisions');
    Route::get('roles', RolePage::class)->name('roles');
    Route::get('brands', BrandPage::class)->name('brands');
});