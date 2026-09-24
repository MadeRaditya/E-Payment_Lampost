<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Receipt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReceiptController extends Controller
{
    public function downloadByPayment(Payment $payment)
    {
        if ($payment->status !== 'success') {
            abort(404, 'Kuitansi belum tersedia.');
        }

        $receipt = $payment->receipt ?? $this->generateReceiptRecord($payment);

        return $this->buildPdf($payment, $receipt)->download(
            'Kuitansi-' . $receipt->receipt_number . '.pdf'
        );
    }

    public function preview(Payment $payment)
    {
        if ($payment->status !== 'success') {
            abort(404, 'Kuitansi belum tersedia.');
        }

        $receipt = $payment->receipt ?? $this->generateReceiptRecord($payment);

        return $this->buildPdf($payment, $receipt)->stream(
            'Kuitansi-' . $receipt->receipt_number . '.pdf'
        );
    }

    public function downloadByReceiptNumber($receipt_number)
    {
        $receipt = Receipt::where('receipt_number', $receipt_number)
            ->with('payment.invoice')
            ->firstOrFail();

        if (!$receipt->payment || $receipt->payment->status !== 'success') {
            abort(404, 'Kuitansi tidak valid.');
        }

        return $this->buildPdf($receipt->payment, $receipt)->download(
            'Kuitansi-' . $receipt->receipt_number . '.pdf'
        );
    }

    private function buildPdf(Payment $payment, Receipt $receipt)
    {
        $payment->load('invoice.creator');
        $invoice = $payment->invoice;

        $data = [
            'receipt' => $receipt,
            'payment' => $payment,
            'invoice' => $invoice,
            'company' => [
                'name' => config('app.name', 'AdPay'),
                'address' => 'Jl. Contoh Alamat No. 123, Jakarta',
                'phone' => '(021) 1234-5678',
                'email' => 'finance@company.com',
                'website' => 'www.company.com',
            ],
            'verification_url' => route('receipt.verify', $receipt->receipt_number),
        ];

        try {
            $html = view('pdf.receipt', $data)->render();
        } catch (\Throwable $e) {
            Log::error('Receipt View Error: ' . $e->getMessage());
            abort(500, 'Gagal merender kuitansi: ' . $e->getMessage());
        }

        return Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);
    }

    private function generateReceiptRecord(Payment $payment): Receipt
    {
        return Receipt::create([
            'payment_id' => $payment->id,
            'receipt_number' => 'RCP-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
            'file_path' => 'receipts/' . $payment->id . '.pdf',
        ]);
    }
}