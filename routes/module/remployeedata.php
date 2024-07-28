<?php

use App\Livewire\DepartmentPage;
use App\Livewire\DivisionPage;
use App\Livewire\RolePage;

Route::get('departments', DepartmentPage::class)->name('departments');
Route::get('divisions', DivisionPage::class)->name('divisions');
Route::get('roles', RolePage::class)->name('roles');