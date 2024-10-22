<?php

use App\Livewire\AttendanceLeavePage;
use App\Livewire\AttendanceOvertimePage;
use App\Livewire\AttendanceSwitchOffPage;
use App\Livewire\AttendanceTimePage;

Route::get('attendance_times', AttendanceTimePage::class)->name('attendance_times');
Route::get('attendance_overtimes', AttendanceOvertimePage::class)->name('attendance_overtimes');
Route::get('attendance_switch_offs', AttendanceSwitchOffPage::class)->name('attendance_switch_offs');
Route::get('attendance_leaves', AttendanceLeavePage::class)->name('attendance_leaves');
Route::get('attendance_confirms', AttendanceTimePage::class)->name('attendance_confirms');
