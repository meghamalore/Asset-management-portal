<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {return view('dashboard');})->name('dashboard');
Route::view('/add-asset-management', 'pages.asset-management.add')->name('add.asset.management');
Route::view('/list-asset-management', 'pages.asset-management.list')->name('list.asset.management');
