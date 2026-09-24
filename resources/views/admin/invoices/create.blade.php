@extends('layouts.admin')

@section('title', 'Buat Tagihan')
@section('page-title', 'Buat Tagihan Baru')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('invoices.index') }}" class="text-sm text-gray-500 hover:text-red-600">← Kembali ke daftar tagihan</a>
    </div>

    <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4 flex items-center gap-2">
                <span class="w-6 h-6 bg-red-50 text-red-600 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                Informasi Pengiklan
            </h2>
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pengiklan <span class="text-red-500">*</span></label>
                    <input type="text" name="advertiser_name" value="{{ old('advertiser_name') }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none">
                    @error('advertiser_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kontak (Email/WA) <span class="text-red-500">*</span></label>
                    <input type="text" name="advertiser_contact" value="{{ old('advertiser_contact') }}" required
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
                        <option value="Sidebar" {{ old('ad_slot') === 'Sidebar' ? 'selected' : '' }}>Sidebar (300×250)</option>
                        <option value="Header Banner" {{ old('ad_slot') === 'Header Banner' ? 'selected' : '' }}>Header Banner (970×250)</option>
                        <option value="In-Article" {{ old('ad_slot') === 'In-Article' ? 'selected' : '' }}>In-Article (728×90)</option>
                        <option value="Footer" {{ old('ad_slot') === 'Footer' ? 'selected' : '' }}>Footer</option>
                    </select>
                    @error('ad_slot')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="ad_duration_days" value="{{ old('ad_duration_days', 7) }}" required min="1"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('ad_duration_days')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mulai Tayang <span class="text-red-500">*</span></label>
                    <input type="date" name="ad_start_date" value="{{ old('ad_start_date') }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('ad_start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat <span class="text-red-500">*</span></label>
                    <input type="text" name="description" value="{{ old('description') }}" required placeholder="cth: Banner promo produk A"
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
                    <input type="number" name="amount" value="{{ old('amount') }}" required min="1000"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('amount')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Batas Pembayaran <span class="text-red-500">*</span></label>
                    <input type="date" name="due_date" value="{{ old('due_date', now()->addDays(7)->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('due_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" 
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2.5 rounded-lg transition shadow-sm">
                Simpan & Buat Tagihan
            </button>
            <a href="{{ route('invoices.index') }}" class="text-gray-600 hover:text-gray-800 font-medium px-4 py-2.5">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection