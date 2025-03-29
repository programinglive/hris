<?php

use App\Http\Controllers\Organization\BranchController;
use App\Http\Controllers\Organization\BrandController;
use App\Http\Controllers\Organization\CompanyController;
use App\Http\Controllers\Organization\DepartmentController;
use App\Http\Controllers\Organization\DivisionController;
use App\Http\Controllers\Organization\LevelController;
use App\Http\Controllers\Organization\PositionController;
use App\Http\Controllers\Organization\SubDivisionController;
use Illuminate\Support\Facades\Route;

Route::prefix('organization')->name('organization.')->group(function () {
    // Company routes
    Route::prefix('company')->name('company.')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        Route::post('/', [CompanyController::class, 'store'])->name('store');
        Route::get('/{company}', [CompanyController::class, 'show'])->name('show');
        Route::get('/{company}/edit', [CompanyController::class, 'edit'])->name('edit');
        Route::put('/{company}', [CompanyController::class, 'update'])->name('update');
        Route::delete('/{company}', [CompanyController::class, 'destroy'])->name('destroy');

        // Company Import routes
        Route::get('/import/template', [CompanyController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [CompanyController::class, 'processImport'])->name('import.process');
    });

    // Branch routes
    Route::prefix('branch')->name('branch.')->group(function () {
        Route::get('/', [BranchController::class, 'index'])->name('index');
        Route::get('/create', [BranchController::class, 'create'])->name('create');
        Route::post('/', [BranchController::class, 'store'])->name('store');
        Route::get('/{branch}', [BranchController::class, 'show'])->name('show');
        Route::get('/{branch}/edit', [BranchController::class, 'edit'])->name('edit');
        Route::put('/{branch}', [BranchController::class, 'update'])->name('update');
        Route::delete('/{branch}', [BranchController::class, 'destroy'])->name('destroy');

        // Branch Import routes
        Route::get('/import/template', [BranchController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [BranchController::class, 'processImport'])->name('import.process');
    });

    // Brand routes
    Route::prefix('brand')->name('brand.')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/', [BrandController::class, 'store'])->name('store');
        Route::get('/{brand}', [BrandController::class, 'show'])->name('show');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('edit');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('update');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('destroy');

        // Brand Import routes
        Route::get('/import', [BrandController::class, 'showImport'])->name('import');
        Route::get('/import/template', [BrandController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [BrandController::class, 'processImport'])->name('import.process');
    });

    // Department routes
    Route::prefix('department')->name('department.')->group(function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('index');
        Route::get('/create', [DepartmentController::class, 'create'])->name('create');
        Route::post('/', [DepartmentController::class, 'store'])->name('store');
        Route::get('/{department}', [DepartmentController::class, 'show'])->name('show');
        Route::get('/{department}/edit', [DepartmentController::class, 'edit'])->name('edit');
        Route::put('/{department}', [DepartmentController::class, 'update'])->name('update');
        Route::delete('/{department}', [DepartmentController::class, 'destroy'])->name('destroy');

        // Department Import routes
        Route::get('/import/template', [DepartmentController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [DepartmentController::class, 'processImport'])->name('import.process');
    });

    // Division routes with Inertia.js
    Route::prefix('division')->name('division.')->group(function () {
        Route::get('/', [DivisionController::class, 'index'])->name('index');
        Route::get('/create', [DivisionController::class, 'create'])->name('create');
        Route::post('/', [DivisionController::class, 'store'])->name('store');
        Route::get('/{id}', [DivisionController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [DivisionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DivisionController::class, 'update'])->name('update');
        Route::delete('/{id}', [DivisionController::class, 'destroy'])->name('destroy');

        // Division Import routes
        Route::get('/import/template', [DivisionController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [DivisionController::class, 'processImport'])->name('import.process');
    });

    // Sub Division routes with Inertia.js
    Route::prefix('subdivision')->name('subdivision.')->group(function () {
        Route::get('/', [SubDivisionController::class, 'index'])->name('index');
        Route::get('/create', [SubDivisionController::class, 'create'])->name('create');
        Route::post('/', [SubDivisionController::class, 'store'])->name('store');
        Route::get('/{subdivision}', [SubDivisionController::class, 'show'])->name('show');
        Route::get('/{subdivision}/edit', [SubDivisionController::class, 'edit'])->name('edit');
        Route::put('/{subdivision}', [SubDivisionController::class, 'update'])->name('update');
        Route::delete('/{subdivision}', [SubDivisionController::class, 'destroy'])->name('destroy');

        // Sub Division Import routes
        Route::get('/import', [SubDivisionController::class, 'import'])->name('import');
        Route::get('/import/template', [SubDivisionController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [SubDivisionController::class, 'processImport'])->name('import.process');
    });

    // Level routes
    Route::prefix('level')->name('level.')->group(function () {
        Route::get('/', [LevelController::class, 'index'])->name('index');
        Route::get('/create', [LevelController::class, 'create'])->name('create');

        // Level Import routes - moved before the {level} parameter routes
        Route::get('/import', [LevelController::class, 'import'])->name('import');
        Route::get('/import/template', [LevelController::class, 'downloadTemplate'])->name('import.template');
        Route::post('/import/process', [LevelController::class, 'processImport'])->name('import.process');

        Route::post('/', [LevelController::class, 'store'])->name('store');
        Route::get('/{level}', [LevelController::class, 'show'])->name('show');
        Route::get('/{level}/edit', [LevelController::class, 'edit'])->name('edit');
        Route::put('/{level}', [LevelController::class, 'update'])->name('update');
        Route::delete('/{level}', [LevelController::class, 'destroy'])->name('destroy');
    });

    // Position routes
    Route::prefix('position')->name('position.')->group(function () {
        Route::get('/', [PositionController::class, 'index'])->name('index');
        Route::get('/create', [PositionController::class, 'create'])->name('create');
        Route::post('/', [PositionController::class, 'store'])->name('store');
        Route::get('/{position}', [PositionController::class, 'show'])->name('show');
        Route::get('/{position}/edit', [PositionController::class, 'edit'])->name('edit');
        Route::put('/{position}', [PositionController::class, 'update'])->name('update');
        Route::delete('/{position}', [PositionController::class, 'destroy'])->name('destroy');
    });
});
