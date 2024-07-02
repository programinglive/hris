<?php

use App\Livewire\AboutPage;
use App\Livewire\CompanyRegisterPage;
use App\Livewire\DocumentationPage;
use App\Livewire\LandingPage;
use App\Livewire\PasswordResetPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('home');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/docs', DocumentationPage::class)->name('docs');
Route::get('/company/register', CompanyRegisterPage::class)->name('company.register.index');
Route::get('/password/reset', PasswordResetPage::class)->name('password.reset');
