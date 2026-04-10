<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Hub - Selamat Datang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18] min-h-screen">
    <div class="mx-auto max-w-6xl px-6 py-10 lg:px-8">
        <header class="mb-12 flex flex-col gap-6 rounded-[2rem] bg-white/80 p-6 shadow-xl ring-1 ring-[#e3e3e0] backdrop-blur-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#f53003]">Event Hub</p>
                <h1 class="mt-4 text-4xl font-bold sm:text-5xl">Landing page profesional untuk event dan layanan acara.</h1>
                <p class="mt-4 max-w-3xl text-base leading-8 text-[#706f6c]">Temukan paket event, paket layanan, dan bantuan semua dalam satu platform dengan tampilan yang seragam dan modern.</p>
            </div>
            <nav class="flex flex-wrap gap-3 text-sm font-medium">
                <a href="/kontak" class="rounded-full bg-[#1b1b18] px-5 py-3 text-white transition hover:bg-[#222]">Kontak</a>
                <a href="/katalog" class="rounded-full border border-[#e3e3e0] bg-white px-5 py-3 text-[#1b1b18] transition hover:border-[#19140035]">Katalog</a>
                <a href="/profil" class="rounded-full border border-[#e3e3e0] bg-white px-5 py-3 text-[#1b1b18] transition hover:border-[#19140035]">Profil</a>
                <a href="/bantuan" class="rounded-full border border-[#e3e3e0] bg-white px-5 py-3 text-[#1b1b18] transition hover:border-[#19140035]">Bantuan</a>
            </nav>
        </header>

        <main class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr]">
            <section class="rounded-[2rem] bg-white p-8 shadow-xl ring-1 ring-[#e3e3e0]">
                <span class="inline-flex rounded-full bg-[#fff2f2] px-4 py-2 text-sm font-semibold text-[#f53003]">Landing Page</span>
                <h2 class="mt-6 text-3xl font-bold">Sajikan pengalaman pengunjung yang rapi dan mudah dijelajahi.</h2>
                <p class="mt-4 text-base leading-7 text-[#706f6c]">Halaman utama ini mengarahkan calon pelanggan ke semua halaman penting: kontak, katalog layanan, profil tim, dan bantuan. Desainnya konsisten dengan warna, tipografi, dan kartu yang modern.</p>
                <div class="mt-10 grid gap-4 sm:grid-cols-2">
                    <article class="rounded-[1.5rem] bg-[#fff2f2] p-6 shadow ring-1 ring-[#e3e3e0]">
                        <p class="text-sm font-semibold text-[#1b1b18]">Navigasi cepat</p>
                        <p class="mt-3 text-sm text-[#706f6c]">Akses cepat ke halaman kontak, katalog, profil, dan bantuan dari navbar teratas.</p>
                    </article>
                    <article class="rounded-[1.5rem] bg-[#fff2f2] p-6 shadow ring-1 ring-[#e3e3e0]">
                        <p class="text-sm font-semibold text-[#1b1b18]">Gaya seragam</p>
                        <p class="mt-3 text-sm text-[#706f6c]">Setiap halaman dibangun dengan komponen kartu, warna netral, dan tipografi yang mudah dibaca.</p>
                    </article>
                </div>
                <div class="mt-10 flex flex-wrap gap-3">
                    <a href="/katalog" class="inline-flex items-center justify-center rounded-full bg-[#1b1b18] px-6 py-3 text-white transition hover:bg-[#222]">Jelajahi Katalog</a>
                    <a href="/kontak" class="inline-flex items-center justify-center rounded-full border border-[#e3e3e0] bg-white px-6 py-3 text-[#1b1b18] transition hover:border-[#19140035]">Hubungi Kami</a>
                </div>
            </section>

            <aside class="rounded-[2rem] bg-[#1b1b18] p-8 text-white shadow-xl ring-1 ring-[#1b1b18]">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-[#f53003]">Mengapa memilih</p>
                <h3 class="mt-6 text-3xl font-bold">Solusi acara lengkap</h3>
                <p class="mt-4 text-base leading-7 text-[#d7d7d5]">Desain halaman ini membantu pengunjung memahami secara jelas apa saja fungsi tiap menu dan bagaimana mereka dapat berinteraksi dengan platform Anda.</p>
                <div class="mt-8 space-y-4">
                    <div class="rounded-[1.5rem] bg-[#fff2f2] p-5 text-[#1b1b18]">
                        <p class="font-semibold">Katalog layanan</p>
                        <p class="mt-2 text-sm text-[#706f6c]">Menampilkan paket event, workshop, dan layanan pendukung.</p>
                    </div>
                    <div class="rounded-[1.5rem] bg-[#fff2f2] p-5 text-[#1b1b18]">
                        <p class="font-semibold">Detail tim</p>
                        <p class="mt-2 text-sm text-[#706f6c]">Profil organisasi yang menjelaskan tujuan, visi, dan nilai.</p>
                    </div>
                </div>
            </aside>
        </main>
    </div>
</body>
</html>
