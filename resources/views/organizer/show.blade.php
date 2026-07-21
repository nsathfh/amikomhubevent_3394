@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-6 py-20">
    <!-- Profile Card Header -->
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8 md:p-12 mb-12 flex flex-col md:flex-row items-center md:items-start gap-8">
        <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-extrabold text-4xl shadow-inner">
            {{ substr($user->name, 0, 2) }}
        </div>
        <div class="flex-1 text-center md:text-left space-y-4">
            <div>
                <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-700 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                    {{ $user->role === 'admin' ? 'Superadmin' : 'Penyelenggara Terverifikasi' }}
                </span>
                <h1 class="text-4xl font-extrabold text-slate-800">{{ $user->name }}</h1>
                <p class="text-slate-500 mt-1">{{ $user->email }}</p>
            </div>
            
            <!-- Rating Summary -->
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-6 pt-4 border-t border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="text-3xl font-black text-slate-800">{{ number_format($averageRating, 1) }}</span>
                    <div class="flex items-center text-orange-400">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-6 h-6 {{ $i <= round($averageRating) ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                </div>
                <div class="text-slate-400 font-bold uppercase text-xs tracking-wider border-l pl-6 border-slate-200">
                    {{ count($reviews) }} Ulasan Peserta
                </div>
            </div>
        </div>
    </div>

    <!-- Organizer Tabs/Sections -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Events List -->
        <div class="lg:col-span-2 space-y-8">
            <h2 class="text-2xl font-black text-slate-800 border-b pb-4">Event yang Diselenggarakan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($events as $event)
                <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="relative overflow-hidden aspect-3/4">
                        <img src="{{ $event->poster_path ? asset('storage/'.$event->poster_path) : asset('assets/concert.png') }}" alt="{{ $event->title }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-indigo-600">
                            {{ $event->category->name }}
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition">{{ $event->title }}</h3>
                        <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t">
                            <span class="text-2xl font-black text-indigo-600">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                            <a href="{{ route('events.show', $event->id) }}"
                                class="px-5 py-2 bg-indigo-50 text-indigo-600 rounded-xl font-bold hover:bg-indigo-600 hover:text-white transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full rounded-3xl border border-dashed border-slate-200 bg-white p-8 text-center text-slate-500">
                    Belum ada event aktif yang diselenggarakan.
                </div>
                @endforelse
            </div>
        </div>

        <!-- Reviews Sidebar -->
        <div class="space-y-8">
            <h2 class="text-2xl font-black text-slate-800 border-b pb-4">Rekam Jejak Ulasan</h2>
            <div class="space-y-6">
                @forelse($reviews as $review)
                <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm space-y-3">
                    <div class="flex justify-between items-center">
                        <p class="font-bold text-slate-800 text-sm uppercase tracking-wide">{{ $review->customer_name }}</p>
                        <div class="flex items-center text-orange-400">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-100' }}" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 font-semibold italic">Event: {{ $review->event->title ?? '-' }}</p>
                    <p class="text-slate-600 text-sm leading-relaxed font-medium">"{{ $review->testimony }}"</p>
                    <p class="text-[10px] text-slate-400 text-right">{{ $review->created_at->diffForHumans() }}</p>
                </div>
                @empty
                <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-8 text-center text-slate-500">
                    Belum ada ulasan yang diterima.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</main>
@endsection
