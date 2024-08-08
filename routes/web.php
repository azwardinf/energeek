<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('energeek', [CategoryController::class, 'index'])->name('index');
Route::post('energeek', [CategoryController::class, 'store'])->name('store');
