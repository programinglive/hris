<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('assets')->name('assets.')->group(function () {
    Route::get('category/', function () {
        return Inertia::render('coming-soon', [
            'pageTitle' => 'Category Lists'
        ]);
    })->name('category');

    Route::get('sub-category/', function () {
        return Inertia::render('coming-soon', [
            'pageTitle' => 'Sub Category Lists'
        ]);
    })->name('sub-category');

    Route::get('inventory/', function () {
        return Inertia::render('coming-soon', [
            'pageTitle' => 'Inventory Lists'
        ]);
    })->name('inventory');

    Route::get('/', function () {
        return Inertia::render('coming-soon', [
            'pageTitle' => 'Asset Lists'
        ]);
    })->name('lists');

    Route::get('request/', function () {
        return Inertia::render('coming-soon', [
            'pageTitle' => 'Request Lists'
        ]);
    })->name('request');
});