@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-500 uppercase">Total Pendapatan</span>
            <div class="w-8 h-8 bg-green-50 text-green-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-500 uppercase">Lunas</span>
            <div class="w-8 h-8 bg-red-50 text-red-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-gray-900">{{ $paidCount }}</p>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-500 uppercase">Menunggu</span>
            <div class="w-8 h-8 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-gray-900">{{ $unpaidCount }}</p>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-medium text-gray-500 uppercase">Kedaluwarsa</span>
            <div class="w-8 h-8 bg-gray-100 text-gray-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-gray-900">{{ $expiredCount }}</p>
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="font-semibold text-gray-800">Tagihan Terbaru</h2>
            <a href="{{ route('invoices.index') }}" class="text-sm text-red-600 hover:underline font-medium">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentInvoices as $invoice)
            <a href="{{ route('invoices.show', $invoice->id) }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition">
                <div class="min-w-0 flex-1">
                    <p class="font-medium text-sm truncate">{{ $invoice->advertiser_name ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $invoice->invoice_number }} · {{ $invoice->description }}</p>
                </div>
                <div class="ml-4 text-right flex-shrink-0">
                    <p class="font-semibold text-sm">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                    <span class="inline-block mt-1 px-2 py-0.5 text-xs font-semibold rounded-full
                        {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-700' : 
                           ($invoice->status === 'unpaid' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </div>
            </a>
            @empty
            <div class="p-8 text-center text-gray-400 text-sm">Belum ada tagihan</div>
            @endforelse
        </div>
    </div>

    <div class="space-y-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-semibold text-gray-800 mb-4">Aksi Cepat</h2>
            <a href="{{ route('invoices.create') }}" 
               class="flex items-center gap-3 p-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition mb-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="font-medium text-sm">Buat Tagihan Baru</span>
            </a>
            <a href="{{ route('payments.index') }}" 
               class="flex items-center gap-3 p-3 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <span class="font-medium text-sm">Lihat Riwayat Pembayaran</span>
            </a>
        </div>

        <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-xl p-5 text-white">
            <p class="text-xs uppercase opacity-80 mb-1">Tips</p>
            <p class="text-sm leading-relaxed">
                Kirimkan ID Tagihan ke calon pengiklan melalui email. Mereka bisa membayar tanpa perlu membuat akun.
            </p>
        </div>
    </div>
</div>
@endsection