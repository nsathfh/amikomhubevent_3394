<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Event Hub - Katalog</title>

        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme{:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;--color-black:#000;--color-white:#fff;--spacing:.25rem;--radius-lg:.5rem;--radius-xl:.75rem;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);}
                @layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");-webkit-tap-highlight-color:transparent}body{line-height:inherit}img,svg,video,canvas,audio,iframe,embed,object{max-width:100%;height:auto;display:block}button,input,select,textarea{font:inherit;background-color:transparent;border:none}ol,ul,menu{list-style:none}}@layer utilities{.bg-white{background-color:#fff}.bg-[#FDFDFC]{background-color:#FDFDFC}.bg-[#161615]{background-color:#161615}.bg-[#1b1b18]{background-color:#1b1b18}.bg-[#f53003]{background-color:#f53003}.bg-[#fff2f2]{background-color:#fff2f2}.text-[#1b1b18]{color:#1b1b18}.text-[#706f6c]{color:#706f6c}.text-white{color:#fff}.text-sm{font-size:.875rem;line-height:1.25rem}.text-base{font-size:1rem;line-height:1.5rem}.text-lg{font-size:1.125rem;line-height:1.75rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-2xl{font-size:1.5rem;line-height:2rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.font-medium{font-weight:500}.font-semibold{font-weight:600}.font-bold{font-weight:700}.uppercase{text-transform:uppercase}.tracking-[0.3em]{letter-spacing:.3em}.rounded-full{border-radius:9999px}.rounded-3xl{border-radius:1.5rem}.rounded-[1.5rem]{border-radius:1.5rem}.shadow-lg{box-shadow:0 25px 50px rgba(0,0,0,0.08)}.shadow-xl{box-shadow:0 20px 50px rgba(0,0,0,0.1)}.ring-1{box-shadow:0 0 0 1px rgba(0,0,0,0.05)}.ring-[#e3e3e0]{box-shadow:0 0 0 1px #e3e3e0}.max-w-6xl{max-width:72rem}.mx-auto{margin-left:auto;margin-right:auto}.px-6{padding-left:1.5rem;padding-right:1.5rem}.py-10{padding-top:2.5rem;padding-bottom:2.5rem}.lg\:px-8{padding-left:2rem;padding-right:2rem}.mb-10{margin-bottom:2.5rem}.mb-6{margin-bottom:1.5rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.mt-8{margin-top:2rem}.mt-10{margin-top:2.5rem}.gap-3{gap:.75rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.gap-8{gap:2rem}.grid{display:grid}.flex{display:flex}.items-center{align-items:center}.justify-between{justify-content:space-between}.justify-center{justify-content:center}.flex-col{flex-direction:column}.lg\:grid-cols-[1.2fr_0.8fr]{grid-template-columns:1.2fr 0.8fr}.sm\:flex-row{flex-direction:row}.sm\:items-center{align-items:center}.sm\:justify-between{justify-content:space-between}.sm\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.lg\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.gap-10{gap:2.5rem}.w-full{width:100%}.max-w-3xl{max-width:48rem}.text-center{text-align:center}.leading-7{line-height:1.75rem}.tracking-tight{letter-spacing:-.025em}.transition{transition:all .15s ease}.hover\:bg-[#f0f0f0]:hover{background-color:#f0f0f0}.hover\:bg-[#222]{background-color:#222}.hover\:text-white:hover{color:#fff}.hover\:shadow-xl:hover{box-shadow:0 20px 50px rgba(0,0,0,0.1)}.hover\:ring-[#19140035]:hover{box-shadow:0 0 0 1px #19140035}.dark\:bg-[#0a0a0a]{background-color:#0a0a0a}.dark\:bg-[#161615]{background-color:#161615}.dark\:text-[#EDEDEC]{color:#EDEDEC}.dark\:ring-[#1d1d1d]{box-shadow:0 0 0 1px #1d1d1d}.dark\:hover\:bg-[#111]:hover{background-color:#111}.dark\:hover\:text-white:hover{color:#fff}}
            </style>
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] min-h-screen">
        <div class="max-w-6xl mx-auto px-6 py-10 lg:px-8">
            <header class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.3em] text-[#f53003]">Event Hub</p>
                    <h1 class="mt-4 text-3xl font-semibold sm:text-4xl">Katalog Layanan & Event</h1>
                    <p class="mt-4 max-w-3xl text-base leading-7 text-[#706f6c]">Jelajahi pilihan paket event, workshop, dan layanan pendukung terbaik untuk membuat acara Anda lebih berkesan.</p>
                </div>
                <nav class="flex flex-wrap gap-3">
                    <a href="/" class="inline-flex items-center justify-center rounded-full bg-[#1b1b18] px-5 py-3 text-sm font-medium text-white transition hover:bg-[#222]">Beranda</a>
                    <a href="/kontak" class="inline-flex items-center justify-center rounded-full border border-[#e3e3e0] bg-white px-5 py-3 text-sm font-medium text-[#1b1b18] transition hover:border-[#19140035]">Kontak</a>
                    <a href="/bantuan" class="inline-flex items-center justify-center rounded-full border border-[#e3e3e0] bg-white px-5 py-3 text-sm font-medium text-[#1b1b18] transition hover:border-[#19140035]">Bantuan</a>
                </nav>
            </header>

            <section class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr] mb-10">
                <div class="rounded-[1.5rem] bg-white p-8 shadow-xl ring-1 ring-[#e3e3e0] dark:bg-[#161615] dark:ring-[#1d1d1d]">
                    <div class="flex flex-col gap-6">
                        <div class="rounded-3xl bg-[#fff2f2] p-6">
                            <p class="text-sm font-semibold text-[#f53003]">Filter Kategori</p>
                            <div class="mt-4 flex flex-wrap gap-3">
                                <span class="rounded-full bg-white px-4 py-2 text-sm font-medium text-[#1b1b18] shadow ring-1 ring-[#e3e3e0]">Seminar</span>
                                <span class="rounded-full bg-white px-4 py-2 text-sm font-medium text-[#1b1b18] shadow ring-1 ring-[#e3e3e0]">Workshop</span>
                                <span class="rounded-full bg-white px-4 py-2 text-sm font-medium text-[#1b1b18] shadow ring-1 ring-[#e3e3e0]">Konser</span>
                                <span class="rounded-full bg-white px-4 py-2 text-sm font-medium text-[#1b1b18] shadow ring-1 ring-[#e3e3e0]">Pameran</span>
                            </div>
                        </div>
                        <div class="rounded-[1.5rem] bg-white p-6 shadow ring-1 ring-[#e3e3e0] dark:bg-[#161615] dark:ring-[#1d1d1d]">
                            <h2 class="text-2xl font-semibold">Cari sesuai kebutuhan</h2>
                            <p class="mt-4 text-base leading-7 text-[#706f6c]">Pilih layanan berdasarkan jenis event, lokasi, atau paket harga untuk menemukan solusi yang paling sesuai.</p>
                            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                                <div class="rounded-3xl bg-[#fff2f2] p-5">
                                    <p class="text-sm font-medium text-[#1b1b18]">Lokasi</p>
                                    <p class="mt-3 text-base text-[#706f6c]">Bandung, Jakarta, Surabaya</p>
                                </div>
                                <div class="rounded-3xl bg-[#fff2f2] p-5">
                                    <p class="text-sm font-medium text-[#1b1b18]">Harga</p>
                                    <p class="mt-3 text-base text-[#706f6c]">Mulai dari Rp150.000</p>
                                </div>
                                <div class="rounded-3xl bg-[#fff2f2] p-5">
                                    <p class="text-sm font-medium text-[#1b1b18]">Peserta</p>
                                    <p class="mt-3 text-base text-[#706f6c]">1-500 orang</p>
                                </div>
                                <div class="rounded-3xl bg-[#fff2f2] p-5">
                                    <p class="text-sm font-medium text-[#1b1b18]">Durasi</p>
                                    <p class="mt-3 text-base text-[#706f6c]">1 hari - 3 hari</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-[1.5rem] bg-[#1b1b18] p-8 text-white shadow-xl ring-1 ring-[#1b1b18]">
                    <p class="text-sm font-medium uppercase tracking-[0.3em] text-[#f53003]">Dapatkan rekomendasi</p>
                    <h2 class="mt-6 text-2xl font-semibold">Layanan event paling populer</h2>
                    <p class="mt-4 text-base leading-7 text-[#d7d7d5]">Pilih paket yang paling sering digunakan untuk acara bisnis, hiburan, atau komunitas.</p>
                    <div class="mt-8 space-y-4">
                        <div class="rounded-3xl bg-[#fff2f2] p-5 text-[#1b1b18]">
                            <p class="font-semibold">Paket Event Premium</p>
                            <p class="mt-2 text-sm text-[#706f6c]">Termasuk dekor, sound system, dan dokumentasi profesional.</p>
                        </div>
                        <div class="rounded-3xl bg-[#fff2f2] p-5 text-[#1b1b18]">
                            <p class="font-semibold">Workshop & Training</p>
                            <p class="mt-2 text-sm text-[#706f6c]">Sesi interaktif untuk tim atau peserta acara.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid gap-6 lg:grid-cols-3">
                <article class="rounded-[1.5rem] bg-white p-8 shadow-xl ring-1 ring-[#e3e3e0] transition hover:shadow-xl dark:bg-[#161615] dark:ring-[#1d1d1d]">
                    <div class="flex items-center justify-between gap-3">
                        <span class="rounded-full bg-[#f53003] px-4 py-2 text-sm font-semibold text-white">Workshop</span>
                        <span class="text-sm text-[#706f6c]">Terpopuler</span>
                    </div>
                    <h3 class="mt-6 text-2xl font-semibold">Kelas Fotografi Event</h3>
                    <p class="mt-4 text-base leading-7 text-[#706f6c]">Belajar teknik dokumentasi acara profesional untuk menghasilkan konten promosi yang menarik.</p>
                    <div class="mt-6 flex flex-wrap gap-2 text-sm">
                        <span class="rounded-full bg-[#fff2f2] px-3 py-1 text-[#1b1b18]">Online</span>
                        <span class="rounded-full bg-[#dbdbd7] px-3 py-1 text-[#1b1b18]">Rp250.000</span>
                    </div>
                    <a href="#" class="mt-8 inline-flex items-center rounded-full bg-[#1b1b18] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#222]">Lihat Detail</a>
                </article>

                <article class="rounded-[1.5rem] bg-white p-8 shadow-xl ring-1 ring-[#e3e3e0] transition hover:shadow-xl dark:bg-[#161615] dark:ring-[#1d1d1d]">
                    <div class="flex items-center justify-between gap-3">
                        <span class="rounded-full bg-[#fff2f2] px-4 py-2 text-sm font-semibold text-[#1b1b18]">Paket</span>
                        <span class="text-sm text-[#706f6c]">Terjangkau</span>
                    </div>
                    <h3 class="mt-6 text-2xl font-semibold">Paket Dekor Venue</h3>
                    <p class="mt-4 text-base leading-7 text-[#706f6c]">Dekorasi tematik untuk ruangan konferensi, pameran, atau pesta perusahaan.</p>
                    <div class="mt-6 flex flex-wrap gap-2 text-sm">
                        <span class="rounded-full bg-[#fff2f2] px-3 py-1 text-[#1b1b18]">Offline</span>
                        <span class="rounded-full bg-[#dbdbd7] px-3 py-1 text-[#1b1b18]">Rp400.000</span>
                    </div>
                    <a href="#" class="mt-8 inline-flex items-center rounded-full bg-[#1b1b18] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#222]">Lihat Detail</a>
                </article>

                <article class="rounded-[1.5rem] bg-white p-8 shadow-xl ring-1 ring-[#e3e3e0] transition hover:shadow-xl dark:bg-[#161615] dark:ring-[#1d1d1d]">
                    <div class="flex items-center justify-between gap-3">
                        <span class="rounded-full bg-[#fff2f2] px-4 py-2 text-sm font-semibold text-[#1b1b18]">Layanan</span>
                        <span class="text-sm text-[#706f6c]">Penuh</span>
                    </div>
                    <h3 class="mt-6 text-2xl font-semibold">Paket Produksi Live</h3>
                    <p class="mt-4 text-base leading-7 text-[#706f6c]">Sound system, lighting, dan tim produksi untuk event live yang lancar.</p>
                    <div class="mt-6 flex flex-wrap gap-2 text-sm">
                        <span class="rounded-full bg-[#fff2f2] px-3 py-1 text-[#1b1b18]">Hybrid</span>
                        <span class="rounded-full bg-[#dbdbd7] px-3 py-1 text-[#1b1b18]">Rp1.250.000</span>
                    </div>
                    <a href="#" class="mt-8 inline-flex items-center rounded-full bg-[#1b1b18] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#222]">Lihat Detail</a>
                </article>
            </section>

            <section class="mt-10 rounded-[1.5rem] bg-white p-8 shadow-xl ring-1 ring-[#e3e3e0] dark:bg-[#161615] dark:ring-[#1d1d1d]">
                <div class="grid gap-6 lg:grid-cols-3">
                    <div>
                        <p class="text-sm font-medium uppercase tracking-[0.3em] text-[#f53003]">Fitur Katalog</p>
                        <h2 class="mt-4 text-3xl font-semibold">Mudah dipilih, mudah diatur</h2>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold">Responsif</h3>
                        <p class="text-[#706f6c]">Lihat katalog layanan dengan tampilan yang nyaman di desktop maupun ponsel.</p>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold">Terstruktur</h3>
                        <p class="text-[#706f6c]">Kategori dan paket dirancang agar Anda mudah menemukan layanan yang dibutuhkan.</p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
