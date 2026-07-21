<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $successStatuses = ['success', 'settlement', 'Success'];
        $isOrganizer = auth()->user()->role === 'organizer';
        $userId = auth()->id();

        // 1. Hitung total pendapatan (akumulasi total_price dari status success/settlement)
        $totalIncome = Transaction::whereIn('status', $successStatuses)
            ->when($isOrganizer, function($q) use ($userId) {
                return $q->whereHas('event', fn($e) => $e->where('user_id', $userId));
            })->sum('total_price');

        // 2. Hitung jumlah tiket terjual (jumlah transaksi sukses)
        $ticketsSold = Transaction::whereIn('status', $successStatuses)
            ->when($isOrganizer, function($q) use ($userId) {
                return $q->whereHas('event', fn($e) => $e->where('user_id', $userId));
            })->count();

        // 3. Hitung jumlah event aktif (tanggal event di masa depan)
        $activeEvents = Event::where('date', '>=', now())
            ->when($isOrganizer, function($q) use ($userId) {
                return $q->where('user_id', $userId);
            })->count();

        // 4. Hitung jumlah pesanan pending
        $pendingOrders = Transaction::whereIn('status', ['pending', 'Pending'])
            ->when($isOrganizer, function($q) use ($userId) {
                return $q->whereHas('event', fn($e) => $e->where('user_id', $userId));
            })->count();

        // 5. Ambil 5 transaksi terakhir beserta relasi event
        $latestTransactions = Transaction::with('event')
            ->when($isOrganizer, function($q) use ($userId) {
                return $q->whereHas('event', fn($e) => $e->where('user_id', $userId));
            })->latest()->take(5)->get();

        // 6. Data grafik monthly revenue (6 bulan terakhir)
        $monthlyRevenue = [];
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->translatedFormat('F Y');
            
            $monthlyRevenue[] = Transaction::whereIn('status', $successStatuses)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->when($isOrganizer, function($q) use ($userId) {
                    return $q->whereHas('event', fn($e) => $e->where('user_id', $userId));
                })->sum('total_price');
        }

        // 7. Event pending approval (hanya untuk Superadmin)
        $pendingApprovalEvents = !$isOrganizer 
            ? Event::with('category')->where('status', 'pending')->latest()->get() 
            : collect();

        return view('admin.dashboard', compact(
            'totalIncome', 
            'ticketsSold', 
            'activeEvents', 
            'pendingOrders', 
            'latestTransactions',
            'monthlyRevenue',
            'months',
            'pendingApprovalEvents'
        ));
    }

    public function viewEvent()
    {
        return view('admin.events');
    }
}
