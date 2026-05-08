@extends('layouts.admin')
@section('content')
    <main class="flex-1 overflow-y-auto p-10">
        <header class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black">Laporan Transaksi</h1>
                <p class="font-medium text-slate-500">Pantau arus kas dan penjualan tiket Anda.</p>
            </div>
            <div class="flex gap-4">
                <button
                    class="rounded-2xl border-2 border-slate-200 px-6 py-3 font-bold transition hover:border-indigo-600 hover:bg-white hover:text-indigo-600">
                    Ekspor Excel
                </button>
                <button
                    class="rounded-2xl bg-indigo-600 px-6 py-3 font-bold text-white shadow-lg transition hover:bg-indigo-700">
                    Unduh PDF
                </button>
            </div>
        </header>

        <div class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
            <div class="flex flex-wrap items-center gap-4 border-b bg-slate-50/50 px-8 py-6">
                <div class="flex min-w-[300px] flex-1 gap-2">
                    <input type="text" placeholder="Cari Order ID, Nama, atau Email..."
                        class="flex-1 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-medium uppercase tracking-wide outline-none transition focus:ring-2 focus:ring-indigo-500">
                </div>
                <div class="flex gap-2">
                    <select class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold outline-none">
                        <option>Semua Status</option>
                        <option class="text-green-600">Success</option>
                        <option class="text-orange-600">Pending</option>
                        <option class="text-rose-600">Expired</option>
                    </select>
                    <select class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold outline-none">
                        <option>Bulan Ini</option>
                        <option>Bulan Lalu</option>
                        <option>Tahun 2024</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-400">
                        <tr>
                            <th class="px-8 py-4">Order ID</th>
                            <th class="px-8 py-4">Detail Pembeli</th>
                            <th class="px-8 py-4">Event</th>
                            <th class="px-8 py-4">Tgl Transaksi</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Total Tagihan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @forelse($transactions as $transaction)
                            <tr class="transition hover:bg-slate-50/50">
                                <td class="px-8 py-6">
                                    <span class="rounded-lg bg-indigo-50 px-3 py-1 font-mono text-sm font-bold text-indigo-600">#{{ $transaction->order_id }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-800">{{ $transaction->customer_name }}</p>
                                    <p class="text-xs text-slate-500">{{ $transaction->customer_email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-medium text-slate-700">{{ $transaction->event?->title ?? '-' }}</p>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-8 py-6">
                                    <span class="rounded-lg px-3 py-1 text-xs font-bold uppercase ring-1 {{ strcasecmp($transaction->status, 'Success') === 0 ? 'bg-green-100 text-green-700 ring-green-200' : (strcasecmp($transaction->status, 'Pending') === 0 ? 'bg-orange-100 text-orange-700 ring-orange-200' : 'bg-slate-100 text-slate-600 ring-slate-200') }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right font-black text-slate-900">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-10 text-center text-slate-500">Belum ada transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex items-center justify-between border-t bg-slate-50/50 px-8 py-6">
                <p class="text-sm font-medium text-slate-500">
                    Menampilkan {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} dari {{ $transactions->total() }} transaksi
                </p>
                <div>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
