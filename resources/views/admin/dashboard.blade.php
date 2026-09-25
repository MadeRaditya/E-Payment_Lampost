@extends('layouts.admin')

@section('title', 'Dashboard Keuangan')
@section('page-title', 'Ringkasan Eksekutif')

@section('content')
<div class="space-y-8">
    
    <!-- Welcome Banner with Quick Actions -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-red-950 rounded-3xl p-6 sm:p-8 text-white shadow-xl border border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-600/30 text-red-300 border border-red-500/30 text-xs font-semibold">
                <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                Sistem E-Payment Lampung Post
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                Selamat Datang, {{ Auth::user()->name }}
            </h2>
            <p class="text-xs sm:text-sm text-slate-300 max-w-xl leading-relaxed">
                Pantau seluruh arus pembayaran digital iklan secara real-time, buat tagihan baru, dan kelola kuitansi resmi dalam satu portal terpadu.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('invoices.create') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-xs sm:text-sm px-5 py-3 rounded-xl shadow-lg shadow-red-600/30 active:scale-95 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Buat Tagihan Baru</span>
            </a>
            <a href="{{ route('payments.index') }}" 
               class="inline-flex items-center gap-2 bg-slate-800/80 hover:bg-slate-800 text-slate-200 font-semibold text-xs sm:text-sm px-5 py-3 rounded-xl border border-slate-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span>Riwayat Transaksi</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Pendapatan -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pendapatan</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </p>
            <div class="mt-3 flex items-center gap-1.5 text-xs text-emerald-600 font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Pembayaran Berhasil</span>
            </div>
        </div>

        <!-- Tagihan Lunas -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tagihan Lunas</span>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {{ $paidCount }}
            </p>
            <div class="mt-3 flex items-center gap-1.5 text-xs text-blue-600 font-semibold">
                <span>Kuitansi Resmi Terbit</span>
            </div>
        </div>

        <!-- Menunggu Pembayaran -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menunggu Bayar</span>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {{ $unpaidCount }}
            </p>
            <div class="mt-3 flex items-center gap-1.5 text-xs text-amber-600 font-semibold">
                <span>Belum Dilunasi Pengiklan</span>
            </div>
        </div>

        <!-- Kedaluwarsa / Expired -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kedaluwarsa</span>
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
            </div>
            <p class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                {{ $expiredCount }}
            </p>
            <div class="mt-3 flex items-center gap-1.5 text-xs text-slate-500 font-semibold">
                <span>Melewati Jatuh Tempo</span>
            </div>
        </div>

    </div>

    <!-- 7-Day Revenue Trend Chart Section -->
    <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-slate-900">Tren Pendapatan 7 Hari Terakhir</h3>
                <p class="text-xs text-slate-500 mt-0.5">Grafik akumulasi transaksi pembayaran yang berhasil diverifikasi</p>
            </div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-red-50 text-red-700 text-xs font-semibold">
                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                <span>Data Real-time</span>
            </div>
        </div>

        @php
            $maxTotal = $chartData->max('total') ?: 1;
        @endphp

        @if($chartData->isNotEmpty())
            <div class="space-y-4">
                <!-- Bar Chart Representation -->
                <div class="grid grid-cols-7 gap-2 sm:gap-4 items-end h-48 pt-6">
                    @foreach($chartData as $item)
                        @php
                            $heightPct = min(100, max(12, ($item->total / $maxTotal) * 100));
                        @endphp
                        <div class="flex flex-col items-center h-full justify-end group">
                            <!-- Tooltip on hover -->
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity bg-slate-900 text-white text-[10px] py-1 px-2 rounded-md mb-2 pointer-events-none whitespace-nowrap shadow-md">
                                Rp {{ number_format($item->total, 0, ',', '.') }}
                            </div>
                            <div class="w-full max-w-[48px] bg-slate-100 rounded-t-xl overflow-hidden flex items-end">
                                <div class="w-full bg-gradient-to-t from-red-600 to-red-500 rounded-t-xl transition-all duration-300 group-hover:from-red-700 group-hover:to-red-600"
                                     style="height: {{ $heightPct }}%;"></div>
                            </div>
                            <span class="text-[11px] font-semibold text-slate-500 mt-2 truncate w-full text-center">
                                {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d M') }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Placeholder Empty Chart State -->
            <div class="py-12 text-center">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <p class="text-sm font-bold text-slate-700">Belum Ada Transaksi Dalam 7 Hari Terakhir</p>
                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Data grafik akan otomatis terisi saat pengiklan melakukan pelunasan tagihan melalui payment gateway.</p>
            </div>
        @endif
    </div>

    <!-- Main Content Split: Recent Invoices & Quick Operations -->
    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Left: Recent Invoices Table (2 cols) -->
        <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-base text-slate-900">Tagihan Terbaru</h3>
                    <p class="text-xs text-slate-500">5 transaksi pembuatan tagihan terakhir</p>
                </div>
                <a href="{{ route('invoices.index') }}" 
                   class="text-xs font-bold text-red-600 hover:text-red-700 hover:underline flex items-center gap-1 transition">
                    <span>Lihat Semua</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($recentInvoices as $invoice)
                    <div class="p-5 hover:bg-slate-50/80 transition flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5 min-w-0">
                            <!-- Initials Avatar -->
                            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-sm flex-shrink-0">
                                {{ strtoupper(substr($invoice->advertiser_name ?? 'A', 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-sm text-slate-900 truncate">{{ $invoice->advertiser_name ?? 'Tanpa Nama' }}</p>
                                    <span class="text-xs font-mono font-medium text-slate-400">#{{ $invoice->invoice_number }}</span>
                                </div>
                                <p class="text-xs text-slate-500 truncate mt-0.5">
                                    {{ $invoice->ad_slot ?? 'Slot Iklan' }} • {{ $invoice->description }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right flex-shrink-0 flex items-center gap-4">
                            <div>
                                <p class="font-extrabold text-sm text-slate-900">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</p>
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider mt-1
                                    {{ $invoice->status === 'paid' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                                       ($invoice->status === 'unpaid' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                    <span class="w-1 h-1 rounded-full {{ $invoice->status === 'paid' ? 'bg-emerald-500' : ($invoice->status === 'unpaid' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                    {{ $invoice->status === 'paid' ? 'Lunas' : ($invoice->status === 'unpaid' ? 'Menunggu' : ucfirst($invoice->status)) }}
                                </span>
                            </div>

                            <a href="{{ route('invoices.show', $invoice->id) }}" 
                               class="p-2 rounded-xl text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition" title="Lihat Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <p class="text-sm font-semibold text-slate-500">Belum ada tagihan dibuat</p>
                        <p class="text-xs text-slate-400 mt-1">Gunakan tombol Buat Tagihan untuk membuat transaksi baru.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right: Quick Panel & Health (1 col) -->
        <div class="space-y-6">
            
            <!-- Quick Actions Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                <h3 class="font-bold text-sm text-slate-900 uppercase tracking-wider mb-2">Aksi Cepat</h3>
                
                <a href="{{ route('invoices.create') }}" 
                   class="flex items-center gap-3 p-3.5 rounded-2xl bg-red-50 text-red-700 hover:bg-red-100/80 font-semibold text-xs sm:text-sm transition group">
                    <div class="w-8 h-8 rounded-xl bg-red-600 text-white flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span>Buat Tagihan Iklan Baru</span>
                </a>

                <a href="{{ route('payments.index') }}" 
                   class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 text-slate-700 hover:bg-slate-100 font-semibold text-xs sm:text-sm transition">
                    <div class="w-8 h-8 rounded-xl bg-slate-800 text-white flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <span>Periksa Riwayat Pembayaran</span>
                </a>

                <a href="{{ route('landing') }}" target="_blank"
                   class="flex items-center gap-3 p-3.5 rounded-2xl bg-slate-50 text-slate-700 hover:bg-slate-100 font-semibold text-xs sm:text-sm transition">
                    <div class="w-8 h-8 rounded-xl bg-slate-800 text-white flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </div>
                    <span>Buka Portal Publik Pelanggan</span>
                </a>
            </div>

            <!-- Operational Notice Card -->
            <div class="bg-gradient-to-br from-slate-900 to-slate-950 rounded-3xl p-6 text-white border border-slate-800 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-red-400">Panduan Finance</span>
                    <span class="text-xs bg-slate-800 px-2 py-0.5 rounded text-slate-300">Tips</span>
                </div>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Setiap tagihan yang Anda buat memiliki nomor unik. Berikan tautan tagihan atau nomor tagihan tersebut kepada klien. Status pembayaran akan terupdate otomatis saat klien menyelesaikan transaksi.
                </p>
                <div class="pt-2 border-t border-slate-800 flex items-center justify-between text-[11px] text-slate-400">
                    <span>Status Gateway:</span>
                    <span class="text-emerald-400 font-semibold flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Aktif & Siap Pakai
                    </span>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection