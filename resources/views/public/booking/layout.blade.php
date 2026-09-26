<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pemesanan Iklan — PT Lampung Post')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .step-active   { @apply bg-red-600 text-white border-red-600; }
        .step-done     { @apply bg-emerald-500 text-white border-emerald-500; }
        .step-inactive { @apply bg-white text-slate-400 border-slate-300; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

    <div class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center">LP</div>
                <div>
                    <p class="text-sm font-black text-slate-900 leading-none">LAMPUNG POST</p>
                    <p class="text-[11px] text-slate-500">Pemesanan Iklan Online</p>
                </div>
            </a>
            <a href="{{ route('landing') }}" class="text-xs text-slate-500 hover:text-red-600 font-semibold">← Kembali ke Beranda</a>
        </div>
    </div>

    <div class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 py-6">
            @php $current = $currentStep ?? 1; @endphp
            <div class="flex items-center justify-between">
                @foreach([
                    1 => 'Kategori & Format',
                    2 => 'Isi & Jadwal Iklan',
                    3 => 'Unggah Media',
                    4 => 'Data & Pembayaran',
                ] as $num => $label)
                    @php
                        $class = $num < $current ? 'step-done' : ($num === $current ? 'step-active' : 'step-inactive');
                    @endphp
                    <div class="flex-1 flex flex-col items-center relative">
                        <div class="w-9 h-9 rounded-full border-2 flex items-center justify-center font-bold text-sm {{ $class }}">
                            @if($num < $current)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @else
                                {{ $num }}
                            @endif
                        </div>
                        <p class="text-[10px] sm:text-xs font-semibold mt-2 text-center {{ $num === $current ? 'text-red-600' : 'text-slate-400' }}">
                            {{ $label }}
                        </p>
                        @if($num < 4)
                            <div class="hidden sm:block absolute top-4 left-1/2 w-full h-0.5 {{ $num < $current ? 'bg-emerald-500' : 'bg-slate-200' }}"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 py-8">
        @if(session('error'))
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl text-sm">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>