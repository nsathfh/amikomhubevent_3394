@extends('layouts.app')

@php
    $title = 'Katalog - Amikom Event Hub';
    $headline = 'Katalog Program Event';
    $active = 'katalog';
@endphp

@section('content')
    <section class="rounded-3xl border border-blue-100 bg-white p-8 shadow-lg">
        <h2 class="text-3xl font-extrabold text-blue-900">Katalog Kegiatan</h2>
        <p class="mt-3 text-slate-600">Berikut daftar program dan layanan yang tersedia di Event Hub.</p>

        <div class="mt-6 grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl bg-blue-50 p-5">
                <h3 class="font-bold text-blue-900">Workshop Digital Branding</h3>
                <p class="mt-2 text-sm text-slate-600">Pelatihan branding dan promosi acara di media sosial.</p>
            </article>
            <article class="rounded-2xl bg-blue-50 p-5">
                <h3 class="font-bold text-blue-900">Seminar Karier Kreatif</h3>
                <p class="mt-2 text-sm text-slate-600">Diskusi karier bersama praktisi industri kreatif.</p>
            </article>
            <article class="rounded-2xl bg-blue-50 p-5">
                <h3 class="font-bold text-blue-900">Paket Dokumentasi Event</h3>
                <p class="mt-2 text-sm text-slate-600">Layanan foto dan video profesional untuk acara kampus.</p>
            </article>
        </div>
    </section>
@endsection
