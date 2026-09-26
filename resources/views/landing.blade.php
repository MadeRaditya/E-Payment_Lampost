@extends('layouts.public')

@section('title', 'E-Payment Resmi PT Lampung Post — Pembayaran Digital Cepat & Aman')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28">
    <!-- Ambient Background Blobs -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full overflow-hidden pointer-events-none -z-10">
        <div class="absolute -top-32 right-10 w-96 h-96 bg-red-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-48 -left-20 w-80 h-80 bg-red-600/10 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Official Pill -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-red-50 border border-red-200/80 text-red-700 text-xs font-semibold shadow-xs">
                    <span class="flex h-2 w-2 rounded-full bg-red-600 animate-pulse"></span>
                    Portal Resmi E-Payment PT Lampung Post
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                    Pesan Iklan & Bayar Tagihan <br class="hidden sm:inline">
                    <span class="bg-gradient-to-r from-red-600 via-red-600 to-red-800 bg-clip-text text-transparent">
                        Lebih Cepat, Otomatis, & Sah.
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    Pesan slot iklan koran & media digital Lampung Post secara mandiri, atau selesaikan tagihan iklan Anda tanpa perlu kirim bukti transfer WhatsApp. Terverifikasi instan 24/7 dengan kuitansi PDF resmi.
                </p>

                <!-- Dual CTA Buttons -->
                <div class="pt-2 max-w-xl mx-auto lg:mx-0">
                    <!-- Primary CTAs -->
                    <div class="flex flex-col sm:flex-row gap-3 mb-4">
                        <a href="{{ route('booking.step1') }}" 
                           class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold px-6 py-3.5 rounded-2xl shadow-xl shadow-red-600/30 transition-all active:scale-95 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Pesan Iklan Baru</span>
                        </a>
                        <a href="#pricing" 
                           class="flex-1 inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-semibold px-6 py-3.5 rounded-2xl transition-all text-sm shadow-sm">
                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <span>Lihat Tarif Iklan</span>
                        </a>
                    </div>

                    <!-- Divider Label -->
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest text-center lg:text-left mb-2">
                        Sudah punya tagihan dari tim kami?
                    </p>

                    <!-- Quick Check Form Bar -->
                    <form action="{{ route('public.pay.check') }}" method="POST" 
                          class="p-2 sm:p-2.5 bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-200/80 flex flex-col sm:flex-row gap-2 transition hover:border-red-300">
                        @csrf
                        <div class="relative flex-1 flex items-center">
                            <span class="absolute left-4 text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </span>
                            <input type="text" name="invoice_number" required placeholder="Masukkan ID Tagihan (cth: INV-2026...)" 
                                   class="w-full pl-11 pr-4 py-3 text-sm bg-transparent outline-none font-mono text-slate-800 placeholder:font-sans placeholder:text-slate-400 uppercase tracking-wider">
                        </div>
                        <button type="submit" 
                                class="bg-slate-900 hover:bg-slate-800 active:scale-95 text-white font-semibold text-sm px-6 py-3.5 rounded-xl shadow-md transition-all flex items-center justify-center gap-2">
                            <span>Cek Tagihan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>
                    <p class="text-xs text-slate-500 mt-2.5 flex items-center justify-center lg:justify-start gap-1.5">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Cukup masukkan ID Tagihan — tanpa perlu mendaftar akun pengguna.</span>
                    </p>
                </div>

                <!-- Trust Metrics -->
                <div class="grid grid-cols-3 gap-4 pt-6 max-w-lg mx-auto lg:mx-0 border-t border-slate-200/80">
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ max($stats['advertisers'] ?? 1, 100) }}+</p>
                        <p class="text-xs text-slate-500 font-medium">Mitra & Pengiklan</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-red-600">&lt; 1 Menit</p>
                        <p class="text-xs text-slate-500 font-medium">Verifikasi Otomatis</p>
                    </div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-extrabold text-slate-900">100%</p>
                        <p class="text-xs text-slate-500 font-medium">Kuitansi PDF Sah</p>
                    </div>
                </div>
            </div>

            <!-- Right Hero Visual Card -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md">
                    <!-- Glassmorphism Card Simulation -->
                    <div class="bg-gradient-to-b from-slate-900 to-slate-950 p-6 sm:p-7 rounded-3xl shadow-2xl text-white border border-slate-800 relative z-10">
                        
                        <!-- Top status pill & logo -->
                        <div class="flex items-center justify-between pb-5 border-b border-slate-800">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-red-600 text-white font-bold flex items-center justify-center text-sm shadow-md">
                                    LP
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-white leading-none">LAMPUNG POST</p>
                                    <p class="text-[10px] text-slate-400">Digital Invoice Preview</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                Siap Dibayar
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="py-6 space-y-4">
                            <div>
                                <span class="text-[11px] font-medium text-slate-400 block uppercase tracking-wider">Nomor Tagihan</span>
                                <span class="text-lg font-bold font-mono text-slate-100 tracking-wide">INV-20260925-LP88</span>
                            </div>

                            <div class="bg-slate-800/60 rounded-2xl p-4 border border-slate-700/50 space-y-2.5">
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-400">Pengiklan:</span>
                                    <span class="font-semibold text-slate-200">PT Maju Jaya Bersama</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-400">Layanan:</span>
                                    <span class="font-semibold text-slate-200">Header Banner (970×250)</span>
                                </div>
                                <div class="flex justify-between text-xs">
                                    <span class="text-slate-400">Periode:</span>
                                    <span class="font-semibold text-slate-200">14 Hari Tayang</span>
                                </div>
                                <div class="pt-2 border-t border-slate-700/60 flex justify-between items-baseline">
                                    <span class="text-xs text-slate-300 font-semibold">Total Tagihan:</span>
                                    <span class="text-xl font-extrabold text-red-400">Rp 1.500.000</span>
                                </div>
                            </div>

                            <!-- Payment Channels Mini Grid -->
                            <div class="pt-1">
                                <p class="text-[11px] text-slate-400 mb-2 font-medium">Metode Pembayaran Tersedia:</p>
                                <div class="grid grid-cols-3 gap-2 text-center text-[10px] font-semibold">
                                    <div class="bg-slate-800/80 py-2 rounded-lg border border-slate-700 text-slate-300">QRIS Instan</div>
                                    <div class="bg-slate-800/80 py-2 rounded-lg border border-slate-700 text-slate-300">Virtual Account</div>
                                    <div class="bg-slate-800/80 py-2 rounded-lg border border-slate-700 text-slate-300">GoPay / Shopee</div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer CTA -->
                        <div class="pt-2 space-y-2">
                            <a href="{{ route('booking.step1') }}" 
                               class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center gap-2 text-sm shadow-lg shadow-red-600/30 transition active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                <span>Pesan Slot Iklan</span>
                            </a>
                            <a href="{{ route('public.pay.form') }}" 
                               class="w-full bg-slate-800/60 hover:bg-slate-800 text-slate-200 font-semibold py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 text-xs border border-slate-700 transition">
                                <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                <span>Bayar Tagihan yang Sudah Ada</span>
                            </a>
                        </div>
                    </div>

                    <!-- Ambient Floating Badge -->
                    <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl p-4 shadow-xl border border-slate-100 flex items-center gap-3 z-20 hidden sm:flex">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">Verifikasi Otomatis</p>
                            <p class="text-[11px] text-slate-500">Kuitansi PDF langsung terbit</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4 Key Value Pillars -->
<section class="py-16 bg-white border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h2 class="text-xs font-bold uppercase tracking-widest text-red-600 mb-2">Keunggulan Sistem</h2>
            <p class="text-3xl font-extrabold text-slate-900">Mengapa Menggunakan E-Payment Lampung Post?</p>
            <p class="text-slate-600 text-sm mt-3">Meninggalkan transfer manual konvensional demi efisiensi, akurasi, dan transparansi transaksi Anda.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Feature 1 -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/70 hover:border-red-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">
                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Verifikasi Instan</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Pembayaran diproses dan divalidasi langsung dalam hitungan detik melalui sistem webhook Payment Gateway resmi.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/70 hover:border-red-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">
                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Banyak Pilihan Bayar</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Dukungan pembayaran lengkap: QRIS semua aplikasi, Virtual Account (BCA, Mandiri, BNI, BRI), hingga e-Wallet.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/70 hover:border-red-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">
                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Kuitansi PDF Sah</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Kuitansi elektronik berformat PDF diterbitkan otomatis dengan nomor registrasi unik dan dapat diverifikasi online.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/70 hover:border-red-300 hover:shadow-lg hover:-translate-y-1 transition-all duration-200 group">
                <div class="w-12 h-12 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-base font-bold text-slate-900 mb-2">Tanpa Perlu Login</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Pesan iklan atau bayar tagihan tanpa perlu mendaftar akun. Cukup akses langsung dari browser Anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing / Slot Iklan Section -->
<section id="pricing" class="py-20 lg:py-28 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-red-600">Tarif Resmi Slot Iklan</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2">Pilihan Posisi Promosi Lampung Post</h2>
            <p class="text-slate-600 text-sm mt-3">Tingkatkan visibilitas brand Anda di portal media berita terpercaya dengan jangkauan ratusan ribu pembaca setiap hari.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 items-stretch">
            
            <!-- Tier 1: Sidebar -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 hover:border-slate-300 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Slot Standar</span>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">Sidebar Banner</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700">300×250 px</span>
                    </div>
                    <p class="text-xs text-slate-500 mb-6">Tampil strategis di kolom kanan seluruh artikel dan rubrik berita.</p>
                    
                    <div class="mb-6 pb-6 border-b border-slate-100">
                        <span class="text-3xl font-black text-slate-900">Rp 500.000</span>
                        <span class="text-xs text-slate-500 font-medium"> / 7 hari tayang</span>
                    </div>

                    <ul class="space-y-3 text-xs text-slate-600 mb-8">
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Dimensi standar 300 × 250 pixel</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Tayang di semua halaman artikel</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Termasuk tautan langsung ke website/WA</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'kolom']) }}" 
                   class="w-full text-center py-3 px-4 rounded-xl border border-slate-200 hover:border-red-600 hover:text-red-600 hover:bg-red-50/40 font-semibold text-sm transition inline-flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Pesan Slot Ini
                </a>
            </div>

            <!-- Tier 2: Header Banner (POPULAR) -->
            <div class="bg-gradient-to-b from-slate-900 to-slate-950 text-white rounded-3xl p-8 border-2 border-red-500 shadow-2xl relative flex flex-col justify-between transform md:-translate-y-2">
                <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-red-600 to-red-700 text-white text-[11px] font-extrabold px-4 py-1 rounded-full uppercase tracking-wider shadow-md shadow-red-600/30">
                    Paling Diminati
                </div>

                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-red-400 uppercase tracking-wider">Slot Premium</span>
                            <h3 class="text-2xl font-bold text-white mt-1">Header Banner</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-red-600/30 text-red-300 border border-red-500/30">970×250 px</span>
                    </div>
                    <p class="text-xs text-slate-300 mb-6">Posisi paling prestisius di bagian atas portal berita dengan eksposur maksimal.</p>
                    
                    <div class="mb-6 pb-6 border-b border-slate-800">
                        <span class="text-3xl font-black text-white">Rp 1.500.000</span>
                        <span class="text-xs text-slate-400 font-medium"> / 14 hari tayang</span>
                    </div>

                    <ul class="space-y-3 text-xs text-slate-300 mb-8">
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Dimensi besar 970 × 250 pixel</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Tayang di Homepage & Seluruh Artikel</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Prioritas tampilan pertama saat website dibuka</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Laporan performa klik & impressions</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'display_banner']) }}" 
                   class="w-full text-center py-3.5 px-4 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-sm shadow-lg shadow-red-600/30 transition inline-flex items-center justify-center gap-2 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Pesan Slot Premium
                </a>
            </div>

            <!-- Tier 3: In-Article -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 hover:border-slate-300 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Slot Engagement</span>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">In-Article Banner</h3>
                        </div>
                        <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700">728×90 px</span>
                    </div>
                    <p class="text-xs text-slate-500 mb-6">Disisipkan tepat di tengah isi berita saat pembaca fokus membaca konten.</p>
                    
                    <div class="mb-6 pb-6 border-b border-slate-100">
                        <span class="text-3xl font-black text-slate-900">Rp 800.000</span>
                        <span class="text-xs text-slate-500 font-medium"> / 10 hari tayang</span>
                    </div>

                    <ul class="space-y-3 text-xs text-slate-600 mb-8">
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Dimensi horizontal 728 × 90 pixel</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Disisipkan antara paragraf 3 dan 4</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Tingkat Click-Through Rate (CTR) tinggi</span>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'advertorial']) }}" 
                   class="w-full text-center py-3 px-4 rounded-xl border border-slate-200 hover:border-red-600 hover:text-red-600 hover:bg-red-50/40 font-semibold text-sm transition inline-flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Pesan Slot Ini
                </a>
            </div>

        </div>

        <!-- Additional CTA Below Pricing -->
        <div class="mt-12 text-center">
            <p class="text-sm text-slate-500 mb-4">Tidak menemukan slot yang sesuai kebutuhan Anda?</p>
            <a href="{{ route('booking.step1') }}" 
               class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg transition-all active:scale-95 text-sm">
                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Konsultasi & Pesan Custom Slot</span>
            </a>
        </div>
    </div>
</section>

<!-- Cara Pembayaran (How it Works) -->
<section id="how-it-works" class="py-20 bg-white border-t border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold uppercase tracking-widest text-red-600">Alur Mudah</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-2">2 Cara Menggunakan Portal Ini</h2>
            <p class="text-slate-600 text-sm mt-3">Pilih alur sesuai kebutuhan Anda: pesan iklan baru, atau bayar tagihan yang sudah diterbitkan.</p>
        </div>

        <!-- Two Track Layout -->
        <div class="grid lg:grid-cols-2 gap-10">
            <!-- Track A: Pesan Iklan Baru -->
            <div class="bg-gradient-to-br from-red-50 to-slate-50 rounded-3xl p-8 border border-red-100">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-red-600 text-white text-xs font-bold uppercase tracking-wider mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Alur A — Pesan Iklan Baru
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Belum Punya ID Tagihan?</h3>
                <p class="text-sm text-slate-600 mb-8 leading-relaxed">
                    Isi form pemesanan 4 langkah, unggah materi iklan, dan bayar langsung via QRIS / Virtual Account. Tagihan otomatis terbit.
                </p>

                <ol class="space-y-4">
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">1</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Pilih Kategori & Format Iklan</p>
                            <p class="text-xs text-slate-500 mt-0.5">Properti, Otomotif, Karir, atau lainnya.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">2</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Isi Teks & Jadwal Tayang</p>
                            <p class="text-xs text-slate-500 mt-0.5">Harga otomatis terhitung real-time.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">3</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Unggah Media (Opsional)</p>
                            <p class="text-xs text-slate-500 mt-0.5">Foto atau PDF pendukung iklan Anda.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">4</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Isi Data & Bayar</p>
                            <p class="text-xs text-slate-500 mt-0.5">Langsung ke Payment Gateway, kuitansi otomatis terbit.</p>
                        </div>
                    </li>
                </ol>

                <a href="{{ route('booking.step1') }}" 
                   class="mt-8 w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold px-6 py-3.5 rounded-2xl shadow-lg shadow-red-600/30 transition-all active:scale-95 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Mulai Pesan Iklan
                </a>
            </div>

            <!-- Track B: Bayar Tagihan -->
            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-4">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Alur B — Bayar Tagihan
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Sudah Punya ID Tagihan?</h3>
                <p class="text-sm text-slate-600 mb-8 leading-relaxed">
                    Cukup masukkan ID tagihan yang dikirim oleh tim keuangan Lampung Post. Tidak perlu login atau daftar akun.
                </p>

                <ol class="space-y-4">
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-slate-900 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">1</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Terima ID Tagihan dari Tim Kami</p>
                            <p class="text-xs text-slate-500 mt-0.5">Format: <code class="font-mono bg-slate-200 px-1 py-0.5 rounded text-red-700 font-semibold">INV-2026...</code></p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-slate-900 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">2</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Periksa Detail Tagihan</p>
                            <p class="text-xs text-slate-500 mt-0.5">Pastikan nama, nominal, dan jatuh tempo benar.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-slate-900 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">3</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Pilih Kanal Pembayaran</p>
                            <p class="text-xs text-slate-500 mt-0.5">QRIS, Virtual Account, atau e-Wallet via Midtrans.</p>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <span class="w-8 h-8 rounded-xl bg-slate-900 text-white font-extrabold flex items-center justify-center text-xs flex-shrink-0">4</span>
                        <div>
                            <p class="font-bold text-sm text-slate-900">Kuitansi PDF Otomatis Terbit</p>
                            <p class="text-xs text-slate-500 mt-0.5">Setelah pembayaran diverifikasi real-time.</p>
                        </div>
                    </li>
                </ol>

                <a href="{{ route('public.pay.form') }}" 
                   class="mt-8 w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold px-6 py-3.5 rounded-2xl shadow-lg transition-all active:scale-95 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Masukkan ID Tagihan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Direct Action Call to Action Banner -->
<section class="py-16 bg-gradient-to-br from-red-600 via-red-700 to-red-900 text-white relative overflow-hidden">
    <div class="absolute -right-20 -bottom-20 w-96 h-96 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-3xl sm:text-4xl font-extrabold mb-4 tracking-tight">
            Siap Memulai? Pilih Alur Anda.
        </h2>
        <p class="text-red-100 text-base max-w-2xl mx-auto mb-8 leading-relaxed">
            Pesan slot iklan baru secara mandiri, atau selesaikan kewajiban pembayaran iklan Anda untuk memastikan slot tayang tepat waktu.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('booking.step1') }}" 
               class="bg-white hover:bg-slate-100 text-red-700 font-bold px-8 py-3.5 rounded-xl shadow-xl transition-all active:scale-95 text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Pesan Iklan Baru</span>
            </a>
            <a href="{{ route('public.pay.form') }}" 
               class="bg-red-800/60 hover:bg-red-800 text-white font-semibold px-6 py-3.5 rounded-xl border border-red-400/40 transition text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span>Bayar Tagihan</span>
            </a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section id="faq" class="py-20 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-red-600">Bantuan</span>
            <h2 class="text-3xl font-extrabold text-slate-900 mt-2">Pertanyaan yang Sering Diajukan</h2>
        </div>

        <div class="space-y-4">
            <!-- Question 1 -->
            <details class="group bg-white rounded-2xl border border-slate-200/80 p-5 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-xs transition hover:border-slate-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 text-sm">
                    <span>Apakah saya harus mendaftar akun terlebih dahulu untuk memesan iklan atau membayar tagihan?</span>
                    <span class="transition group-open:rotate-180 text-slate-400 group-hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Tidak perlu. Anda bisa langsung memesan iklan melalui menu "Pesan Iklan Baru" atau membayar tagihan dengan memasukkan ID Tagihan yang telah diberikan oleh staf Lampung Post — semua tanpa akun.
                </p>
            </details>

            <!-- Question 2 -->
            <details class="group bg-white rounded-2xl border border-slate-200/80 p-5 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-xs transition hover:border-slate-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 text-sm">
                    <span>Bagaimana cara memesan slot iklan baru?</span>
                    <span class="transition group-open:rotate-180 text-slate-400 group-hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Klik tombol "Pesan Iklan Baru" dari halaman mana pun. Anda akan dibimbing melalui 4 langkah: pilih kategori & format, isi teks & jadwal, unggah media (opsional), lalu isi data pembayaran. Total harga terhitung otomatis.
                </p>
            </details>

            <!-- Question 3 -->
            <details class="group bg-white rounded-2xl border border-slate-200/80 p-5 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-xs transition hover:border-slate-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 text-sm">
                    <span>Metode pembayaran apa saja yang didukung?</span>
                    <span class="transition group-open:rotate-180 text-slate-400 group-hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Melalui integrasi Midtrans, kami menerima pembayaran via QRIS (BCA, GoPay, OVO, ShopeePay, Dana, LinkAja, seluruh mobile banking), Virtual Account Bank (BCA, Mandiri, BNI, BRI, Permata), dan e-Wallet.
                </p>
            </details>

            <!-- Question 4 -->
            <details class="group bg-white rounded-2xl border border-slate-200/80 p-5 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-xs transition hover:border-slate-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 text-sm">
                    <span>Apakah kuitansi digital PDF yang diterbitkan sah untuk keperluan perpajakan/pembukuan?</span>
                    <span class="transition group-open:rotate-180 text-slate-400 group-hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Ya, kuitansi elektronik resmi diterbitkan langsung oleh PT Lampung Post dengan nomor seri kuitansi terdaftar, tanggal pembayaran tervalidasi, serta tautan verifikasi online untuk memastikan keabsahan dokumen.
                </p>
            </details>

            <!-- Question 5 -->
            <details class="group bg-white rounded-2xl border border-slate-200/80 p-5 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-xs transition hover:border-slate-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 text-sm">
                    <span>Bagaimana jika saya kehilangan nomor ID Tagihan?</span>
                    <span class="transition group-open:rotate-180 text-slate-400 group-hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-3 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                    Silakan hubungi marketing representatif Anda di Lampung Post atau hubungi Divisi Keuangan melalui email <a href="mailto:keuangan@lampungpost.co.id" class="text-red-600 font-semibold underline">keuangan@lampungpost.co.id</a> dengan menyertakan nama pengiklan dan tanggal pesanan iklan Anda.
                </p>
            </details>
        </div>
    </div>
</section>
@endsection