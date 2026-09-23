<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/pay', function () {
    return view('public.pay'); 
})->name('public.pay');

// Route::post('/pay/check', [App\Http\Controllers\PublicPaymentController::class, 'checkInvoice'])->name('public.pay.check');

// Route::get('/pay/{invoice_number}', [App\Http\Controllers\PublicPaymentController::class, 'showInvoice'])->name('public.pay.show');

// Route::post('/pay/{invoice_number}/process', [App\Http\Controllers\PublicPaymentController::class, 'processPayment'])->name('public.pay.process');

// Route::post('/api/webhook/payment', [App\Http\Controllers\WebhookController::class, 'handle']);


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Route::resource('invoices', App\Http\Controllers\InvoiceController::class);
});

Route::get('/', function () {
    return redirect('/login');
});