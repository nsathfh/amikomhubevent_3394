@extends('layouts.app')

@php
	$title = 'Home - Amikom Event Hub';
	$headline = 'Selamat Datang di Amikom Event Hub';
	$active = 'home';
@endphp

@push('styles')
	<style>
		.hero-visual {
			aspect-ratio: 4 / 5;
			border-radius: 2rem;
		}

		.event-poster {
			aspect-ratio: 3 / 4;
		}
	</style>
@endpush

@section('content')
	<section class="mx-auto flex max-w-7xl flex-col gap-12 px-6 py-20 md:flex-row md:items-center">
		<div class="flex-1 space-y-8">
			<span class="inline-block rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-bold uppercase tracking-wider text-indigo-700">#1 Event Platform</span>
			<div class="space-y-5">
				<h1 class="max-w-2xl text-5xl font-extrabold leading-tight md:text-7xl">Temukan & Pesan <span class="text-indigo-600">Tiket Event</span> Impianmu.</h1>
				<p class="max-w-xl text-lg leading-relaxed text-slate-500">Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan Midtrans.</p>
			</div>
			<div class="flex flex-wrap gap-4">
				<a href="#events" class="rounded-2xl bg-indigo-600 px-8 py-4 text-lg font-bold text-white shadow-xl shadow-indigo-200 transition-transform hover:scale-105">Mulai Jelajah</a>
				<a href="{{ route('events.show') }}" class="rounded-2xl border-2 border-slate-200 px-8 py-4 text-lg font-bold transition hover:border-indigo-600 hover:text-indigo-600">Lihat Detail Event</a>
			</div>
		</div>

		<div class="relative flex-1">
			<div class="animate-blob absolute -left-10 -top-10 h-64 w-64 rounded-full bg-indigo-400 opacity-20 mix-blend-multiply blur-3xl"></div>
			<div class="animation-delay-2000 animate-blob absolute -bottom-10 -right-10 h-64 w-64 rounded-full bg-purple-400 opacity-20 mix-blend-multiply blur-3xl"></div>
			<img src="{{ asset('assets/concert.png') }}" alt="Concert" class="hero-visual relative z-10 w-full object-cover shadow-2xl object-center">

			<div class="glass absolute -bottom-6 -left-6 z-20 rounded-2xl border border-white p-6 shadow-xl">
				<div class="flex items-center gap-4">
					<div class="flex h-12 w-12 items-center justify-center rounded-full bg-green-100 text-green-600">
						<svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
						</svg>
					</div>
					<div>
						<p class="text-xs font-bold uppercase text-slate-500">Terverifikasi</p>
						<p class="font-bold">Pembayaran Aman via Midtrans</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="events" class="mx-auto max-w-7xl px-6 py-20">
		<div class="mb-12 flex flex-col items-start justify-between gap-4 md:flex-row md:items-end">
			<div>
				<h2 class="mb-2 text-3xl font-extrabold">Event Terdekat</h2>
				<p class="font-medium text-slate-500">Jangan sampai ketinggalan acara seru minggu ini!</p>
			</div>
			<span class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm">3 Event Tersedia</span>
		</div>

		<div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
			<article class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-2xl">
				<div class="event-poster relative overflow-hidden">
					<img src="{{ asset('assets/concert.png') }}" alt="Jazz Night" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
					<div class="absolute left-4 top-4 rounded-lg bg-white/90 px-3 py-1 text-xs font-bold uppercase text-indigo-600 backdrop-blur">Musik</div>
				</div>
				<div class="p-6">
					<h3 class="mb-2 text-xl font-bold transition group-hover:text-indigo-600">Jazz Night 2024: A Celebration</h3>
					<div class="mb-4 flex items-center gap-2 text-sm text-slate-500">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
						<span>16 November 2024, 19:30</span>
					</div>
					<div class="flex items-center justify-between border-t pt-4">
						<span class="text-2xl font-black text-indigo-600">Rp 150rb</span>
						<a href="{{ route('events.show') }}" class="rounded-xl bg-indigo-50 px-5 py-2 font-bold text-indigo-600 transition hover:bg-indigo-600 hover:text-white">Lihat Detail</a>
					</div>
				</div>
			</article>

			<article class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-2xl">
				<div class="event-poster relative overflow-hidden">
					<img src="{{ asset('assets/workshop.png') }}" alt="AI & Future" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
					<div class="absolute left-4 top-4 rounded-lg bg-white/90 px-3 py-1 text-xs font-bold uppercase text-indigo-600 backdrop-blur">Technology</div>
				</div>
				<div class="p-6">
					<h3 class="mb-2 text-xl font-bold transition group-hover:text-indigo-600">AI & Future: Unleash The Power</h3>
					<div class="mb-4 flex items-center gap-2 text-sm text-slate-500">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
						<span>26 October 2024, 09:00</span>
					</div>
					<div class="flex items-center justify-between border-t pt-4">
						<span class="text-2xl font-black text-indigo-600">Rp 50rb</span>
						<a href="{{ route('events.show') }}" class="rounded-xl bg-indigo-50 px-5 py-2 font-bold text-indigo-600 transition hover:bg-indigo-600 hover:text-white">Lihat Detail</a>
					</div>
				</div>
			</article>

			<article class="group overflow-hidden rounded-3xl border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-2xl">
				<div class="event-poster relative overflow-hidden">
					<img src="{{ asset('assets/hackathon.png') }}" alt="Hackathon 2024" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
					<div class="absolute left-4 top-4 rounded-lg bg-white/90 px-3 py-1 text-xs font-bold uppercase text-indigo-600 backdrop-blur">Coding</div>
				</div>
				<div class="p-6">
					<h3 class="mb-2 text-xl font-bold transition group-hover:text-indigo-600">Hackathon 2024: Ultimate Marathon</h3>
					<div class="mb-4 flex items-center gap-2 text-sm text-slate-500">
						<svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
						<span>18-20 October 2024</span>
					</div>
					<div class="flex items-center justify-between border-t pt-4">
						<span class="text-2xl font-black text-indigo-600">Gratis</span>
						<a href="{{ route('events.show') }}" class="rounded-xl bg-indigo-50 px-5 py-2 font-bold text-indigo-600 transition hover:bg-indigo-600 hover:text-white">Lihat Detail</a>
					</div>
				</div>
			</article>
		</div>
	</section>
