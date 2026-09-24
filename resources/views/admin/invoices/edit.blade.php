@extends('layouts.admin')

@section('title', 'Edit Tagihan')
@section('page-title', 'Edit Tagihan')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('invoices.show', $invoice->id) }}" class="text-sm text-gray-500 hover:text-red-600">← Kembali ke detail tagihan</a>
    </div>

    @if($invoice->payments->where('status', 'pending')->count() > 0)
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg mb-6 flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <div>
                <p class="font-semibold text-sm">Perhatian!</p>
                <p class="text-sm">Tagihan ini memiliki pembayaran yang masih <strong>pending</strong>. Mengubah nominal dapat menyebabkan ketidaksesuaian dengan transaksi di payment gateway.</p>
            </div>
        </div>
    @endif

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="w-6 h-6 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                Informasi Pengiklan
            </h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengiklan <span class="text-red-500">*</span></label>
                    <input type="text" name="advertiser_name" value="{{ old('advertiser_name', $invoice->advertiser_name) }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                    @error('advertiser_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kontak (Email/WA) <span class="text-red-500">*</span></label>
                    <input type="text" name="advertiser_contact" value="{{ old('advertiser_contact', $invoice->advertiser_contact) }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                    @error('advertiser_contact')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="w-6 h-6 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                Detail Slot Iklan
            </h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Slot Iklan <span class="text-red-500">*</span></label>
                    <select name="ad_slot" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                        <option value="">Pilih Slot</option>
                        <option value="Sidebar" {{ old('ad_slot', $invoice->ad_slot) === 'Sidebar' ? 'selected' : '' }}>Sidebar (300×250)</option>
                        <option value="Header Banner" {{ old('ad_slot', $invoice->ad_slot) === 'Header Banner' ? 'selected' : '' }}>Header Banner (970×250)</option>
                        <option value="In-Article" {{ old('ad_slot', $invoice->ad_slot) === 'In-Article' ? 'selected' : '' }}>In-Article (728×90)</option>
                        <option value="Footer" {{ old('ad_slot', $invoice->ad_slot) === 'Footer' ? 'selected' : '' }}>Footer</option>
                    </select>
                    @error('ad_slot')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="ad_duration_days" value="{{ old('ad_duration_days', $invoice->ad_duration_days) }}" required min="1"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('ad_duration_days')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mulai Tayang <span class="text-red-500">*</span></label>
                    <input type="date" name="ad_start_date" 
                        value="{{ old('ad_start_date', $invoice->ad_start_date ? $invoice->ad_start_date->format('Y-m-d') : '') }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('ad_start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <input type="text" name="description" value="{{ old('description', $invoice->description) }}" required 
                        placeholder="cth: Banner promo produk A"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="w-6 h-6 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                Detail Pembayaran
            </h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="amount" value="{{ old('amount', (int) $invoice->amount) }}" required min="1000"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('amount')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batas Pembayaran <span class="text-red-500">*</span></label>
                    <input type="date" name="due_date" 
                        value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('due_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-xl border border-gray-100 p-4">
            <div class="grid sm:grid-cols-2 gap-3 text-xs">
                <div>
                    <span class="text-gray-500">ID Tagihan:</span>
                    <span class="font-mono font-semibold ml-1">{{ $invoice->invoice_number }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Dibuat:</span>
                    <span class="font-semibold ml-1">{{ $invoice->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Status saat ini:</span>
                    <span class="font-semibold ml-1">{{ ucfirst($invoice->status) }}</span>
                </div>
                <div>
                    <span class="text-gray-500">Dibuat oleh:</span>
                    <span class="font-semibold ml-1">{{ $invoice->creator->name ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg transition shadow-sm">
                Simpan Perubahan
            </button>
            <a href="{{ route('invoices.show', $invoice->id) }}" class="text-gray-600 hover:text-gray-800 font-medium px-4 py-2.5">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection