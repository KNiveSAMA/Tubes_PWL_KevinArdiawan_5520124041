<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin only
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dosen',             [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create',      [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen',            [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{nidn}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::patch('/dosen/{nidn}',    [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{nidn}',   [DosenController::class, 'destroy'])->name('dosen.destroy');

    Route::get('/mahasiswa',              [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create',       [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa',             [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{npm}/edit',   [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::patch('/mahasiswa/{npm}',      [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{npm}',     [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    Route::get('/matakuliah',             [MatakuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/create',      [MatakuliahController::class, 'create'])->name('matakuliah.create');
    Route::post('/matakuliah',            [MatakuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah/{kode}/edit', [MatakuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::patch('/matakuliah/{kode}',    [MatakuliahController::class, 'update'])->name('matakuliah.update');
    Route::delete('/matakuliah/{kode}',   [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');

    Route::get('/jadwal',            [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/create',     [JadwalController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal',           [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit',  [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::patch('/jadwal/{id}',     [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{id}',    [JadwalController::class, 'destroy'])->name('jadwal.destroy');

    Route::get('/krs',                    [KrsController::class, 'index'])->name('krs.index');
    Route::get('/krs/export/{npm}',       [KrsController::class, 'exportPdf'])->name('krs.export.admin');
    Route::delete('/krs/{id}',            [KrsController::class, 'destroy'])->name('krs.destroy');
});

// Mahasiswa only
Route::middleware(['auth', 'mahasiswa'])->group(function () {
    Route::get('/jadwal-kuliah',     [JadwalController::class, 'index'])->name('jadwal.lihat');
    Route::get('/krs/my',            [KrsController::class, 'myKrs'])->name('krs.my');
    Route::post('/krs/my',           [KrsController::class, 'store'])->name('krs.store');
    Route::delete('/krs/my/{id}',    [KrsController::class, 'destroy'])->name('krs.my.destroy');
    Route::get('/krs/export',        [KrsController::class, 'exportPdf'])->name('krs.export');
});

require __DIR__.'/auth.php';
