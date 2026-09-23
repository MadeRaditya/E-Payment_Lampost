<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Online</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800 antialiased">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-red-600">E-Payment</h1>
                <p class="text-gray-500 mt-2">Masukkan ID Tagihan Anda</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
                @if (session('error'))
                    <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('public.pay.check') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID Tagihan / Invoice Number</label>
                        <input type="text" name="invoice_number" required autofocus
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition"
                            placeholder="Contoh: INV-2026-0001">
                    </div>
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md">
                        Cari Tagihan
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
