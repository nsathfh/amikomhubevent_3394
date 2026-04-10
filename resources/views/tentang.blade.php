@extends('layouts.app')

@php
    $title = 'Tentang - Amikom Event Hub';
    $headline = 'Tentang Amikom Event Hub';
    $active = 'tentang';
@endphp

@section('content')
    <section class="rounded-3xl border border-blue-100 bg-white p-8 shadow-lg">
        <h2 class="text-3xl font-extrabold text-blue-900">Tentang Aplikasi</h2>
        <p class="mt-4 leading-7 text-slate-600">Amikom Event Hub adalah aplikasi yang membantu mahasiswa dan panitia mengelola informasi kegiatan kampus secara terstruktur.</p>

        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <article class="rounded-2xl bg-blue-50 p-5">
                <h3 class="font-bold text-blue-900">Tujuan</h3>
                <p class="mt-2 text-sm text-slate-600">Menyediakan pusat informasi acara yang mudah diakses dari satu platform.</p>
            </article>
            <article class="rounded-2xl bg-blue-50 p-5">
                <h3 class="font-bold text-blue-900">Manfaat</h3>
                <p class="mt-2 text-sm text-slate-600">Mempermudah promosi, pendaftaran, dan koordinasi event kampus.</p>
            </article>
        </div>
    </section>
@endsection