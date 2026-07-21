<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function showScanner()
    {
        return view('admin.scan');
    }

    public function processCheckin(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
        ]);

        $orderId = trim($request->order_id);

        $transaction = Transaction::with('event')->where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket tidak valid atau tidak ditemukan!',
            ]);
        }

        // Batasi akses jika role organizer
        if (auth()->user()->role === 'organizer' && $transaction->event->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak! Anda bukan penyelenggara event ini.',
            ]);
        }

        // Cek status pembayaran
        $successStatuses = ['success', 'settlement', 'Success'];
        if (!in_array($transaction->status, $successStatuses)) {
            return response()->json([
                'success' => false,
                'message' => 'Tiket belum dibayar! Status: ' . $transaction->status,
            ]);
        }

        // Cek double entry
        if ($transaction->checked_in_at) {
            return response()->json([
                'success' => false,
                'message' => 'WARNING: Tiket sudah digunakan pada ' . $transaction->checked_in_at->format('d M Y, H:i') . '! (Double Entry Terdeteksi)',
            ]);
        }

        // Tandai tiket sudah digunakan
        $transaction->update([
            'checked_in_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Check-in Berhasil!',
            'customer_name' => $transaction->customer_name,
            'event_title' => $transaction->event->title,
            'time' => $transaction->checked_in_at->format('H:i:s'),
        ]);
    }
}
