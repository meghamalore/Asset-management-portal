<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {return view('dashboard');})->name('dashboard');
Route::view('/list-asset-management', 'pages.asset-management.list')->name('list.asset.management');

Route::get('/add-asset-management', [CategoryController::class, 'insert'])->name('add.asset.management');
Route::post('/insert-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/get-subcategories/{id}', [CategoryController::class, 'getSubCategories']);

Route::post('/insert-location', [LocationController::class, 'store'])->name('location.store');
Route::get('/get-sublocation/{id}', [LocationController::class, 'getSubLocation']);
