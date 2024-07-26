<?php

use App\Livewire\DashboardPage;
use App\Livewire\LoginPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', LoginPage::class)->name('landingpage');

Route::group(['prefix' => '/', 'middleware'=>'auth'], function () {
    Route::get('dashboard', DashboardPage::class)->name('dashboard');

    include(__DIR__ . '/module/rbasedata.php');
    include(__DIR__ . '/module/rorganizationdata.php');
});