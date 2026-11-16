
<x-app-layout>
    <div class="space-y-6">

        <!-- Judul Halaman -->
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Profil Pengguna
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola informasi akun dan keamanan password.
            </p>
        </div>

        <!-- Informasi Profil -->
        <div class="bg-white border border-gray-200 p-6">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Ubah Password -->
        <div class="bg-white border border-gray-200 p-6">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Hapus Akun -->
        <div class="bg-white border border-gray-200 p-6">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</x-app-layout>
