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
Route::get('/checkout/{event}/validate-coupon', [App\Http\Controllers\CheckoutController::class, 'validateCoupon'])->name('checkout.validate-coupon');
Route::get('/payment/{order_id}', [App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/success/{order_id}', [App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/my-ticket', [TicketController::class, 'show'])->name('ticket');
Route::get('/payment/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'payment']) ->name('checkout.payment'); 
Route::post('/midtrans/callback', [\App\Http\Controllers\MidtransWebhookController::class, 'handle']);

use App\Http\Controllers\AuthController;

// Rute Autentikasi Admin & Penyelenggara
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// Registrasi Organizer
Route::get('/organizer/register', [AuthController::class, 'showRegister'])->name('organizer.register');
Route::post('/organizer/register', [AuthController::class, 'register']);

Route::get('/organizer/{user}', [App\Http\Controllers\OrganizerController::class, 'show'])->name('organizers.show');

// Google SSO
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('sso.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('sso.google.callback');

// Rute untuk Halaman Admin & Penyelenggara (Multi-Tenant)
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', [DashboardController::class, 'viewDashboard'])->name('dashboard');
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('partners', AdminPartnerController::class)->except(['show']);
    Route::resource('events', AdminEventController::class);
    
    // Approval Event (Superadmin)
    Route::post('/events/{event}/approve', [AdminEventController::class, 'approve'])->name('events.approve');
    Route::post('/events/{event}/reject', [AdminEventController::class, 'reject'])->name('events.reject');
    
    // Scan QR Penjaga Pintu
    Route::get('/scan', [App\Http\Controllers\Admin\CheckinController::class, 'showScanner'])->name('scan');
    Route::post('/check-in', [App\Http\Controllers\Admin\CheckinController::class, 'processCheckin'])->name('checkin.process');
});

