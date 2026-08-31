<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SimaksiController;
use App\Http\Controllers\AuthController;

// ==================== ROUTE GUEST (BELUM LOGIN) ====================
Route::middleware(['guest'])->group(function () {
    // Register Pemohon SIPAKAR
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Login Pemohon SIPAKAR (Default Login untuk Pengguna Biasa)
    Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
    Route::get('/user/login', [AuthController::class, 'showUserLogin'])->name('user.login');
    
    // Menambahkan alias name('login.post') agar sesuai dengan form action di login.blade.php
    Route::post('/login', [AuthController::class, 'userLogin'])->name('login.post');
    Route::post('/user/login', [AuthController::class, 'userLogin'])->name('user.login.post');

    // Login Khusus Admin (Tetap Dipertahankan)
    Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
});

// ==================== ROUTE AUTHENTICATED (HARUS LOGIN) ====================
Route::middleware(['auth'])->group(function () {
    // 1. Halaman Formulir Pendaftaran Pemohon (Diproteksi Auth)
    Route::get('/', [SimaksiController::class, 'index'])->name('simaksi.index');
    Route::get('/pendaftaran', [SimaksiController::class, 'index']);
    Route::post('/simaksi/store', [SimaksiController::class, 'store'])->name('simaksi.store');
    
    // Download Bukti PDF
    Route::get('/simaksi/{id}/download-pdf', [SimaksiController::class, 'downloadPdf'])->name('simaksi.downloadPdf');

    // Logout (Dapat digunakan oleh Admin & Pemohon)
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

    // 2. Route Khusus Admin (Tetap Dipertahankan)
    Route::get('/admin/simaksi', [SimaksiController::class, 'adminIndex'])->name('simaksi.admin');

    // Route Update Status Permohonan Admin (Setujui / Tolak)
    Route::patch('/admin/simaksi/{id}/status', [SimaksiController::class, 'updateStatus'])->name('admin.simaksi.updateStatus');

    // Route CRUD Tambahan untuk Admin (Tetap Dipertahankan)
    Route::get('/admin/simaksi/{id}/edit', [SimaksiController::class, 'edit'])->name('admin.simaksi.edit');
    Route::put('/admin/simaksi/{id}', [SimaksiController::class, 'update'])->name('admin.simaksi.update');
    Route::delete('/admin/simaksi/{id}', [SimaksiController::class, 'destroy'])->name('admin.simaksi.destroy');

    // Route untuk mencetak dan mengunduh Surat Izin SIMAKSI dalam bentuk PDF
    Route::get('/permohonan/cetak-pdf/{id}', [SimaksiController::class, 'cetakPdf'])->name('permohonan.cetakPdf');
});