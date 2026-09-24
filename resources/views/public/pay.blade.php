@extends('layouts.public')

@section('title', 'Bayar Tagihan')

@section('content')
<section class="max-w-lg mx-auto px-4 py-16 lg:py-24">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Bayar Tagihan Iklan</h1>
        <p class="text-gray-500">Masukkan ID Tagihan yang Anda terima</p>
    </div>

    <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-8">
        @if(session('error'))
            <div class="bg-red-50 border border-red-100 text-red-700 p-3 rounded-lg mb-5 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('public.pay.check') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">ID Tagihan</label>
                <input type="text" name="invoice_number" value="{{ old('invoice_number') }}" required autofocus
                    placeholder="Contoh: INV-20260924-AB12"
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none text-center font-mono tracking-wider">
                @error('invoice_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition shadow-sm">
                Cari Tagihan
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-gray-100">
            <p class="text-xs text-gray-500 text-center">
                Belum menerima ID Tagihan? Hubungi tim keuangan kami di 
                <a href="mailto:finance@company.com" class="text-red-600 hover:underline">finance@company.com</a>
            </p>
        </div>
    </div>
</section>
@endsection