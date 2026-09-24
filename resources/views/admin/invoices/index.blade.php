@extends('layouts.admin')

@section('title', 'Tagihan')
@section('page-title', 'Manajemen Tagihan')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Semua Tagihan</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola tagihan iklan Anda</p>
    </div>
    <a href="{{ route('invoices.create') }}" 
       class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2.5 rounded-lg transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Tagihan
    </a>
</div>

<form method="GET" class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6 flex flex-col sm:flex-row gap-3">
    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID atau pengiklan..."
        class="flex-1 px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-sm">
    <select name="status" class="px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none text-sm">
        <option value="">Semua Status</option>
        <option value="unpaid" {{ request('status') === 'unpaid' ? 'selected' : '' }}>Menunggu</option>
        <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
        <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
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
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">ID Tagihan</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Pengiklan</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Slot</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Nominal</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Jatuh Tempo</th>
                    <th class="px-4 py-3 font-semibold text-gray-600 text-xs uppercase">Status</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($invoices as $invoice)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 font-medium">{{ $invoice->invoice_number }}</td>
                    <td class="px-4 py-3">{{ $invoice->advertiser_name ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $invoice->ad_slot ?? '-' }}</td>
                    <td class="px-4 py-3 font-semibold">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $invoice->due_date->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-700' : 
                               ($invoice->status === 'unpaid' ? 'bg-yellow-100 text-yellow-700' : 
                               ($invoice->status === 'expired' ? 'bg-gray-100 text-gray-600' : 'bg-red-100 text-red-700')) }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('invoices.show', $invoice->id) }}" 
                           class="text-red-600 hover:underline font-medium text-xs">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center">
                        <div class="text-gray-300 mb-2">
                            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">Belum ada tagihan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $invoices->links() }}
</div>
@endsection