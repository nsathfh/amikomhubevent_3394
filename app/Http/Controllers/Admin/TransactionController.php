<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View
    {
        $query = Transaction::with('event')->latest();
        if (auth()->user()->role === 'organizer') {
            $query->whereHas('event', fn($q) => $q->where('user_id', auth()->id()));
        }
        $transactions = $query->paginate(20);

        return view('admin.transactions.index', compact('transactions'));
    }
}
