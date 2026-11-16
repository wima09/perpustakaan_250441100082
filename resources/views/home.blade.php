@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="hero">
        <div class="hero-content">
            <span class="hero-label">SELAMAT DATANG</span>

            <h2>
                Temukan Buku Favoritmu
                <span>di Perpustakaan</span>
            </h2>

            <p>
                Jelajahi berbagai koleksi buku yang tersedia dan
                temukan bacaan yang sesuai dengan minatmu.
            </p>

            <div class="hero-actions">
                <a href="{{ route('buku.index') }}" class="hero-button">
                    Jelajahi Koleksi
                </a>

                <a href="{{ route('buku.index') }}" class="hero-link">
                    Lihat daftar buku →
                </a>
            </div>
        </div>
    </section>
@endsection