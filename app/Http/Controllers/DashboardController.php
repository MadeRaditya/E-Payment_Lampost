<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Payment::where('status', 'success')->sum('amount');
        $paidCount = Invoice::where('status', 'paid')->count();
        $unpaidCount = Invoice::where('status', 'unpaid')->count();
        $expiredCount = Invoice::where('status', 'expired')->count();

        // Data 7 hari terakhir untuk chart
        $chartData = Payment::where('status', 'success')
            ->where('paid_at', '>=', now()->subDays(7))
            ->select(
                DB::raw('DATE(paid_at) as date'),
                DB::raw('SUM(amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Recent activity
        $recentInvoices = Invoice::with('creator')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'paidCount',
            'unpaidCount',
            'expiredCount',
            'chartData',
            'recentInvoices'
        ));
    }
}
