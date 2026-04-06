<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CustomeViewControlller;

Route::get('/', function () {return view('dashboard');})->name('dashboard');
// Route::view('/list-asset-management', 'pages.asset-management.list')->name('list.asset.management');

Route::get('/add-asset-management', [CategoryController::class, 'insert'])->name('add.asset.management');
Route::post('/insert-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/get-subcategories/{id}', [CategoryController::class, 'getSubCategories']);

Route::post('/insert-location', [LocationController::class, 'store'])->name('location.store');
Route::get('/get-sublocation/{id}', [LocationController::class, 'getSubLocation']);

Route::post('/insert-status', [StatusController::class, 'store'])->name('status.store');
Route::post('/insert-asset', [AssetController::class, 'store'])->name('asset.store');
Route::get('/list-asset-management', [AssetController::class, 'index'])->name('list.asset.management');

Route::post('/store-view', [CustomeViewControlller::class, 'store'])->name('custom-view.store');
Route::delete('/custom-view/delete/{id}', [CustomeViewControlller::class, 'destroy'])->name('custom-view.destroy');

Route::get('/custom-view/{id}', [CustomeViewControlller::class, 'show']);

