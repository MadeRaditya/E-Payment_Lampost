<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;


class PublicPaymentController extends Controller
{
    public function showForm()
    {
        return view('public.pay');
    }

    public function showResult($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();
        $invoice->load('payments');
        return view('public.result', compact('invoice'));
    }
    public function checkInvoice(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string',
        ]);

        $invoice = Invoice::where('invoice_number', $request->invoice_number)->first();

        if (!$invoice) {
            return back()->with('error', 'ID Tagihan tidak ditemukan. Silakan periksa kembali.');
        }

        if ($invoice->status !== 'unpaid') {
            return back()->with('error', 'Tagihan ini sudah dibayar atau sudah kedaluwarsa.');
        }

        if (now()->greaterThan($invoice->due_date)) {
            $invoice->update(['status' => 'expired']);
            return back()->with('error', 'Tagihan ini sudah melewati batas jatuh tempo.');
        }

        return redirect()->route('public.pay.show', $invoice->invoice_number);
    }

    public function showInvoice($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();

        // Cek lagi keamanannya
        if ($invoice->status !== 'unpaid') {
            return redirect()->route('public.pay')->with('error', 'Tagihan tidak valid atau sudah dibayar.');
        }

        return view('public.invoice_detail', compact('invoice'));
    }

    public function processPayment($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();

        if ($invoice->status !== 'unpaid') {
            return redirect()->route('public.pay')->with('error', 'Tagihan sudah tidak aktif.');
        }

        $payment = Payment::create([
            'invoice_id' => $invoice->id,
            'payment_gateway' => 'Midtrans',
            'amount' => $invoice->amount,
            'status' => 'pending',
        ]);

        config::$serverKey = config('midtrans.server_key');
        config::$isProduction = config('midtrans.is_production');
        config::$isSanitized = true;
        config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $invoice->invoice_number . '-' . $payment->id,
                'gross_amount' => $invoice->amount,
            ],
            'customer_details' => [
                'first_name' => 'Client',
                'email' => 'client@example.com'
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $payment->update(['reference_id' => $snapToken]);

            return view('public.payment_gateway', compact('snapToken', 'invoice', 'payment'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghubungi Payment Gateway: ' . $e->getMessage());
        }
    }

    public function downloadInvoice($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();
        $invoice->load('creator', 'payments');
        return app(InvoiceController::class)->buildPdf($invoice)->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function printInvoice($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();
        $invoice->load('creator', 'payments');
        return app(InvoiceController::class)->buildPdf($invoice)->stream('Invoice-' . $invoice->invoice_number . '.pdf');
    }
}
