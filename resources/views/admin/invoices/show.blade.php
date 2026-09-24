@extends('layouts.admin')

@section('title', 'Detail Tagihan')
@section('page-title', 'Detail Tagihan')

@section('content')
<div class="mb-6">
    <a href="{{ route('invoices.index') }}" class="text-sm text-gray-500 hover:text-red-600">← Kembali ke daftar tagihan</a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 to-red-700 text-white p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs opacity-80 uppercase tracking-wider">ID Tagihan</p>
                        <p class="text-2xl font-bold mt-1">{{ $invoice->invoice_number }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-white/20 backdrop-blur-sm">
                        {{ strtoupper($invoice->status) }}
                    </span>
                </div>
                <div class="mt-6">
                    <p class="text-xs opacity-80 uppercase tracking-wider">Total Tagihan</p>
                    <p class="text-3xl font-bold mt-1">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="p-6 grid sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Pengiklan</p>
                    <p class="font-semibold">{{ $invoice->advertiser_name ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ $invoice->advertiser_contact ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Slot Iklan</p>
                    <p class="font-semibold">{{ $invoice->ad_slot ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ $invoice->ad_duration_days ? $invoice->ad_duration_days . ' hari' : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Mulai Tayang</p>
                    <p class="font-semibold">{{ $invoice->ad_start_date ? $invoice->ad_start_date->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Jatuh Tempo</p>
                    <p class="font-semibold">{{ $invoice->due_date->format('d M Y') }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Deskripsi</p>
                    <p>{{ $invoice->description }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="p-5 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Riwayat Pembayaran</h2>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($invoice->payments as $payment)
                <div class="p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium">{{ $payment->payment_method ?? 'Belum dipilih' }}</p>
                        <p class="text-xs text-gray-500">{{ $payment->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                        {{ $payment->status === 'success' ? 'bg-green-100 text-green-700' : 
                           ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                @empty
                <div class="p-8 text-center text-gray-400 text-sm">Belum ada percobaan pembayaran</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-4">Aksi</h3>
            <div class="space-y-2">
                <button onclick="copyToClipboard('{{ $invoice->invoice_number }}')" 
                    class="w-full flex items-center gap-2 p-2.5 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3"/>
                    </svg>
                    Copy ID Tagihan
                </button>
                @if($invoice->status !== 'paid')
                <a href="{{ route('invoices.edit', $invoice->id) }}" 
                    class="w-full flex items-center gap-2 p-2.5 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Tagihan
                </a>
                <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" 
                      onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" 
                        class="w-full flex items-center gap-2 p-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus Tagihan
                    </button>
                </form>
                @endif
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">
            <p class="text-xs font-semibold text-blue-700 uppercase mb-2">Link Pembayaran</p>
            <p class="text-xs text-blue-600 mb-3 break-all">{{ route('public.pay.show', $invoice->invoice_number) }}</p>
            <button onclick="copyToClipboard('{{ route('public.pay.show', $invoice->invoice_number) }}')"
                class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-lg hover:bg-blue-700 transition">
                Copy Link
            </button>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Berhasil dicopy: ' + text);
        });
    }
</script>
@endsection