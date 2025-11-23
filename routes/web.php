<?php

use App\Http\Controllers\PatenController;
use App\Http\Controllers\HakCiptaController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakCiptaController as PublicHakCiptaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardHakCiptaController;
use App\Http\Controllers\DashboardDesainIndustriController;
use App\Http\Controllers\DashboardPatenController;


Route::get('/', function () {
    return view('search');
});

// Search routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/advanced-search', [SearchController::class, 'advancedSearch'])->name('advancedSearch');

// Detail pages
Route::get('/hak-cipta/{id}', [PublicHakCiptaController::class, 'show'])->name('hak_cipta.detail');
Route::get('/paten/{id}', [PatenController::class, 'show'])->name('paten.detail');
Route::get('/desain-industri/{id}', [DesainIndustriController::class, 'show'])->name('desain_industri.detail');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard routes
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Hak Cipta Dashboard Routes
    Route::prefix('hak-cipta')->name('hak_cipta.')->group(function () {
        Route::get('/', [DashboardHakCiptaController::class, 'index'])->name('index');
        Route::get('/create', [DashboardHakCiptaController::class, 'create'])->name('create');
        Route::post('/', [DashboardHakCiptaController::class, 'store'])->name('store');
        Route::get('/{id}', [DashboardHakCiptaController::class, 'show'])->name('show');
        Route::get('/{id}/edit-status', [DashboardHakCiptaController::class, 'editStatus'])->name('edit_status');
        Route::put('/{id}/update-status', [DashboardHakCiptaController::class, 'updateStatus'])->name('update_status');
    });

      Route::prefix('desain-industri')->name('desain_industri.')->group(function () {
        Route::get('/', [DashboardDesainIndustriController::class, 'index'])->name('index');
        Route::get('/create', [DashboardDesainIndustriController::class, 'create'])->name('create');
        Route::post('/', [DashboardDesainIndustriController::class, 'store'])->name('store');
        Route::get('/{id}', [DashboardDesainIndustriController::class, 'show'])->name('show');
        Route::get('/{id}/edit-status', [DashboardDesainIndustriController::class, 'editStatus'])->name('edit_status');
        Route::put('/{id}/update-status', [DashboardDesainIndustriController::class, 'updateStatus'])->name('update_status');
    });

    // Paten Dashboard Routes
    Route::prefix('paten')->name('paten.')->group(function () {
        Route::get('/', [DashboardPatenController::class, 'index'])->name('index');
        Route::get('/create', [DashboardPatenController::class, 'create'])->name('create');
        Route::post('/', [DashboardPatenController::class, 'store'])->name('store');
        Route::get('/{id}', [DashboardPatenController::class, 'show'])->name('show');
        Route::get('/{id}/edit-status', [DashboardPatenController::class, 'editStatus'])->name('edit_status');
        Route::put('/{id}/update-status', [DashboardPatenController::class, 'updateStatus'])->name('update_status');
    });
});