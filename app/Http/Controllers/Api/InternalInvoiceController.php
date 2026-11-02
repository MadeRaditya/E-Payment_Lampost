<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InternalInvoiceController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // Wajib menggunakan 'with' agar tidak terjadi N+1 Query saat meload relasi detail
        $query = Invoice::with(['payments.receipt', 'creator'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Dibuat 50 per halaman agar tarikan bulk-data lebih efisien
        $invoices = $query->paginate(50);

        // Petakan semua data lengkap per-transaksi
        $formattedInvoices = $invoices->getCollection()->map(function ($invoice) {
            return [
                // 1. Informasi Utama Transaksi
                'id' => $invoice->id,
                'invoice_number' => $invoice->invoice_number,
                'status' => $invoice->status,
                'amount' => $invoice->amount,
                'amount_formatted' => 'Rp ' . number_format($invoice->amount, 0, ',', '.'),
                'description' => $invoice->description,
                
                // 2. Data Entitas Pengiklan / Penagihan Lengkap
                'advertiser' => [
                    'name' => $invoice->advertiser_name ?? $invoice->billing_name,
                    'contact_general' => $invoice->advertiser_contact,
                    'email' => $invoice->billing_email,
                    'phone' => $invoice->billing_phone,
                    'nik_npwp' => $invoice->advertiser_nik_npwp ?? $invoice->billing_npwp_nik,
                    'address' => $invoice->advertiser_address ?? $invoice->billing_address,
                ],

                // 3. Detail Konten, Spesifikasi & Teks Iklan
                'ad_details' => [
                    'placement_type' => $invoice->placement_type,
                    'category' => $invoice->category,
                    'sub_category' => $invoice->sub_category ?? $invoice->subcategory,
                    'format' => $invoice->ad_format,
                    'slot' => $invoice->ad_slot,
                    'title' => $invoice->ad_title,
                    'text' => $invoice->ad_text, 
                    'duration_days' => $invoice->ad_duration_days,
                    'start_date' => $invoice->ad_start_date ? $invoice->ad_start_date->format('Y-m-d') : null,
                    'publication_date' => $invoice->publication_date ? $invoice->publication_date->format('Y-m-d') : null,
                ],

                // 4. Aset Visual / Media Pendukung
                'media' => [
                    'main_media_url' => $invoice->media_path ? asset('storage/' . $invoice->media_path) : null,
                    'additional_media_urls' => collect($invoice->media_files ?? [])->map(function ($path) {
                        return asset('storage/' . $path);
                    })->toArray(),
                ],

                // 5. Data Legal & Tanda Tangan
                'legal_agreement' => [
                    'signed_by_name' => $invoice->signed_by_name,
                    'signed_at' => $invoice->signed_at,
                    'signed_ip' => $invoice->signed_ip,
                    'has_signature' => !empty($invoice->signature_data)
                ],

                // 6. Preferensi & Riwayat Pembayaran (Gateway Integration)
                'payment_preference' => $invoice->payment_preference,
                'payment_history' => $invoice->payments->map(function ($payment) {
                    return [
                        'payment_id' => $payment->id,
                        'gateway' => $payment->payment_gateway,
                        'method' => $payment->payment_method,
                        'reference_id' => $payment->reference_id, 
                        'status' => $payment->status,
                        'amount' => $payment->amount,
                        'paid_at' => $payment->paid_at ? $payment->paid_at->toDateTimeString() : null,
                        'gateway_raw_response' => $payment->gateway_response, 
                        'receipt' => $payment->receipt ? [
                            'receipt_number' => $payment->receipt->receipt_number,
                            'file_url' => asset('storage/' . $payment->receipt->file_path),
                        ] : null,
                    ];
                }),

                // 7. Metadata Sistem
                'system_info' => [
                    'created_at' => $invoice->created_at->toDateTimeString(),
                    'updated_at' => $invoice->updated_at->toDateTimeString(),
                    'due_date' => $invoice->due_date ? $invoice->due_date->format('Y-m-d') : null,
                    'created_by' => $invoice->creator ? [
                        'user_id' => $invoice->creator->id,
                        'name' => $invoice->creator->name,
                    ] : 'Sistem Self-Service Publik',
                ]
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Seluruh data transaksi berhasil diambil.',
            'data' => $formattedInvoices,
            'meta' => [
                'current_page' => $invoices->currentPage(),
                'last_page' => $invoices->lastPage(),
                'per_page' => $invoices->perPage(),
                'total' => $invoices->total(),
            ]
        ], 200);
    }
}