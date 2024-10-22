<?php

use App\Livewire\DepartmentPage;
use App\Livewire\DivisionPage;
use App\Livewire\EmployeeLeavePlafondPage;
use App\Livewire\EmployeePage;
use App\Livewire\LevelPage;
use App\Livewire\PositionPage;
use App\Livewire\SubDivisionPage;

Route::get('employees', EmployeePage::class)->name('employees');
Route::get('leave_plafonds', EmployeeLeavePlafondPage::class)->name('leave_plafonds');
Route::get('departments', DepartmentPage::class)->name('departments');
Route::get('divisions', DivisionPage::class)->name('divisions');
Route::get('sub_divisions', SubDivisionPage::class)->name('sub_divisions');
Route::get('levels', LevelPage::class)->name('levels');
Route::get('positions', PositionPage::class)->name('positions');