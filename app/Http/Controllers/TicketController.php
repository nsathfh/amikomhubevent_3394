<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function show(Request $request): View
    {
        $orderId = $request->string('order')->toString();

        $transaction = Transaction::with(['event.user', 'review'])
            ->when($orderId, fn ($query) => $query->where('order_id', $orderId))
            ->latest()
            ->firstOrFail();

        return view('ticket', compact('transaction'));
    }

    public function storeReview(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'rating' => 'required|integer|between:1,5',
            'testimony' => 'required|string|min:5',
        ]);

        $transaction = Transaction::with('event')->findOrFail($request->transaction_id);

        $existingReview = \App\Models\Review::where('transaction_id', $transaction->id)->first();
        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk tiket ini.');
        }

        // Check if event has completed
        if (now() < $transaction->event->date) {
            return back()->with('error', 'Ulasan hanya dapat diberikan setelah acara selesai.');
        }

        \App\Models\Review::create([
            'event_id' => $transaction->event_id,
            'transaction_id' => $transaction->id,
            'rating' => $request->rating,
            'testimony' => $request->testimony,
            'customer_name' => $transaction->customer_name,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil disimpan.');
    }
}
