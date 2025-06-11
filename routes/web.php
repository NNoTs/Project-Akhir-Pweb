<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardPetugas;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/DashboardAdmin',[DashboardAdmin::class, 'dashboard']);
Route::get('/DashboardPetugas', [DashboardPetugas::class, 'dashboard']);

// Route yang sudah Anda miliki
Route::get('/laporan', [LaporanController::class, 'index'])->name('petugas.laporan.index');
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('petugas.laporan.show');
Route::post('/laporan/kirim/{id}', [LaporanController::class, 'kirimKeAdmin'])->name('petugas.laporan.kirim');
Route::patch('/laporan/status/{id}', [LaporanController::class, 'updateStatus'])->name('petugas.laporan.status');

// Route tambahan (opsional)
Route::get('/laporan/edit-status/{id}', [LaporanController::class, 'editStatus'])->name('petugas.laporan.edit_status');
Route::get('/laporan/filter', [LaporanController::class, 'filterByStatus'])->name('petugas.laporan.filter');
Route::get('/laporan/search', [LaporanController::class, 'search'])->name('petugas.laporan.search');
Route::post('/laporan/bulk-update', [LaporanController::class, 'bulkUpdateStatus'])->name('petugas.laporan.bulk_update');
Route::get('/laporan/export', [LaporanController::class, 'export'])->name('petugas.laporan.export');

