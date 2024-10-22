<?php

use App\Livewire\AttendanceOvertimePage;
use App\Livewire\AttendanceTimePage;

Route::get('attendance_times', AttendanceTimePage::class)->name('attendance_times');
Route::get('attendance_overtimes', AttendanceOvertimePage::class)->name('attendance_overtimes');
Route::get('attendance_time_offs', AttendanceTimePage::class)->name('attendance_time_offs');
Route::get('attendance_leaves', AttendanceTimePage::class)->name('attendance_leaves');
Route::get('attendance_confirms', AttendanceTimePage::class)->name('attendance_confirms');