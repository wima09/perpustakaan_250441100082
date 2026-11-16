<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-800">
            Login Perpustakaan
        </h1>
        <p class="text-sm text-gray-500 mt-2">
            Silakan masuk menggunakan akun Anda.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-600">
                    Ingat saya
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a
                    class="text-sm text-blue-700 hover:text-blue-900 hover:underline"
                    href="{{ route('password.request') }}"
                >
                    Lupa password?
                </a>
            @endif

            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                Login
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center text-sm text-gray-600">
        Belum memiliki akun?
        <a href="{{ route('register') }}"
           class="text-blue-700 hover:underline">
            Register
        </a>
    </div>
</x-guest-layout>