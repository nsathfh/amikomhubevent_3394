<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin - AmikomEventHub' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="flex min-h-screen bg-slate-50 text-slate-900">

    <aside class="sticky top-0 flex h-screen w-64 flex-col space-y-8 bg-indigo-900 p-6 text-indigo-100">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-xl font-bold text-indigo-900">
                AH
            </div>
            <span class="text-xl font-bold tracking-tight text-white">AmikomEventHub</span>
        </div>

        <nav class="flex-1 space-y-2">
            <p class="mb-4 px-2 text-[10px] font-bold uppercase tracking-widest text-indigo-400">Main Menu</p>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.events.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 font-bold transition {{ request()->routeIs('admin.events.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.events.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                Kelola Event
            </a>

            <a href="{{ route('admin.transactions.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 font-bold transition {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.transactions.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                Laporan Transaksi
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 font-bold transition {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }}">
                <svg class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-300' : 'text-indigo-400' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18">
                    </path>
                </svg>
                Manajemen Kategori
            </a>
        </nav>

        <div class="border-t border-indigo-800 pt-6">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 px-4 py-3 font-medium text-indigo-300 transition hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Keluar
            </a>
        </div>
    </aside>

    @yield('content')

</body>

</html>
