<?php

use App\Livewire\BranchPage;
use App\Livewire\BrandPage;
use App\Livewire\CompanyPage;

Route::get('companies', CompanyPage::class)->name('companies');
Route::get('branches', BranchPage::class)->name('branches');
Route::get('brands', BrandPage::class)->name('brands');
