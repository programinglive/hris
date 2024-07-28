<?php

use App\Livewire\ItemPage;
use App\Livewire\PermissionPage;
use App\Livewire\UserPage;

Route::get('users', UserPage::class)->name('users');
Route::get('permissions', PermissionPage::class)->name('permissions');
Route::get('items', ItemPage::class)->name('items');