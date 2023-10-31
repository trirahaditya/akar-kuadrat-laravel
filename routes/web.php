<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SquareRootController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', [SquareRootController::class, 'index'])->name('square_root.index');
// Route::get('/', [SquareRootController::class, 'index'])->name('square_root.index');
Route::post('/calculate', [SquareRootController::class, 'calculate'])->name('square_root.calculate');

Route::get('/history', [SquareRootController::class, 'sortedHistory'])->name('square_root.history');
Route::get('/sorted_history', [SquareRootController::class, 'sortedHistory'])->name('square_root.sorted_history');
Route::get('/refresh-rekapitulasi', 'SquareRootController@refreshRekapitulasi')->name('square_root.refreshRekapitulasi');

Route::get('/statistics', [SquareRootController::class, 'statistics'])->name('square_root.statistics');
Route::get('/refresh-statistik', 'SquareRootController@refreshStatistik')->name('square_root.refreshStatistik');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');