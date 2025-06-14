<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardPetugas;
use App\Http\Controllers\LaporanController;

Route::get('/', [BerandaController::class, 'index']);
Route::get('/', [LaporanController::class, 'index']);
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/lihat-laporan', [LaporanController::class, 'lihat'])->name('laporan.lihat');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/DashboardAdmin',[DashboardAdmin::class, 'dashboard']);
Route::get('/DashboardAdmin/{id}', [DashboardAdmin::class, 'show']);
Route::post('/DashboardAdmin/{id}/tanggapan', [DashboardAdmin::class, 'tanggapan']);
Route::post('/DashboardAdmin/{id}/verifikasi', [DashboardAdmin::class, 'verifikasi']);

Route::get('/DashboardPetugas', [DashboardPetugas::class, 'dashboard']);
Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('petugas.laporan.show');
Route::post('/laporan/kirim/{id}', [LaporanController::class, 'kirimKeAdmin'])->name('petugas.laporan.kirim');
Route::patch('/laporan/status/{id}', [LaporanController::class, 'updateStatus'])->name('petugas.laporan.status');

