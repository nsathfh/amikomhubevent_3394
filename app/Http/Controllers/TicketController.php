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

        $transaction = Transaction::with('event')
            ->when($orderId, fn ($query) => $query->where('order_id', $orderId))
            ->latest()
            ->firstOrFail();

        return view('ticket', compact('transaction'));
    }
}
