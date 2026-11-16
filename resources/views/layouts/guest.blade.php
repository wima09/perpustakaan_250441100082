<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-800">

    <nav class="bg-white border-b">
        <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
            <a href="/" class="text-xl font-bold text-blue-700">
                Perpustakaan
            </a>
        </div>
    </nav>

    <main class="min-h-screen flex justify-center items-start px-4 py-12">
        <div class="w-full max-w-md bg-white border rounded-lg px-6 py-6">
            {{ $slot }}
        </div>
    </main>

</body>
</html>