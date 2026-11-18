<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
    //

    public function index()
    {
        $peminjamans = Peminjaman::with(['anggota', 'buku'])
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjamans'));
    }

    public function setujui($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'disetujui',
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now()->toDateString(),
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }

    public function riwayat()
    {
        $anggota = Auth::user()->anggota;

        if (!$anggota) {
            $peminjamans = collect();
        } else {
            $peminjamans = Peminjaman::with('buku')
                ->where('anggota_id', $anggota->id)
                ->latest()
                ->get();
        }

        return view('peminjaman.riwayat', compact('peminjamans'));
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);
        $user = Auth::user();

        // Admin/petugas boleh melihat semua; siswa hanya miliknya sendiri
        if (!Gate::forUser($user)->allows('kelola peminjaman')) {
            $anggota = $user->anggota;
            abort_unless($anggota && $peminjaman->anggota_id === $anggota->id, 403);
        }

        return view('peminjaman.show', compact('peminjaman'));
    }

    public function ajukan(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $anggota = Auth::user()->anggota;

        if (!$anggota) {
            return back()->with('error', 'Data anggota tidak ditemukan.');
        }

        Peminjaman::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => now()->toDateString(),
            'tanggal_kembali' => null,
            'status' => 'menunggu',
        ]);

        return back()->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }
}