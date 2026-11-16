<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuController extends Controller
{
    private function formatBuku($book)
    {
        return [
            'id' => $book->id,
            'judul' => $book->judul,
            'penulis' => $book->penulis,
            'tahun' => $book->tahun_terbit,
            'kategori' => $book->kategori->nama ?? 'Tidak diketahui',
            'cover' => 'buku' . $book->id . '.png',
        ];
    }

    public function index()
    {
        $books = Buku::with('kategori')->get()
            ->map(function ($book) {
                return $this->formatBuku($book);
            });

        return view('buku.index', ['books' => $books]);
    }

    public function show($id)
    {
        $item = Buku::with('kategori')->findOrFail($id);
        $book = $this->formatBuku($item);

        return view('buku.show', ['book' => $book]);
    }
}
