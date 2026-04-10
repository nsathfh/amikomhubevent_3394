@extends('layouts.app')

@php
	$title = 'Profil - Amikom Event Hub';
	$headline = 'Profil Tim Event Hub';
	$active = 'profil';
@endphp

@section('content')
	<section class="grid gap-6 md:grid-cols-2">
		<article class="rounded-3xl border border-blue-100 bg-white p-8 shadow-lg">
			<h2 class="text-3xl font-extrabold text-blue-900">Siapa Kami</h2>
			<p class="mt-4 leading-7 text-slate-600">Amikom Event Hub adalah tim pengelola kegiatan kampus yang fokus pada perencanaan event edukatif, kreatif, dan kolaboratif.</p>
			<p class="mt-3 leading-7 text-slate-600">Kami membantu mahasiswa, organisasi, dan mitra untuk menyelenggarakan acara yang tertata rapi dari konsep hingga evaluasi.</p>
		</article>
		<article class="rounded-3xl bg-blue-900 p-8 text-white shadow-lg">
			<h3 class="text-2xl font-bold">Visi dan Misi</h3>
			<ul class="mt-4 space-y-3 text-sm text-blue-100">
				<li class="rounded-xl bg-blue-800/70 p-3">Menciptakan ekosistem event kampus yang inovatif.</li>
				<li class="rounded-xl bg-blue-800/70 p-3">Mengembangkan kemampuan manajemen acara mahasiswa.</li>
				<li class="rounded-xl bg-blue-800/70 p-3">Meningkatkan kolaborasi antara kampus, komunitas, dan industri.</li>
			</ul>
		</article>
	</section>
@endsection
