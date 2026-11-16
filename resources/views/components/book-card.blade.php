<div class="book-card">

    <h3>{{ $book['judul'] }}</h3>

    <p>Penulis: {{ $book['penulis'] }}</p>

    <p>Tahun Terbit: {{ $book['tahun'] }}</p>

    <a href="{{ route('buku.show', $book['id']) }}">
        Lihat Detail
    </a>

    {{ $slot }}

</div>