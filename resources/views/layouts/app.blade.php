<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Amikom Event Hub' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-linear-to-b from-blue-100 via-blue-50 to-white text-slate-900">
    <header class="sticky top-0 z-20 border-b border-blue-200/70 bg-blue-900/95 text-white backdrop-blur-sm">
        <div class="mx-auto flex w-full max-w-6xl flex-col gap-4 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div>
                <h1 class="text-xl font-bold">Amikom Event Hub</h1>
            </div>
            <nav class="flex flex-wrap gap-2 text-sm font-semibold">
                <a href="/" class="rounded-full px-4 py-2 transition {{ ($active ?? '') === 'home' ? 'bg-white text-blue-900' : 'bg-blue-800 text-white hover:bg-blue-700' }}">Home</a>
                <a href="/tentang" class="rounded-full px-4 py-2 transition {{ ($active ?? '') === 'tentang' ? 'bg-white text-blue-900' : 'bg-blue-800 text-white hover:bg-blue-700' }}">Tentang</a>
                <a href="/katalog" class="rounded-full px-4 py-2 transition {{ ($active ?? '') === 'katalog' ? 'bg-white text-blue-900' : 'bg-blue-800 text-white hover:bg-blue-700' }}">Katalog</a>
                <a href="/profil" class="rounded-full px-4 py-2 transition {{ ($active ?? '') === 'profil' ? 'bg-white text-blue-900' : 'bg-blue-800 text-white hover:bg-blue-700' }}">Profil</a>
                <a href="/kontak" class="rounded-full px-4 py-2 transition {{ ($active ?? '') === 'kontak' ? 'bg-white text-blue-900' : 'bg-blue-800 text-white hover:bg-blue-700' }}">Kontak</a>
                <a href="/bantuan" class="rounded-full px-4 py-2 transition {{ ($active ?? '') === 'bantuan' ? 'bg-white text-blue-900' : 'bg-blue-800 text-white hover:bg-blue-700' }}">Bantuan</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <footer class="border-t border-blue-100 bg-white/70">
        <div class="mx-auto w-full max-w-6xl px-4 py-6 text-sm text-slate-600 sm:px-6 lg:px-8">
            <p>Copyright {{ date('Y') }} Amikom Event Hub.</p>
        </div>
    </footer>
</body>
</html>