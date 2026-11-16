
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

<body class="font-sans antialiased bg-slate-100 text-slate-800">
    <div class="min-h-screen">

        @include('layouts.navigation')

        <div class="min-h-screen">

            @isset($header)
                <header class="bg-white border-b border-slate-200">
                    <div class="px-4 sm:px-6 lg:px-8 py-5">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-4 sm:p-6 lg:p-8">
                {{ $slot ?? '' }}
                @yield('content')
            </main>

        </div>
    </div>
</body>
</html>