@extends('layouts.admin')

@section('title', 'Buat Tagihan Baru')
@section('page-title', 'Penerbitan Tagihan Iklan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Back Navigation Breadcrumb -->
    <div class="flex items-center justify-between">
        <a href="{{ route('invoices.index') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Daftar Tagihan</span>
        </a>
        <span class="text-xs text-slate-400 font-mono">Format Otomatis: INV-YYYYMMDD-XXXX</span>
    </div>

    <!-- Main Form -->
    <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Section 1: Informasi Pengiklan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs shadow-sm shadow-red-600/20">
                    1
                </span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Informasi Pengiklan / Mitra</h3>
                    <p class="text-xs text-slate-400">Data lengkap instansi, perusahaan, atau perorangan yang memesan iklan.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Pengiklan / Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="advertiser_name" id="input_advertiser" value="{{ old('advertiser_name') }}" required
                           placeholder="cth: PT Maju Jaya Bersama"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    @error('advertiser_name')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kontak Email / No. WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="advertiser_contact" value="{{ old('advertiser_contact') }}" required
                           placeholder="cth: finance@majujaya.com / 0812-3456-7890"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    @error('advertiser_contact')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Detail Slot Iklan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs shadow-sm shadow-red-600/20">
                    2
                </span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Spesifikasi & Penayangan Slot Iklan</h3>
                    <p class="text-xs text-slate-400">Pilih posisi penayangan iklan dan durasi tayang yang disepakati.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Pilihan Slot Iklan <span class="text-red-500">*</span>
                    </label>
                    <select name="ad_slot" id="select_ad_slot" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none transition font-medium text-slate-700">
                        <option value="">-- Pilih Posisi Slot Iklan --</option>
                        <option value="Header Banner" {{ old('ad_slot') === 'Header Banner' ? 'selected' : '' }}>Header Banner (970 × 250 px) - Premium</option>
                        <option value="Sidebar" {{ old('ad_slot') === 'Sidebar' ? 'selected' : '' }}>Sidebar Banner (300 × 250 px)</option>
                        <option value="In-Article" {{ old('ad_slot') === 'In-Article' ? 'selected' : '' }}>In-Article (728 × 90 px)</option>
                        <option value="Footer" {{ old('ad_slot') === 'Footer' ? 'selected' : '' }}>Footer Banner</option>
                        <option value="Advertorial Koran" {{ old('ad_slot') === 'Advertorial Koran' ? 'selected' : '' }}>Advertorial / Cetak Koran</option>
                        <option value="Kerja Sama Kemitraan" {{ old('ad_slot') === 'Kerja Sama Kemitraan' ? 'selected' : '' }}>Paket Kerja Sama Khusus</option>
                    </select>
                    @error('ad_slot')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Durasi Penayangan (Hari) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="ad_duration_days" value="{{ old('ad_duration_days', 7) }}" min="1" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    @error('ad_duration_days')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Mulai Tayang <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="ad_start_date" value="{{ old('ad_start_date', date('Y-m-d')) }}" required min="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    @error('ad_start_date')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Keterangan / Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="description" value="{{ old('description') }}" required
                           placeholder="cth: Penayangan banner promo produk peluncuran baru"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    @error('description')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 3: Nominal & Jatuh Tempo -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs shadow-sm shadow-red-600/20">
                    3
                </span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Ketentuan Pembayaran & Jatuh Tempo</h3>
                    <p class="text-xs text-slate-400">Tentukan nilai nominal bersih tagihan dan batas akhir penyelesaian transaksi.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nominal Tagihan (IDR) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center font-bold text-slate-500 text-sm">
                            Rp
                        </span>
                        <input type="number" name="amount" id="input_amount" value="{{ old('amount', 500000) }}" min="1000" step="1000" required
                               placeholder="500000"
                               class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-base font-bold text-slate-900 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    </div>
                    <p id="amount_preview" class="text-xs text-slate-400 mt-1 font-semibold">Rp 500.000</p>
                    @error('amount')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Batas Akhir Pembayaran (Jatuh Tempo) <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="due_date" value="{{ old('due_date', now()->addDays(7)->format('Y-m-d')) }}" required min="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    <p class="text-xs text-slate-400 mt-1">Default 7 hari dari hari ini.</p>
                    @error('due_date')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('invoices.index') }}" 
               class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm transition">
                Batalkan
            </a>
            <button type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-sm shadow-lg shadow-red-600/30 active:scale-95 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Terbitkan & Simpan Tagihan</span>
            </button>
        </div>
    </form>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountInput = document.getElementById('input_amount');
        const previewEl = document.getElementById('amount_preview');

        function updatePreview() {
            const val = parseFloat(amountInput.value) || 0;
            previewEl.textContent = 'Terbaca: Rp ' + new Intl.NumberFormat('id-ID').format(val);
        }

        if (amountInput && previewEl) {
            amountInput.addEventListener('input', updatePreview);
            updatePreview();
        }
    });
</script>
@endpush
@endsection