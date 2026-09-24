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
}
