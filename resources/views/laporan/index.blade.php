
<x-app-layout>
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Laporan Perpustakaan
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Informasi rekapitulasi data buku dan peminjaman perpustakaan.
            </p>
        </div>

        <!-- Rekap Buku per Kategori -->
        <div class="bg-white border border-gray-200 overflow-x-auto">

            <div class="p-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    Rekap Buku per Kategori
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Jumlah koleksi buku berdasarkan kategori.
                </p>
            </div>

            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-5 py-3 font-semibold">No</th>
                        <th class="px-5 py-3 font-semibold">Kategori</th>
                        <th class="px-5 py-3 font-semibold">Jumlah Buku</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($bukuPerKategori as $kategori)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $kategori->nama }}
                            </td>
                            <td class="px-5 py-4 text-gray-600">
                                {{ $kategori->bukus_count }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3"
                                class="px-5 py-6 text-center text-sm text-gray-500">
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Rekap Peminjaman per Buku -->
        <div class="bg-white border border-gray-200 overflow-x-auto">

            <div class="p-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    Rekap Peminjaman per Buku
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Jumlah peminjaman untuk setiap judul buku.
                </p>
            </div>

            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-5 py-3 font-semibold">No</th>
                        <th class="px-5 py-3 font-semibold">Judul Buku</th>
                        <th class="px-5 py-3 font-semibold">Penulis</th>
                        <th class="px-5 py-3 font-semibold">Jumlah Peminjaman</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjamanPerBuku as $buku)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $buku->judul }}
                            </td>
                            <td class="px-5 py-4 text-gray-600">
                                {{ $buku->penulis }}
                            </td>
                            <td class="px-5 py-4 text-gray-600">
                                {{ $buku->peminjamans_count }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="px-5 py-6 text-center text-sm text-gray-500">
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
