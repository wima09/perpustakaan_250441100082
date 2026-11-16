
<section>
    <header class="border-b border-gray-200 pb-4">
        <h2 class="text-lg font-semibold text-gray-800">
            Ganti Password
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Perbarui password akun untuk menjaga keamanan.
        </p>
    </header>

    <form method="post"
        action="{{ route('password.update') }}"
        class="mt-6 space-y-5">

        @csrf
        @method('put')

        <!-- Password Saat Ini -->
        <div>
            <x-input-label
                for="update_password_current_password"
                value="Password Saat Ini"
            />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />
        </div>

        <!-- Password Baru -->
        <div>
            <x-input-label
                for="update_password_password"
                value="Password Baru"
            />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />
        </div>

        <!-- Konfirmasi Password -->
        <div>
            <x-input-label
                for="update_password_password_confirmation"
                value="Konfirmasi Password Baru"
            />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />
        </div>

        <!-- Tombol Simpan -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >
                    Password berhasil diperbarui.
                </p>
            @endif
        </div>

    </form>
</section>
