
<x-app-layout>
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Dashboard
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Selamat datang, {{ auth()->user()->name }}.
                Berikut informasi perpustakaan saat ini.
            </p>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="bg-white border border-gray-200 p-5">
                <p class="text-sm text-gray-500">Jumlah Buku</p>
                <h2 class="text-3xl font-semibold text-gray-800 mt-2">
                    {{ $totalBuku }}
                </h2>
            </div>

            <div class="bg-white border border-gray-200 p-5">
                <p class="text-sm text-gray-500">Jumlah Pengguna</p>
                <h2 class="text-3xl font-semibold text-gray-800 mt-2">
                    {{ $totalPengguna }}
                </h2>
            </div>

            <div class="bg-white border border-gray-200 p-5">
                <p class="text-sm text-gray-500">Jumlah Peminjaman</p>
                <h2 class="text-3xl font-semibold text-gray-800 mt-2">
                    {{ $totalPeminjaman }}
                </h2>
            </div>

        </div>

        <!-- Informasi Sistem -->
        <div class="bg-white border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">
                Informasi Sistem
            </h2>

            <p class="text-sm text-gray-600 leading-6">
                Sistem Informasi Perpustakaan digunakan untuk
                membantu pengelolaan data buku, data pengguna,
                peminjaman, pengembalian, dan laporan perpustakaan.
            </p>

            <a href="{{ route('buku.index') }}"
               class="inline-block mt-5 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                Lihat Data Buku
            </a>
        </div>

    </div>
</x-app-layout>
