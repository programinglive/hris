<?php

use App\Livewire\PermissionPage;

Route::name('master.')->prefix('master')->group(function () {
    Route::get('permissions', PermissionPage::class)->name('permissions');
});