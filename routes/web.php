<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController; 
use Illuminate\Support\Facades\Route;

// === HALAMAN PUBLIK / LANDING PAGE ===
Route::get('/', function () {
    return view('welcome'); // Tampilan Beranda Utama sesuai Screenshot 2026-06-14
})->name('home');

Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/pengembang', function () {
    return view('public.pengembang');
})->name('pengembang');

// === PROSES AUTENTIKASI ===
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// === AKSI KELUAR ===
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// === HALAMAN KHUSUS USER ===
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/input-matriks', [UserController::class, 'showForm'])->name('input_matriks');
    Route::post('/input-matriks', [UserController::class, 'hitung'])->name('hitung');
    Route::get('/history', [UserController::class, 'history'])->name('history');
    Route::get('/history/{id}', [UserController::class, 'showDetail'])->name('history.detail');
});

// === HALAMAN KHUSUS ADMIN ===
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // CRUD Data Latih
    Route::get('/data-training', [AdminController::class, 'dataTrainingIndex'])->name('data_training.index');
    Route::get('/data-training/create', [AdminController::class, 'dataTrainingCreate'])->name('data_training.create');
    Route::post('/data-training/store', [AdminController::class, 'dataTrainingStore'])->name('data_training.store');
    Route::get('/data-training/{id}/edit', [AdminController::class, 'dataTrainingEdit'])->name('data_training.edit');
    Route::put('/data-training/{id}', [AdminController::class, 'dataTrainingUpdate'])->name('data_training.update');
    Route::delete('/data-training/{id}', [AdminController::class, 'dataTrainingDestroy'])->name('data_training.destroy');

    // ◄ PENYESUAIAN: Rute Baru untuk Halaman Riwayat Global Admin
    Route::get('/riwayat', [AdminController::class, 'riwayatGlobal'])->name('riwayat');
});