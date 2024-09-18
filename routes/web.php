<?php

use App\Livewire\DashboardPage;
use App\Livewire\LoginPage;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', LoginPage::class)->name('landingpage');

Route::get('pinfo', function () {
    return phpinfo();
});

Route::group(['prefix' => '/', 'middleware'=>'auth'], function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');


    Route::name('master.')->prefix('master')->group(function () {
        include(__DIR__ . '/module/rbasedata.php');
        include(__DIR__ . '/module/rorganizationdata.php');
        include(__DIR__ . '/module/remployeedata.php');
        include(__DIR__ . '/module/rannountcement.php');
    });
});