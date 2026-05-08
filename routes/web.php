<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{event?}', [EventController::class, 'show'])->name('events.show');
Route::redirect('/event-detail.html', '/event');
Route::get('/checkout', [EventController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout', [EventController::class, 'processCheckout'])->name('checkout.process');
Route::get('/my-ticket', [TicketController::class, 'show'])->name('ticket');

//Rute Admin Area
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/', [DashboardController::class, 'viewDashboard'])->name('dashboard');
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::resource('categories', AdminCategoryController::class)->except(['show']);
    Route::resource('events', AdminEventController::class);
});

