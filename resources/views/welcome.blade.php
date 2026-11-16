
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white border-b">
        <div class="w-full px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-700">
                Perpustakaan
            </h1>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-blue-700 hover:underline">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                        class="px-4 py-2 rounded text-blue-700 hover:bg-blue-100 transition">
                            Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-24">
        <div class="bg-white rounded-lg p-10 text-center border">
            <h2 class="text-3xl font-bold mb-4">
                Selamat Datang di Perpustakaan
            </h2>

            <p class="text-gray-600 max-w-2xl mx-auto mb-8">
                Sistem Informasi Perpustakaan merupakan aplikasi
                untuk mengelola data buku, peminjaman, dan
                pengembalian buku secara lebih mudah.
            </p>

            <a href="{{ route('login') }}"
               class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
                Mulai Sekarang
            </a>
        </div>
    </main>

    <footer class="text-center text-sm text-gray-500 py-6">
        &copy; {{ date('Y') }} Sistem Informasi Perpustakaan
    </footer>

</body>
</html>
