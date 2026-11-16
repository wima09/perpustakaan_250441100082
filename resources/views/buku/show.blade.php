@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')

    @if ($book)

        <div class="book-detail">

            <div class="book-detail-cover">
                <img src="{{ asset('image/' . $book['cover']) }}"
                     alt="{{ $book['judul'] }}">
            </div>

            <div class="book-detail-content">

                <span class="detail-label">DETAIL BUKU</span>

                <h2>{{ $book['judul'] }}</h2>

                <p class="book-description">
                    Informasi lengkap mengenai buku yang tersedia
                    dalam koleksi perpustakaan.
                </p>

                <div class="book-info">
                    <div class="info-item">
                        <span>Penulis</span>
                        <strong>{{ $book['penulis'] }}</strong>
                    </div>

                    <div class="info-item">
                        <span>Tahun Terbit</span>
                        <strong>{{ $book['tahun'] }}</strong>
                    </div>

                    <div class="info-item">
                        <span>Kategori</span>
                        <strong>{{ $book['kategori'] }}</strong>
                    </div>

                </div>

                <a href="{{ route('buku.index') }}" class="back-button">
                    ← Kembali ke Daftar Buku
                </a>

            </div>

        </div>

    @else

        <div class="not-found">
            <h2>Buku Tidak Ditemukan</h2>
            <p>
                Maaf, buku yang kamu cari tidak tersedia
                dalam koleksi perpustakaan.
            </p>

            <a href="{{ route('buku.index') }}" class="back-button">
                ← Kembali ke Daftar Buku
            </a>

        </div>

    @endif

@endsection