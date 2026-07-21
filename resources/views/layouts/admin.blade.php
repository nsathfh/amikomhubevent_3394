<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }} - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-50 text-slate-900 flex min-h-screen">
    <aside class="w-64 bg-indigo-900 text-indigo-100 flex flex-col p-6 space-y-8 sticky top-0 h-screen">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">AH</div>
            <span class="text-xl font-bold text-white tracking-tight">AmikomEventHub</span>
        </div>
        <nav class="flex-1 space-y-2">
            <p class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 mb-4 px-2">Main Menu</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800 text-indigo-100' }} rounded-xl font-bold transition">Dashboard</a>
            <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800 text-indigo-100' }} rounded-xl font-bold transition">
                Kelola Event
            </a>
            <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800 text-indigo-100' }} rounded-xl font-bold transition">
                Kelola Transaksi
            </a>
            <a href="{{ route('admin.scan') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.scan') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800 text-indigo-100' }} rounded-xl font-bold transition text-amber-300 hover:text-amber-100">
                Scan QR Check-in
            </a>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800 text-indigo-100' }} rounded-xl font-bold transition">
                Kelola Kategori
            </a>
            <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.partners.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800 text-indigo-100' }} rounded-xl font-bold transition">
                Kelola Partner
            </a>
            @endif
        </nav>

        <!-- User Profile & Logout -->
        <!-- Bagian ini menampilkan nama admin yang sedang login dan tombol logout aman (menggunakan POST + CSRF token) -->
        <div class="border-t border-indigo-800 pt-6">
            <div class="flex items-center gap-3 px-2 mb-4">
                <!-- Menampilkan inisial nama admin -->
                <div class="w-8 h-8 rounded-full bg-indigo-700 flex items-center justify-center text-xs font-bold text-white uppercase">
                    {{ substr(auth()->user()->name, 0, 2) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-indigo-300 truncate">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <!-- Logout dikirimkan sebagai form POST untuk mencegah serangan CSRF -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 bg-red-600/10 hover:bg-red-600/20 text-red-400 hover:text-red-300 rounded-xl font-bold transition text-left cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>


    <main class="flex-1 p-10 overflow-y-auto">
        @yield('content')
    </main>
</body>
</html>
