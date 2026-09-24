<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AdPay — Portal Pembayaran Iklan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased">
    <header class="border-b border-gray-100 sticky top-0 bg-white/80 backdrop-blur-sm z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg">AdPay</span>
            </a>
            <a href="{{ route('public.pay.form') }}" 
               class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                Bayar Tagihan
            </a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-gray-100 py-8 mt-16">
        <div class="max-w-6xl mx-auto px-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} AdPay. Sistem Pembayaran Iklan Digital.
        </div>
    </footer>
</body>
</html>