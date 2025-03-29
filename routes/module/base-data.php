<?php

use App\Http\Controllers\BaseData\FaqController;
use Illuminate\Support\Facades\Route;

Route::prefix('basedata')->name('basedata.')->group(function () {
    // FAQ routes
    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/create', [FaqController::class, 'create'])->name('create');
        Route::post('/', [FaqController::class, 'store'])->name('store');
        Route::get('/{faq}', [FaqController::class, 'show'])->name('show');
        Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('edit');
        Route::put('/{faq}', [FaqController::class, 'update'])->name('update');
        Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
    });
});