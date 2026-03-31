<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {return view('dashboard');})->name('dashboard');
Route::view('/list-asset-management', 'pages.asset-management.list')->name('list.asset.management');

Route::get('/add-asset-management', [CategoryController::class, 'insert'])->name('add.asset.management');
Route::post('/insert-category', [CategoryController::class, 'store'])->name('categories.store');
