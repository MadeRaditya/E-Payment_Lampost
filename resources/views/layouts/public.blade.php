<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Payment Lampung Post — Portal Pembayaran Resmi')</title>
    <meta name="description" content="Portal pembayaran tagihan iklan, langganan, dan kerja sama kemitraan resmi PT Lampung Post. Cepat, aman, dan terverifikasi otomatis.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col selection:bg-red-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-red-950 text-slate-300 text-xs py-2 px-4 border-b border-slate-700/40">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-red-600/30 text-red-300 border border-red-500/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-400 animate-pulse"></span>
                    Portal Resmi
                </span>
                <span class="hidden sm:inline text-slate-300">PT Lampung Post — Sistem Pembayaran Digital Terintegrasi</span>
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <a href="mailto:keuangan@lampungpost.co.id" class="hover:text-white transition flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span class="hidden md:inline">keuangan@lampungpost.co.id</span>
                </a>
                <span class="text-slate-600 hidden md:inline">|</span>
                <a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition flex items-center gap-1 font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Portal Staf
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-md shadow-red-500/20 group-hover:scale-105 transition-transform duration-200">
                    <span class="font-black text-white text-xl tracking-tighter">LP</span>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1.5">
                        <span class="font-extrabold text-lg tracking-tight text-slate-900 group-hover:text-red-600 transition">LAMPUNG POST</span>
                        <span class="bg-red-50 text-red-600 text-[10px] font-bold px-1.5 py-0.5 rounded border border-red-200/60 uppercase">Pay</span>
                    </div>
                    <span class="text-[11px] font-medium text-slate-400 -mt-1 tracking-wide">E-Payment Gateway</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                <a href="{{ route('landing') }}" class="hover:text-red-600 transition {{ request()->routeIs('landing') ? 'text-red-600 font-semibold' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('landing') }}#pricing" class="hover:text-red-600 transition">
                    Pilihan Slot Iklan
                </a>
                <a href="{{ route('landing') }}#how-it-works" class="hover:text-red-600 transition">
                    Cara Pembayaran
                </a>
                <a href="{{ route('landing') }}#faq" class="hover:text-red-600 transition">
                    Bantuan / FAQ
                </a>
            </nav>

            <!-- Action Button -->
            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('public.pay.form') }}" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-sm hover:shadow-md hover:shadow-red-600/20 active:scale-95 transition-all duration-150">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Bayar Tagihan
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition" aria-label="Buka Menu">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown Navigation -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white/95 px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('landing') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:bg-red-50 hover:text-red-600 transition">
                Beranda
            </a>
            <a href="{{ route('landing') }}#pricing" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:bg-red-50 hover:text-red-600 transition">
                Pilihan Slot Iklan
            </a>
            <a href="{{ route('landing') }}#how-it-works" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:bg-red-50 hover:text-red-600 transition">
                Cara Pembayaran
            </a>
            <a href="{{ route('landing') }}#faq" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:bg-red-50 hover:text-red-600 transition">
                Bantuan & FAQ
            </a>
            <div class="pt-2 border-t border-slate-100 space-y-2">
                <a href="{{ route('public.pay.form') }}" class="flex items-center justify-center gap-2 w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-xl transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Bayar Tagihan Sekarang
                </a>
                <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full text-slate-600 hover:text-slate-900 font-medium py-2 rounded-xl transition text-sm">
                    Login Portal Staf
                </a>
            </div>
        </div>
    </header>

    <!-- Global Toast Alerts for Public Pages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        @if (session('success'))
            <div class="mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1">✕</button>
            </div>
        @endif
        @if (session('error'))
            <div class="mt-4 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1">✕</button>
            </div>
        @endif
    </div>

    <!-- Main Content Area -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Professional Footer -->
    <footer class="bg-slate-900 text-slate-400 mt-20 border-t border-slate-800">
        <!-- Top Footer Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            <!-- Brand Column -->
            <div class="lg:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center text-white font-extrabold text-lg shadow-md shadow-red-600/30">
                        LP
                    </div>
                    <div>
                        <span class="font-bold text-white text-base tracking-tight block">PT LAMPUNG POST</span>
                        <span class="text-xs text-red-400 font-medium">E-Payment Official Gateway</span>
                    </div>
                </div>
                <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                    Platform pembayaran digital resmi Lampung Post untuk transaksi iklan koran, iklan digital, advertorial, langganan, dan kerja sama kemitraan secara cepat, aman, dan instan.
                </p>
                <div class="flex items-center gap-2 pt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                        <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        256-bit SSL Encrypted
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                        <svg class="w-3.5 h-3.5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Verifikasi Otomatis
                    </span>
                </div>
            </div>

            <!-- Nav Links -->
            <div class="space-y-3">
                <p class="text-white text-xs font-bold uppercase tracking-wider">Navigasi</p>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('landing') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('landing') }}#pricing" class="hover:text-white transition">Pilihan Slot Iklan</a></li>
                    <li><a href="{{ route('landing') }}#how-it-works" class="hover:text-white transition">Alur Pembayaran</a></li>
                    <li><a href="{{ route('public.pay.form') }}" class="hover:text-white transition">Cek ID Tagihan</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Login Admin</a></li>
                </ul>
            </div>

            <!-- Kantor & Layanan -->
            <div class="space-y-3">
                <p class="text-white text-xs font-bold uppercase tracking-wider">Kantor Redaksi</p>
                <div class="text-sm space-y-2 text-slate-400">
                    <p class="leading-relaxed">
                        Jl. Soekarno Hatta No. 108, Rajabasa, Bandar Lampung, Lampung 35144
                    </p>
                    <p class="pt-1">
                        <strong class="text-slate-300 block text-xs">Telepon Redaksi / Iklan:</strong>
                        (0721) 783693 / 783694
                    </p>
                </div>
            </div>

            <!-- Bantuan Finansial -->
            <div class="space-y-3">
                <p class="text-white text-xs font-bold uppercase tracking-wider">Bantuan Keuangan</p>
                <div class="text-sm space-y-2 text-slate-400">
                    <p>Butuh bantuan konfirmasi pembayaran atau kuitansi cetak?</p>
                    <p class="pt-1">
                        <span class="text-xs text-slate-500 block">Email Tim Finance:</span>
                        <a href="mailto:keuangan@lampungpost.co.id" class="text-red-400 hover:text-red-300 font-medium">keuangan@lampungpost.co.id</a>
                    </p>
                    <p>
                        <span class="text-xs text-slate-500 block">Jam Operasional:</span>
                        Senin - Jumat: 08:30 - 17:00 WIB
                    </p>
                </div>
            </div>
        </div>

        <!-- Payment Channels Supported & Copyright -->
        <div class="border-t border-slate-800/80 bg-slate-950/60 py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <div>
                    &copy; {{ date('Y') }} <span class="text-slate-200 font-semibold">PT Lampung Post</span>. Hak Cipta Dilindungi Undang-Undang.
                </div>
                <!-- Payment Logos Pill -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-slate-400 text-[11px] mr-1">Metode Resmi:</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded text-[11px] font-semibold text-slate-300 border border-slate-700">QRIS</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded text-[11px] font-semibold text-slate-300 border border-slate-700">BCA VA</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded text-[11px] font-semibold text-slate-300 border border-slate-700">Mandiri VA</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded text-[11px] font-semibold text-slate-300 border border-slate-700">BNI / BRI</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded text-[11px] font-semibold text-slate-300 border border-slate-700">GoPay</span>
                    <span class="bg-slate-800 px-2.5 py-1 rounded text-[11px] font-semibold text-slate-300 border border-slate-700">ShopeePay</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vanilla JavaScript for Mobile Menu & Utilities -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');

            if (btn && menu) {
                btn.addEventListener('click', function () {
                    const isHidden = menu.classList.contains('hidden');
                    if (isHidden) {
                        menu.classList.remove('hidden');
                        hamburger.classList.add('hidden');
                        close.classList.remove('hidden');
                    } else {
                        menu.classList.add('hidden');
                        hamburger.classList.remove('hidden');
                        close.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>