<?php

use App\Livewire\DepartmentPage;
use App\Livewire\DivisionPage;
use App\Livewire\EmployeePage;
use App\Livewire\LevelPage;
use App\Livewire\PositionPage;

Route::get('employees', EmployeePage::class)->name('employees');
Route::get('departments', DepartmentPage::class)->name('departments');
Route::get('divisions', DivisionPage::class)->name('divisions');
Route::get('levels', LevelPage::class)->name('levels');
Route::get('positions', PositionPage::class)->name('positions');