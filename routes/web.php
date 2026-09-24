<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicPaymentController;
use App\Http\Controllers\WebhookController;


// Public ROute
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::prefix('pay')->name('public.pay')->group(function () {
    Route::get('/', [PublicPaymentController::class, 'showForm'])->name('.form');
    Route::post('/check', [PublicPaymentController::class, 'checkInvoice'])->name('.check');
    Route::get('/{invoice_number}', [PublicPaymentController::class, 'showInvoice'])->name('.show');
    Route::post('/{invoice_number}/process', [PublicPaymentController::class, 'processPayment'])->name('.process');
    Route::get('/{invoice_number}/result', [PublicPaymentController::class, 'showResult'])->name('.result');
});

// Webhook Midtrans
Route::post('/api/webhook/payment', [WebhookController::class, 'handle']);

// Auth Route
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Admin Route
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('invoices', InvoiceController::class);
    
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
});