<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticket - AmikomEventHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-indigo-600 text-white min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full">
        <!-- Success Banner -->
        <div class="text-center mb-8">
            <div
                class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-black">Pembayaran Berhasil!</h1>
            <p class="text-indigo-100 mt-2">Order {{ $transaction->order_id }} telah terbit dan siap digunakan.</p>
        </div>

        <div class="bg-white text-slate-900 rounded-[2.5rem] overflow-hidden shadow-2xl relative">
            <!-- Ticket Header -->
            <div class="p-8 bg-indigo-50 border-b-4 border-dashed border-indigo-100 text-center relative">
                <p class="text-indigo-600 font-bold uppercase tracking-widest text-xs mb-2">E-Ticket Resmi</p>
                <h2 class="text-2xl font-black leading-tight">{{ $transaction->event->title }}</h2>

                <!-- Ticket Side Cuts -->
                <div class="absolute -left-4 -bottom-4 w-8 h-8 bg-indigo-600 rounded-full"></div>
                <div class="absolute -right-4 -bottom-4 w-8 h-8 bg-indigo-600 rounded-full"></div>
            </div>

            <!-- Ticket Body -->
            <div class="p-8 space-y-8">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Nama Pembeli</p>
                        <p class="font-bold text-lg">{{ $transaction->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Tanggal & Waktu</p>
                        <p class="font-bold text-lg">{{ $transaction->event->date->format('d M, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Order ID</p>
                        <p class="font-bold">{{ $transaction->order_id }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400 text-xs font-bold uppercase mb-1">Lokasi</p>
                        <p class="font-bold">{{ $transaction->event->location }}</p>
                    </div>
                </div>

                <div class="bg-slate-100 p-6 rounded-3xl flex flex-col items-center">
                    <p class="text-slate-400 text-xs font-bold uppercase mb-4">Scan QR untuk Check-in</p>
                    <!-- Dynamic QR Code -->
                    <div class="w-48 h-48 bg-white p-4 rounded-xl shadow-inner flex items-center justify-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=192x192&data={{ urlencode($transaction->order_id) }}" 
                            alt="QR Code" class="w-full h-full object-contain">
                    </div>
                    <p class="mt-4 font-mono font-bold text-slate-800">{{ $transaction->order_id }}</p>
                </div>
            </div>

            <div class="px-8 pb-8">
                <button onclick="window.print()"
                    class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-700 transition">
                    Cetak / Simpan PDF
                </button>
                <a href="{{ route('home') }}"
                    class="block text-center mt-4 text-slate-500 font-bold hover:text-indigo-600">Kembali ke Beranda</a>
            </div>
        </div>

        <!-- Review Section -->
        @if(now() >= $transaction->event->date)
        <div class="bg-white text-slate-900 rounded-[2.5rem] overflow-hidden shadow-2xl p-8 mt-6">
            <h3 class="text-xl font-black mb-4">Ulasan & Testimoni</h3>
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-2xl font-bold border border-emerald-100">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-2xl font-bold border border-red-100">
                    {{ session('error') }}
                </div>
            @endif

            @if($transaction->review)
                <div class="space-y-4">
                    <p class="text-sm text-slate-500">Anda telah memberikan ulasan:</p>
                    <div class="flex items-center gap-1 text-orange-400">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $transaction->review->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="font-medium text-slate-700 italic">"{{ $transaction->review->testimony }}"</p>
                </div>
            @else
                <form action="{{ route('ticket.review') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                    <div>
                        <label class="block text-sm font-bold text-slate-500 mb-2">Penilaian Anda (Bintang)</label>
                        <div class="flex items-center gap-2" id="star-rating">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" data-rating="{{ $i }}" class="star-btn text-slate-300 hover:text-orange-400 transition cursor-pointer">
                                    <svg class="w-8 h-8 fill-current" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input" required value="">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-500 mb-2">Pesan Ulasan / Testimoni</label>
                        <textarea name="testimony" rows="3" placeholder="Bagikan pengalaman Anda mengikuti acara ini..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium" required></textarea>
                    </div>
                    <button type="submit" class="w-full py-4 bg-slate-800 text-white rounded-2xl font-bold shadow-lg hover:bg-slate-900 transition active:scale-95">
                        Kirim Ulasan
                    </button>
                </form>
            @endif
        </div>
        @endif
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-input');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                stars.forEach(s => {
                    const r = s.getAttribute('data-rating');
                    if (r <= rating) {
                        s.classList.remove('text-slate-300');
                        s.classList.add('text-orange-400');
                    } else {
                        s.classList.remove('text-orange-400');
                        s.classList.add('text-slate-300');
                    }
                });
            });
        });
    });
    </script>
</body>

</html>