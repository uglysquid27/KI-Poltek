<?php

use App\Http\Controllers\PatenController;
use App\Http\Controllers\HakCiptaController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakCiptaController as PublicHakCiptaController; // Alias untuk controller publik
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardHakCiptaController;
use App\Http\Controllers\DashboardPatenController; // Pastikan ini mengarah ke DashboardPatenController


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('search');
});

// Search routes
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/advanced-search', [SearchController::class, 'advancedSearch'])->name('advancedSearch');

// Detail pages for Hak Cipta and Paten (public-facing)
Route::get('/hak-cipta/{id}', [PublicHakCiptaController::class, 'show'])->name('hak_cipta.detail'); // Menggunakan alias
Route::get('/paten/{id}', [PatenController::class, 'show'])->name('paten.detail');

// Authentication routes (using manual auth)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard routes (using manual auth check inside controller)
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Hak Cipta Dashboard Routes
    Route::prefix('hak-cipta')->name('hak_cipta.')->group(function () {
        Route::get('/', [DashboardHakCiptaController::class, 'index'])->name('index'); // PASTIKAN MENGGUNAKAN DashboardHakCiptaController
        Route::get('/create', [DashboardHakCiptaController::class, 'create'])->name('create'); // PASTIKAN MENGGUNAKAN DashboardHakCiptaController
        Route::post('/', [DashboardHakCiptaController::class, 'store'])->name('store'); // PASTIKAN MENGGUNAKAN DashboardHakCiptaController
        Route::get('/{id}', [DashboardHakCiptaController::class, 'show'])->name('show');
        Route::get('/{id}/edit-status', [DashboardHakCiptaController::class, 'editStatus'])->name('edit_status');
        Route::put('/{id}/update-status', [DashboardHakCiptaController::class, 'updateStatus'])->name('update_status');
    });

    // Paten Dashboard Routes (placeholder)
    Route::prefix('paten')->name('paten.')->group(function () {
        Route::get('/', [DashboardPatenController::class, 'index'])->name('index'); // Arahkan ke DashboardPatenController
        Route::get('/create', [DashboardPatenController::class, 'create'])->name('create'); // Arahkan ke DashboardPatenController
        Route::post('/', [DashboardPatenController::class, 'store'])->name('store'); // Tambahkan rute store
        Route::get('/{id}', [DashboardPatenController::class, 'show'])->name('show'); // Tambahkan rute show untuk Paten
        Route::get('/{id}/edit-status', [DashboardPatenController::class, 'editStatus'])->name('edit_status');
        Route::put('/{id}/update-status', [DashboardPatenController::class, 'updateStatus'])->name('update_status');
    });
});
