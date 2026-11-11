@extends('layouts.public')

@section('title', 'E-Payment Resmi PT Lampung Post — Pesan Iklan & Pembayaran Digital')

@section('content')
<!-- 
  HERO SECTION
  Konsep: Menggabungkan daya tarik marketing (Benefit/Jangkauan Audiens) dengan utilitas (Form Cek Tagihan).
  Desain: Clean background dengan tipografi tebal dan interaktif.
-->
<section class="relative bg-white overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-32">
    <!-- Dekorasi Background Ambient Halus -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[20%] -right-[10%] w-[70%] h-[70%] rounded-full bg-gradient-to-b from-red-50 to-transparent blur-3xl opacity-60"></div>
        <div class="absolute top-[40%] -left-[10%] w-[50%] h-[50%] rounded-full bg-gradient-to-tr from-slate-50 to-transparent blur-3xl opacity-80"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- KIRI: Copywriting & Call to Action (Berpusat pada Pengguna) -->
            <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                
                <!-- Badge Kepercayaan -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-900 text-white text-xs font-bold shadow-lg shadow-slate-900/20">
                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L3 7v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-9-5zm-2 14l-4-4 1.41-1.41L10 13.17l6.59-6.59L18 8l-8 8z"/></svg>
                    Portal Resmi PT Lampung Post
                </div>

                <!-- Headline yang Berorientasi pada Keuntungan Klien -->
                <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] font-extrabold text-slate-900 tracking-tight leading-[1.1]">
                    Jangkau Ratusan Ribu Pembaca <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-800">
                        Lebih Cepat & Mudah.
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                    Tingkatkan visibilitas bisnis Anda melalui portal berita terbesar di Lampung. Pesan slot iklan secara mandiri atau bayar tagihan Anda dalam hitungan detik.
                </p>

                <!-- Aksi Utama (Pesan Iklan) -->
                <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('booking.step1') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-3 bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-2xl shadow-xl shadow-red-600/30 transition-all focus:ring-4 focus:ring-red-600/20 active:scale-95 text-base group">
                        <span>Pesan Iklan Sekarang</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#pricing" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-slate-700 border-2 border-slate-200 font-bold px-8 py-4 rounded-2xl transition-all focus:ring-4 focus:ring-slate-200 active:scale-95 text-base">
                        Lihat Tarif Iklan
                    </a>
                </div>

                <!-- Pemisah & Form Utilitas Cek Tagihan -->
                <div class="pt-8 border-t border-slate-200 max-w-xl mx-auto lg:mx-0">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">
                        Sudah Memiliki ID Tagihan?
                    </label>
                    <form action="{{ route('public.pay.check') }}" method="POST" 
                          class="group relative flex items-center bg-slate-50 border-2 border-slate-200 rounded-2xl focus-within:border-red-500 focus-within:ring-4 focus-within:ring-red-500/10 transition-all overflow-hidden p-1.5">
                        @csrf
                        <div class="pl-4 pr-2 text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="invoice_number" required placeholder="Masukkan ID (cth: INV-2026...)" 
                               class="w-full py-3 bg-transparent outline-none font-mono text-slate-800 placeholder:font-sans placeholder:text-slate-400 uppercase tracking-wider text-sm font-semibold">
                        <button type="submit" 
                                class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm px-6 py-3 rounded-xl transition-colors shrink-0">
                            Cek & Bayar
                        </button>
                    </form>
                </div>
            </div>

            <!-- KANAN: Visual Marketing (Mockup Dashboard Kinerja Iklan) -->
            <div class="lg:col-span-5 relative hidden sm:block">
                <!-- Ornamen Latar Belakang Mockup -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-gradient-to-tr from-slate-100 to-red-50 rounded-full blur-3xl -z-10"></div>
                
                <!-- Mockup Dashboard -->
                <div class="bg-slate-900 rounded-3xl p-1 shadow-2xl shadow-slate-900/40 border border-slate-800 rotate-1 hover:rotate-0 transition-transform duration-500">
                    <div class="bg-slate-950 rounded-[22px] overflow-hidden">
                        
                        <!-- Header Mockup -->
                        <div class="px-6 py-4 border-b border-slate-800 flex items-center justify-between bg-slate-900/50">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-red-500 animate-pulse"></div>
                                <span class="text-white text-sm font-bold tracking-wide">Live Ad Performance</span>
                            </div>
                            <div class="flex gap-1.5">
                                <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                                <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                                <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                            </div>
                        </div>

                        <!-- Konten Mockup -->
                        <div class="p-6 space-y-6">
                            <!-- Metrik -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700/50">
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Impressions</p>
                                    <p class="text-3xl font-black text-white">128.4K</p>
                                    <p class="text-emerald-400 text-xs font-bold mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                        +14.2% hari ini
                                    </p>
                                </div>
                                <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700/50">
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Click-Through</p>
                                    <p class="text-3xl font-black text-white">4.8%</p>
                                    <p class="text-emerald-400 text-xs font-bold mt-2 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                        Di atas rata-rata
                                    </p>
                                </div>
                            </div>

                            <!-- Simulasi Grafik -->
                            <div class="space-y-3">
                                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Aktivitas 7 Hari Terakhir</p>
                                <div class="flex items-end justify-between h-32 gap-2">
                                    <div class="w-full bg-slate-800 rounded-t-sm h-[40%] hover:bg-red-500/50 transition-colors"></div>
                                    <div class="w-full bg-slate-800 rounded-t-sm h-[55%] hover:bg-red-500/50 transition-colors"></div>
                                    <div class="w-full bg-slate-800 rounded-t-sm h-[35%] hover:bg-red-500/50 transition-colors"></div>
                                    <div class="w-full bg-red-600 rounded-t-sm h-[80%] shadow-[0_0_15px_rgba(220,38,38,0.5)] relative">
                                        <!-- Tooltip -->
                                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-white text-slate-900 text-[10px] font-bold px-2 py-1 rounded shadow-lg whitespace-nowrap">
                                            Puncak Traffic!
                                        </div>
                                    </div>
                                    <div class="w-full bg-slate-800 rounded-t-sm h-[65%] hover:bg-red-500/50 transition-colors"></div>
                                    <div class="w-full bg-slate-800 rounded-t-sm h-[50%] hover:bg-red-500/50 transition-colors"></div>
                                    <div class="w-full bg-slate-800 rounded-t-sm h-[70%] hover:bg-red-500/50 transition-colors"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Floating Trust Badge -->
                <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 flex items-center gap-4 z-20">
                    <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-slate-900 leading-none">{{ max($stats['advertisers'] ?? 1, 100) }}+</p>
                        <p class="text-xs font-semibold text-slate-500 mt-1">Pengiklan Aktif</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 
  KEUNGGULAN SECTION
  Konsep: Simplicity & Visual Hierarchy.
  Desain: Grid yang rapi, ikon besar, teks deskriptif yang tidak bertele-tele.
-->
<section class="py-20 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Proses Bisnis Tanpa Hambatan</h2>
            <p class="text-slate-600">Kami merancang ekosistem ini agar Anda dapat berfokus pada promosi bisnis, sementara kami menangani seluruh otomatisasi pembayarannya.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-red-200 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-3">Verifikasi Instan</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Sistem mendeteksi pelunasan Anda dalam hitungan detik via Webhook Payment Gateway secara otomatis.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-red-200 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-3">Multi-Kanal Bayar</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Dukungan penuh untuk QRIS, Virtual Account seluruh Bank Nasional, hingga e-Wallet populer.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-red-200 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-3">Kuitansi Resmi Sah</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Unduh Kuitansi elektronik berformat PDF dengan nomor seri perusahaan untuk kebutuhan pembukuan Anda.</p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-red-200 hover:-translate-y-1 transition-all duration-300 group">
                <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-3">Tanpa Perlu Login</h3>
                <p class="text-sm text-slate-600 leading-relaxed">Sistem berbasis <i class="font-serif">self-service</i>. Cukup masukkan ID Tagihan atau isi form pesanan langsung tanpa buat akun.</p>
            </div>
        </div>
    </div>
</section>

<!-- 
  PRICING / TIER SECTION
  Konsep: Visual Hierarchy.
  Desain: Opsi premium ditonjolkan dengan palet warna gelap (Slate-950) dan aksen emas/amber untuk menegaskan kelasnya.
-->
<section id="pricing" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mb-4">Investasi Promosi yang Transparan</h2>
            <p class="text-slate-600 text-lg">Pilih ruang iklan yang paling sesuai dengan kebutuhan eksposur *brand* Anda.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 items-center">
            
            <!-- Tier 1: Sidebar -->
            <div class="bg-white rounded-3xl p-8 border-2 border-slate-100 shadow-sm flex flex-col justify-between h-full">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-900">Sidebar Banner</h3>
                        <span class="px-3 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">300×250 px</span>
                    </div>
                    <p class="text-sm text-slate-500 mb-8">Tampil strategis di kolom kanan pada halaman pembacaan artikel.</p>
                    
                    <div class="mb-8">
                        <span class="text-4xl font-black text-slate-900">Rp 500rb</span>
                        <span class="text-sm text-slate-500 font-medium block mt-1">/ 7 hari masa tayang</span>
                    </div>

                    <ul class="space-y-4 text-sm text-slate-700 font-medium mb-8">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Tampil di semua halaman artikel
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Termasuk tautan URL *Outbound*
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'kolom']) }}" 
                   class="w-full text-center py-4 rounded-xl border-2 border-slate-200 text-slate-700 font-bold hover:border-red-600 hover:text-red-600 transition-all focus:ring-4 focus:ring-red-50 active:scale-95">
                    Pilih Slot Standar
                </a>
            </div>

            <!-- Tier 2: Header Banner (PREMIUM - HIGHLIGHTED) -->
            <div class="bg-slate-950 rounded-3xl p-8 border border-slate-800 shadow-2xl relative flex flex-col justify-between h-[105%] z-10">
                <div class="absolute -top-5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-amber-400 to-amber-600 text-slate-950 text-xs font-black px-6 py-2 rounded-full uppercase tracking-widest shadow-lg shadow-amber-500/20">
                    Paling Direkomendasikan
                </div>

                <div>
                    <div class="flex justify-between items-center mb-6 mt-4">
                        <h3 class="text-2xl font-black text-white">Header Banner</h3>
                        <span class="px-3 py-1 rounded-lg text-xs font-bold bg-slate-800 text-amber-400 border border-slate-700">970×250 px</span>
                    </div>
                    <p class="text-sm text-slate-400 mb-8">Posisi eksklusif teratas. Audiens melihat iklan Anda sebelum membaca berita.</p>
                    
                    <div class="mb-8">
                        <span class="text-4xl font-black text-white">Rp 1.5jt</span>
                        <span class="text-sm text-slate-400 font-medium block mt-1">/ 14 hari masa tayang</span>
                    </div>

                    <ul class="space-y-4 text-sm text-slate-300 font-medium mb-8">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-white">Posisi paling premium (Header Utama)</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Tampil di Homepage & Artikel
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Laporan performa interaksi iklan
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'display_banner']) }}" 
                   class="w-full text-center py-4 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold shadow-xl shadow-red-600/30 transition-all focus:ring-4 focus:ring-red-600/30 active:scale-95">
                    Pilih Slot Premium
                </a>
            </div>

            <!-- Tier 3: In-Article -->
            <div class="bg-white rounded-3xl p-8 border-2 border-slate-100 shadow-sm flex flex-col justify-between h-full">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-900">In-Article Banner</h3>
                        <span class="px-3 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">728×90 px</span>
                    </div>
                    <p class="text-sm text-slate-500 mb-8">Disisipkan secara cerdas di antara paragraf berita. Tingkat klik tertinggi.</p>
                    
                    <div class="mb-8">
                        <span class="text-4xl font-black text-slate-900">Rp 800rb</span>
                        <span class="text-sm text-slate-500 font-medium block mt-1">/ 10 hari masa tayang</span>
                    </div>

                    <ul class="space-y-4 text-sm text-slate-700 font-medium mb-8">
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Disisipkan di antara isi artikel
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Visibilitas saat pembaca fokus
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'advertorial']) }}" 
                   class="w-full text-center py-4 rounded-xl border-2 border-slate-200 text-slate-700 font-bold hover:border-red-600 hover:text-red-600 transition-all focus:ring-4 focus:ring-red-50 active:scale-95">
                    Pilih Slot Engagement
                </a>
            </div>

        </div>
    </div>
</section>

<!-- 
  CARA PEMBAYARAN / ALUR SECTION
  Konsep: Navigasi Intuitif.
  Desain: Menghilangkan kesan kaku menggunakan layout berbasis kartu timeline horizontal.
-->
<section id="how-it-works" class="py-24 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl sm:text-4xl font-black mb-4">Pilih Alur Sesuai Kebutuhan Anda</h2>
            <p class="text-slate-400 text-lg">Hanya butuh beberapa menit, mulai dari pengisian form hingga iklan siap ditayangkan.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <!-- Track A: Pemesanan Baru -->
            <div class="bg-slate-800/50 border border-slate-700 p-8 rounded-3xl relative overflow-hidden group hover:border-red-500/50 transition-colors">
                <div class="absolute top-0 right-0 p-8 opacity-10 text-9xl font-black text-white group-hover:text-red-500 transition-colors">A</div>
                
                <h3 class="text-2xl font-bold mb-2">Ingin Memesan Iklan Baru?</h3>
                <p class="text-slate-400 mb-8 text-sm">Gunakan form pemesanan *self-service* kami tanpa perlu menghubungi admin.</p>
                
                <div class="space-y-6 relative before:absolute before:inset-0 before:ml-[1.125rem] before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-600 before:to-transparent">
                    <!-- Step 1 -->
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group/step is-active">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-900 border-4 border-slate-800 text-slate-400 font-bold shrink-0 md:order-1 md:group-odd/step:-ml-[1.125rem] md:group-even/step:-mr-[1.125rem] shadow z-10">1</div>
                        <div class="w-[calc(100%-3rem)] md:w-[calc(50%-1.5rem)] bg-slate-800 p-4 rounded-xl border border-slate-700">
                            <h4 class="font-bold text-sm">Pilih Format & Durasi</h4>
                            <p class="text-xs text-slate-400 mt-1">Tentukan posisi iklan dan berapa lama ditayangkan.</p>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group/step is-active">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-900 border-4 border-slate-800 text-slate-400 font-bold shrink-0 md:order-1 md:group-odd/step:-ml-[1.125rem] md:group-even/step:-mr-[1.125rem] shadow z-10">2</div>
                        <div class="w-[calc(100%-3rem)] md:w-[calc(50%-1.5rem)] bg-slate-800 p-4 rounded-xl border border-slate-700">
                            <h4 class="font-bold text-sm">Unggah Materi Iklan</h4>
                            <p class="text-xs text-slate-400 mt-1">Lampirkan file banner / naskah artikel Anda.</p>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group/step is-active">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-900 border-4 border-slate-800 text-slate-400 font-bold shrink-0 md:order-1 md:group-odd/step:-ml-[1.125rem] md:group-even/step:-mr-[1.125rem] shadow z-10">3</div>
                        <div class="w-[calc(100%-3rem)] md:w-[calc(50%-1.5rem)] bg-slate-800 p-4 rounded-xl border border-slate-700">
                            <h4 class="font-bold text-sm">Bayar Instan</h4>
                            <p class="text-xs text-slate-400 mt-1">Selesaikan tagihan via QRIS/VA dan iklan siap tayang.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('booking.step1') }}" class="mt-8 block w-full bg-red-600 hover:bg-red-700 text-center py-4 rounded-xl font-bold transition-colors">
                    Mulai Form Pemesanan
                </a>
            </div>

            <!-- Track B: Bayar Tagihan -->
            <div class="bg-slate-800/50 border border-slate-700 p-8 rounded-3xl relative overflow-hidden group hover:border-slate-400 transition-colors">
                <div class="absolute top-0 right-0 p-8 opacity-10 text-9xl font-black text-white group-hover:text-slate-400 transition-colors">B</div>
                
                <h3 class="text-2xl font-bold mb-2">Sudah Punya ID Tagihan?</h3>
                <p class="text-slate-400 mb-8 text-sm">Jika admin telah membuatkan tagihan untuk Anda, cek detailnya di sini.</p>
                
                <div class="space-y-6 relative before:absolute before:inset-0 before:ml-[1.125rem] before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-600 before:to-transparent">
                    <!-- Step 1 -->
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group/step is-active">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-900 border-4 border-slate-800 text-slate-400 font-bold shrink-0 md:order-1 md:group-odd/step:-ml-[1.125rem] md:group-even/step:-mr-[1.125rem] shadow z-10">1</div>
                        <div class="w-[calc(100%-3rem)] md:w-[calc(50%-1.5rem)] bg-slate-800 p-4 rounded-xl border border-slate-700">
                            <h4 class="font-bold text-sm">Siapkan ID Tagihan</h4>
                            <p class="text-xs text-slate-400 mt-1">Cek ID berawalan <span class="text-red-400">INV-...</span> dari pesan Admin.</p>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group/step is-active">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-900 border-4 border-slate-800 text-slate-400 font-bold shrink-0 md:order-1 md:group-odd/step:-ml-[1.125rem] md:group-even/step:-mr-[1.125rem] shadow z-10">2</div>
                        <div class="w-[calc(100%-3rem)] md:w-[calc(50%-1.5rem)] bg-slate-800 p-4 rounded-xl border border-slate-700">
                            <h4 class="font-bold text-sm">Validasi Detail</h4>
                            <p class="text-xs text-slate-400 mt-1">Masukkan ID dan pastikan data nama/nominal sesuai.</p>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group/step is-active">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-slate-900 border-4 border-slate-800 text-slate-400 font-bold shrink-0 md:order-1 md:group-odd/step:-ml-[1.125rem] md:group-even/step:-mr-[1.125rem] shadow z-10">3</div>
                        <div class="w-[calc(100%-3rem)] md:w-[calc(50%-1.5rem)] bg-slate-800 p-4 rounded-xl border border-slate-700">
                            <h4 class="font-bold text-sm">Selesaikan Pembayaran</h4>
                            <p class="text-xs text-slate-400 mt-1">Pilih metode bayar. Kuitansi PDF akan otomatis terbit.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('public.pay.form') }}" class="mt-8 block w-full bg-white text-slate-900 hover:bg-slate-100 text-center py-4 rounded-xl font-bold transition-colors">
                    Cek & Bayar Tagihan
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 
  FAQ SECTION
  Konsep: Accessibility & Simplicity. 
  Desain: Accordion dengan interaksi yang jelas, indikator panah (chevron) yang berotasi.
-->
<section id="faq" class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-slate-900">Pertanyaan Umum (FAQ)</h2>
            <p class="mt-3 text-slate-600">Jawaban cepat seputar proses pemesanan dan pembayaran.</p>
        </div>

        <div class="space-y-4">
            <!-- FAQ 1 -->
            <details class="group bg-white border border-slate-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-sm hover:shadow-md hover:border-red-200 transition-all duration-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 outline-none">
                    <span class="pr-6">Apakah saya harus membuat akun untuk memasang iklan?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-red-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                    Tidak perlu. Sistem kami didesain sepenuhnya *self-service* dan tanpa pendaftaran. Anda dapat langsung memilih slot iklan, mengunggah materi, dan menyelesaikan pembayaran. Sistem akan mencatat detail pesanan dari data email yang Anda masukkan.
                </p>
            </details>

            <!-- FAQ 2 -->
            <details class="group bg-white border border-slate-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-sm hover:shadow-md hover:border-red-200 transition-all duration-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 outline-none">
                    <span class="pr-6">Metode pembayaran apa saja yang diterima?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-red-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                    Kami terintegrasi dengan Payment Gateway resmi (Midtrans). Anda bisa membayar menggunakan QRIS (BCA mobile, GoPay, OVO, ShopeePay, DANA), maupun Virtual Account dari hampir semua bank nasional di Indonesia (BCA, Mandiri, BNI, BRI, dsb).
                </p>
            </details>

            <!-- FAQ 3 -->
            <details class="group bg-white border border-slate-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-sm hover:shadow-md hover:border-red-200 transition-all duration-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 outline-none">
                    <span class="pr-6">Apakah bukti pembayaran ini sah untuk pembukuan kantor saya?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-red-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                    Tentu saja. Segera setelah pembayaran Anda berhasil, sistem akan otomatis menghasilkan Kuitansi berformat PDF dengan nomor faktur dan rincian transaksi lengkap yang sah untuk pelaporan keuangan instansi/perusahaan Anda.
                </p>
            </details>

            <!-- FAQ 4 -->
            <details class="group bg-white border border-slate-200 rounded-2xl p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-sm hover:shadow-md hover:border-red-200 transition-all duration-300">
                <summary class="flex items-center justify-between font-bold text-slate-900 outline-none">
                    <span class="pr-6">Bagaimana jika saya ingin berkonsultasi mengenai slot iklan khusus?</span>
                    <span class="transition-transform duration-300 group-open:rotate-180 text-red-500 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </span>
                </summary>
                <p class="mt-4 text-sm text-slate-600 leading-relaxed">
                    Jika Anda memiliki kebutuhan kampanye promosi khusus atau *bundled advertorial*, silakan hubungi tim pemasaran kami melalui email di <a href="mailto:iklan@lampungpost.co.id" class="text-red-600 font-semibold hover:underline">iklan@lampungpost.co.id</a>. Kami akan menyesuaikan tagihan (*custom invoice*) yang nantinya bisa Anda bayarkan melalui form "Cek Tagihan" di website ini.
                </p>
            </details>
        </div>
    </div>
</section>
@endsection