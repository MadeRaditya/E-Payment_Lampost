@extends('layouts.public')

@section('title', 'Bayar Tagihan Iklan — E-Payment PT Lampung Post')

@section('content')
<section class="max-w-2xl mx-auto px-4 sm:px-6 py-16 lg:py-24">

    {{-- Title & Trust Banner --}}
    <div class="text-center mb-10 space-y-3">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[var(--color-brand-light)] border border-[var(--color-brand-muted)] text-[var(--color-brand)] text-[10px] font-bold uppercase tracking-widest">
            <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand)] animate-pulse"></span>
            Portal Mandiri Pelanggan
        </div>
        <h1 class="text-3xl sm:text-4xl font-editorial font-semibold text-[var(--color-text-main)] tracking-tight">
            Bayar Tagihan Iklan Anda
        </h1>
        <p class="text-[var(--color-text-muted)] text-sm max-w-md mx-auto leading-relaxed">
            Masukkan ID Tagihan resmi yang Anda terima dari staf PT Lampung Post untuk melihat rincian dan melakukan pembayaran.
        </p>
    </div>

    {{-- Main Card --}}
    <div class="hairline-card p-7 sm:p-10 relative overflow-hidden">

        {{-- Error Alert --}}
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 p-4 rounded-xl mb-6 text-xs flex items-start gap-3">
                <svg class="w-5 h-5 flex-shrink-0 text-[var(--color-brand)] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <p class="font-bold text-red-900">Pemberitahuan</p>
                    <p class="mt-0.5 leading-relaxed">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('public.pay.check') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2 text-center">
                    Nomor / ID Tagihan Resmi
                </label>
                <input type="text" name="invoice_number" value="{{ old('invoice_number') }}" required autofocus
                    placeholder="INV-YYYYMMDD-XXXX"
                    class="form-input py-4 text-center font-mono text-lg font-bold tracking-widest uppercase">
                <p class="text-xs text-[var(--color-text-muted)] text-center mt-2 font-mono">
                    Contoh: INV-20260925-AB12
                </p>
                @error('invoice_number')
                    <p class="text-red-500 text-xs mt-1.5 text-center font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold py-4 rounded-xl transition shadow-sm active:scale-95 text-base flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Periksa & Bayar Tagihan</span>
            </button>
        </form>

        {{-- Help / Tips --}}
        <div class="mt-8 pt-6 border-t border-[var(--color-border)] space-y-4">
            <div class="bg-[var(--color-bg)] rounded-xl p-4 border border-[var(--color-border)] text-xs text-[var(--color-text-muted)] space-y-2">
                <p class="font-bold text-[var(--color-text-main)] flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Di mana menemukan ID Tagihan?
                </p>
                <p class="leading-relaxed">
                    ID Tagihan dikirimkan oleh Bagian Keuangan atau Marketing Lampung Post melalui email atau pesan WhatsApp konfirmasi pemesanan iklan.
                </p>
            </div>

            <p class="text-center text-xs text-[var(--color-text-muted)]">
                Belum menerima atau kehilangan nomor tagihan?<br>
                Hubungi tim keuangan kami di
                <a href="mailto:keuangan@lampungpost.co.id" class="text-[var(--color-brand)] font-semibold hover:underline">keuangan@lampungpost.co.id</a>
            </p>
        </div>

    </div>

    {{-- Security Badges --}}
    <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-xs text-[var(--color-text-muted)]">
        <span class="inline-flex items-center gap-1.5">
            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            Enkripsi 256-Bit SSL
        </span>
        <span class="inline-flex items-center gap-1.5">
            <svg class="w-4 h-4 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Midtrans Snap Gateway
        </span>
        <span class="inline-flex items-center gap-1.5">
            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Kuitansi PDF Sah Otomatis
        </span>
    </div>

</section>
@endsection