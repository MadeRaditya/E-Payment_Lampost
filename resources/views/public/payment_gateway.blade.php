<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghubungkan ke Gateway — {{ $invoice->invoice_number }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4 selection:bg-red-500 selection:text-white">

    <div class="max-w-md w-full text-center space-y-6">
        
        <!-- Brand Icon -->
        <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-red-600 to-red-700 text-white font-extrabold text-2xl flex items-center justify-center mx-auto shadow-xl shadow-red-600/30">
            LP
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-bold text-white tracking-tight">Menghubungkan ke Payment Gateway</h1>
            <p class="text-xs sm:text-sm text-slate-400 max-w-sm mx-auto leading-relaxed">
                Jendela pembayaran Midtrans sedang dipersiapkan untuk tagihan <span class="font-mono text-slate-200 font-bold">{{ $invoice->invoice_number }}</span>.
            </p>
        </div>

        <!-- Animated Progress Card -->
        <div class="bg-slate-800/80 backdrop-blur-xl border border-slate-700/80 rounded-3xl p-8 shadow-2xl space-y-6">
            <div class="relative w-16 h-16 mx-auto">
                <div class="w-16 h-16 rounded-full border-4 border-slate-700 border-t-red-500 animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center text-red-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
            </div>

            <div class="space-y-1">
                <p class="text-xs font-semibold text-slate-300">Total Transaksi:</p>
                <p class="text-2xl font-black text-white">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</p>
            </div>

            <div class="pt-2 border-t border-slate-700/60 space-y-2">
                <button type="button" id="btn-reopen-snap"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition text-xs shadow-md shadow-red-600/20">
                    Buka Ulang Jendela Pembayaran
                </button>

                <a href="{{ route('public.pay.show', $invoice->invoice_number) }}"
                   class="block w-full py-2.5 text-xs text-slate-400 hover:text-white transition font-medium">
                    Batalkan & Kembali ke Tagihan
                </a>
            </div>
        </div>

        <!-- Security Guarantee -->
        <div class="flex items-center justify-center gap-2 text-xs text-slate-500">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
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