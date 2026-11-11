<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghubungkan ke Gateway — {{ $invoice->invoice_number }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        :root {
            --color-brand: #DC2626;
            --color-brand-light: #FEF2F2;
            --color-surface: #FFFFFF;
            --color-bg: #F8FAFC;
            --color-border: #E2E8F0;
            --color-border-hover: #CBD5E1;
            --color-text-main: #0F172A;
            --color-text-muted: #64748B;
            --font-sans: 'Manrope', system-ui, -apple-system, sans-serif;
            --font-serif: 'Newsreader', Georgia, serif;
            --shadow-ambient: 0 12px 32px -4px rgba(15, 23, 42, 0.06);
        }
        body {
            font-family: var(--font-sans);
            background-color: var(--color-bg);
            color: var(--color-text-main);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .font-editorial {
            font-family: var(--font-serif);
            letter-spacing: -0.02em;
            line-height: 1.15;
        }
        .hairline-card {
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 selection:bg-red-100 selection:text-red-900">

    <div class="max-w-md w-full text-center space-y-6">

        {{-- Brand Icon --}}
        <div class="w-14 h-14 rounded-xl bg-[var(--color-brand)] text-white font-bold text-xl flex items-center justify-center mx-auto shadow-sm">
            LP
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-editorial font-semibold text-[var(--color-text-main)] tracking-tight">
                Menghubungkan ke Payment Gateway
            </h1>
            <p class="text-xs sm:text-sm text-[var(--color-text-muted)] max-w-sm mx-auto leading-relaxed">
                Jendela pembayaran Midtrans sedang dipersiapkan untuk tagihan
                <span class="font-mono text-[var(--color-text-main)] font-bold">{{ $invoice->invoice_number }}</span>.
            </p>
        </div>

        {{-- Progress Card --}}
        <div class="hairline-card p-8 shadow-[var(--shadow-ambient)] space-y-6">
            <div class="relative w-16 h-16 mx-auto">
                <div class="w-16 h-16 rounded-full border-4 border-[var(--color-border)] border-t-[var(--color-brand)] animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center text-[var(--color-brand)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>

            <div class="space-y-1">
                <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-muted)]">Total Transaksi</p>
                <p class="text-2xl font-editorial font-semibold text-[var(--color-text-main)]">
                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                </p>
            </div>

            <div class="pt-3 border-t border-[var(--color-border)] space-y-2">
                <button type="button" id="btn-reopen-snap"
                    class="w-full bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold py-3 rounded-xl transition text-xs shadow-sm active:scale-95">
                    Buka Ulang Jendela Pembayaran
                </button>

                <a href="{{ route('public.pay.show', $invoice->invoice_number) }}"
                   class="block w-full py-2.5 text-xs text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition font-medium">
                    Batalkan & Kembali ke Tagihan
                </a>
            </div>
        </div>

        {{-- Security Guarantee --}}
        <div class="flex items-center justify-center gap-2 text-xs text-[var(--color-text-muted)]">
            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <span>Terkoneksi Aman dengan Midtrans Snap Engine</span>
        </div>

    </div>

    <script type="text/javascript">
        function triggerSnapPayment() {
            if (window.snap) {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){
                        window.location.href = "{{ route('public.pay.result', $invoice->invoice_number) }}";
                    },
                    onPending: function(result){
                        window.location.href = "{{ route('public.pay.result', $invoice->invoice_number) }}";
                    },
                    onError: function(result){
                        window.location.href = "{{ route('public.pay.show', $invoice->invoice_number) }}";
                    },
                    onClose: function(){
                        // User closed the popup manually
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            triggerSnapPayment();

            const reopenBtn = document.getElementById('btn-reopen-snap');
            if (reopenBtn) {
                reopenBtn.addEventListener('click', triggerSnapPayment);
            }
        });
    </script>
</body>
</html>