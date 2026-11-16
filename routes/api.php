<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;

// Melihat daftar dan detail buku
Route::get('/buku', [BukuController::class, 'index']);
Route::get('/buku/{buku}', [BukuController::class, 'show']);

// Mengelola buku hanya untuk pengguna yang login
// dan memiliki permission kelola data buku
Route::middleware(['auth:sanctum', 'permission:kelola data buku'])->group(function () {
    Route::post('/buku', [BukuController::class, 'store']);
    Route::put('/buku/{buku}', [BukuController::class, 'update']);
    Route::patch('/buku/{buku}', [BukuController::class, 'update']);
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);
});

// Melihat laporan hanya untuk pengguna yang memiliki izin
Route::middleware(['auth:sanctum', 'permission:lihat laporan perpustakaan'])->group(function () {
    Route::get('/rekap/buku-per-kategori', [
        BukuController::class,
        'rekapBukuPerKategori'
    ]);

    Route::get('/rekap/peminjaman-per-buku', [
        BukuController::class,
        'rekapPeminjamanPerBuku'
    ]);
});