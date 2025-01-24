<?php

use App\Http\Controllers\adminJabatanController;
use App\Http\Controllers\adminUserController;
use App\Http\Controllers\adminProdukController;
use App\Http\Controllers\adminKategoriController;
use App\Http\Controllers\adminMerkController;
use App\Http\Controllers\adminStaffController;
use App\Http\Controllers\adminTransaksiController;
use App\Http\Controllers\adminTransaksiDetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard 
    Route::get('/dashboard', function () {
        $content = 'admin.dashboard.index';
        return view('admin.layouts.wrapper', compact('content'));
    })->name('dashboard');


        // Prefix Admin Routes
        Route::prefix('admin')->group(function () {
        Route::resource('/kategori', adminKategoriController::class);
        Route::resource('/merk', adminMerkController::class);
        Route::resource('/transaksi', adminTransaksiController::class);
        Route::post('/transaksi/detail/create', [adminTransaksiDetailController::class, 'create']);

        // CRUD Jabatan
        Route::resource('/jabatan',adminJabatanController::class);

        // CRUD Staff
        Route::resource('/staff',adminStaffController::class);

        // CRUD Kategori
        Route::resource('/kategori', adminKategoriController::class);


        // Nested Route untuk Transaksi Detail
        Route::prefix('/transaksi/{transaksi}')->group(function () {
        });

        Route::resource('/produk', adminProdukController::class);
        
        Route::resource('/user', adminUserController::class);
    });

    // Post Management
    Route::get('/post', function () {
        $content = 'admin.post.index';
        return view('admin.layouts.wrapper', compact('content'));
    });
});

// Verifikasi Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Auth Routes
Auth::routes();
