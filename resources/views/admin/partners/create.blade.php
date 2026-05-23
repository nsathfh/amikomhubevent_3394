@extends('layouts.admin', ['title' => 'Tambah Partner'])

@section('content')
<header class="mb-10">
    <h1 class="text-3xl font-black">Tambah Partner</h1>
    <p class="font-medium text-slate-500">Tambahkan data partner baru.</p>
</header>

<div class="rounded-[2.5rem] border border-slate-100 bg-white p-10 shadow-sm">
    <form action="{{ route('admin.partners.store') }}" method="POST">
        @csrf

        <div class="mb-6">
            <label class="mb-2 block font-bold text-slate-700">Nama Partner</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" placeholder="Masukkan nama partner">
            @error('name')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="mb-2 block font-bold text-slate-700">Logo URL</label>
            <input type="url" name="logo_url" value="{{ old('logo_url') }}" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100" placeholder="https://example.com/logo.png">
            @error('logo_url')
                <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.partners.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">Kembali</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-indigo-700">Simpan Partner</button>
        </div>
    </form>
</div>
@endsection