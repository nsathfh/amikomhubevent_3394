@extends('layouts.admin')
@section('content')
     <main class="flex-1 p-10 overflow-y-auto">
        <!-- Header -->
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black">Dashboard Ringkasan</h1>
                <p class="text-slate-500 font-medium">Selamat datang kembali, {{ auth()->user()->name }}!</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="font-bold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400">
                        {{ auth()->user()->role === 'admin' ? 'Superadmin' : 'Penyelenggara HIMA/Kepanitiaan' }}
                    </p>
                </div>
                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border flex items-center justify-center p-1">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff"
                        class="rounded-xl">
                </div>
            </div>
        </header>

        <!-- Notification Banner -->
        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm text-emerald-700 font-bold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <p class="text-slate-400 text-sm font-bold uppercase mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-black">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                        </path>
                    </svg>
                </div>
                <p class="text-slate-400 text-sm font-bold uppercase mb-1">Tiket Terjual</p>
                <h3 class="text-2xl font-black">{{ number_format($ticketsSold, 0, ',', '.') }}</h3>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-slate-400 text-sm font-bold uppercase mb-1">Event Aktif</p>
                <h3 class="text-2xl font-black">{{ $activeEvents }} Event</h3>
            </div>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-slate-400 text-sm font-bold uppercase mb-1">Pesanan Pending</p>
                <h3 class="text-2xl font-black">{{ $pendingOrders }} Pesanan</h3>
            </div>
        </div>

        <!-- Revenue Growth Chart -->
        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-10">
            <h3 class="font-black text-xl mb-6">Pertumbuhan Pendapatan (6 Bulan Terakhir)</h3>
            <div class="w-full h-80">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Superadmin Approval Section -->
        @if(auth()->user()->role === 'admin' && count($pendingApprovalEvents) > 0)
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mb-10">
            <div class="p-8 border-b">
                <h3 class="font-black text-xl text-amber-600">Persetujuan Event Baru</h3>
                <p class="text-xs text-slate-400 mt-1">Pengajuan event baru yang memerlukan peninjauan.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Poster</th>
                            <th class="px-8 py-4">Event</th>
                            <th class="px-8 py-4">Penyelenggara</th>
                            <th class="px-8 py-4">Harga / Stok</th>
                            <th class="px-8 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @foreach($pendingApprovalEvents as $event)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-8 py-6">
                                <img src="{{ $event->poster_path ? asset('storage/'.$event->poster_path) : asset('assets/concert.png') }}" class="w-12 h-16 rounded-xl object-cover shadow-sm">
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-bold text-slate-800">{{ $event->title }}</p>
                                <p class="text-xs text-slate-400">{{ $event->category->name }} • {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-bold text-slate-800">{{ $event->user->name ?? 'Admin' }}</p>
                                <p class="text-xs text-slate-400">{{ $event->user->email ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-bold text-indigo-600">Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-400">Stok: {{ $event->stock }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-bold transition">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.events.reject', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 bg-rose-500 hover:bg-rose-600 text-white rounded-xl text-xs font-bold transition">Tolak</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Latest Sales Table -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mb-10">
            <div class="p-8 border-b flex justify-between items-center">
                <h3 class="font-black text-xl">Transaksi Terakhir</h3>
                <a href="{{ route('admin.transactions.index') }}" class="text-indigo-600 font-bold hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Pembeli</th>
                            <th class="px-8 py-4">Event</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @forelse($latestTransactions as $trx)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-8 py-6">
                                <p class="font-bold uppercase tracking-wide text-sm">{{ $trx->customer_name }}</p>
                                <p class="text-xs text-slate-400">{{ $trx->customer_email }}</p>
                            </td>
                            <td class="px-8 py-6 font-medium text-slate-600">{{ $trx->event->title ?? '-' }}</td>
                            <td class="px-8 py-6">
                                @if($trx->status === 'settlement' || $trx->status === 'success' || strcasecmp($trx->status, 'Success') === 0)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase">Success</span>
                                @elseif($trx->status === 'pending' || strcasecmp($trx->status, 'Pending') === 0)
                                    <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-bold uppercase">Pending</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase">{{ $trx->status }}</span>
                                @endif
                            </td>
                            <td class="px-8 py-6 font-black text-indigo-600">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-slate-500">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($monthlyRevenue) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Pendapatan: Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
    </script>
@endsection