<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardPetugas;
use App\Http\Controllers\LaporanController;

Route::get('/', [BerandaController::class, 'index']);
Route::get('/', [LaporanController::class, 'index']);
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/DashboardAdmin',[DashboardAdmin::class, 'dashboard']);
Route::get('/DashboardPetugas', [DashboardPetugas::class, 'dashboard']);
