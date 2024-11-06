<?php

use App\Livewire\DashboardPage;
use App\Livewire\LoginPage;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('/', LoginPage::class)->name('landingpage');

Route::get('pinfo', function () {
    return phpinfo();
});

Route::group(['middleware' => ['auth', 'loggedIn']], function () {

    Route::get('dashboard', DashboardPage::class)->name('dashboard');

    Route::name('master.')->prefix('master')->group(function () {
        include __DIR__.'/module/rbasedata.php';
        include __DIR__.'/module/rorganizationdata.php';
        include __DIR__.'/module/remployeedata.php';
    });

    Route::name('transaction.')->prefix('transaction')->group(function () {
        include __DIR__.'/module/rannountcement.php';
        include __DIR__.'/module/rrecruitment.php';
        include __DIR__.'/module/rattendance.php';
        include __DIR__.'/module/rbusinesstrip.php';
        include __DIR__.'/module/rasset.php';
        include __DIR__.'/module/rpayrol.php';
        include __DIR__.'/module/ritem.php';
    });

    Route::name('setting.')->prefix('transaction')->group(function () {
        include __DIR__.'/module/rapplication.php';
    });

    Route::name('download.')->prefix('download')->group(function () {
        include __DIR__.'/download/demployee.php';
    });
});
