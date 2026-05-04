<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CustomeViewControlller;
use App\Http\Controllers\AssetDisposalController;
use App\Http\Controllers\HelpDeskController;
use App\Http\Controllers\HelpDeskSettingController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {return view('pages.auth.login');})->name('login');
Route::get('/login', function () {return view('pages.auth.login');})->name('login');
// Route::view('/list-asset-management', 'pages.asset-management.list')->name('list.asset.management');


Route::post('/check-login', [LoginController::class, 'login'])->name('check_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

Route::middleware(['custom.auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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

Route::post('/insert-asset-disposal', [AssetDisposalController::class, 'store'])->name('disposal.store');
Route::get('/get-asset-details/{id}', [AssetController::class, 'getAssetDetails']);
Route::get('/view-asset-details/{id}', [AssetController::class, 'viewAssetDetails'])->name('assets.view');
Route::post('/update-asset/{id}', [AssetController::class, 'updateAsset']);
Route::post('/asset-transfer', [AssetController::class, 'transfer'])->name('asset.transfer');

Route::post('/insert-asset-schedule', [AssetController::class, 'storeScheduleActivity'])->name('schedule.store');
Route::get('/export-assets', [AssetController::class, 'exportAssets'])->name('assets.export');

Route::get('/add-help-desk', [HelpDeskController::class, 'insert'])->name('add.help.desk');
Route::post('/store-help-desk', [HelpDeskController::class, 'store'])->name('store.help.desk');
Route::get('/list-help-desk', [HelpDeskController::class, 'index'])->name('list.help.desk');
Route::delete('/destroy-ticket/{id}', [HelpDeskController::class, 'destroy'])->name('ticket.destroy');
Route::get('/edit-ticket/{id}', [HelpDeskController::class, 'edit'])->name('ticket.edit');
Route::get('/view-ticket/{id}', [HelpDeskController::class, 'view'])->name('ticket.view');
Route::post('/ticket/{id}', [HelpDeskController::class, 'update'])->name('ticket.update');
Route::get('/export-ticket', [HelpDeskController::class, 'exportTicket'])->name('ticket.export');
Route::delete('/ticket/bulk-delete', [HelpDeskController::class, 'bulkDelete'])->name('ticket.bulkDelete');

Route::get('/ticket/multiple-records-fetch', [HelpDeskController::class, 'multipleRecordsFetch']);
Route::post('/ticket/multiple-records-update', [HelpDeskController::class, 'multipleRecordsUpdate']);


Route::get('/add-ticket-status', [HelpDeskSettingController::class, 'insert'])->name('add-ticket-status');

Route::get('/add-ticket-type', [HelpDeskSettingController::class, 'insert'])->name('add-ticket-type');
// Route::get('/list-ticket-type', [HelpDeskSettingController::class, 'index_type'])->name('list.ticket.type');

Route::post('/api/assets/bulk-fetch', [AssetController::class, 'bulkFetch'])->name('assets.bulk-fetch');
Route::post('/api/assets/bulk-update', [AssetController::class, 'bulkUpdate'])->name('assets.bulkUpdate');

Route::get('/add-ticket-status', [TicketStatusController::class, 'add'])->name('add.ticket.status');
Route::post('/store-ticket-status', [TicketStatusController::class, 'store'])->name('store-ticket-status');
Route::get('/index-ticket-status', [TicketStatusController::class, 'index'])->name('list-ticket-status');
Route::delete('/destroy-ticket-status/{id}', [TicketStatusController::class, 'destroy'])->name('ticket.status.destroy');
Route::get('/edit-ticket-status/{id}', [TicketStatusController::class, 'edit'])->name('ticket.status.edit');
Route::get('/view-ticket-status/{id}', [TicketStatusController::class, 'view'])->name('ticket.status.view');
Route::post('/ticket-status/{id}', [TicketStatusController::class, 'update'])->name('ticket.status.update');

Route::get('/add-ticket-type', [TicketTypeController::class, 'add'])->name('add.ticket.type');
Route::post('/store-ticket-type', [TicketTypeController::class, 'store'])->name('store.ticket.type');
Route::get('/index-ticket-type', [TicketTypeController::class, 'index'])->name('list.ticket.type');
Route::delete('/destroy-ticket-type/{id}', [TicketTypeController::class, 'destroy'])->name('ticket.type.destroy');
Route::get('/edit-ticket-type/{id}', [TicketTypeController::class, 'edit'])->name('ticket.type.edit');
Route::get('/view-ticket-type/{id}', [TicketTypeController::class, 'view'])->name('ticket.type.view');
Route::post('/ticket-type/{id}', [TicketTypeController::class, 'update'])->name('ticket.type.update');

});



