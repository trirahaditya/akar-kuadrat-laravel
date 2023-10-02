<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SquareRootController;

Route::get('/', [SquareRootController::class, 'index'])->name('square_root.index');
Route::post('/calculate', [SquareRootController::class, 'calculate'])->name('square_root.calculate');

// Route::get('/', [SquareRootController::class,'index']);
// Route::post('/calculate', [SquareRootController::class,'calculate'])->name('square_root.calculate');