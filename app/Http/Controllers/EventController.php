<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function show(?Event $event = null): View
    {
        $event = $event ?? Event::with('category')->latest()->firstOrFail();

        return view('event-detail', compact('event'));
    }
    
    public function showCheckout(Request $request): View
    {
        $eventId = $request->integer('event_id');

        $eventQuery = Event::query();
        if ($eventId) {
            $eventQuery->where('id', $eventId);
        }

        $event = $eventQuery->first() ?? Event::latest()->firstOrFail();

        return view('checkout', compact('event'));
    }

    public function processCheckout(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:25',
        ]);

        $serviceFee = 5000;

        $transaction = DB::transaction(function () use ($data, $serviceFee) {
            $event = Event::whereKey($data['event_id'])->lockForUpdate()->firstOrFail();

            if ($event->stock < 1) {
                abort(422, 'Stok tiket untuk event ini sudah habis.');
            }

            $orderId = 'TRX-' . now()->format('ymdHis') . strtoupper(Str::random(3));

            $transaction = Transaction::create([
                'event_id' => $event->id,
                'order_id' => $orderId,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'total_price' => $event->price + $serviceFee,
                'status' => 'Success',
            ]);

            $event->decrement('stock');

            return $transaction;
        });

        return redirect()->route('ticket', ['order' => $transaction->order_id]);
    }
}
