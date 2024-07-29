<?php

use App\Livewire\ItemPage;
use App\Livewire\UserPage;

Route::get('users', UserPage::class)->name('users');
Route::get('items', ItemPage::class)->name('items');