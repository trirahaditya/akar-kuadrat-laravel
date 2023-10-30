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

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
