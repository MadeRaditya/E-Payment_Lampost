<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pemesanan Iklan — PT Lampung Post')</title>

    <!-- High-Craft Typography: Newsreader (Editorial Serif) & Manrope (Clean Geometric Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

    <style>
        /* CSS Variables for Strict Consistency */
        :root {
            --color-brand: #DC2626; /* Sharp Red */
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

        /* Typography Scale */
        h1, h2, h3, .font-editorial {
            font-family: var(--font-serif);
            letter-spacing: -0.02em;
            line-height: 1.15;
        }

        /* Surface Treatments */
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

        /* Forms & Inputs */
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

        /* Custom Radio Card Logic */
        .radio-peer:checked + .radio-card {
            border-color: var(--color-brand);
            background-color: var(--color-brand-light);
            box-shadow: 0 0 0 1px var(--color-brand);
        }
        .radio-peer:checked + .radio-card .check-icon {
            opacity: 1;
            transform: scale(1);
        }

        @keyframes staggerFade {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="min-h-screen selection:bg-red-100 selection:text-red-900 flex flex-col">

    @php
        $current = max(1, min(4, (int) ($currentStep ?? 1)));
        $steps = [
            1 => ['label' => 'Kategori & Format', 'desc' => 'Tentukan posisi ruang iklan'],
            2 => ['label' => 'Materi & Jadwal', 'desc' => 'Isi teks dan durasi tayang'],
            3 => ['label' => 'Unggah Aset', 'desc' => 'Grafis atau dokumen pendukung'],
            4 => ['label' => 'Penyelesaian', 'desc' => 'Verifikasi dan pembayaran'],
        ];
    @endphp

    {{-- TOP NAVBAR --}}
    <header class="sticky top-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <div class="w-8 h-8 rounded-lg bg-[var(--color-brand)] text-white flex items-center justify-center font-bold text-sm transition-transform group-hover:scale-105">
                    LP
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold tracking-tight text-[var(--color-text-main)] leading-none">LAMPUNG POST</span>
                    <span class="text-[10px] font-semibold tracking-widest text-[var(--color-text-muted)] mt-1 uppercase">Pemesanan Iklan</span>
                </div>
            </a>

            <a href="{{ route('landing') }}" class="text-sm font-medium text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition-colors inline-flex items-center gap-2">
                <span>Batal & Kembali</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </a>
        </div>
    </header>

    {{-- MAIN LAYOUT: SPLIT GRID --}}
    <div class="flex-1 max-w-7xl mx-auto px-6 w-full py-10 lg:py-16 grid grid-cols-1 lg:grid-cols-[280px_1fr] gap-12 lg:gap-20">
        
        {{-- SIDEBAR: PROGRESS STEPPER (Desktop) --}}
        <aside class="hidden lg:block relative">
            <div class="sticky top-32">
                <h3 class="text-xs font-bold uppercase tracking-widest text-[var(--color-text-muted)] mb-8">Progress Pemesanan</h3>
                <nav class="relative">
                    <!-- Tracking Line -->
                    <div class="absolute left-[11px] top-2 bottom-6 w-[2px] bg-[var(--color-border)] z-0"></div>
                    
                    <ul class="space-y-8 relative z-10">
                        @foreach ($steps as $num => $step)
                            @php
                                $isDone = $num < $current;
                                $isActive = $num === $current;
                            @endphp
                            <li class="flex gap-5">
                                <div class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 border-2 transition-all bg-[var(--color-bg)]
                                    {{ $isActive ? 'border-[var(--color-brand)] ring-4 ring-[var(--color-brand-light)]' : ($isDone ? 'border-[var(--color-brand)] bg-[var(--color-brand)]' : 'border-[var(--color-border-hover)]') }}">
                                    @if ($isDone)
                                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <span class="text-[10px] font-bold {{ $isActive ? 'text-[var(--color-brand)]' : 'text-[var(--color-text-muted)]' }}">{{ $num }}</span>
                                    @endif
                                </div>
                                <div class="-mt-1">
                                    <p class="text-sm font-bold {{ $isActive ? 'text-[var(--color-text-main)]' : 'text-[var(--color-text-muted)]' }}">{{ $step['label'] }}</p>
                                    <p class="text-xs text-[var(--color-text-muted)] mt-1 leading-relaxed">{{ $step['desc'] }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </aside>

        {{-- MOBILE COMPACT STEPPER --}}
        <div class="lg:hidden mb-4">
            <p class="text-xs font-bold tracking-widest text-[var(--color-brand)] uppercase mb-2">Tahap {{ $current }} dari 4</p>
            <h1 class="text-2xl font-editorial text-[var(--color-text-main)]">{{ $steps[$current]['label'] }}</h1>
            <!-- Hairline Progress Bar -->
            <div class="w-full h-1 bg-[var(--color-border)] rounded-full mt-4 overflow-hidden">
                <div class="h-full bg-[var(--color-brand)] transition-all duration-500 ease-out" style="width: {{ ($current / 4) * 100 }}%"></div>
            </div>
        </div>

        {{-- MAIN CONTENT AREA --}}
        <main class="min-w-0">
            @if (session('error'))
                <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-xl text-red-800 flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- FOOTER --}}
    <footer class="mt-auto py-6 border-t border-[var(--color-border)] text-center">
        <p class="text-[11px] font-medium text-[var(--color-text-muted)]">&copy; {{ date('Y') }} PT Lampung Post. Secured Booking Portal.</p>
    </footer>

    @stack('scripts')
</body>
</html>