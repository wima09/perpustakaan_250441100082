
@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Ubah Data Pengguna
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi dan hak akses pengguna.
            </p>
        </div>

        <!-- Form Edit Pengguna -->
        <div class="bg-white border border-gray-200 p-6">

            @if ($errors->any())
                <div class="mb-5 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}"
                method="POST" class="space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Pengguna
                    </label>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
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

                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('users.index') }}"
                        class="inline-block px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded hover:bg-gray-300">
                        Kembali
                    </a>
                </div>

            </form>
        </div>

    </div>
@endsection
    