@extends('layouts.admin')

@section('title', 'Dashboard Keuangan')
@section('page-title', 'Dashboard Keuangan')

@section('content')
<div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-xs space-y-4">
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-red-600 text-white font-extrabold flex items-center justify-center text-lg shadow-md shadow-red-600/30">
            LP
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">Portal Keuangan PT Lampung Post</h2>
            <p class="text-xs text-slate-500">Selamat datang kembali, {{ Auth::user()->name }}!</p>
        </div>
    </div>
    <p class="text-sm text-slate-600 leading-relaxed max-w-2xl">
        Kelola seluruh transaksi penerbitan tagihan dan pemantauan pembayaran digital melalui menu di sidebar navigasi.
    </p>
    <div class="pt-4 flex items-center gap-3">
        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold text-xs rounded-xl shadow-xs transition">
            Buka Ringkasan Dashboard
        </a>
        <a href="{{ route('invoices.index') }}" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition">
            Kelola Tagihan
        </a>
    </div>
</div>
@endsection
