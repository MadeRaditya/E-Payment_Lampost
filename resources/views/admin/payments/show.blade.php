@extends('layouts.admin')

@section('title', 'Detail Pembayaran ' . ($payment->reference_id ?? $payment->id))
@section('page-title', 'Inspeksi Transaksi Pembayaran')

@section('content')
<div class="space-y-6">

    <!-- Back Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('payments.index') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Riwayat Pembayaran</span>
        </a>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
            {{ $payment->status === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
               ($payment->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $payment->status === 'success' ? 'bg-emerald-500' : ($payment->status === 'pending' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
            {{ $payment->status === 'success' ? 'Berhasil (Success)' : ucfirst($payment->status) }}
        </span>
    </div>

    <!-- Main Grid -->
    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Payment Details & Gateway Payload -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Summary Banner -->
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 rounded-3xl p-7 text-white shadow-xl border border-slate-800">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-xs uppercase tracking-wider text-red-300 font-semibold">Payment Gateway Reference</span>
                        <h2 class="text-xl sm:text-2xl font-mono font-bold text-white mt-1 break-all">
                            {{ $payment->reference_id ?? 'Token Belum Terbit' }}
                        </h2>
                        <p class="text-xs text-slate-400 mt-2">
                            Gateway: <strong class="text-slate-200">{{ $payment->payment_gateway ?? 'Midtrans' }}</strong> • 
                            Waktu: {{ $payment->created_at->translatedFormat('d F Y, H:i:s') }} WIB
                        </p>
                    </div>
                    <div class="bg-slate-800/80 p-4 rounded-2xl border border-slate-700 text-left sm:text-right">
                        <span class="text-xs text-slate-400 uppercase tracking-wider block">Nominal Terbayar</span>
                        <p class="text-2xl sm:text-3xl font-black text-red-400 mt-0.5">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Transaction Audit Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                    Parameter Transaksi Digital
                </h3>

                <div class="grid sm:grid-cols-2 gap-4 text-xs">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-slate-400 font-semibold block mb-1">Metode Pembayaran</span>
                        <span class="font-bold text-sm text-slate-900">{{ strtoupper($payment->payment_method ?? 'Belum Dipilih') }}</span>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-slate-400 font-semibold block mb-1">Waktu Penyelesaian (Paid At)</span>
                        <span class="font-bold text-sm text-slate-900">
                            {{ $payment->paid_at ? $payment->paid_at->translatedFormat('d F Y, H:i:s') . ' WIB' : 'Belum Selesai' }}
                        </span>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-slate-400 font-semibold block mb-1">ID Transaksi Internal</span>
                        <span class="font-mono font-bold text-sm text-slate-900">#{{ $payment->id }}</span>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-slate-400 font-semibold block mb-1">Status Webhook</span>
                        <span class="font-bold text-sm text-slate-900">
                            {{ $payment->gateway_response ? 'Webhook Payload Tersimpan' : 'Menunggu Callback' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Technical Gateway Payload Inspector -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-900">Payload Webhook Gateway</h3>
                        <p class="text-xs text-slate-400">Respons mentah JSON dari Midtrans callback untuk keperluan audit</p>
                    </div>
                </div>

                @if($payment->gateway_response)
                    <div class="bg-slate-950 rounded-2xl p-4 overflow-x-auto border border-slate-800">
                        <pre class="text-xs font-mono text-emerald-400 leading-relaxed">{{ json_encode($payment->gateway_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                    </div>
                @else
                    <div class="p-6 bg-slate-50 rounded-2xl text-center text-slate-400 text-xs border border-slate-100">
                        Belum ada payload respons tersimpan untuk transaksi ini.
                    </div>
                @endif
            </div>

        </div>

        <!-- Right 1 Col: Related Invoice & Receipt -->
        <div class="space-y-6">
            
            <!-- Linked Invoice Card -->
            @if($payment->invoice)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                        <h4 class="font-bold text-sm text-slate-900">Tagihan Terkait</h4>
                        <span class="text-xs font-mono font-bold text-red-600">{{ $payment->invoice->invoice_number }}</span>
                    </div>

                    <div class="space-y-2 text-xs text-slate-600">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Pengiklan:</span>
                            <span class="font-semibold text-slate-800">{{ $payment->invoice->advertiser_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Slot Iklan:</span>
                            <span class="font-semibold text-slate-800">{{ $payment->invoice->ad_slot }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Total Tagihan:</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($payment->invoice->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Status Tagihan:</span>
                            <span class="font-bold uppercase {{ $payment->invoice->status === 'paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                {{ $payment->invoice->status }}
                            </span>
                        </div>
                    </div>

                    <a href="{{ route('invoices.show', $payment->invoice->id) }}" 
                       class="w-full mt-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 px-4 rounded-xl text-xs transition text-center block">
                        Buka Detail Tagihan
                    </a>
                </div>
            @endif

            <!-- Receipt Actions if Paid -->
            @if($payment->status === 'success')
                <div class="bg-emerald-50 rounded-3xl border border-emerald-200 p-6 shadow-xs space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-emerald-950">Kuitansi Resmi Tersedia</h4>
                            <p class="text-xs text-emerald-700">Nomor: {{ $payment->receipt->receipt_number ?? 'Diterbitkan saat unduh' }}</p>
                        </div>
                    </div>

                    <div class="pt-2 space-y-2">
                        <a href="{{ route('receipt.download', $payment->id) }}" 
                           class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2 shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>Unduh Kuitansi PDF</span>
                        </a>
                        <a href="{{ route('receipt.preview', $payment->id) }}" target="_blank"
                           class="w-full bg-white hover:bg-emerald-100/60 text-emerald-800 border border-emerald-300 font-semibold py-2 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                            <span>Pratinjau Kuitansi</span>
                        </a>
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
