@extends('layouts.admin', ['title' => 'Kelola Partner'])

@section('content')
<header class="flex items-center justify-between gap-4 mb-10">
    <div>
        <h1 class="text-3xl font-black">Kelola Partner</h1>
        <p class="font-medium text-slate-500">Atur daftar partner yang tampil di sistem.</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">
        + Tambah Partner
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    @if(session('success'))
        <div class="m-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="border-b bg-slate-50/50 px-8 py-6">
        <form method="GET" action="{{ route('admin.partners.index') }}" class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-lg font-black text-slate-800">Daftar Partner</h2>
            </div>
            <div class="flex w-full gap-3 lg:max-w-md">
                <label class="sr-only" for="partner-search">Cari partner</label>
                <input id="partner-search" type="text" name="q" value="{{ request('q') }}" placeholder="Cari partner..."
                    class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-3 outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                <button type="submit" class="rounded-2xl bg-indigo-600 px-5 py-3 font-bold text-white transition hover:bg-indigo-700">
                    Cari
                </button>
                @if(request()->filled('q'))
                    <a href="{{ route('admin.partners.index') }}" class="rounded-2xl border border-slate-200 bg-white px-5 py-3 font-bold text-slate-700 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4">ID</th>
                    <th class="px-8 py-4">Nama</th>
                    <th class="px-8 py-4">Logo</th>
                    <th class="px-8 py-4">Created At</th>
                    <th class="px-8 py-4">Updated At</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($partners as $partner)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">{{ $partner->id }}</td>
                    <td class="px-8 py-6">
                        <p class="font-black text-slate-800">{{ $partner->name }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="h-12 w-28 rounded-xl object-contain bg-slate-50 border border-slate-100 p-2">
                    </td>
                    <td class="px-8 py-6 text-slate-600">{{ $partner->created_at?->format('d M Y, H:i') }}</td>
                    <td class="px-8 py-6 text-slate-600">{{ $partner->updated_at?->format('d M Y, H:i') }}</td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="rounded-xl bg-indigo-50 px-4 py-2 text-indigo-600 transition hover:bg-indigo-600 hover:text-white">Edit</a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Hapus partner ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl bg-rose-50 px-4 py-2 text-rose-600 transition hover:bg-rose-600 hover:text-white">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-10 text-center text-slate-500">Belum ada partner.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="border-t bg-slate-50 px-8 py-6">
        {{ $partners->links() }}
    </div>
</div>
@endsection