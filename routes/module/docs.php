<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    // Documentation index
    Route::get('/docs', function () {
        return Inertia::render('docs/index');
    })->name('docs.index');

    // Documentation show
    Route::get('/docs/{file}', function ($file) {
        return Inertia::render('docs/show', [
            'file' => $file,
        ]);
    })->name('docs.show');

    // Serve documentation files
    Route::get('/resources/docs/{path}', function ($path) {
        // Clean up the path to prevent directory traversal
        $path = str_replace(['..', '.php'], ['', ''], $path);
        $path = str_replace('//', '/', $path);

        // Ensure we're only serving files from the docs directory
        if (strpos($path, '../') !== false) {
            abort(404);
        }

        $file = base_path("resources/docs/{$path}");

        if (! file_exists($file)) {
            abort(404);
        }

        return response()->file($file);
    })->where('path', '.*');
});
