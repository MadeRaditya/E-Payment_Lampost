@extends('layouts.admin')

@section('title', 'Pembayaran')
@section('page-title', 'Riwayat Pembayaran')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900">Riwayat Pembayaran</h2>
    <p class="text-sm text-gray-500 mt-1">Semua transaksi yang masuk dari payment gateway</p>
</div>

<form method="GET" class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6 flex flex-col sm:flex-row gap-3">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID tagihan atau pengiklan..."
        class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-sm">
    <select name="status" class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-sm">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Berhasil</option>
        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
    </select>
    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
        Filter
    </button>
</form>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Waktu</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">ID Tagihan</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Pengiklan</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Metode</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Nominal</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($payments as $payment)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-600 text-xs">{{ $payment->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-3 font-medium">{{ $payment->invoice->invoice_number ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $payment->invoice->advertiser_name ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $payment->payment_method ?? '-' }}</td>
                    <td class="px-4 py-3 font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $payment->status === 'success' ? 'bg-green-100 text-green-700' : 
                               ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-12 text-center text-gray-500 text-sm">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">{{ $payments->links() }}</div>
@endsection