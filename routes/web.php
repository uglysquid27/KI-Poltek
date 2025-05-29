<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakCiptaController;
use App\Http\Controllers\PatenController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController; // Ensure this is imported

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

// Detail pages for Hak Cipta and Paten
Route::get('/hak-cipta/{ki_id}', [HakCiptaController::class, 'show'])->name('hak_cipta.detail');
Route::get('/paten/{id}', [PatenController::class, 'show'])->name('paten.detail');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard route - authentication check is handled directly within DashboardController@index
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
