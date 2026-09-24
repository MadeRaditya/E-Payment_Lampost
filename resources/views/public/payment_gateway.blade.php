<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Memproses Pembayaran...</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Menghubungkan ke Payment Gateway...</h2>
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto"></div>
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
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
                    alert('Anda menutup jendela pembayaran sebelum menyelesaikan transaksi.');
                    window.location.href = "{{ route('public.pay.show', $invoice->invoice_number) }}";
                }
            });
        });
    </script>
</body>
</html>