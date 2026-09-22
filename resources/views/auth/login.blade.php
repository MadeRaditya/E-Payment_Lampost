@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-8">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Masuk ke Akun</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat Saya</label>
            </div>

            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2.5 rounded-lg transition duration-200 shadow-md">
                Login
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="/register" class="text-red-600 font-semibold hover:underline">Daftar Sekarang</a>
        </p>
    </div>
@endsection
