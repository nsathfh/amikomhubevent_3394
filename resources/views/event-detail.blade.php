@extends('layouts.app')

@php
    $title = 'Detail Event - AmikomEventHub';
    $headline = 'Detail Event';
    $active = 'event-detail';
@endphp

@section('content')
    <main class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 py-12 lg:grid-cols-3">
        <div class="lg:col-span-1">
            <div class="sticky top-32">
                <img src="{{ asset('assets/concert.png') }}" alt="Concert Poster" class="w-full rounded-[2.5rem] border-8 border-white shadow-2xl">
                <div class="mt-8 rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                    <h4 class="mb-4 font-bold">Penyelenggara</h4>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-600">AB</div>
                        <div>
                            <p class="font-bold text-slate-800">ABP Productions</p>
                            <p class="text-xs text-slate-500">Verified Organizer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-12 lg:col-span-2">
            <div class="space-y-4">
                <span class="rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-bold uppercase tracking-wider text-indigo-700">Music Festival</span>
                <h1 class="text-4xl font-black leading-tight md:text-5xl">Jazz Night 2024: A Celebration of Rhythm & Melody</h1>
                <div class="flex flex-wrap gap-6 font-medium text-slate-500">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Saturday, 16 Nov 2024</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>The Blue Note Lounge, Metropolis</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-2xl font-bold">Deskripsi Event</h3>
                <p class="text-lg leading-relaxed text-slate-600">Nikmati malam yang tak terlupakan dengan alunan jazz dari musisi internasional. Jazz Night 2024 hadir untuk membawa Anda ke dalam perjalanan melodi yang menenangkan dan ritme yang menggugah jiwa.</p>
                <p class="text-lg leading-relaxed text-slate-600">Tahun ini kami menghadirkan <strong>The Jazz Collective</strong>, <strong>Luna Vance</strong>, dan artis favorit lainnya. Acara ini juga dilengkapi dengan food stall premium dan area networking yang nyaman.</p>
            </div>

            <div class="relative overflow-hidden rounded-[2.5rem] bg-indigo-600 p-8 text-white shadow-2xl shadow-indigo-200 md:p-12">
                <div class="relative z-10 flex flex-col items-center justify-between gap-8 md:flex-row">
                    <div>
                        <p class="mb-2 text-sm font-bold uppercase tracking-widest text-indigo-200">Harga Tiket</p>
                        <h2 class="text-5xl font-black">Rp 150.000 <span class="text-lg font-medium text-indigo-200">/ orang</span></h2>
                        <p class="mt-4 flex items-center gap-2 text-indigo-100">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Sisa stok: <span class="font-bold underline">42 Tiket lagi!</span>
                        </p>
                    </div>
                    <a href="{{ route('checkout') }}" class="inline-block rounded-2xl bg-white px-10 py-5 text-xl font-black text-indigo-600 shadow-xl transition-transform hover:scale-105">Pesan Sekarang</a>
                </div>
                <div class="absolute -right-20 -bottom-20 h-64 w-64 rounded-full bg-white opacity-10"></div>
                <div class="absolute -left-10 -top-10 h-32 w-32 rounded-full bg-indigo-400 opacity-20"></div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-bold">Kebijakan Tiket</h3>
                <ul class="space-y-3 text-slate-500">
                    <li class="flex items-start gap-2">
                        <svg class="mt-1 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        E-Ticket akan dikirimkan otomatis setelah pembayaran berhasil.
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="mt-1 h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Tiket dapat discan di pintu masuk (Check-in).
                    </li>
                    <li class="flex items-start gap-2 text-rose-500">
                        <svg class="mt-1 h-5 w-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tiket yang sudah dibeli tidak dapat direfund.
                    </li>
                </ul>
            </div>
        </div>
    </main>
@endsection

