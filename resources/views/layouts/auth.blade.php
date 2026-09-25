<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Login Staf') — E-Payment PT Lampung Post</title>

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
<body class="bg-slate-900 text-slate-100 antialiased min-h-screen flex flex-col justify-between selection:bg-red-500 selection:text-white relative overflow-x-hidden">

    <!-- Ambient Gradient Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-red-600/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-red-900/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] bg-slate-800/40 rounded-full blur-3xl"></div>
    </div>

    <!-- Top Bar with Return to Public Link -->
    <header class="relative z-10 px-6 py-6 max-w-7xl mx-auto w-full flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center text-white font-extrabold shadow-md shadow-red-600/30 group-hover:scale-105 transition-transform">
                LP
            </div>
            <div>
                <span class="font-extrabold text-white tracking-tight text-base block group-hover:text-red-400 transition">LAMPUNG POST</span>
                <span class="text-[11px] text-slate-400 font-medium">E-Payment Internal Portal</span>
            </div>
        </a>

        <a href="{{ route('landing') }}" class="text-xs font-semibold text-slate-400 hover:text-white flex items-center gap-1.5 transition bg-slate-800/60 hover:bg-slate-800 px-3.5 py-2 rounded-lg border border-slate-700/60 backdrop-blur-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Portal Publik
        </a>
    </header>

    <!-- Center Card Container -->
    <main class="relative z-10 flex-1 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>

    <!-- Footer Security Notice -->
    <footer class="relative z-10 py-6 text-center text-xs text-slate-400 max-w-7xl mx-auto w-full px-4 border-t border-slate-800/60 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p>&copy; {{ date('Y') }} PT Lampung Post. All rights reserved.</p>
        <div class="flex items-center gap-3 text-[11px] text-slate-400">
            <span class="inline-flex items-center gap-1">
                <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Akses Terproteksi & Terenkripsi
            </span>
            <span>•</span>
            <span>Divisi Keuangan & TI</span>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>