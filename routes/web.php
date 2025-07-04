<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdmin;
use App\Http\Controllers\DashboardPetugas;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePetugasController;

Route::get('/', [BerandaController::class, 'index']);
Route::get('/', [LaporanController::class, 'index']);
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
Route::get('/lihat-laporan', [LaporanController::class, 'lihat'])->name('laporan.lihat');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// group halaman admin
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/DashboardAdmin',[DashboardAdmin::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/DetailLaporanAdmin/{id}', [DashboardAdmin::class, 'show'])->name('admin.detailLaporan');
    Route::post('/DashboardAdmin/tanggapan/{id}', [DashboardAdmin::class, 'kirimTanggapan'])->name('admin.kirimtanggapan');
    Route::post('/DashboardAdmin/verifikasi/{id}', [DashboardAdmin::class, 'verifikasi']);
    Route::get('/profile', [ProfileController::class,'index'])->name('admin.profile');
    Route::get('/profile/change-password', [ProfileController::class, 'changePasswordForm'])->name('admin.change-password');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.update-password');
});

// group halaman petugas
Route::middleware(['auth:petugas'])->prefix('petugas')->group(function () {
    Route::get('/laporan', [DashboardPetugas::class, 'dashboard'])->name('petugas.laporan.index');
    Route::get('/profile', [ProfilePetugasController::class,'index'])->name('petugas.profile');
    Route::get('/change-password', [ProfilePetugasController::class, 'changePasswordPetugas'])->name('petugas.change-password');
    Route::post('/change-password', [ProfilePetugasController::class, 'changePasswordNow'])->name('petugas.update-password');
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('petugas.laporan.show');
    Route::post('/laporan/kirim/{id}', [LaporanController::class, 'kirimKeAdmin'])->name('petugas.laporan.kirim');
    Route::patch('/laporan/status/{id}', [LaporanController::class, 'updateStatus'])->name('petugas.laporan.status');
    Route::get('/laporan/edit-status/{id}', [LaporanController::class, 'editStatus'])->name('petugas.laporan.edit_status');
    Route::get('/laporan/filter', [LaporanController::class, 'filterByStatus'])->name('petugas.laporan.filter');
    Route::get('/laporan/search', [LaporanController::class, 'search'])->name('petugas.laporan.search');
    Route::post('/laporan/bulk-update', [LaporanController::class, 'bulkUpdateStatus'])->name('petugas.laporan.bulk_update');
    Route::get('/laporan/export', [LaporanController::class, 'export'])->name('petugas.laporan.export');

});
