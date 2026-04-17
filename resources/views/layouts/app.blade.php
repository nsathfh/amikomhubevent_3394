<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'AmikomEventHub - Temukan Event Seru!' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(14px);
        }

        @keyframes blob {
            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(18px, -24px) scale(1.08);
            }

            66% {
                transform: translate(-14px, 18px) scale(0.96);
            }
        }

        .animate-blob {
            animation: blob 9s infinite ease-in-out;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900">
    <nav
        class="glass sticky top-4 z-40 mx-4 mt-4 rounded-2xl border border-white/40 px-6 py-4 shadow-lg shadow-slate-200/60">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-lg font-black text-white">AH</div>
                <div>
                    <p class="text-lg font-extrabold tracking-tight">AmikomEventHub</p>
                    <p class="text-xs font-medium text-slate-500">Temukan event seru di satu tempat</p>
                </div>
            </a>

            <div class="hidden items-center gap-2 md:flex">
                <a href="{{ route('home') }}#events"
                    class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('home') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-200' : 'text-slate-600 hover:bg-white hover:text-indigo-600' }}">Jelajahi</a>
                <a href="{{ route('home') }}#events"
                    class="rounded-xl px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-white hover:text-indigo-600">Kategori</a>
                <a href="{{ route('home') }}#tentang"
                    class="rounded-xl px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-white hover:text-indigo-600">Tentang Kami</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer id="tentang" class="mt-20 bg-indigo-900 px-6 py-20 text-indigo-100">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 md:grid-cols-4">
            <div class="space-y-4 md:col-span-2">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-lg font-black text-indigo-900">AH</div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-sm text-indigo-300">Platform reservasi tiket event online terbaik untuk mahasiswa dan penyelenggara profesional.</p>
            </div>
            <div>
                <h4 class="mb-6 font-bold text-white">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('events.show') }}" class="transition hover:text-white">Detail Event</a></li>
                    <li><a href="{{ route('checkout') }}" class="transition hover:text-white">Checkout</a></li>
                    <li><a href="{{ route('admin.dashboard') }}" class="transition hover:text-white">Admin Dashboard</a></li>
                </ul>
            </div>
            <div>
                <h4 class="mb-6 font-bold text-white">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li>support@eventtiket.com</li>
                    <li>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        <div class="mx-auto mt-12 max-w-7xl border-t border-indigo-800 pt-12 text-center text-sm text-indigo-400">
            &copy; 2024 AmikomEventHub. Built with Laravel & Tailwind CSS.
        </div>
    </footer>
</body>

</html>