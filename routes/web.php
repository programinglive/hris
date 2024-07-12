<?php

use App\Livewire\AboutPage;
use App\Livewire\CompanyRegisterPage;
use App\Livewire\DashboardPage;
use App\Livewire\DocumentationPage;
use App\Livewire\LandingPage;
use App\Livewire\LoginPage;
use App\Livewire\PasswordResetPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('home');
Route::get('login', LoginPage::class)->name('login');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/docs', DocumentationPage::class)->name('docs');
Route::get('/company/register', CompanyRegisterPage::class)->name('company.register.index');
Route::get('/password/reset', PasswordResetPage::class)->name('password.reset');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Place your admin routes here. For example:
    Route::get('/dashboard', DashboardPage::class)->name('admin.dashboard');
});
