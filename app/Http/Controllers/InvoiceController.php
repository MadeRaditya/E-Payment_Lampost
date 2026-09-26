<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('creator')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($b) use ($q) {
                $b->where('invoice_number', 'like', "%{$q}%")
                    ->orWhere('advertiser_name', 'like', "%{$q}%")
                    ->orWhere('ad_title', 'like', "%{$q}%")
                    ->orWhere('billing_name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $invoices = $query->paginate(10)->withQueryString();

        $stats = [
            'total'   => Invoice::count(),
            'draft'   => Invoice::where('status', 'draft')->count(),
            'unpaid'  => Invoice::where('status', 'unpaid')->count(),
            'paid'    => Invoice::where('status', 'paid')->count(),
            'revenue' => Invoice::where('status', 'paid')->sum('amount'),
        ];

        return view('admin.invoices.index', compact('invoices', 'stats'));
    }

    public function create()
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request)
    {
        if ($request->filled('amount')) {
            $request->merge([
                'amount' => (int) preg_replace('/\D/', '', (string) $request->input('amount')),
            ]);
        }

        $data = $request->validate([
            'category'          => 'nullable|string|max:100',
            'subcategory'       => 'nullable|string|max:100',
            'ad_title'          => 'nullable|string|max:150',
            'ad_format'         => 'nullable|string|max:100',
            'ad_text'           => 'nullable|string|max:2000',

            'ad_start_date'     => 'required|date|after_or_equal:today',
            'ad_duration_days'  => 'required|integer|min:1',
            'amount'            => 'required|numeric|min:1000',
            'due_date'          => 'required|date|after_or_equal:today',
            'description'       => 'nullable|string|max:500',

            'billing_name'      => 'required|string|max:150',
            'billing_npwp_nik'  => 'nullable|string|max:50',
            'billing_email'     => 'nullable|email|max:150',
            'billing_phone'     => 'nullable|string|max:30',
            'billing_address'   => 'nullable|string|max:500',
            'payment_preference' => 'nullable|in:online,manual',

            'media.*'           => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $data['invoice_number']      = 'INV-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
        $data['created_by']          = \Illuminate\Support\Facades\Auth::id();
        $data['status']              = 'unpaid';
        $data['advertiser_name']     = $data['billing_name'];
        $data['advertiser_contact']  = $data['billing_email'] ?? $data['billing_phone'] ?? '-';
        $data['ad_slot']             = $data['ad_format'] ?? 'Custom';
        $data['description']         = $data['description'] ?? $data['ad_title'] ?? 'Tagihan Iklan Manual';

        if ($request->hasFile('media')) {
            $invoiceNumber = $data['invoice_number'];
            $folder = "bookings/admin-{$invoiceNumber}";
            $mediaPaths = [];
            foreach ($request->file('media') as $file) {
                $mediaPaths[] = $file->store($folder, 'public');
            }
            $data['media_files'] = $mediaPaths;
        }

        $invoice = Invoice::create($data);

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Tagihan berhasil dibuat: ' . $invoice->invoice_number);
    }


    public function show(Invoice $invoice)
    {
        $invoice->load('payments', 'creator');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()->route('invoices.show', $invoice->id)
                ->with('error', 'Tagihan yang sudah lunas tidak dapat diubah.');
        }
        return view('admin.invoices.edit', compact('invoice'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan lunas tidak dapat diubah.');
        }

        if ($request->boolean('publish_draft')) {
            $invoice->update(['status' => 'unpaid']);
            return redirect()->route('invoices.show', $invoice->id)
                ->with('success', 'Draft berhasil difinalisasi menjadi tagihan aktif.');
        }

        if ($request->filled('amount')) {
            $request->merge([
                'amount' => (int) preg_replace('/\D/', '', (string) $request->input('amount')),
            ]);
        }

        $data = $request->validate([
            'advertiser_name'    => 'nullable|string|max:255',
            'advertiser_contact' => 'nullable|string|max:255',
            'ad_slot'            => 'nullable|string|max:100',
            'ad_duration_days'   => 'nullable|integer|min:1',
            'ad_start_date'      => 'nullable|date',
            'amount'             => 'required|numeric|min:1000',
            'description'        => 'nullable|string|max:500',
            'due_date'           => 'required|date',
            'category'           => 'nullable|string|max:100',
            'subcategory'        => 'nullable|string|max:100',
            'ad_title'           => 'nullable|string|max:150',
            'ad_format'          => 'nullable|string|max:100',
            'ad_text'            => 'nullable|string|max:2000',
            'billing_name'       => 'required|string|max:150',
            'billing_npwp_nik'   => 'nullable|string|max:50',
            'billing_email'      => 'nullable|email|max:150',
            'billing_phone'      => 'nullable|string|max:30',
            'billing_address'    => 'nullable|string|max:500',
            'payment_preference' => 'nullable|in:online,manual',
            'media.*'            => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $data['advertiser_name']    = $data['billing_name'];
        $data['advertiser_contact'] = $data['billing_email'] ?? $data['billing_phone'] ?? '-';
        $data['ad_slot']            = $data['ad_format'] ?? 'Custom';

        if ($request->hasFile('media')) {
            $existing = $invoice->media_files ?? [];
            $folder = "bookings/admin-{$invoice->invoice_number}";
            foreach ($request->file('media') as $file) {
                $existing[] = $file->store($folder, 'public');
            }
            $data['media_files'] = $existing;
        }

        $invoice->update($data);

        return redirect()->route('invoices.show', $invoice->id)
            ->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return back()->with('error', 'Tagihan lunas tidak dapat dihapus.');
        }

        $invoice->delete();
        return redirect()->route('invoices.index')
            ->with('success', 'Tagihan berhasil dihapus.');
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load('creator', 'payments');
        return $this->buildPdf($invoice)->download('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function print(Invoice $invoice)
    {
        $invoice->load('creator', 'payments');
        return $this->buildPdf($invoice)->stream('Invoice-' . $invoice->invoice_number . '.pdf');
    }

    public function buildPdf(Invoice $invoice)
    {
        $invoice->loadMissing('creator', 'payments');

        $data = [
            'invoice' => $invoice,
            'company' => config('company', [
                'name' => 'PT LAMPUNG POST',
                'legal_name' => 'PT Masa Kini Mandiri (Lampung Post Media Group)',
                'address' => 'Jl. Soekarno Hatta No. 108, Rajabasa, Bandar Lampung 35144',
                'npwp' => '01.325.882.1-322.000',
                'phone' => '(0721) 783693 / 783694',
                'email' => 'keuangan@lampungpost.co.id',
                'website' => 'www.lampungpost.co.id',
                'bank_accounts' => [
                    [
                        'bank' => 'Bank Central Asia (BCA)',
                        'account_number' => '023-8899-777',
                        'account_name' => 'PT LAMPUNG POST',
                    ],
                    [
                        'bank' => 'Bank Mandiri',
                        'account_number' => '114-00-998877-6',
                        'account_name' => 'PT LAMPUNG POST',
                    ],
                ],
            ]),
            'payment_url' => route('public.pay.show', $invoice->invoice_number),
        ];

        $html = view('pdf.invoice', $data)->render();

        return \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isRemoteEnabled' => false,
                'isHtml5ParserEnabled' => true,
                'defaultFont' => 'DejaVu Sans',
            ]);
    }
}
