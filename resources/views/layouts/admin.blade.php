<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin E-Payment Lampung Post</title>

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
<body class="bg-slate-100/70 text-slate-800 antialiased selection:bg-red-500 selection:text-white">

    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- Mobile Sidebar Overlay Backdrop -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity"></div>

        <!-- Sidebar Navigation -->
        <aside id="admin-sidebar" 
            class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-900 text-slate-300 flex flex-col justify-between border-r border-slate-800 transform -translate-x-full transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static">
            
            <div>
                <!-- Brand Header -->
                <div class="h-20 flex items-center justify-between px-6 border-b border-slate-800/80 bg-slate-950/40">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center text-white font-extrabold shadow-md shadow-red-600/30">
                            LP
                        </div>
                        <div>
                            <span class="font-bold text-white text-base tracking-tight block">LAMPUNG POST</span>
                            <span class="text-[10px] text-red-400 font-semibold uppercase tracking-wider">E-Payment Admin</span>
                        </div>
                    </a>
                    <!-- Mobile Close Button -->
                    <button id="sidebar-close-btn" type="button" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Navigation Sections -->
                <div class="px-4 py-6">
                    <p class="px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Menu Utama</p>
                    <nav class="space-y-1.5">
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150
                            {{ request()->routeIs('dashboard') 
                                ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-sm shadow-red-600/30' 
                                : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('invoices.index') }}"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150
                            {{ request()->routeIs('invoices.*') 
                                ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-sm shadow-red-600/30' 
                                : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span>Manajemen Tagihan</span>
                        </a>

                        <a href="{{ route('payments.index') }}"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-150
                            {{ request()->routeIs('payments.*') 
                                ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-sm shadow-red-600/30' 
                                : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span>Riwayat Pembayaran</span>
                        </a>
                    </nav>

                    <p class="px-3 text-[11px] font-bold text-slate-400 uppercase tracking-wider mt-8 mb-2">Tautan Eksternal</p>
                    <nav class="space-y-1.5">
                        <a href="{{ route('landing') }}" target="_blank"
                            class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800/80 transition">
                            <span class="flex items-center gap-3">
                                <svg class="w-5 h-5 flex-shrink-0 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                <span>Portal Pelanggan</span>
                            </span>
                            <span class="text-[11px] bg-slate-800 px-2 py-0.5 rounded text-slate-400 font-mono">/pay</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Sidebar Bottom Info & Status -->
            <div class="p-4 border-t border-slate-800/80 bg-slate-950/40">
                <div class="bg-slate-800/80 rounded-xl p-3 border border-slate-700/50 mb-3">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                        <span class="text-xs font-semibold text-slate-200">Gateway Terhubung</span>
                    </div>
                    <p class="text-[11px] text-slate-400">Midtrans Snap Sandbox</p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400 px-1">
                    <span>E-Payment v1.0</span>
                    <span class="text-slate-400">Lampung Post</span>
                </div>
            </div>
        </aside>

        <!-- Main Body Wrapper -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Top Header Navbar -->
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8 sticky top-0 z-30 shadow-2xs">
                
                <!-- Left: Hamburger button & Page Title -->
                <div class="flex items-center gap-4">
                    <button id="sidebar-toggle-btn" type="button" class="lg:hidden p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition" aria-label="Buka Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <h1 class="text-xl font-bold text-slate-900 leading-tight">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-xs text-slate-400 hidden sm:block">Sistem Informasi Pembayaran Digital PT Lampung Post</p>
                    </div>
                </div>

                <!-- Right: Date pill, User Profile & Logout -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Date Pill -->
                    <div class="hidden md:flex items-center gap-2 bg-slate-50 border border-slate-200/80 px-3.5 py-1.5 rounded-xl text-xs font-medium text-slate-600">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                    </div>

                    <!-- Divider -->
                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                    <!-- User Pill & Logout -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-red-700 text-white flex items-center justify-center font-bold text-sm shadow-xs">
                                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                            </div>
                            <div class="hidden sm:block text-left">
                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ Auth::user()->name ?? 'Admin Finance' }}</p>
                                <span class="text-[11px] font-semibold text-red-600 bg-red-50 px-2 py-0.5 rounded-md border border-red-100">
                                    Tim Keuangan
                                </span>
                            </div>
                        </div>

                        <!-- Logout Form -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" 
                                onclick="return confirm('Apakah Anda yakin ingin logout dari sistem?')"
                                class="p-2.5 rounded-xl text-slate-400 hover:text-red-600 hover:bg-red-50 transition border border-transparent hover:border-red-100" 
                                title="Logout dari Sistem">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Notification Messages -->
            <div class="px-4 sm:px-6 lg:px-8 max-w-7xl w-full mx-auto">
                @if (session('success'))
                    <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center justify-between shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-900">Operasi Berhasil</p>
                                <p class="text-xs text-emerald-700">{{ session('success') }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 p-1 text-sm font-bold">✕</button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mt-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 flex items-center justify-between shadow-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-rose-900">Terjadi Kesalahan</p>
                                <p class="text-xs text-rose-700">{{ session('error') }}</p>
                            </div>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 p-1 text-sm font-bold">✕</button>
                    </div>
                @endif
            </div>

            <!-- Page Content Body -->
            <main class="flex-1 p-4 sm:px-6 lg:px-8 py-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Vanilla Script for Sidebar Interaction -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            const closeBtn = document.getElementById('sidebar-close-btn');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            function openSidebar() {
                if (sidebar) sidebar.classList.remove('-translate-x-full');
                if (overlay) overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                if (sidebar) sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', openSidebar);
            if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
            if (overlay) overlay.addEventListener('click', closeSidebar);
        });
    </script>
    @stack('scripts')
</body>
</html>
