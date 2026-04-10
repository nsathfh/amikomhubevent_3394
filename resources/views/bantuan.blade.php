@extends('layouts.app')

@php
	$title = 'Bantuan - Amikom Event Hub';
	$headline = 'Pusat Bantuan';
	$active = 'bantuan';
@endphp

@section('content')
	<section class="rounded-3xl border border-blue-100 bg-white p-8 shadow-lg">
		<h2 class="text-3xl font-extrabold text-blue-900">Bantuan Pengguna</h2>
		<p class="mt-3 text-slate-600">Temukan jawaban untuk pertanyaan yang sering ditanyakan terkait penggunaan Event Hub.</p>

		<div class="mt-6 space-y-4">
			<article class="rounded-2xl bg-blue-50 p-5">
				<h3 class="font-bold text-blue-900">Bagaimana cara mendaftar acara?</h3>
				<p class="mt-2 text-sm text-slate-600">Buka halaman katalog, pilih acara, lalu ikuti petunjuk pendaftaran yang tersedia.</p>
			</article>
			<article class="rounded-2xl bg-blue-50 p-5">
				<h3 class="font-bold text-blue-900">Bagaimana menghubungi panitia?</h3>
				<p class="mt-2 text-sm text-slate-600">Masuk ke halaman kontak untuk melihat email, telepon, dan lokasi kantor.</p>
			</article>
			<article class="rounded-2xl bg-blue-50 p-5">
				<h3 class="font-bold text-blue-900">Apa layanan utama Event Hub?</h3>
				<p class="mt-2 text-sm text-slate-600">Manajemen acara, publikasi kegiatan, dan layanan pendukung event kampus.</p>
			</article>
		</div>
	</section>
@endsection
