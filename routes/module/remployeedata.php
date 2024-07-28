<?php

use App\Livewire\DepartmentPage;
use App\Livewire\DivisionPage;
use App\Livewire\EmployeePage;
use App\Livewire\RolePage;

Route::get('employees', EmployeePage::class)->name('employees');
Route::get('departments', DepartmentPage::class)->name('departments');
Route::get('divisions', DivisionPage::class)->name('divisions');
Route::get('roles', RolePage::class)->name('roles');