@extends('layouts.public')

@section('title', 'E-Payment Resmi PT Lampung Post — Pesan Iklan & Pembayaran Digital')

@section('content')

{{-- ============================================================ --}}
{{-- HERO — Editorial Split: Copy + Utility Form + Live Card     --}}
{{-- ============================================================ --}}
<section class="relative bg-white border-b border-[var(--color-border)] overflow-hidden">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-[36rem] h-[36rem] rounded-full bg-[var(--color-brand-light)] blur-3xl opacity-70"></div>
        <div class="absolute bottom-0 -left-24 w-[28rem] h-[28rem] rounded-full bg-slate-50 blur-3xl opacity-80"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-16 lg:py-24 grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">

        {{-- LEFT: Editorial Copy + Utility Form --}}
        <div class="lg:col-span-7 space-y-8">

            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[var(--color-bg)] border border-[var(--color-border)] text-xs font-semibold text-[var(--color-text-muted)] animate-stagger">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand)] animate-pulse"></span>
                <span class="text-[var(--color-text-main)]">Portal Resmi</span>
                <span class="text-[var(--color-border-hover)]">•</span>
                <span>PT Lampung Post</span>
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-[3.5rem] font-editorial text-[var(--color-text-main)] leading-[1.05] animate-stagger" style="animation-delay: 0.05s">
                Jangkau Ratusan Ribu Pembaca,<br>
                <em class="text-[var(--color-brand)] not-italic font-medium">Lebih Cepat & Mudah.</em>
            </h1>

            <p class="text-base sm:text-lg text-[var(--color-text-muted)] max-w-2xl leading-relaxed animate-stagger" style="animation-delay: 0.1s">
                Tingkatkan visibilitas bisnis Anda melalui portal berita terbesar di Lampung. Pesan slot iklan secara mandiri, atau selesaikan tagihan Anda dalam hitungan detik.
            </p>

            <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 animate-stagger" style="animation-delay: 0.15s">
                <a href="{{ route('booking.step1') }}"
                   class="inline-flex items-center justify-center gap-3 bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-sm transition-all focus:ring-4 focus:ring-red-100 active:scale-95 group">
                    <span>Pesan Iklan Sekarang</span>
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <a href="#pricing"
                   class="inline-flex items-center justify-center gap-2 bg-white hover:bg-[var(--color-bg)] text-[var(--color-text-main)] border border-[var(--color-border)] hover:border-[var(--color-border-hover)] font-bold px-7 py-3.5 rounded-xl transition-all active:scale-95">
                    Lihat Tarif Iklan
                </a>
            </div>

            {{-- Invoice Check Form --}}
            <div class="pt-6 border-t border-[var(--color-border)] animate-stagger" style="animation-delay: 0.2s">
                <label class="block text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-3">
                    Sudah Memiliki ID Tagihan?
                </label>
                <form action="{{ route('public.pay.check') }}" method="POST"
                      class="flex items-stretch bg-white border border-[var(--color-border)] rounded-xl focus-within:border-[var(--color-brand)] focus-within:ring-[3px] focus-within:ring-red-100 transition-all overflow-hidden p-1.5">
                    @csrf
                    <div class="pl-3 pr-1 flex items-center text-[var(--color-text-muted)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="invoice_number" required
                           placeholder="Masukkan ID (cth: INV-2026-0001)"
                           class="flex-1 bg-transparent outline-none px-2 text-sm font-medium text-[var(--color-text-main)] placeholder:text-[var(--color-text-muted)] uppercase tracking-wider">
                    <button type="submit"
                            class="bg-[var(--color-text-main)] hover:bg-black text-white font-bold text-sm px-5 py-2.5 rounded-lg transition-colors shrink-0">
                        Cek Tagihan
                    </button>
                </form>
            </div>
        </div>

        {{-- RIGHT: Editorial Live Performance Card --}}
        <div class="lg:col-span-5 relative hidden lg:block animate-stagger" style="animation-delay: 0.25s">
            <div class="absolute inset-0 -z-10 flex items-center justify-center">
                <div class="w-3/4 h-3/4 rounded-full bg-[var(--color-brand-light)] blur-3xl opacity-60"></div>
            </div>

            <div class="hairline-card p-7 relative">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[var(--color-brand)] animate-pulse"></span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)]">Live Performance</span>
                    </div>
                    <span class="text-[10px] font-bold text-[var(--color-text-muted)] px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)]">7 Hari</span>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="bg-[var(--color-bg)] border border-[var(--color-border)] rounded-xl p-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)] mb-1">Impressions</p>
                        <p class="text-2xl font-editorial font-semibold text-[var(--color-text-main)] leading-none">128.4K</p>
                        <p class="text-[11px] font-bold text-[var(--color-brand)] mt-2">+14.2% hari ini</p>
                    </div>
                    <div class="bg-[var(--color-bg)] border border-[var(--color-border)] rounded-xl p-4">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)] mb-1">CTR</p>
                        <p class="text-2xl font-editorial font-semibold text-[var(--color-text-main)] leading-none">4.8%</p>
                        <p class="text-[11px] font-bold text-[var(--color-brand)] mt-2">Di atas rata-rata</p>
                    </div>
                </div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)] mb-2">Aktivitas 7 Hari</p>
                <div class="flex items-end justify-between h-24 gap-1.5">
                    <div class="w-full bg-[var(--color-border)] rounded-t-sm h-[40%]"></div>
                    <div class="w-full bg-[var(--color-border)] rounded-t-sm h-[55%]"></div>
                    <div class="w-full bg-[var(--color-border)] rounded-t-sm h-[35%]"></div>
                    <div class="w-full bg-[var(--color-brand)] rounded-t-sm h-[80%]"></div>
                    <div class="w-full bg-[var(--color-border)] rounded-t-sm h-[65%]"></div>
                    <div class="w-full bg-[var(--color-border)] rounded-t-sm h-[50%]"></div>
                    <div class="w-full bg-[var(--color-border)] rounded-t-sm h-[70%]"></div>
                </div>
            </div>

            <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl border border-[var(--color-border)] shadow-[var(--shadow-ambient)] flex items-center gap-3">
                <div class="w-10 h-10 bg-[var(--color-brand-light)] rounded-lg flex items-center justify-center text-[var(--color-brand)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xl font-editorial font-semibold text-[var(--color-text-main)] leading-none">{{ max($stats['advertisers'] ?? 1, 100) }}+</p>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)] mt-1">Pengiklan Aktif</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- FEATURES — Hairline Cards Grid                              --}}
{{-- ============================================================ --}}
<section class="py-20 bg-[var(--color-bg)]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-2xl mb-14">
            <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)] mb-3">Kenapa Kami</p>
            <h2 class="text-3xl sm:text-4xl font-editorial text-[var(--color-text-main)] mb-3">Proses Bisnis Tanpa Hambatan</h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed">Ekosistem dirancang agar Anda berfokus pada promosi bisnis, sementara kami menangani otomatisasi pembayarannya.</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @php
                $features = [
                    ['title' => 'Verifikasi Instan', 'desc' => 'Sistem mendeteksi pelunasan dalam hitungan detik via Webhook Payment Gateway.', 'icon' => 'bolt'],
                    ['title' => 'Multi-Kanal Bayar', 'desc' => 'Dukungan QRIS, Virtual Account seluruh bank nasional, hingga e-Wallet populer.', 'icon' => 'card'],
                    ['title' => 'Kuitansi Resmi', 'desc' => 'Unduh kuitansi elektronik PDF bernomor seri perusahaan untuk pembukuan.', 'icon' => 'doc'],
                    ['title' => 'Tanpa Login', 'desc' => 'Self-service penuh. Cukup masukkan ID Tagihan atau isi form pesanan langsung.', 'icon' => 'lock'],
                ];
            @endphp

            @foreach ($features as $f)
                <div class="hairline-card p-6 group">
                    <div class="w-10 h-10 rounded-lg mb-5 flex items-center justify-center border border-[var(--color-border)] bg-[var(--color-bg)] text-[var(--color-text-main)] group-hover:bg-[var(--color-brand-light)] group-hover:text-[var(--color-brand)] group-hover:border-[var(--color-brand-muted)] transition-colors">
                        @if ($f['icon'] === 'bolt')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        @elseif ($f['icon'] === 'card')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        @elseif ($f['icon'] === 'doc')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        @endif
                    </div>
                    <h3 class="text-base font-bold text-[var(--color-text-main)] mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- PRICING — Editorial 3-Tier                                 --}}
{{-- ============================================================ --}}
<section id="pricing" class="py-24 bg-white border-y border-[var(--color-border)]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)] mb-3">Tarif Transparan</p>
            <h2 class="text-3xl sm:text-4xl font-editorial text-[var(--color-text-main)] mb-3">Investasi Promosi yang Jelas</h2>
            <p class="text-[var(--color-text-muted)]">Pilih ruang iklan yang paling sesuai dengan kebutuhan eksposur brand Anda.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 items-stretch">

            {{-- Tier 1 --}}
            <div class="hairline-card p-7 flex flex-col justify-between h-full">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-[var(--color-text-main)]">Sidebar Banner</h3>
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-[var(--color-bg)] text-[var(--color-text-muted)] border border-[var(--color-border)]">300×250</span>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)] mb-7">Tampil strategis di kolom kanan pada halaman pembacaan artikel.</p>

                    <div class="mb-7">
                        <span class="text-3xl font-editorial font-semibold text-[var(--color-text-main)]">Rp 500rb</span>
                        <span class="block text-xs text-[var(--color-text-muted)] font-medium mt-1">/ 7 hari tayang</span>
                    </div>

                    <ul class="space-y-3 text-sm text-[var(--color-text-main)] font-medium mb-7">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Tampil di semua halaman artikel
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Termasuk tautan URL outbound
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'kolom']) }}"
                   class="block text-center py-3 rounded-xl border border-[var(--color-border)] text-[var(--color-text-main)] font-bold hover:border-[var(--color-brand)] hover:text-[var(--color-brand)] transition-all text-sm active:scale-[0.98]">
                    Pilih Slot Standar
                </a>
            </div>

            {{-- Tier 2 — Premium --}}
            <div class="hairline-card p-7 flex flex-col justify-between h-full relative border-2 border-[var(--color-brand)] shadow-[var(--shadow-ambient)]">
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[var(--color-brand)] text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest whitespace-nowrap">
                    Paling Direkomendasikan
                </div>

                <div>
                    <div class="flex items-center justify-between mb-5 mt-2">
                        <h3 class="text-lg font-bold text-[var(--color-text-main)]">Header Banner</h3>
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-[var(--color-brand-light)] text-[var(--color-brand)] border border-[var(--color-brand-muted)]">970×250</span>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)] mb-7">Posisi eksklusif teratas. Audiens melihat iklan sebelum membaca berita.</p>

                    <div class="mb-7">
                        <span class="text-3xl font-editorial font-semibold text-[var(--color-text-main)]">Rp 1.5jt</span>
                        <span class="block text-xs text-[var(--color-text-muted)] font-medium mt-1">/ 14 hari tayang</span>
                    </div>

                    <ul class="space-y-3 text-sm text-[var(--color-text-main)] font-medium mb-7">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Posisi paling premium (header utama)
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Tampil di homepage & artikel
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Laporan performa interaksi iklan
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'display_banner']) }}"
                   class="block text-center py-3 rounded-xl bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold shadow-sm transition-all text-sm active:scale-[0.98]">
                    Pilih Slot Premium
                </a>
            </div>

            {{-- Tier 3 --}}
            <div class="hairline-card p-7 flex flex-col justify-between h-full">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-[var(--color-text-main)]">In-Article Banner</h3>
                        <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-[var(--color-bg)] text-[var(--color-text-muted)] border border-[var(--color-border)]">728×90</span>
                    </div>
                    <p class="text-sm text-[var(--color-text-muted)] mb-7">Disisipkan secara cerdas di antara paragraf berita. Tingkat klik tertinggi.</p>

                    <div class="mb-7">
                        <span class="text-3xl font-editorial font-semibold text-[var(--color-text-main)]">Rp 800rb</span>
                        <span class="block text-xs text-[var(--color-text-muted)] font-medium mt-1">/ 10 hari tayang</span>
                    </div>

                    <ul class="space-y-3 text-sm text-[var(--color-text-main)] font-medium mb-7">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Disisipkan di antara isi artikel
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[var(--color-brand)] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Visibilitas saat pembaca fokus
                        </li>
                    </ul>
                </div>

                <a href="{{ route('booking.step1', ['format' => 'advertorial']) }}"
                   class="block text-center py-3 rounded-xl border border-[var(--color-border)] text-[var(--color-text-main)] font-bold hover:border-[var(--color-brand)] hover:text-[var(--color-brand)] transition-all text-sm active:scale-[0.98]">
                    Pilih Slot Engagement
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- HOW IT WORKS — Two Editorial Tracks                         --}}
{{-- ============================================================ --}}
<section id="how-it-works" class="py-24 bg-[var(--color-bg)]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="max-w-2xl mb-14">
            <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)] mb-3">Alur Kerja</p>
            <h2 class="text-3xl sm:text-4xl font-editorial text-[var(--color-text-main)] mb-3">Pilih Alur Sesuai Kebutuhan</h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed">Hanya butuh beberapa menit — mulai dari pengisian form hingga iklan siap ditayangkan.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-6">

            {{-- Track A --}}
            <div class="hairline-card p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-[0.06] text-[7rem] font-editorial font-semibold text-[var(--color-text-main)] leading-none select-none">A</div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)] mb-2">Track A</p>
                <h3 class="text-xl font-editorial font-semibold text-[var(--color-text-main)] mb-2">Ingin Memesan Iklan Baru?</h3>
                <p class="text-sm text-[var(--color-text-muted)] mb-7">Gunakan form pemesanan self-service kami tanpa perlu menghubungi admin.</p>

                <ol class="space-y-4 mb-7">
                    @php $stepsA = [['Pilih Format & Durasi','Tentukan posisi iklan dan berapa lama ditayangkan.'],['Unggah Materi Iklan','Lampirkan file banner atau naskah artikel Anda.'],['Bayar Instan','Selesaikan tagihan via QRIS/VA dan iklan siap tayang.']]; @endphp
                    @foreach ($stepsA as $i => $s)
                        <li class="flex gap-4">
                            <div class="w-7 h-7 rounded-full bg-[var(--color-brand-light)] text-[var(--color-brand)] border border-[var(--color-brand-muted)] flex items-center justify-center text-xs font-bold shrink-0">{{ $i + 1 }}</div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-[var(--color-text-main)]">{{ $s[0] }}</p>
                                <p class="text-xs text-[var(--color-text-muted)] mt-0.5 leading-relaxed">{{ $s[1] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                <a href="{{ route('booking.step1') }}"
                   class="block text-center bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold py-3 rounded-xl shadow-sm transition-all text-sm active:scale-[0.98]">
                    Mulai Form Pemesanan
                </a>
            </div>

            {{-- Track B --}}
            <div class="hairline-card p-8 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-[0.06] text-[7rem] font-editorial font-semibold text-[var(--color-text-main)] leading-none select-none">B</div>

                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)] mb-2">Track B</p>
                <h3 class="text-xl font-editorial font-semibold text-[var(--color-text-main)] mb-2">Sudah Punya ID Tagihan?</h3>
                <p class="text-sm text-[var(--color-text-muted)] mb-7">Jika admin telah membuatkan tagihan untuk Anda, cek detailnya di sini.</p>

                <ol class="space-y-4 mb-7">
                    @php $stepsB = [['Siapkan ID Tagihan','Cek ID berawalan INV- dari pesan Admin.'],['Validasi Detail','Masukkan ID dan pastikan data nama/nominal sesuai.'],['Selesaikan Pembayaran','Pilih metode bayar. Kuitansi PDF otomatis terbit.']]; @endphp
                    @foreach ($stepsB as $i => $s)
                        <li class="flex gap-4">
                            <div class="w-7 h-7 rounded-full bg-[var(--color-bg)] text-[var(--color-text-main)] border border-[var(--color-border)] flex items-center justify-center text-xs font-bold shrink-0">{{ $i + 1 }}</div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-[var(--color-text-main)]">{{ $s[0] }}</p>
                                <p class="text-xs text-[var(--color-text-muted)] mt-0.5 leading-relaxed">{{ $s[1] }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                <a href="{{ route('public.pay.form') }}"
                   class="block text-center bg-[var(--color-text-main)] hover:bg-black text-white font-bold py-3 rounded-xl shadow-sm transition-all text-sm active:scale-[0.98]">
                    Cek & Bayar Tagihan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ============================================================ --}}
{{-- FAQ — Editorial Accordion                                   --}}
{{-- ============================================================ --}}
<section id="faq" class="py-24 bg-white border-t border-[var(--color-border)]">
    <div class="max-w-3xl mx-auto px-6">
        <div class="mb-12">
            <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)] mb-3">Bantuan</p>
            <h2 class="text-3xl sm:text-4xl font-editorial text-[var(--color-text-main)] mb-3">Pertanyaan Umum</h2>
            <p class="text-[var(--color-text-muted)]">Jawaban cepat seputar proses pemesanan dan pembayaran.</p>
        </div>

        <div class="space-y-3">
            @php
                $faqs = [
                    ['Apakah saya harus membuat akun untuk memasang iklan?',
                     'Tidak perlu. Sistem kami didesain sepenuhnya self-service dan tanpa pendaftaran. Anda dapat langsung memilih slot iklan, mengunggah materi, dan menyelesaikan pembayaran. Sistem akan mencatat detail pesanan dari data email yang Anda masukkan.'],
                    ['Metode pembayaran apa saja yang diterima?',
                     'Kami terintegrasi dengan Payment Gateway resmi. Anda bisa membayar menggunakan QRIS (BCA mobile, GoPay, OVO, ShopeePay, DANA), maupun Virtual Account dari hampir semua bank nasional di Indonesia (BCA, Mandiri, BNI, BRI, dsb).'],
                    ['Apakah bukti pembayaran ini sah untuk pembukuan kantor saya?',
                     'Tentu saja. Segera setelah pembayaran Anda berhasil, sistem akan otomatis menghasilkan kuitansi berformat PDF dengan nomor faktur dan rincian transaksi lengkap yang sah untuk pelaporan keuangan instansi/perusahaan Anda.'],
                    ['Bagaimana jika saya ingin berkonsultasi mengenai slot iklan khusus?',
                     'Jika Anda memiliki kebutuhan kampanye promosi khusus atau bundled advertorial, silakan hubungi tim pemasaran kami melalui email di iklan@lampungpost.co.id. Kami akan menyesuaikan tagihan (custom invoice) yang nantinya bisa Anda bayarkan melalui form "Cek Tagihan" di website ini.'],
                ];
            @endphp

            @foreach ($faqs as $i => $faq)
                <details class="group hairline-card p-5 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex items-center justify-between font-bold text-[var(--color-text-main)] outline-none text-sm sm:text-base">
                        <span class="pr-6">{{ $faq[0] }}</span>
                        <span class="transition-transform duration-300 group-open:rotate-180 text-[var(--color-brand)] shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </summary>
                    <p class="mt-3 pt-3 border-t border-[var(--color-border)] text-sm text-[var(--color-text-muted)] leading-relaxed">
                        @if ($i === 3)
                            Jika Anda memiliki kebutuhan kampanye promosi khusus atau <em>bundled advertorial</em>, silakan hubungi tim pemasaran kami melalui email di <a href="mailto:iklan@lampungpost.co.id" class="text-[var(--color-brand)] font-semibold hover:underline">iklan@lampungpost.co.id</a>. Kami akan menyesuaikan tagihan (<em>custom invoice</em>) yang nantinya bisa Anda bayarkan melalui form "Cek Tagihan" di website ini.
                        @else
                            {{ $faq[1] }}
                        @endif
                    </p>
                </details>
            @endforeach
        </div>
    </div>
</section>

@endsection