@extends('layouts.public')

@section('title', 'Status Pembayaran — ' . $invoice->invoice_number)

@section('content')
<section class="max-w-2xl mx-auto px-4 sm:px-6 py-16 lg:py-24">
    @php
        $isPaid = $invoice->status === 'paid';
        $successPayment = $invoice->payments->where('status', 'success')->first();
    @endphp

    {{-- Status Header --}}
    <div class="text-center mb-10 space-y-3">
        <div class="w-16 h-16 rounded-2xl mx-auto flex items-center justify-center
            {{ $isPaid ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-amber-50 text-amber-600 border border-amber-200' }}">
            @if ($isPaid)
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            @else
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
        </div>

        <h1 class="text-3xl font-editorial font-semibold text-[var(--color-text-main)] tracking-tight">
            {{ $isPaid ? 'Pembayaran Berhasil Diverifikasi' : 'Menunggu Penyelesaian Pembayaran' }}
        </h1>
        <p class="text-[var(--color-text-muted)] text-sm max-w-md mx-auto leading-relaxed">
            {{ $isPaid
                ? 'Terima kasih! Transaksi Anda telah tercatat sah di sistem keuangan PT Lampung Post.'
                : 'Transaksi Anda masih menunggu konfirmasi pelunasan dari kanal pembayaran yang Anda pilih.' }}
        </p>
    </div>

    {{-- Summary Card --}}
    <div class="hairline-card p-6 sm:p-8 space-y-6">

        <div class="flex items-center justify-between border-b border-[var(--color-border)] pb-4">
            <span class="text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest">Ringkasan Tagihan</span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                {{ $isPaid ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                <span class="w-1.5 h-1.5 rounded-full {{ $isPaid ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' }}"></span>
                {{ $isPaid ? 'Lunas' : 'Menunggu Pelunasan' }}
            </span>
        </div>

        <div class="space-y-3 text-xs sm:text-sm">
            <div class="flex justify-between py-1">
                <span class="text-[var(--color-text-muted)] font-medium">Nomor Tagihan</span>
                <span class="font-mono font-bold text-[var(--color-text-main)]">{{ $invoice->invoice_number }}</span>
            </div>
            <div class="flex justify-between py-1">
                <span class="text-[var(--color-text-muted)] font-medium">Nama Pengiklan</span>
                <span class="font-bold text-[var(--color-text-main)]">{{ $invoice->advertiser_name }}</span>
            </div>
            <div class="flex justify-between py-1">
                <span class="text-[var(--color-text-muted)] font-medium">Penempatan Slot</span>
                <span class="font-semibold text-[var(--color-text-main)]">{{ $invoice->ad_slot }}</span>
            </div>
            @if($successPayment)
                <div class="flex justify-between py-1">
                    <span class="text-[var(--color-text-muted)] font-medium">Metode Pembayaran</span>
                    <span class="font-bold text-[var(--color-text-main)] uppercase">{{ $successPayment->payment_method ?? 'Payment Gateway' }}</span>
                </div>
            @endif
            <div class="flex justify-between py-3 border-t border-[var(--color-border)] items-baseline">
                <span class="text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest">Total Lunas</span>
                <span class="text-2xl font-editorial font-semibold text-[var(--color-brand)]">
                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        @if ($isPaid && $successPayment)
            <div class="space-y-3 pt-2">
                <a href="{{ route('receipt.download', $successPayment->id) }}"
                   class="w-full bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold py-3.5 rounded-xl shadow-sm transition flex items-center justify-center gap-2 text-sm active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Unduh Kuitansi Resmi (PDF)</span>
                </a>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('receipt.preview', $successPayment->id) }}" target="_blank"
                       class="text-center py-3 rounded-xl border border-[var(--color-border)] hover:border-[var(--color-border-hover)] hover:bg-[var(--color-bg)] text-[var(--color-text-main)] font-semibold text-xs transition">
                        Pratinjau Kuitansi
                    </a>
                    <a href="{{ route('landing') }}"
                       class="text-center py-3 rounded-xl bg-[var(--color-text-main)] hover:bg-black text-white font-semibold text-xs transition active:scale-95">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @else
            <div class="space-y-3 pt-2">
                <a href="{{ route('public.pay.show', $invoice->invoice_number) }}"
                   class="w-full bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold py-3.5 rounded-xl shadow-sm transition text-sm flex items-center justify-center gap-2 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    <span>Coba Bayar Lagi / Ganti Metode</span>
                </a>
                <a href="{{ route('landing') }}"
                   class="block text-center py-3 rounded-xl border border-[var(--color-border)] hover:bg-[var(--color-bg)] text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] font-semibold text-xs transition">
                    Kembali ke Beranda
                </a>
            </div>
        @endif

    </div>

    {{-- Assurance --}}
    <div class="mt-8 text-center text-xs text-[var(--color-text-muted)] space-y-1">
        <p>Kuitansi elektronik ini sah dan diakui sebagai bukti pembayaran resmi PT Lampung Post.</p>
        <p>Bila ada pertanyaan mengenai transaksi ini, hubungi
            <a href="mailto:keuangan@lampungpost.co.id" class="text-[var(--color-brand)] font-semibold hover:underline">keuangan@lampungpost.co.id</a>
        </p>
    </div>

</section>
@endsection