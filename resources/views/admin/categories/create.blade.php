@extends('layouts.admin')
@section('content')
    <main class="flex-1 overflow-y-auto p-10">
        <header class="mb-10">
            <h1 class="text-3xl font-black">Tambah Kategori</h1>
            <p class="font-medium text-slate-500">Tambahkan kategori baru untuk event.</p>
        </header>

        <div class="rounded-[2.5rem] border border-slate-100 bg-white p-10 shadow-sm">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="mb-2 block font-bold text-slate-700">Nama Kategori</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
                        placeholder="Masukkan nama kategori">
                    @error('name')
                        <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.categories.index') }}"
                        class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-50">
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white transition hover:bg-indigo-700">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection
