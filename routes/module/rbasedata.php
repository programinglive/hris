<?php

use App\Livewire\CategoryPage;
use App\Livewire\ItemPage;
use App\Livewire\SubCategoryPage;
use App\Livewire\UserPage;
use App\Livewire\WorkingDayPage;

Route::get('users', UserPage::class)->name('users');
Route::get('categories', CategoryPage::class)->name('categories');
Route::get('sub_categories', SubCategoryPage::class)->name('sub_categories');
Route::get('items', ItemPage::class)->name('items');
Route::get('working_days', WorkingDayPage::class)->name('working_days');
