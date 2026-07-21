@extends('layouts.app')
@section('title', 'Checkout - ' . $event->title)
@section('content')
<main class="max-w-3xl mx-auto px-6 py-20">
    <div class="mb-12">
        <a href="{{ route('events.show', $event->id) }}" class="text-indigo-600 font-bold flex items-center gap-2 mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Event
        </a>
        <h1 class="text-4xl font-extrabold">Checkout</h1>
        <p class="text-slate-500 mt-2">Lengkapi data Anda untuk mendapatkan tiket.</p>
    </div>
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl font-bold">
            {{ session('error') }}
        </div>
    @endif
    <div class="grid grid-cols-1 gap-8">
        <!-- Summary Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6 border-b pb-4">Pesanan Anda</h3>
            <div class="flex gap-6 items-start">
                <img src="{{ ($event->poster_path && Storage::disk('public')->exists($event->poster_path))
                    ? asset('storage/' . $event->poster_path)
                    : asset('assets/concert.png') }}"
                    alt="Event" class="w-24 h-24 rounded-2xl object-cover">
                <div>
                    <h4 class="font-extrabold text-lg">{{ $event->title }}</h4>
                    <p class="text-slate-500">{{ $event->date->format('d M Y') }} • {{ $event->location }}</p>
                    <p class="text-indigo-600 font-bold mt-2">1 x Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t space-y-3">
                <div class="flex justify-between text-slate-500">
                    <span>Harga Tiket</span>
                    <span>Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                </div>
                <div id="row_discount" class="flex justify-between text-emerald-600 hidden font-bold">
                    <span>Diskon Voucher</span>
                    <span id="txt_discount">-Rp 0</span>
                </div>
                <div class="flex justify-between text-slate-500">
                    <span>Biaya Layanan</span>
                    <span>Rp {{ $event->price == 0 ? '0' : '5.000' }}</span>
                </div>
                <div class="flex justify-between text-2xl font-black mt-4 pt-4 border-t">
                    <span>Total Bayar</span>
                    <span id="txt_total" class="text-indigo-600">Rp {{ number_format($event->price + ($event->price == 0 ? 0 : 5000), 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
            <h3 class="text-xl font-bold mb-6 italic text-indigo-600 underline underline-offset-8">
                {{ auth()->check() ? 'Data Pemesan (Akun Terhubung: ' . auth()->user()->email . ')' : 'Data Pemesan (Tanpa Login)' }}
            </h3>

            @if(!auth()->check())
            <div class="mb-8 pb-6 border-b border-slate-100">
                <p class="text-sm text-slate-500 mb-3 font-semibold">Gunakan akun Google Anda untuk checkout lebih cepat:</p>
                <a href="{{ route('sso.google') }}" class="w-full py-4 border border-slate-200 bg-white hover:bg-slate-50 rounded-2xl font-bold flex items-center justify-center gap-3 transition shadow-sm hover:shadow active:scale-98">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.24 10.285V13.4h6.887C18.2 15.614 15.645 18 12.24 18c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.7 0 3.3.65 4.5 1.8l2.4-2.4C17.3 1.7 14.85 1 12.24 1 6.64 1 2 5.64 2 11.24s4.64 10.24 10.24 10.24c5.795 0 10.24-4.11 10.24-10.24 0-.614-.055-1.2-.164-1.745H12.24z"/>
                    </svg>
                    <span>Continue with Google</span>
                </a>
            </div>
            @endif

            <form action="{{ route('checkout.store', $event->id) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Nama Lengkap</label>
                    <input type="text" name="customer_name" placeholder="Masukkan nama sesuai identitas"
                        class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                        required value="{{ auth()->check() ? auth()->user()->name : old('customer_name') }}">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Email Aktif</label>
                        <input type="email" name="customer_email" placeholder="contoh@gmail.com"
                            class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                            required value="{{ auth()->check() ? auth()->user()->email : old('customer_email') }}">
                        <p class="text-[10px] text-slate-400 mt-2 font-bold uppercase tracking-tighter">*E-Ticket akan dikirim ke email ini</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">No. WhatsApp</label>
                        <input type="tel" name="customer_phone" placeholder="08xxxxxxx"
                            class="w-full px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-medium"
                            required value="{{ old('customer_phone') }}">
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-6">
                    <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">Kode Voucher / Kupon</label>
                    <div class="flex gap-4">
                        <input type="text" name="coupon_code" id="coupon_code" placeholder="Contoh: MAHASISWA50"
                            class="flex-1 px-5 py-4 bg-white border-2 border-slate-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-600 outline-none transition font-mono uppercase font-bold"
                            value="{{ old('coupon_code') }}">
                        <button type="button" id="btn_apply_coupon"
                            class="px-6 bg-slate-800 text-white rounded-2xl font-bold hover:bg-slate-900 transition">
                            Terapkan
                        </button>
                    </div>
                    <p id="coupon_message" class="text-xs mt-2 hidden"></p>
                </div>

                <button type="submit"
                    class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-black text-xl shadow-xl shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                    Lanjut Pembayaran
                </button>
                <p class="text-center text-xs text-slate-400">Dengan menekan tombol di atas, Anda menyetujui Syarat & Ketentuan kami.</p>
            </form>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const btnApply = document.getElementById('btn_apply_coupon');
    const couponInput = document.getElementById('coupon_code');
    const couponMessage = document.getElementById('coupon_message');
    const rowDiscount = document.getElementById('row_discount');
    const txtDiscount = document.getElementById('txt_discount');
    const txtTotal = document.getElementById('txt_total');

    if (btnApply) {
        btnApply.addEventListener('click', function() {
            const code = couponInput.value.trim();
            if (!code) {
                couponMessage.textContent = 'Silakan masukkan kode voucher.';
                couponMessage.className = 'text-xs mt-2 text-rose-600 font-bold';
                couponMessage.classList.remove('hidden');
                return;
            }

            fetch('{{ route('checkout.validate-coupon', $event->id) }}?code=' + encodeURIComponent(code), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.valid) {
                    couponMessage.textContent = 'Kupon ' + data.code + ' berhasil diterapkan! Diskon ' + data.discount_percent + '%';
                    couponMessage.className = 'text-xs mt-2 text-emerald-600 font-bold';
                    couponMessage.classList.remove('hidden');
                    
                    rowDiscount.classList.remove('hidden');
                    txtDiscount.textContent = data.discount_amount_formatted;
                    txtTotal.textContent = data.new_total_formatted;
                } else {
                    couponMessage.textContent = data.message;
                    couponMessage.className = 'text-xs mt-2 text-rose-600 font-bold';
                    couponMessage.classList.remove('hidden');
                    
                    rowDiscount.classList.add('hidden');
                    txtTotal.textContent = 'Rp {{ number_format($event->price + ($event->price == 0 ? 0 : 5000), 0, ',', '.') }}';
                }
            })
            .catch(err => {
                console.error(err);
                couponMessage.textContent = 'Terjadi kesalahan sistem.';
                couponMessage.className = 'text-xs mt-2 text-rose-600 font-bold';
                couponMessage.classList.remove('hidden');
            });
        });
    }
});
</script>
@endsection
