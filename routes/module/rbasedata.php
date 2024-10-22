<?php

use App\Livewire\CategoryPage;
use App\Livewire\ItemPage;
use App\Livewire\LeaveTypePage;
use App\Livewire\SubCategoryPage;
use App\Livewire\UserPage;
use App\Livewire\WorkingCalendarPage;
use App\Livewire\WorkingShiftPage;

Route::get('users', UserPage::class)->name('users');
Route::get('categories', CategoryPage::class)->name('categories');
Route::get('sub_categories', SubCategoryPage::class)->name('sub_categories');
Route::get('items', ItemPage::class)->name('items');
Route::get('working_calendars', WorkingCalendarPage::class)->name('working_calendars');
Route::get('working_shifts', WorkingShiftPage::class)->name('working_shifts');
Route::get('leave_types', LeaveTypePage::class)->name('leave_types');
