@extends('layouts.public')

@section('title', 'Detail Tagihan ' . $invoice->invoice_number . ' — E-Payment Lampung Post')

@section('content')
<section class="max-w-3xl mx-auto px-4 py-12 lg:py-20">
    
    <!-- Breadcrumb / Back Navigation -->
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('public.pay.form') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Cari Tagihan Lain</span>
        </a>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Menunggu Pembayaran
        </span>
    </div>

    <!-- Main Invoice Confirmation Dossier -->
    <div class="bg-white border border-slate-200/80 shadow-2xl shadow-slate-200/60 rounded-3xl overflow-hidden">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-red-950 p-6 sm:p-8 text-white relative">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-[11px] font-bold text-red-300 uppercase tracking-widest block mb-1">
                        Konfirmasi Pembayaran Tagihan
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold font-mono tracking-tight text-white">
                        {{ $invoice->invoice_number }}
                    </h1>
                    <p class="text-xs text-slate-400 mt-1">
                        Diterbitkan oleh PT Lampung Post pada {{ $invoice->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div class="bg-slate-800/80 p-4 rounded-2xl border border-slate-700 text-left sm:text-right">
                    <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider block">Total yang Harus Dibayar</span>
                    <p class="text-2xl sm:text-3xl font-black text-red-400 mt-0.5">
                        Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Body Details -->
        <div class="p-6 sm:p-8 space-y-6">
            
            <div class="grid sm:grid-cols-2 gap-4">
                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama Pengiklan / Mitra</span>
                    <p class="font-extrabold text-slate-900 text-sm">{{ $invoice->advertiser_name ?? '-' }}</p>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">{{ $invoice->advertiser_contact ?? '-' }}</p>
                </div>

                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Slot & Penempatan Iklan</span>
                    <p class="font-extrabold text-slate-900 text-sm">{{ $invoice->ad_slot ?? '-' }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $invoice->ad_duration_days ? $invoice->ad_duration_days . ' Hari Tayang' : '-' }}</p>
                </div>

                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Mulai Tayang</span>
                    <p class="font-bold text-slate-900 text-sm">
                        {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d F Y') : '-' }}
                    </p>
                </div>

                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Batas Pembayaran (Jatuh Tempo)</span>
                    <p class="font-bold text-slate-900 text-sm">
                        {{ $invoice->due_date->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div class="sm:col-span-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Keterangan Layanan</span>
                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">{{ $invoice->description }}</p>
                </div>
            </div>

            <!-- Supported Channels Pill Bar -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <span class="font-bold text-slate-700">Metode Bayar Didukung:</span>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="bg-white px-2.5 py-1 rounded-md text-[11px] font-bold text-slate-700 border border-slate-200 shadow-2xs">QRIS Semua Bank</span>
                    <span class="bg-white px-2.5 py-1 rounded-md text-[11px] font-bold text-slate-700 border border-slate-200 shadow-2xs">BCA VA</span>
                    <span class="bg-white px-2.5 py-1 rounded-md text-[11px] font-bold text-slate-700 border border-slate-200 shadow-2xs">Mandiri</span>
                    <span class="bg-white px-2.5 py-1 rounded-md text-[11px] font-bold text-slate-700 border border-slate-200 shadow-2xs">BNI / BRI</span>
                    <span class="bg-white px-2.5 py-1 rounded-md text-[11px] font-bold text-slate-700 border border-slate-200 shadow-2xs">GoPay / ShopeePay</span>
                </div>
            </div>

            <!-- Payment Trigger Form -->
            <form action="{{ route('public.pay.process', $invoice->invoice_number) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-extrabold py-4 px-6 rounded-2xl shadow-xl shadow-red-600/30 hover:shadow-red-600/50 active:scale-95 transition-all text-base flex items-center justify-center gap-2.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>Lanjut ke Pembayaran Aman (Midtrans)</span>
                </button>
            </form>

            <p class="text-center text-xs text-slate-400">
                Setelah mengklik tombol di atas, jendela pembayaran Midtrans akan terbuka secara otomatis. Sistem terenkripsi penuh dan verifikasi berjalan otomatis.
            </p>

        </div>

    </div>

</section>
@endsection