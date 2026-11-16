<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ReportController;
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard/admin', function () {
        $totalBuku = Buku::count();
        $totalPengguna = User::count();
        $totalPeminjaman = Peminjaman::count();

        return view('dashboard', compact(
            'totalBuku',
            'totalPengguna',
            'totalPeminjaman'
        ));
    })->middleware('role:Admin')->name('dashboard.admin');

    Route::get('/dashboard/petugas', function () {
        $totalBuku = Buku::count();
        $totalPengguna = User::count();
        $totalPeminjaman = Peminjaman::count();

        return view('dashboard', compact(
            'totalBuku',
            'totalPengguna',
            'totalPeminjaman'
        ));
    })->middleware('role:Petugas')->name('dashboard.petugas');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');
});

Route::middleware(['auth', 'permission:lihat profil sendiri'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
});

Route::middleware(['auth', 'permission:ubah profil sendiri'])->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])
        ->name('buku.index');

    Route::get('/buku/{id}', [BukuController::class, 'show'])
        ->name('buku.show');
});

Route::middleware(['auth', 'role:Siswa'])->group(function () {
    Route::post('/peminjaman', [PeminjamanController::class, 'ajukan'])
        ->name('peminjaman.ajukan');
});

Route::middleware(['auth', 'permission:melihat status peminjaman sendiri'])->group(function () {
    Route::get('/riwayat-peminjaman', [PeminjamanController::class, 'riwayat'])
        ->name('peminjaman.riwayat');
});

// Melihat daftar peminjaman
Route::middleware(['auth', 'permission:kelola peminjaman'])->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');
});

// Menyetujui pengajuan peminjaman
Route::middleware(['auth', 'permission:memproses persetujuan peminjaman'])->group(function () {
    Route::post('/peminjaman/{id}/setujui', [PeminjamanController::class, 'setujui'])
        ->name('peminjaman.setujui');
});

// Mencatat pengembalian buku
Route::middleware(['auth', 'permission:mencatat pengembalian buku'])->group(function () {
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembalikan');
});

Route::middleware(['auth', 'permission:lihat laporan perpustakaan'])->group(function () {
    Route::get('/laporan', [ReportController::class, 'index'])
        ->name('laporan.index');
});

require __DIR__.'/auth.php';