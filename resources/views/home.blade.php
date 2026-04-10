@extends('layouts.app')

@php
	$title = 'Home - Amikom Event Hub';
	$headline = 'Selamat Datang di Amikom Event Hub';
	$active = 'home';
@endphp

@section('content')
	<section class="grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
		<div class="rounded-3xl border border-blue-100 bg-white p-8 shadow-lg">
			<span class="inline-flex rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800">Home</span>
			<h2 class="mt-4 text-3xl font-extrabold text-blue-900">Semua info event kampus, kumpul di satu tempat</h2>
			<p class="mt-4 leading-7 text-slate-600">Lagi cari acara minggu ini, kontak panitia, atau lihat layanan yang tersedia? Semua bisa diakses dari menu atas tanpa perlu muter-muter halaman.</p>
			<div class="mt-4 rounded-2xl border border-blue-200 bg-blue-50 p-4">
				<p class="text-sm font-semibold text-blue-900">Nama Lengkap: Nisa Athifah As Sodri</p>
				<p class="mt-1 text-sm font-semibold text-blue-900">NIM: 24.12.3394</p>
			</div>
		</div>

		<aside class="rounded-3xl bg-blue-900 p-8 text-white shadow-lg">
			<h3 class="text-2xl font-bold">Agenda Pekan Ini</h3>
			<ul class="mt-4 space-y-3 text-sm text-blue-100">
				<li class="rounded-xl bg-blue-800/70 p-3">Senin, 09.00: Open Booth Komunitas di Lobby A</li>
				<li class="rounded-xl bg-blue-800/70 p-3">Rabu, 13.30: Workshop Public Speaking di Ruang C1.2</li>
				<li class="rounded-xl bg-blue-800/70 p-3">Jumat, 15.00: Mini Expo UKM Digital di Hall Utama</li>
			</ul>
		</aside>
	</section>
@endsection
