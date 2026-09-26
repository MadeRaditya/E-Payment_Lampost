<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PublicPaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Public Payment Portal (Customer Self-Service)
Route::prefix('pay')->group(function () {
    // Lookup form
    Route::get('/', [PublicPaymentController::class, 'showForm'])->name('pay.index');
    Route::get('/form', [PublicPaymentController::class, 'showForm'])->name('public.pay.form');
    Route::get('/portal', [PublicPaymentController::class, 'showForm'])->name('public.pay');

    // Validation & lookup check
    Route::post('/check', [PublicPaymentController::class, 'checkInvoice'])->name('pay.check');
    Route::post('/check-invoice', [PublicPaymentController::class, 'checkInvoice'])->name('public.pay.check');

    // Invoice Detail & Checkout
    Route::get('/{invoice_number}', [PublicPaymentController::class, 'showInvoice'])->name('pay.show');
    Route::get('/{invoice_number}/view', [PublicPaymentController::class, 'showInvoice'])->name('public.pay.show');

    // Payment Processing (Gateway Handshake)
    Route::post('/{invoice_number}/process', [PublicPaymentController::class, 'processPayment'])->name('pay.process');
    Route::post('/{invoice_number}/checkout', [PublicPaymentController::class, 'processPayment'])->name('public.pay.process');

    // Result & Post-Payment Confirmation
    Route::get('/{invoice_number}/result', [PublicPaymentController::class, 'showResult'])->name('pay.result');
    Route::get('/{invoice_number}/status', [PublicPaymentController::class, 'showResult'])->name('public.pay.result');

    // Customer PDF Invoice Download & Print Preview
    Route::get('/{invoice_number}/download', [PublicPaymentController::class, 'downloadInvoice'])->name('pay.download');
    Route::get('/{invoice_number}/print', [PublicPaymentController::class, 'printInvoice'])->name('pay.print');
});

/*
|--------------------------------------------------------------------------
| Public Booking (Multi-Step) — Pemesan Iklan Mandiri
|--------------------------------------------------------------------------
*/
Route::prefix('booking')->name('booking.')->group(function () {
    // Step 1
    Route::get('/step-1', [BookingController::class, 'step1'])->name('step1');
    Route::post('/step-1', [BookingController::class, 'step1Store'])->name('step1.store');

    // Step 2
    Route::get('/step-2', [BookingController::class, 'step2'])->name('step2');
    Route::post('/step-2', [BookingController::class, 'step2Store'])->name('step2.store');
    Route::post('/preview', [BookingController::class, 'preview'])->name('preview'); // AJAX

    // Step 3
    Route::get('/step-3', [BookingController::class, 'step3'])->name('step3');
    Route::post('/step-3', [BookingController::class, 'step3Store'])->name('step3.store');

    // Step 4
    Route::get('/step-4', [BookingController::class, 'step4'])->name('step4');
    Route::post('/step-4', [BookingController::class, 'step4Store'])->name('step4.store');
});


// Payment Gateway Webhook (Midtrans Notification)
Route::post('/api/webhook/payment', [WebhookController::class, 'handle'])->name('webhook.payment');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

/*
|--------------------------------------------------------------------------
| Admin & Finance Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Invoice Management & PDF Generation
    Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'downloadPdf'])->name('invoices.download');
    Route::get('/invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    Route::resource('invoices', InvoiceController::class);

    // Payment History & Gateway Audit Log
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
});

/*
|--------------------------------------------------------------------------
| Digital Receipt Routes (Official PDF Documents)
|--------------------------------------------------------------------------
*/
// Standard RESTful plural resource
Route::prefix('receipts')->group(function () {
    Route::get('/{payment}/download', [ReceiptController::class, 'downloadByPayment'])->name('receipts.download');
    Route::get('/{payment}/preview', [ReceiptController::class, 'preview'])->name('receipts.preview');
    Route::get('/verify/{receipt_number}', [ReceiptController::class, 'downloadByReceiptNumber'])->name('receipts.verify');
});

// Backward-compatible alias routes for receipts
Route::get('/receipt/{payment}/download', [ReceiptController::class, 'downloadByPayment'])->name('receipt.download');
Route::get('/receipt/{payment}/preview', [ReceiptController::class, 'preview'])->name('receipt.preview');
Route::get('/receipt/verify/{receipt_number}', [ReceiptController::class, 'downloadByReceiptNumber'])->name('receipt.verify');
