<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HakCiptaController;
use App\Http\Controllers\PatenController;



Route::get('/', function () {
    return view('search'); 
});

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/hak-cipta/{ki_id}', [HakCiptaController::class, 'show'])->name('hak_cipta.detail');
Route::get('/paten/{id}', [PatenController::class, 'show'])->name('paten.detail');

use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/advanced-search', [SearchController::class, 'advancedSearch'])->name('advancedSearch');

Route::get('/dashboard', function () {
    return 'Welcome to the dashboard!';
})->middleware('auth');



