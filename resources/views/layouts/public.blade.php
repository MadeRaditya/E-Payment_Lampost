<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Payment Lampung Post — Portal Pembayaran Resmi')</title>
    <meta name="description"
        content="Portal pembayaran tagihan iklan, langganan, dan kerja sama kemitraan resmi PT Lampung Post. Cepat, aman, dan terverifikasi otomatis.">

    <!-- High-Craft Typography: Newsreader (Editorial Serif) & Manrope (Clean Geometric Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* CSS Variables for Strict Consistency */
        :root {
            --color-brand: #DC2626;
            --color-brand-light: #FEF2F2;
            --color-brand-muted: #FCA5A5;
            --color-surface: #FFFFFF;
            --color-bg: #F8FAFC;
            --color-border: #E2E8F0;
            --color-border-hover: #CBD5E1;
            --color-text-main: #0F172A;
            --color-text-muted: #64748B;
            --font-sans: 'Manrope', system-ui, -apple-system, sans-serif;
            --font-serif: 'Newsreader', Georgia, serif;
            --shadow-ambient: 0 12px 32px -4px rgba(15, 23, 42, 0.04);
            --transition-snappy: 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--color-bg);
            color: var(--color-text-main);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        h1, h2, h3, .font-editorial {
            font-family: var(--font-serif);
            letter-spacing: -0.02em;
            line-height: 1.15;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--color-border);
        }

        .hairline-card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 1rem;
            transition: all var(--transition-snappy);
        }
        .hairline-card:hover {
            border-color: var(--color-border-hover);
            box-shadow: var(--shadow-ambient);
        }

        .form-input {
            width: 100%;
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: var(--color-text-main);
            transition: all var(--transition-snappy);
            outline: none;
        }
        .form-input:focus {
            border-color: var(--color-brand);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        @keyframes staggerFade {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-stagger {
            animation: staggerFade 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
            opacity: 0;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col selection:bg-red-100 selection:text-red-900">

    {{-- TOP NAVBAR --}}
    <header class="sticky top-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <div class="w-8 h-8 rounded-lg bg-[var(--color-brand)] text-white flex items-center justify-center font-bold text-sm transition-transform group-hover:scale-105">
                    LP
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold tracking-tight text-[var(--color-text-main)] leading-none">LAMPUNG POST</span>
                    <span class="text-[10px] font-semibold tracking-widest text-[var(--color-text-muted)] mt-1 uppercase">Portal Iklan & Pembayaran</span>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-[var(--color-text-muted)]">
                <a href="{{ route('landing') }}"
                   class="hover:text-[var(--color-brand)] transition {{ request()->routeIs('landing') ? 'text-[var(--color-text-main)] font-semibold' : '' }}">Beranda</a>
                <a href="{{ route('booking.step1') }}"
                   class="hover:text-[var(--color-brand)] transition {{ request()->routeIs('booking.*') ? 'text-[var(--color-text-main)] font-semibold' : '' }}">Pesan Iklan</a>
                <a href="{{ route('landing') }}#pricing" class="hover:text-[var(--color-brand)] transition">Tarif</a>
                <a href="{{ route('landing') }}#how-it-works" class="hover:text-[var(--color-brand)] transition">Alur</a>
                <a href="{{ route('landing') }}#faq" class="hover:text-[var(--color-brand)] transition">FAQ</a>
            </nav>

            <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 text-sm font-medium text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition px-3 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                    Login Staf
                </a>
                <a href="{{ route('booking.step1') }}"
                   class="inline-flex items-center gap-2 bg-[var(--color-brand)] hover:bg-red-700 text-white text-sm font-bold px-4 py-2 rounded-xl shadow-sm transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Pesan Iklan
                </a>
            </div>

            <button id="mobile-menu-btn" type="button"
                class="md:hidden p-2 rounded-lg text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] hover:bg-[var(--color-bg)] transition"
                aria-label="Buka Menu">
                <svg id="hamburger-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="hidden md:hidden border-t border-[var(--color-border)] bg-white px-4 pt-3 pb-6 space-y-1">
            <a href="{{ route('landing') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-[var(--color-text-main)] hover:bg-[var(--color-brand-light)] hover:text-[var(--color-brand)] transition">Beranda</a>
            <a href="{{ route('booking.step1') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-[var(--color-text-main)] hover:bg-[var(--color-brand-light)] hover:text-[var(--color-brand)] transition">Pesan Iklan</a>
            <a href="{{ route('landing') }}#pricing" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-[var(--color-text-main)] hover:bg-[var(--color-brand-light)] hover:text-[var(--color-brand)] transition">Tarif Iklan</a>
            <a href="{{ route('landing') }}#how-it-works" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-[var(--color-text-main)] hover:bg-[var(--color-brand-light)] hover:text-[var(--color-brand)] transition">Alur Pembayaran</a>
            <a href="{{ route('landing') }}#faq" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-[var(--color-text-main)] hover:bg-[var(--color-brand-light)] hover:text-[var(--color-brand)] transition">Bantuan & FAQ</a>
            <div class="pt-3 mt-3 border-t border-[var(--color-border)] space-y-2">
                <a href="{{ route('booking.step1') }}"
                   class="flex items-center justify-center gap-2 w-full bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold py-2.5 rounded-xl transition text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Pesan Iklan Baru
                </a>
                <a href="{{ route('public.pay.form') }}"
                   class="flex items-center justify-center gap-2 w-full bg-[var(--color-bg)] hover:bg-slate-100 text-[var(--color-text-main)] font-semibold py-2.5 rounded-xl transition text-sm border border-[var(--color-border)]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cek / Bayar Tagihan
                </a>
                <a href="{{ route('login') }}"
                   class="flex items-center justify-center gap-2 w-full text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] font-medium py-2 rounded-xl transition text-sm">
                    Login Portal Staf
                </a>
            </div>
        </div>
    </header>

    {{-- Global Toast Alerts --}}
    <div class="max-w-7xl mx-auto px-6 w-full">
        @if (session('success'))
            <div class="mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="text-emerald-500 hover:text-emerald-800 p-1">✕</button>
            </div>
        @endif
        @if (session('error'))
            <div class="mt-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="text-red-500 hover:text-red-800 p-1">✕</button>
            </div>
        @endif
    </div>

    {{-- MAIN CONTENT --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- EDITORIAL FOOTER --}}
    <footer class="mt-auto border-t border-[var(--color-border)] bg-white">
        <div class="max-w-7xl mx-auto px-6 py-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <div class="space-y-4 lg:col-span-1">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-[var(--color-brand)] rounded-lg flex items-center justify-center text-white font-bold text-sm">LP</div>
                    <div>
                        <span class="font-bold text-[var(--color-text-main)] text-sm tracking-tight block">PT LAMPUNG POST</span>
                        <span class="text-[10px] text-[var(--color-text-muted)] font-semibold uppercase tracking-widest">Sejak 1965</span>
                    </div>
                </div>
                <p class="text-sm text-[var(--color-text-muted)] leading-relaxed max-w-xs">
                    Platform pemesanan dan pembayaran iklan digital resmi Lampung Post.
                </p>
                <div class="flex items-center gap-2 pt-1">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-[var(--color-bg)] text-[var(--color-text-muted)] border border-[var(--color-border)]">
                        <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        SSL Encrypted
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-[var(--color-bg)] text-[var(--color-text-muted)] border border-[var(--color-border)]">
                        <svg class="w-3 h-3 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Instan
                    </span>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] mb-4">Navigasi</p>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('landing') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition">Beranda</a></li>
                    <li><a href="{{ route('booking.step1') }}" class="text-[var(--color-brand)] font-medium hover:text-red-700 transition">Pesan Iklan</a></li>
                    <li><a href="{{ route('landing') }}#pricing" class="text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition">Tarif Iklan</a></li>
                    <li><a href="{{ route('landing') }}#how-it-works" class="text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition">Alur Pembayaran</a></li>
                    <li><a href="{{ route('public.pay.form') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition">Cek ID Tagihan</a></li>
                    <li><a href="{{ route('login') }}" class="text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition">Login Admin</a></li>
                </ul>
            </div>

            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] mb-4">Kantor Redaksi</p>
                <div class="text-sm space-y-3 text-[var(--color-text-muted)]">
                    <p class="leading-relaxed">Jl. Soekarno Hatta No. 108, Rajabasa, Bandar Lampung, Lampung 35144</p>
                    <p><span class="block text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] mb-1">Telepon</span>(0721) 783693 / 783694</p>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] mb-4">Bantuan Keuangan</p>
                <div class="text-sm space-y-3 text-[var(--color-text-muted)]">
                    <p>Butuh bantuan konfirmasi pembayaran atau kuitansi cetak?</p>
                    <p><span class="block text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] mb-1">Email Finance</span>
                        <a href="mailto:keuangan@lampungpost.co.id" class="text-[var(--color-brand)] font-medium hover:underline">keuangan@lampungpost.co.id</a>
                    </p>
                    <p><span class="block text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] mb-1">Jam Operasional</span>Senin – Jumat, 08:30 – 17:00 WIB</p>
                </div>
            </div>
        </div>

        <div class="border-t border-[var(--color-border)] py-6">
            <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-[var(--color-text-muted)]">
                <p>&copy; {{ date('Y') }} <span class="font-semibold text-[var(--color-text-main)]">PT Lampung Post</span>. Hak Cipta Dilindungi.</p>
                <div class="flex flex-wrap items-center gap-1.5">
                    <span class="mr-1 text-[11px]">Metode:</span>
                    <span class="px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)] font-semibold text-[11px]">QRIS</span>
                    <span class="px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)] font-semibold text-[11px]">BCA VA</span>
                    <span class="px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)] font-semibold text-[11px]">Mandiri VA</span>
                    <span class="px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)] font-semibold text-[11px]">BNI / BRI</span>
                    <span class="px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)] font-semibold text-[11px]">GoPay</span>
                    <span class="px-2 py-1 bg-[var(--color-bg)] rounded border border-[var(--color-border)] font-semibold text-[11px]">ShopeePay</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const hamburger = document.getElementById('hamburger-icon');
            const close = document.getElementById('close-icon');
            if (btn && menu) {
                btn.addEventListener('click', function () {
                    const isHidden = menu.classList.contains('hidden');
                    menu.classList.toggle('hidden', !isHidden);
                    hamburger.classList.toggle('hidden', isHidden);
                    close.classList.toggle('hidden', !isHidden);
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>