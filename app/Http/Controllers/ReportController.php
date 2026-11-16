<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;

class ReportController extends Controller
{
    public function index()
    {
        $bukuPerKategori = Kategori::withCount('bukus')->get();

        $peminjamanPerBuku = Buku::withCount('peminjamans')->get();

        return view('laporan.index', compact(
            'bukuPerKategori',
            'peminjamanPerBuku'
        ));
    }
}