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
use App\Http\Controllers\ImportDataController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\BarcodeController;

Route::get('/', function () {return view('pages.auth.login');})->name('login');
Route::get('/login', function () {return view('pages.auth.login');})->name('login');
// Route::view('/list-asset-management', 'pages.asset-management.list')->name('list.asset.management');


Route::post('/check-login', [LoginController::class, 'login'])->name('check_login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

Route::middleware(['custom.auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/add-asset-management', [CategoryController::class, 'insert'])->name('add.asset.management');
Route::get('/index-asset-management', [CategoryController::class, 'index'])->name('index.asset.management');
Route::post('/insert-category', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/get-subcategories/{id}', [CategoryController::class, 'getSubCategories']);
Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::get('/view-category/{id}', [CategoryController::class, 'view'])->name('categories.view');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

Route::post('/insert-location', [LocationController::class, 'store'])->name('location.store');
Route::get('/get-sublocation/{id}', [LocationController::class, 'getSubLocation']);
Route::get('/list-location', [LocationController::class, 'index'])->name('location.list');
Route::get('/edit-location/{id}', [LocationController::class, 'edit'])->name('location.edit');
Route::get('/view-location/{id}', [LocationController::class, 'view'])->name('location.view');
Route::post('/update-location/{id}', [LocationController::class, 'update']);
Route::delete('/destroy-location/{id}', [LocationController::class, 'destroy'])->name('location.destroy');

Route::post('/insert-status', [StatusController::class, 'store'])->name('status.store');
Route::get('/list-status', [StatusController::class, 'index'])->name('status.list');
Route::delete('/destroy-status/{id}', [StatusController::class, 'destroy'])->name('status.destroy');
Route::get('/edit-status/{id}', [StatusController::class, 'edit'])->name('status.edit');
Route::post('/update-status/{id}', [StatusController::class, 'update']);
Route::get('/view-status/{id}', [StatusController::class, 'view'])->name('status.view');
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

Route::post('/multiple-records-update', [HelpDeskController::class, 'multipleRecordsUpdate']);
Route::get('/ticket/multiple-records-fetch', [HelpDeskController::class, 'multipleRecordsFetch']);


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

Route::get('/import-asset', [ImportDataController::class, 'add'])->name('import-asset');
Route::get('/template-download', [ImportDataController::class, 'downloadTemplate'])->name('assets.sample.download');
Route::post('/import-assets', [ImportDataController::class, 'import'])->name('asset.import');
Route::get('/asset/download-latest', [ImportDataController::class, 'downloadLatest'])->name('asset.download.latest');

Route::get('/import-ticket', [ImportDataController::class, 'addTicket'])->name('import-ticket');
Route::get('/template-download-ticket', [ImportDataController::class, 'downloadTemplateTicket'])->name('ticket.sample.download');
Route::post('/ticket/import', [ImportDataController::class, 'importTicket'])->name('ticket.import');
Route::get('/ticket/download-latest', [ImportDataController::class, 'downloadLatestTicket'])->name('ticket.download.latest');

Route::post('/store-condition', [ConditionController::class, 'store'])->name('store.condition');
Route::get('/index-condition', [ConditionController::class, 'index'])->name('list.condition');
Route::delete('/destroy-condition/{id}', [ConditionController::class, 'destroy'])->name('condition.destroy');
Route::post('/condition/{id}', [ConditionController::class, 'update'])->name('condition.update');

Route::get('/add-barcode', [BarcodeController::class, 'add'])->name('add.barcode');
Route::get('/index-barcode', [BarcodeController::class, 'index'])->name('list.barcode');
Route::post('/store-qr', [BarcodeController::class, 'store'])->name('store.qr');
Route::delete('/destroy-qr/{id}', [BarcodeController::class, 'destroy'])->name('destroy.qr');
Route::get('/view-qr/{id}', [BarcodeController::class, 'view'])->name('qr.view');



});



