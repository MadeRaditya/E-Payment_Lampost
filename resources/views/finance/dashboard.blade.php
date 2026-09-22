<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Finance Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800 p-10">
    <h1 class="text-3xl font-bold text-red-600">Dashboard Keuangan</h1>
    <p class="mt-2 text-gray-600">Selamat datang, {{ Auth::user()->name }}!</p>

    <form action="/logout" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Logout</button>
    </form>
</body>

</html>
