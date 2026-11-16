
@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Pengelolaan Pengguna
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola data pengguna dan hak akses sistem perpustakaan.
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

        <!-- Form Tambah Pengguna -->
        <div class="bg-white border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-5">
                Tambah Pengguna
            </h2>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Pengguna
                    </label>
                    <input type="text" name="name"
                        placeholder="Masukkan nama pengguna"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email" name="email"
                        placeholder="Masukkan email"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input type="password" name="password"
                        placeholder="Password minimal 8 karakter"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Role Pengguna
                    </label>
                    <select name="role"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Tambah Pengguna
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabel Pengguna -->
        <div class="bg-white border border-gray-200 overflow-x-auto">
            <div class="p-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">
                    Daftar Pengguna
                </h2>
            </div>

            <table class="w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-5 py-3 font-semibold">No</th>
                        <th class="px-5 py-3 font-semibold">Nama</th>
                        <th class="px-5 py-3 font-semibold">Email</th>
                        <th class="px-5 py-3 font-semibold">Role</th>
                        <th class="px-5 py-3 font-semibold">Tanggal Dibuat</th>
                        <th class="px-5 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-5 py-4 text-gray-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-5 py-4 font-medium text-gray-800">
                                {{ $user->name }}
                            </td>
                            <td class="px-5 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-5 py-4">
                                {{ $user->getRoleNames()->implode(', ') }}
                            </td>
                            <td class="px-5 py-4">
                                {{ $user->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="inline-block px-3 py-1 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 mr-1">
                                    Ubah
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}"
                                    method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-6 text-center text-sm text-gray-500">
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
