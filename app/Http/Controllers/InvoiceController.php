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
            $query->where(function ($builder) use ($q) {
                $builder->where('invoice_number', 'like', "%{$q}%")
                    ->orWhere('advertiser_name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $invoices = $query->paginate(10)->withQueryString();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('admin.invoices.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'advertiser_name' => 'required|string|max:255',
            'advertiser_contact' => 'required|string|max:255',
            'ad_slot' => 'required|string|max:100',
            'ad_duration_days' => 'required|integer|min:1',
            'ad_start_date' => 'required|date|after_or_equal:today',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:500',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $data['invoice_number'] = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $data['created_by'] = Auth::id();
        $data['status'] = 'unpaid';

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

        $data = $request->validate([
            'advertiser_name' => 'required|string|max:255',
            'advertiser_contact' => 'required|string|max:255',
            'ad_slot' => 'required|string|max:100',
            'ad_duration_days' => 'required|integer|min:1',
            'ad_start_date' => 'required|date',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required|string|max:500',
            'due_date' => 'required|date',
        ]);

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
