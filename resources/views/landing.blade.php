@extends('layouts.public')

@section('title', 'AdPay — Sewa Slot Iklan di Portal Berita Kami')

@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <span class="inline-block bg-red-50 text-red-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                SLOT IKLAN TERSEDIA
            </span>
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight text-gray-900 mb-6">
                Jangkau Pembaca Kami dengan <span class="text-red-600">Slot Iklan Premium</span>
            </h1>
            <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                Promosikan bisnis Anda di portal berita kami. Proses pemesanan mudah, pembayaran aman, 
                dan iklan Anda tayang dalam hitungan menit.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('public.pay.form') }}" 
                   class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg transition shadow-md">
                    Bayar Tagihan Iklan
                </a>
                <a href="#pricing" 
                   class="border border-gray-300 hover:border-red-600 hover:text-red-600 text-gray-700 font-medium px-6 py-3 rounded-lg transition">
                    Lihat Pilihan Slot
                </a>
            </div>
        </div>
        <div class="hidden lg:block">
            <div class="bg-gradient-to-br from-red-500 to-red-700 rounded-2xl p-8 text-white shadow-xl">
                <p class="text-sm opacity-80 mb-2">Total Pengiklan Aktif</p>
                <p class="text-5xl font-bold mb-6">{{ $stats['advertisers'] }}+</p>
                <div class="border-t border-white/20 pt-6">
                    <p class="text-sm opacity-80 mb-1">Slot Tersedia Bulan Ini</p>
                    <p class="text-2xl font-semibold">{{ $stats['slots_available'] }} slot</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="pricing" class="bg-gray-50 py-16 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Pilihan Slot Iklan</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Pilih posisi iklan yang paling sesuai dengan target audiens Anda</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:border-red-500 hover:shadow-lg transition">
                <h3 class="font-bold text-lg mb-2">Sidebar</h3>
                <p class="text-sm text-gray-500 mb-4">Iklan di sisi kanan halaman</p>
                <p class="text-3xl font-bold text-red-600 mb-1">Rp 500.000</p>
                <p class="text-xs text-gray-500 mb-6">/ 7 hari tayang</p>
                <ul class="space-y-2 text-sm text-gray-600 mb-6">
                    <li class="flex items-center gap-2">✓ Dimensi 300×250px</li>
                    <li class="flex items-center gap-2">✓ Semua halaman artikel</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl p-6 border-2 border-red-600 shadow-lg relative">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    POPULER
                </span>
                <h3 class="font-bold text-lg mb-2">Header Banner</h3>
                <p class="text-sm text-gray-500 mb-4">Iklan utama di bagian atas</p>
                <p class="text-3xl font-bold text-red-600 mb-1">Rp 1.500.000</p>
                <p class="text-xs text-gray-500 mb-6">/ 14 hari tayang</p>
                <ul class="space-y-2 text-sm text-gray-600 mb-6">
                    <li class="flex items-center gap-2">✓ Dimensi 970×250px</li>
                    <li class="flex items-center gap-2">✓ Homepage & artikel</li>
                    <li class="flex items-center gap-2">✓ Prioritas tayang</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl p-6 border border-gray-200 hover:border-red-500 hover:shadow-lg transition">
                <h3 class="font-bold text-lg mb-2">In-Article</h3>
                <p class="text-sm text-gray-500 mb-4">Iklan di tengah artikel</p>
                <p class="text-3xl font-bold text-red-600 mb-1">Rp 800.000</p>
                <p class="text-xs text-gray-500 mb-6">/ 10 hari tayang</p>
                <ul class="space-y-2 text-sm text-gray-600 mb-6">
                    <li class="flex items-center gap-2">✓ Dimensi 728×90px</li>
                    <li class="flex items-center gap-2">✓ Insert dalam artikel</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto px-4 py-16">
    <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 lg:p-12 text-center text-white">
        <h2 class="text-2xl lg:text-3xl font-bold mb-4">Sudah Dapat ID Tagihan?</h2>
        <p class="opacity-90 mb-6 max-w-xl mx-auto">
            Selesaikan pembayaran Anda sekarang dengan memasukkan ID Tagihan yang telah kami kirimkan.
        </p>
        <a href="{{ route('public.pay.form') }}" 
           class="inline-block bg-white text-red-600 font-semibold px-8 py-3 rounded-lg hover:bg-gray-100 transition">
            Bayar Sekarang
        </a>
    </div>
</section>
@endsection