
<nav class="bg-slate-900 text-white shadow-sm" x-data="{ open: false }">
    <div class="max-w-full px-4 sm:px-6 lg:px-8">

        <!-- Navbar Utama -->
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
                <div class="flex items-center">
                    <div>
                        <h1 class="font-bold text-lg leading-tight">
                            Perpustakaan
                        </h1>
                        <p class="text-xs text-slate-400">
                            Management System
                        </p>
                    </div>
                </div>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex items-center gap-1">

                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('dashboard.admin') }}"
                        class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('dashboard.admin') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        Dashboard
                    </a>
                @elseif (auth()->user()->hasRole('Petugas'))
                    <a href="{{ route('dashboard.petugas') }}"
                        class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('dashboard.petugas') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        Dashboard
                    </a>
                @endif

                <a href="{{ route('buku.index') }}"
                    class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('buku.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                    Data Buku
                </a>

                @if (auth()->user()->hasRole('Admin'))
                    <a href="{{ route('users.index') }}"
                        class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        Data Pengguna
                    </a>
                @endif

                @can('kelola peminjaman')
                    <a href="{{ route('peminjaman.index') }}"
                        class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('peminjaman.index') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        Peminjaman
                    </a>
                @endcan

                @if (auth()->user()->hasRole('Siswa'))
                    <a href="{{ route('peminjaman.riwayat') }}"
                        class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('peminjaman.riwayat') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        Riwayat Saya
                    </a>
                @endif

                @can('lihat laporan perpustakaan')
                    <a href="{{ route('laporan.index') }}"
                        class="px-3 py-2 rounded text-sm transition {{ request()->routeIs('laporan.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                        Laporan
                    </a>
                @endcan

            </div>

            <!-- Informasi Pengguna Desktop -->
            <div class="hidden lg:flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-400">
                        {{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}
                    </p>
                </div>

                @can('lihat profil sendiri')
                    <a href="{{ route('profile.edit') }}"
                        class="px-3 py-2 text-sm rounded bg-slate-800 hover:bg-slate-700">
                        Profil
                    </a>
                @endcan

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-3 py-2 text-sm rounded bg-red-600 hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>

            <!-- Tombol Menu Mobile -->
            <button @click="open = !open"
                class="lg:hidden p-2 rounded hover:bg-slate-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

        </div>

        <!-- Menu Mobile -->
        <div x-show="open" x-cloak class="lg:hidden border-t border-slate-700 py-3 space-y-1">

            @if (auth()->user()->hasRole('Admin'))
                <a href="{{ route('dashboard.admin') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                    Dashboard
                </a>
            @elseif (auth()->user()->hasRole('Petugas'))
                <a href="{{ route('dashboard.petugas') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                    Dashboard
                </a>
            @endif

            <a href="{{ route('buku.index') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                Data Buku
            </a>

            @if (auth()->user()->hasRole('Admin'))
                <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                    Data Pengguna
                </a>
            @endif

            @can('kelola peminjaman')
                <a href="{{ route('peminjaman.index') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                    Peminjaman
                </a>
            @endcan

            @if (auth()->user()->hasRole('Siswa'))
                <a href="{{ route('peminjaman.riwayat') }}"
                    class="block px-3 py-2 rounded hover:bg-slate-800">
                    Riwayat Saya
                </a>
            @endif

            @can('lihat laporan perpustakaan')
                <a href="{{ route('laporan.index') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                    Laporan
                </a>
            @endcan

            @can('lihat profil sendiri')
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded hover:bg-slate-800">
                    Profil Saya
                </a>
            @endcan

            <div class="border-t border-slate-700 pt-3 mt-3">
                <p class="px-3 text-sm font-semibold">{{ auth()->user()->name }}</p>
                <p class="px-3 text-xs text-blue-400 mb-3">
                    {{ auth()->user()->getRoleNames()->first() ?? 'Pengguna' }}
                </p>

                <form method="POST" action="{{ route('logout') }}" class="px-3">
                    @csrf
                    <button type="submit"
                        class="w-full px-3 py-2 rounded bg-red-600 hover:bg-red-700 text-sm">
                        Logout
                    </button>
                </form>
            </div>

        </div>

    </div>
</nav>
