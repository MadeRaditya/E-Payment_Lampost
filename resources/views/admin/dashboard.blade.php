<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800 p-10">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-red-600">Dashboard Keuangan</h1>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Logout</button>
            </form>
        </div>
        <p class="text-gray-600 mb-6">Selamat datang, {{ Auth::user()->name }}!</p>

        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Menu Cepat</h2>
            <a href="/invoices/create"
                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 inline-block">Buat Tagihan Baru</a>
            <a href="/invoices"
                class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-900 inline-block ml-2">Lihat Semua
                Tagihan</a>
        </div>
    </div>
</body>

</html>
