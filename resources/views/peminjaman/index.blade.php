@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Data Pengajuan Peminjaman
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola pengajuan, persetujuan, dan pengembalian buku.
            </p>
        </div>

        <!-- Pesan -->
        @if (session('success'))
            <div class="border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tabel Peminjaman -->
        <div class="bg-white border border-gray-200 overflow-x-auto">

            <div class="p-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    Daftar Peminjaman
                </h2>
            </div>

            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-5 py-3 font-semibold">No</th>
                        <th class="px-5 py-3 font-semibold">Nama Siswa</th>
                        <th class="px-5 py-3 font-semibold">Judul Buku</th>
                        <th class="px-5 py-3 font-semibold">Tanggal Pinjam</th>
                        <th class="px-5 py-3 font-semibold">Tanggal Kembali</th>
                        <th class="px-5 py-3 font-semibold">Status</th>
                        <th class="px-5 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($peminjamans as $peminjaman)
                        <tr class="hover:bg-gray-50">

                            <td class="px-5 py-4 text-gray-500">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $peminjaman->anggota->nama }}
                            </td>

                            <td class="px-5 py-4 text-gray-800">
                                {{ $peminjaman->buku->judul }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ $peminjaman->tanggal_pinjam }}
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                {{ $peminjaman->tanggal_kembali ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if ($peminjaman->status == 'menunggu')
                                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 text-xs rounded">
                                        Menunggu
                                    </span>
                                @elseif ($peminjaman->status == 'disetujui')
                                    <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded">
                                        Disetujui
                                    </span>
                                @elseif ($peminjaman->status == 'dikembalikan')
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs rounded">
                                        Dikembalikan
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded">
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 whitespace-nowrap">
                                @if ($peminjaman->status == 'menunggu')
                                    <form action="{{ route('peminjaman.setujui', $peminjaman->id) }}"
                                        method="POST">
                                        @csrf

                                        <button type="submit"
                                            class="px-3 py-2 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                            Setujui
                                        </button>
                                    </form>

                                @elseif ($peminjaman->status == 'disetujui')
                                    <form action="{{ route('peminjaman.kembalikan', $peminjaman->id) }}"
                                        method="POST">
                                        @csrf

                                        <button type="submit"
                                            class="px-3 py-2 bg-blue-600 text-white text-xs rounded hover:bg-blue-700">
                                            Kembalikan
                                        </button>
                                    </form>

                                @else
                                    <span class="text-sm text-gray-500">
                                        Selesai
                                    </span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="px-5 py-6 text-center text-sm text-gray-500">
                                Belum ada pengajuan peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
