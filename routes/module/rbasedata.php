<?php

use App\Livewire\BrandPage;
use App\Livewire\PermissionPage;
use App\Livewire\RolePage;

Route::name('master.')->prefix('master')->group(function () {
    Route::get('roles', RolePage::class)->name('roles');
    Route::get('permissions', PermissionPage::class)->name('permissions');
    Route::get('brands', BrandPage::class)->name('brands');
});