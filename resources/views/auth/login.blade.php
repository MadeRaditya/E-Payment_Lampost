@extends('layouts.auth')

@section('title', 'Masuk ke Portal Staf Keuangan')

@section('content')
<div class="bg-slate-900/90 backdrop-blur-xl border border-slate-800 rounded-3xl shadow-2xl p-7 sm:p-9 text-slate-100">
    
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-600 to-red-700 text-white font-extrabold flex items-center justify-center text-xl mx-auto mb-4 shadow-lg shadow-red-600/30">
            LP
        </div>
        <h2 class="text-2xl font-bold text-white tracking-tight">Portal Staf Keuangan</h2>
        <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">
            Masuk untuk mengelola tagihan iklan dan memantau transaksi pembayaran masuk.
        </p>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="bg-rose-950/80 border border-rose-800/80 text-rose-300 p-4 rounded-2xl mb-6 text-xs flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 text-rose-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
                <p class="font-bold text-rose-200">Gagal Masuk</p>
                <p class="mt-0.5">{{ $errors->first() }}</p>
            </div>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email Field -->
        <div>
            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">
                Alamat Email
            </label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-500 pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/></svg>
                </span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="nama@lampungpost.co.id"
                    class="w-full pl-10 pr-4 py-3 bg-slate-800/80 border border-slate-700 rounded-xl text-white placeholder:text-slate-500 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
            </div>
        </div>

        <!-- Password Field -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">
                    Kata Sandi
                </label>
            </div>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-500 pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </span>
                <input type="password" id="password-input" name="password" required
                    placeholder="••••••••"
                    class="w-full pl-10 pr-11 py-3 bg-slate-800/80 border border-slate-700 rounded-xl text-white placeholder:text-slate-500 text-sm focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300 transition" aria-label="Lihat Kata Sandi">
                    <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </button>
            </div>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between text-xs">
            <label class="flex items-center gap-2 cursor-pointer select-none text-slate-300 hover:text-white">
                <input type="checkbox" name="remember" id="remember"
                    class="w-4 h-4 rounded bg-slate-800 border-slate-700 text-red-600 focus:ring-red-500/20">
                <span>Ingat sesi masuk ini</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-red-600/30 hover:shadow-red-600/50 active:scale-95 transition-all text-sm flex items-center justify-center gap-2">
            <span>Masuk ke Dashboard</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </form>

    <!-- Security & Access Notice -->
    <div class="mt-8 pt-6 border-t border-slate-800/80 text-center space-y-2">
        <p class="text-[11px] text-slate-400">
            Akses terbatas hanya untuk staf & manajemen resmi PT Lampung Post.
        </p>
        <p class="text-[11px] text-slate-500">
            Kendala akses? Hubungi Administrator TI di <span class="text-slate-400 font-medium">it@lampungpost.co.id</span>
        </p>
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('toggle-password');
        const passInput = document.getElementById('password-input');

        if (toggleBtn && passInput) {
            toggleBtn.addEventListener('click', function () {
                const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passInput.setAttribute('type', type);
            });
        }
    });
</script>
@endpush
@endsection
