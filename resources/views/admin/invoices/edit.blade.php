@extends('layouts.admin')

@section('title', 'Edit Tagihan ' . $invoice->invoice_number)
@section('page-title', 'Perbarui Data Tagihan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Breadcrumb & Back Link -->
    <div class="flex items-center justify-between">
        <a href="{{ route('invoices.show', $invoice->id) }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Detail Tagihan</span>
        </a>
        <span class="text-xs font-mono font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-lg">
            {{ $invoice->invoice_number }}
        </span>
    </div>

    <!-- Pending Payment Alert Warning -->
    @if($invoice->payments->where('status', 'pending')->count() > 0)
        <div class="bg-amber-50 border border-amber-200/90 text-amber-900 p-5 rounded-2xl flex items-start gap-4 shadow-xs">
            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="font-bold text-sm text-amber-900">Perhatian: Transaksi Pending Terdeteksi</p>
                <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                    Tagihan ini memiliki sesi pembayaran yang masih berstatus <strong>Pending</strong> di Payment Gateway. Mengubah nominal tagihan sekarang berpotensi memicu ketidaksesuaian nominal pada token pembayaran yang sedang diproses.
                </p>
            </div>
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Section 1: Informasi Pengiklan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs shadow-sm shadow-red-600/20">
                    1
                </span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Informasi Pengiklan</h3>
                    <p class="text-xs text-slate-400">Ubah data nama atau kontak pihak pengiklan.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Pengiklan / Instansi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="advertiser_name" value="{{ old('advertiser_name', $invoice->advertiser_name) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition font-medium">
                    @error('advertiser_name')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Kontak (Email / No. WA) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="advertiser_contact" value="{{ old('advertiser_contact', $invoice->advertiser_contact) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition font-medium">
                    @error('advertiser_contact')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Slot Iklan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs shadow-sm shadow-red-600/20">
                    2
                </span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Spesifikasi Slot & Periode</h3>
                    <p class="text-xs text-slate-400">Atur penempatan posisi iklan dan waktu tayang.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Slot Iklan <span class="text-red-500">*</span>
                    </label>
                    <select name="ad_slot" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none transition font-medium text-slate-700">
                        <option value="Header Banner" {{ old('ad_slot', $invoice->ad_slot) === 'Header Banner' ? 'selected' : '' }}>Header Banner (970 × 250 px) - Premium</option>
                        <option value="Sidebar" {{ old('ad_slot', $invoice->ad_slot) === 'Sidebar' ? 'selected' : '' }}>Sidebar Banner (300 × 250 px)</option>
                        <option value="In-Article" {{ old('ad_slot', $invoice->ad_slot) === 'In-Article' ? 'selected' : '' }}>In-Article (728 × 90 px)</option>
                        <option value="Footer" {{ old('ad_slot', $invoice->ad_slot) === 'Footer' ? 'selected' : '' }}>Footer Banner</option>
                        <option value="Advertorial Koran" {{ old('ad_slot', $invoice->ad_slot) === 'Advertorial Koran' ? 'selected' : '' }}>Advertorial / Cetak Koran</option>
                        <option value="Kerja Sama Kemitraan" {{ old('ad_slot', $invoice->ad_slot) === 'Kerja Sama Kemitraan' ? 'selected' : '' }}>Paket Kerja Sama Khusus</option>
                    </select>
                    @error('ad_slot')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Durasi Penayangan (Hari) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="ad_duration_days" value="{{ old('ad_duration_days', $invoice->ad_duration_days) }}" min="1" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition font-medium">
                    @error('ad_duration_days')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Mulai Tayang <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="ad_start_date" 
                           value="{{ old('ad_start_date', $invoice->ad_start_date ? $invoice->ad_start_date->format('Y-m-d') : '') }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition font-medium">
                    @error('ad_start_date')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="description" value="{{ old('description', $invoice->description) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition font-medium">
                    @error('description')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 3: Nominal & Batas Bayar -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs shadow-sm shadow-red-600/20">
                    3
                </span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Nominal & Jatuh Tempo</h3>
                    <p class="text-xs text-slate-400">Sesuaikan nilai tagihan jika ada negosiasi atau perpanjangan tempo.</p>
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
                        <input type="number" name="amount" id="input_amount" value="{{ old('amount', (int) $invoice->amount) }}" min="1000" step="1000" required
                               class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-base font-bold text-slate-900 focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
                    </div>
                    <p id="amount_preview" class="text-xs text-slate-400 mt-1 font-semibold"></p>
                    @error('amount')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Batas Pembayaran (Jatuh Tempo) <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="due_date" 
                           value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition font-medium">
                    @error('due_date')
                        <p class="text-rose-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Audit Metadata Card -->
        <div class="bg-slate-50 rounded-2xl border border-slate-200/80 p-5 text-xs text-slate-500 grid sm:grid-cols-4 gap-4">
            <div>
                <span class="block text-slate-400 font-semibold mb-0.5">Nomor Invoice:</span>
                <span class="font-mono font-bold text-slate-800">{{ $invoice->invoice_number }}</span>
            </div>
            <div>
                <span class="block text-slate-400 font-semibold mb-0.5">Dibuat Pada:</span>
                <span class="font-semibold text-slate-800">{{ $invoice->created_at->translatedFormat('d M Y, H:i') }}</span>
            </div>
            <div>
                <span class="block text-slate-400 font-semibold mb-0.5">Status Saat Ini:</span>
                <span class="font-bold uppercase tracking-wider {{ $invoice->status === 'paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                    {{ $invoice->status }}
                </span>
            </div>
            <div>
                <span class="block text-slate-400 font-semibold mb-0.5">Dibuat Oleh:</span>
                <span class="font-semibold text-slate-800">{{ $invoice->creator->name ?? 'Admin' }}</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('invoices.show', $invoice->id) }}" 
               class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm transition">
                Batal
            </a>
            <button type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-sm shadow-lg shadow-red-600/30 active:scale-95 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Simpan Perubahan</span>
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