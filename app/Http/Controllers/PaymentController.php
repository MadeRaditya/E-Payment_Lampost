<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('invoice')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $query->whereHas('invoice', function ($builder) use ($request) {
                $builder->where('invoice_number', 'like', "%{$request->q}%")
                    ->orWhere('advertiser_name', 'like', "%{$request->q}%")
                    ->orWhere('billing_name', 'like', "%{$request->q}%");
            });
        }

        $payments = $query->paginate(15)->withQueryString();
        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load('invoice', 'receipt');
        return view('admin.payments.show', compact('payment'));
    }
}
