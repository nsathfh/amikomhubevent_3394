<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create(Event $event)
    {
        // Jika event sudah lewat/berlalu, cegah checkout
        if ($event->date->isPast()) {
            return redirect()->route('home')->with('error', 'Tiket untuk acara yang sudah selesai tidak dapat dibeli.');
        }

        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        return view('checkout.create', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        // Jika event sudah lewat/berlalu, cegah pembelian
        if ($event->date->isPast()) {
            return redirect()->route('home')->with('error', 'Tiket untuk acara yang sudah selesai tidak dapat dibeli.');
        }

        // 1. Validasi Input Kredensial Pelanggan
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'coupon_code' => 'nullable|string',
        ]);

        // 2. Cegah Check-out Jika Tiket Habis
        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        // 3. Generate Kode TRX (Unik)
        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        
        // Cek kupon voucher
        $discountAmount = 0;
        $couponCode = null;
        if ($request->filled('coupon_code')) {
            $coupon = \App\Models\Coupon::where('code', $request->coupon_code)->where('is_active', true)->first();
            if ($coupon) {
                $couponCode = $coupon->code;
                $discountAmount = ($event->price * $coupon->discount_percent) / 100;
            }
        }

        $adminFee = $event->price == 0 ? 0 : 5000;
        $totalPrice = ($event->price - $discountAmount) + $adminFee;
        if ($totalPrice < 0) {
            $totalPrice = 0;
        }

        // 4. Merekam Transaksi ke Database
        $transaction = Transaction::create([
            'event_id' => $event->id,
            'order_id' => $orderId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => $event->price == 0 ? 'success' : 'pending', // Status Awal
            'coupon_code' => $couponCode,
            'discount_amount' => $discountAmount,
        ]);

        // Kurangi stok tiket event
        $event->decrement('stock');

        // Jika acara gratis, bypass Midtrans
        if ($event->price == 0) {
            return redirect()->route('checkout.success', $transaction->order_id);
        }

        // --- INTEGRASI SNAP MIDTRANS ---

        // Konfigurasi Kredensial Environment Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; // Mode Sandbox!
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Susun Paket Array Data Transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            // Perintah Tembak Generate Snap Token
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Update rekaman kita bahwa transaksi terkait sudah memiliki id token pelunasan
            $transaction->update(['snap_token' => $snapToken]);

            // Redirect ke halaman antarmuka pembayaran final pelanggan
            return redirect()->route('checkout.payment', $transaction->order_id);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    // Validate Coupon AJAX Endpoint
    public function validateCoupon(Request $request, Event $event)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = \App\Models\Coupon::where('code', $request->code)->where('is_active', true)->first();

        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Kode voucher tidak valid atau telah kedaluwarsa.',
            ]);
        }

        $discountAmount = ($event->price * $coupon->discount_percent) / 100;
        $adminFee = $event->price == 0 ? 0 : 5000;
        $newTotal = ($event->price - $discountAmount) + $adminFee;

        return response()->json([
            'valid' => true,
            'code' => $coupon->code,
            'discount_percent' => $coupon->discount_percent,
            'discount_amount' => $discountAmount,
            'new_total' => $newTotal,
            'new_total_formatted' => 'Rp ' . number_format($newTotal, 0, ',', '.'),
            'discount_amount_formatted' => '-Rp ' . number_format($discountAmount, 0, ',', '.'),
        ]);
    }

    // 11.4.5 - Halaman pembayaran Snap Midtrans
    public function payment($order_id)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();
        return view('checkout.payment', compact('transaction', 'categories'));
    }

    // 11.4.6 - Halaman sukses setelah pembayaran
    public function success(Request $request, $order_id)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        // Jika mode lokal atau debug & ada query bypass=1, paksa status sukses (Untuk kemudahan testing)
        if ((app()->environment('local') || config('app.debug')) && $request->has('bypass')) {
            $transaction->update(['status' => 'success']);
            return view('checkout.success', compact('transaction', 'categories'));
        }

        // Jika transaksi gratis, lewati validasi Midtrans
        if ($transaction->total_price == 0 || $transaction->event->price == 0) {
            $transaction->update(['status' => 'success']);
            return view('checkout.success', compact('transaction', 'categories'));
        }

        // Validasi status pembayaran asli dari Midtrans (Mencegah manipulasi URL)
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            $midtransStatus = \Midtrans\Transaction::status($order_id);

            // Hanya ubah status menjadi sukses jika Midtrans mengonfirmasi pembayaran lunas
            if (in_array($midtransStatus->transaction_status, ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']);
            }
        } catch (\Exception $e) {
            // Jika error (transaksi tidak ada di Midtrans, koneksi terputus), kembalikan ke beranda
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}
