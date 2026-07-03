<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menjumlahkan semua nominal total_price dari kolom Transaksi Lunas 
        $totalRevenue = Transaction::whereIn('status', ['settlement', 'success'])->sum('total_price');

        // 2. Menghitung Berapa orang tamu yang tiketnya sudah Lunas 
        $ticketsSold = Transaction::whereIn('status', ['settlement', 'success'])->count();

        // 3. Menghitung Jumlah Acara Mendatang yang aktif diselenggarakan 
        $activeEvents = Event::where('date', '>=', now())->count();

        // 4. Menghitung Transaksi Ngadat (Status belum dibayar pelanggan / Expired) 
        $pendingOrders = Transaction::where('status', 'pending')->count();

        // 5. Menyertakan 5 daftar riwayat pesanan (History) paling mutakhir di panel 
        $recentTransactions = Transaction::with('event')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalRevenue', 
            'activeEvents', 
            'pendingOrders', 
            'recentTransactions'
        ));
    }

    public function viewDashboard()
    {
        // 1. Hitung total pendapatan (akumulasi total_price dari status success/settlement)
        $successStatuses = ['success', 'settlement', 'Success'];
        $totalIncome = Transaction::whereIn('status', $successStatuses)->sum('total_price');

        // 2. Hitung jumlah tiket terjual (jumlah transaksi sukses)
        $ticketsSold = Transaction::whereIn('status', $successStatuses)->count();

        // 3. Hitung jumlah event aktif (tanggal event di masa depan)
        $activeEvents = Event::where('date', '>=', now())->count();

        // 4. Hitung jumlah pesanan pending
        $pendingOrders = Transaction::whereIn('status', ['pending', 'Pending'])->count();

        // 5. Ambil 5 transaksi terakhir beserta relasi event
        $latestTransactions = Transaction::with('event')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalIncome', 
            'ticketsSold', 
            'activeEvents', 
            'pendingOrders', 
            'latestTransactions'
        ));
    }

    public function viewEvent()
    {
        return view('admin.events');
    }
}
