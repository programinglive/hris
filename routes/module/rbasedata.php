<?php

use App\Livewire\ItemPage;
use App\Livewire\PermissionPage;
use App\Livewire\RolePage;
use App\Livewire\UserPage;

Route::get('roles', RolePage::class)->name('roles');
Route::get('permissions', PermissionPage::class)->name('permissions');
Route::get('users', UserPage::class)->name('users');
Route::get('items', ItemPage::class)->name('items');