<?php

use App\Livewire\AboutPage;
use App\Livewire\CompanyRegisterPage;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPage::class)->name('home');
Route::get('/about', AboutPage::class)->name('about');
Route::get('/companyRegister', CompanyRegisterPage::class)->name('companyRegister');
