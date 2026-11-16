
<section>
    <header class="border-b border-gray-200 pb-4">
        <h2 class="text-lg font-semibold text-gray-800">
            Informasi Profil
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui nama dan alamat email akun kamu.
        </p>
    </header>

    <!-- Form Verifikasi Email -->
    <form id="send-verification"
        method="post"
        action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Form Informasi Profil -->
    <form method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-5">

        @csrf
        @method('patch')

        <!-- Nama -->
        <div>
            <x-input-label for="name" value="Nama Pengguna" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Alamat Email" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            <!-- Verifikasi Email -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 border border-yellow-200 bg-yellow-50 p-3">
                    <p class="text-sm text-yellow-800">
                        Alamat email kamu belum diverifikasi.
                    </p>

                    <button
                        form="send-verification"
                        type="submit"
                        class="mt-2 text-sm text-blue-600 underline hover:text-blue-800">
                        Kirim ulang email verifikasi
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            Link verifikasi baru telah dikirim ke email kamu.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    Profil berhasil diperbarui.
                </p>
            @endif
        </div>

    </form>
</section>
