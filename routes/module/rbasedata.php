<?php

use App\Livewire\PermissionPage;
use App\Livewire\UserPage;

Route::get('users', UserPage::class)->name('users');
Route::get('permissions', PermissionPage::class)->name('permissions');