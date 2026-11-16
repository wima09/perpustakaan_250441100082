<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BukuResource;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    public function index(Request $request)
    {
        $query = Buku::with('kategori')
            ->withCount('peminjamans');

        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('judul', 'like', "%{$cari}%")
                ->orWhere('penulis', 'like', "%{$cari}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun_terbit', $request->tahun);
        }

        $buku = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return BukuResource::collection($buku);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'tahun_terbit' => 'required|integer',
        ]);

        $buku = Buku::create($validated);

        return response()->json([
            'message' => 'Buku berhasil ditambahkan.',
            'data' => $buku->load('kategori'),
        ], 201);
    }


    public function show(string $id)
    {
        $buku = Buku::with('kategori')->find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'data' => $buku,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => 'sometimes|required|exists:kategoris,id',
            'judul' => 'sometimes|required|string',
            'penulis' => 'sometimes|required|string',
            'tahun_terbit' => 'sometimes|required|integer',
        ]);

        $buku->update($validated);

        return response()->json([
            'message' => 'Data buku berhasil diperbarui',
            'data' => $buku
        ], 200);
    }


    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'Buku tidak ditemukan.',
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'message' => 'Buku berhasil dihapus.',
        ], 200);
    }

    public function rekapBukuPerKategori()
    {
        $data = \App\Models\Kategori::withCount('bukus')->get();

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function rekapPeminjamanPerBuku()
    {
        $data = Buku::withCount('peminjamans')->get();

        return response()->json([
            'data' => $data
        ], 200);
    }
}