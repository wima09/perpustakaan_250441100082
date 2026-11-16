
<section class="space-y-6">

    <!-- Judul dan Keterangan -->
    <header class="border-b border-gray-200 pb-4">
        <h2 class="text-lg font-semibold text-red-600">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Menghapus akun akan menghapus seluruh data dan informasi
            yang terkait dengan akun tersebut secara permanen.
        </p>
    </header>

    <!-- Tombol Hapus -->
    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
        Hapus Akun
    </button>

    <!-- Modal Konfirmasi -->
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6">

            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-800">
                Apakah kamu yakin ingin menghapus akun?
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Setelah akun dihapus, seluruh data yang terkait
                akan dihapus secara permanen. Masukkan password
                untuk mengonfirmasi penghapusan akun.
            </p>

            <!-- Password -->
            <div class="mt-6">
                <x-input-label
                    for="password"
                    value="Password"
                    class="sr-only"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full"
                    placeholder="Masukkan password"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 flex justify-end gap-2">

                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-danger-button>
                    Hapus Akun
                </x-danger-button>

            </div>

        </form>
    </x-modal>

</section>
