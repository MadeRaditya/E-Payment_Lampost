<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Tagihan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-red-600">E-Payment</h1>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 text-center">Konfirmasi Pembayaran</h2>
                
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">ID Tagihan</span>
                        <span class="font-semibold">{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Deskripsi</span>
                        <span class="font-semibold text-right">{{ $invoice->description }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-2">
                        <span class="text-gray-500">Jatuh Tempo</span>
                        <span class="font-semibold">{{ $invoice->due_date->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between pt-2">
                        <span class="text-gray-500 font-bold">Total Bayar</span>
                        <span class="font-bold text-red-600 text-xl">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <form action="{{ route('public.pay.process', $invoice->invoice_number) }}" method="POST">
                    @csrf
                    <button type="submit" 
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md">
                        Bayar Sekarang
                    </button>
                </form>
                
                <p class="mt-4 text-center text-sm text-gray-500">
                    Anda akan diarahkan ke halaman pembayaran yang aman.
                </p>
            </div>
        </div>
    </div>
</body>
</html>