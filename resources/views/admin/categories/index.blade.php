@extends('layouts.admin')
@section('content')
    <main class="flex-1 overflow-y-auto p-10">
        <header class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black">Manajemen Kategori</h1>
                <p class="font-medium text-slate-500">Kelola daftar kategori event yang tersedia.</p>
            </div>
            <button
                class="rounded-2xl bg-indigo-600 px-6 py-3 font-bold text-white shadow-lg shadow-indigo-100 transition hover:bg-indigo-700 active:scale-95">
                + Tambah Kategori
            </button>
        </header>

        <section class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
            <div class="flex flex-wrap items-center gap-4 border-b bg-slate-50/50 px-8 py-6">
                <input type="text" placeholder="Cari kategori..."
                    class="flex-1 rounded-xl border border-slate-200 bg-white px-5 py-3 outline-none transition focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-400">
                        <tr>
                            <th class="w-16 px-8 py-4">No</th>
                            <th class="px-8 py-4">Nama Kategori</th>
                            <th class="px-8 py-4">Deskripsi</th>
                            <th class="px-8 py-4">Jumlah Event</th>
                            <th class="px-8 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-8 py-6 font-bold text-slate-400">1</td>
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800">Seminar</p>
                            </td>
                            <td class="px-8 py-6 text-slate-600">Acara edukasi dan presentasi topik tertentu.</td>
                            <td class="px-8 py-6">
                                <span class="rounded-lg bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">12 Event</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex gap-2">
                                    <button
                                        class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600 transition hover:bg-emerald-600 hover:text-white">
                                        Tambah
                                    </button>
                                    <button
                                        class="rounded-xl bg-indigo-50 p-2.5 text-indigo-600 transition hover:bg-indigo-600 hover:text-white">
                                        Edit
                                    </button>
                                    <button
                                        class="rounded-xl bg-rose-50 p-2.5 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-8 py-6 font-bold text-slate-400">2</td>
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800">Konser</p>
                            </td>
                            <td class="px-8 py-6 text-slate-600">Pertunjukan musik live dari musisi atau band.</td>
                            <td class="px-8 py-6">
                                <span class="rounded-lg bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">8 Event</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex gap-2">
                                    <button
                                        class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600 transition hover:bg-emerald-600 hover:text-white">
                                        Tambah
                                    </button>
                                    <button
                                        class="rounded-xl bg-indigo-50 p-2.5 text-indigo-600 transition hover:bg-indigo-600 hover:text-white">
                                        Edit
                                    </button>
                                    <button
                                        class="rounded-xl bg-rose-50 p-2.5 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="transition hover:bg-slate-50/50">
                            <td class="px-8 py-6 font-bold text-slate-400">3</td>
                            <td class="px-8 py-6">
                                <p class="font-black text-slate-800">Workshop</p>
                            </td>
                            <td class="px-8 py-6 text-slate-600">Sesi praktik langsung dengan mentor atau instruktur.</td>
                            <td class="px-8 py-6">
                                <span class="rounded-lg bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-600">5 Event</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex gap-2">
                                    <button
                                        class="rounded-xl bg-emerald-50 p-2.5 text-emerald-600 transition hover:bg-emerald-600 hover:text-white">
                                        Tambah
                                    </button>
                                    <button
                                        class="rounded-xl bg-indigo-50 p-2.5 text-indigo-600 transition hover:bg-indigo-600 hover:text-white">
                                        Edit
                                    </button>
                                    <button
                                        class="rounded-xl bg-rose-50 p-2.5 text-rose-600 transition hover:bg-rose-600 hover:text-white">
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
