@extends('layouts.public')

@section('title', 'Status Pembayaran — ' . $invoice->invoice_number)

@section('content')
<section class="max-w-2xl mx-auto px-4 py-16 lg:py-24">
    @php
        $isPaid = $invoice->status === 'paid';
        $successPayment = $invoice->payments->where('status', 'success')->first();
    @endphp

    <!-- Status Header Animation -->
    <div class="text-center mb-8 space-y-3">
        <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center shadow-lg transition-transform duration-300
            {{ $isPaid ? 'bg-emerald-100 text-emerald-600 shadow-emerald-500/20' : 'bg-amber-100 text-amber-600 shadow-amber-500/20' }}">
            @if ($isPaid)
                <svg class="w-10 h-10 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            @else
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
        </div>

        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
            {{ $isPaid ? 'Pembayaran Berhasil Diverifikasi!' : 'Menunggu Penyelesaian Pembayaran' }}
        </h1>
        <p class="text-slate-600 text-sm max-w-md mx-auto leading-relaxed">
            {{ $isPaid 
                ? 'Terima kasih! Transaksi Anda telah tercatat sah di sistem keuangan PT Lampung Post.' 
                : 'Transaksi Anda masih menunggu konfirmasi pelunasan dari kanal pembayaran yang Anda pilih.' }}
        </p>
    </div>

    <!-- Summary Confirmation Card -->
    <div class="bg-white border border-slate-200/80 shadow-2xl shadow-slate-200/60 rounded-3xl p-6 sm:p-8 space-y-6">
        
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Ringkasan Tagihan</span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                {{ $isPaid ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $isPaid ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                {{ $isPaid ? 'Lunas' : 'Menunggu Pelunasan' }}
            </span>
        </div>

        <div class="space-y-3 text-xs sm:text-sm">
            <div class="flex justify-between py-1">
                <span class="text-slate-400 font-medium">Nomor Tagihan:</span>
                <span class="font-mono font-bold text-slate-900">{{ $invoice->invoice_number }}</span>
            </div>
            <div class="flex justify-between py-1">
                <span class="text-slate-400 font-medium">Nama Pengiklan:</span>
                <span class="font-bold text-slate-900">{{ $invoice->advertiser_name }}</span>
            </div>
            <div class="flex justify-between py-1">
                <span class="text-slate-400 font-medium">Penempatan Slot:</span>
                <span class="font-semibold text-slate-900">{{ $invoice->ad_slot }}</span>
            </div>
            @if($successPayment)
                <div class="flex justify-between py-1">
                    <span class="text-slate-400 font-medium">Metode Pembayaran:</span>
                    <span class="font-bold text-slate-900 uppercase">{{ $successPayment->payment_method ?? 'Payment Gateway' }}</span>
                </div>
            @endif
            <div class="flex justify-between py-3 border-t border-slate-100 items-baseline">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">Total Lunas</span>
                <span class="text-2xl font-black text-red-600">
                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        @if ($isPaid && $successPayment)
            <div class="space-y-3 pt-2">
                <a href="{{ route('receipt.download', $successPayment->id) }}"
                   class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-4 rounded-2xl shadow-lg shadow-red-600/30 hover:shadow-red-600/50 transition flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Unduh Kuitansi Resmi (PDF)</span>
                </a>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('receipt.preview', $successPayment->id) }}" target="_blank"
                       class="text-center py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-xs transition">
                        Pratinjau Kuitansi
                    </a>
                    <a href="{{ route('landing') }}"
                       class="text-center py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-xs transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-3 pt-2">
                <a href="{{ route('public.pay.show', $invoice->invoice_number) }}"
                   class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3.5 rounded-2xl shadow-md shadow-red-600/30 transition text-sm flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    <span>Coba Bayar Lagi / Ganti Metode</span>
                </a>
                <a href="{{ route('landing') }}" 
                   class="block text-center py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold text-xs transition">
                    Kembali ke Beranda
                </a>
            </div>
        @endif

    </div>

    <!-- Assurance -->
    <div class="mt-8 text-center text-xs text-slate-400 space-y-1">
        <p>Kuitansi elektronik ini sah dan diakui sebagai bukti pembayaran resmi PT Lampung Post.</p>
        <p>Bila ada pertanyaan mengenai transaksi ini, hubungi <a href="mailto:keuangan@lampungpost.co.id" class="text-red-600 font-medium hover:underline">keuangan@lampungpost.co.id</a></p>
    </div>

</section>
@endsection
