<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{event?}', [EventController::class, 'show'])->name('events.show');
Route::redirect('/event-detail.html', '/event');
Route::get('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/payment/{order_id}', [App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/my-ticket', [TicketController::class, 'show'])->name('ticket');

use App\Http\Controllers\AuthController;

// Rute Autentikasi Admin (Bisa diakses publik/tamu)
// Diberi nama 'login' agar middleware 'auth' bawaan Laravel otomatis mengalihkan pengguna yang belum login ke rute ini
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Halaman Admin (Mengelompokkan rute dengan prefix /admin dan nama route diawali 'admin.')
// Menerapkan middleware 'auth' (harus terautentikasi) dan 'admin' (harus role admin)
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', [DashboardController::class, 'viewDashboard'])->name('dashboard');
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    
    // Rute resource secara otomatis membuat 7 rute CRUD (index, create, store, edit, update, destroy).
    // Kita kecualikan 'show' karena tidak memerlukan halaman detail partner secara khusus.
    Route::resource('partners', AdminPartnerController::class)->except(['show']);
    
    Route::resource('events', AdminEventController::class);
});

