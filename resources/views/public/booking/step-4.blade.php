@extends('public.booking.layout', ['currentStep' => 4])

@section('title', 'Step 4 — Data & Pembayaran')

@section('content')
<form action="{{ route('booking.step4.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-1">Data Pembayar / Penanggung Jawab</h2>
                <p class="text-xs text-slate-500 mb-6">Data ini akan digunakan untuk penerbitan kuitansi resmi.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap / Perusahaan <span class="text-red-500">*</span></label>
                        <input type="text" name="billing_name" value="{{ old('billing_name', $draft->billing_name ?? $draft->advertiser_name) }}" required maxlength="150"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        @error('billing_name')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NPWP / NIK KTP <span class="text-red-500">*</span></label>
                            <input type="text" name="billing_npwp_nik" value="{{ old('billing_npwp_nik', $draft->billing_npwp_nik) }}" required maxlength="50"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                            @error('billing_npwp_nik')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="billing_email" value="{{ old('billing_email', $draft->billing_email ?? $draft->advertiser_contact) }}" required maxlength="150"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                            @error('billing_email')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                            <input type="text" name="billing_phone" value="{{ old('billing_phone', $draft->billing_phone) }}" required maxlength="30"
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                            @error('billing_phone')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea name="billing_address" rows="3" required maxlength="500"
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">{{ old('billing_address', $draft->billing_address) }}</textarea>
                        @error('billing_address')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                <h3 class="text-base font-black text-slate-900 mb-1">Preferensi Metode Pembayaran</h3>
                <p class="text-xs text-slate-500 mb-5">Anda akan tetap memilih kanal pembayaran (QRIS / VA / e-Wallet) di halaman selanjutnya.</p>

                <div class="grid sm:grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_preference" value="online" class="peer sr-only" checked>
                        <div class="border-2 border-slate-200 rounded-2xl p-5 peer-checked:border-red-600 peer-checked:bg-red-50/60 transition">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <p class="font-black text-sm text-slate-900">Bayar Online (Instan)</p>
                            </div>
                            <p class="text-[11px] text-slate-500 leading-relaxed">Bayar langsung via QRIS, Virtual Account, atau e-Wallet. Kuitansi terbit otomatis.</p>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="payment_preference" value="manual" class="peer sr-only">
                        <div class="border-2 border-slate-200 rounded-2xl p-5 peer-checked:border-red-600 peer-checked:bg-red-50/60 transition">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                </div>
                                <p class="font-black text-sm text-slate-900">Transfer Manual</p>
                            </div>
                            <p class="text-[11px] text-slate-500 leading-relaxed">Transfer ke rekening perusahaan. Verifikasi manual oleh tim keuangan.</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm sticky top-4 space-y-4">
                <h3 class="text-sm font-black text-slate-900 border-b border-slate-100 pb-3">Ringkasan Pesanan</h3>

                <div class="space-y-2.5 text-xs">
                    <div><span class="text-slate-400 block">Kategori</span><span class="font-bold text-slate-900">{{ $draft->category }} › {{ $draft->subcategory }}</span></div>
                    <div><span class="text-slate-400 block">Judul</span><span class="font-bold text-slate-900">{{ $draft->ad_title }}</span></div>
                    <div><span class="text-slate-400 block">Format</span><span class="font-bold text-slate-900">{{ config('ad_booking.formats')[$draft->ad_format]['name'] ?? '-' }}</span></div>
                    <div><span class="text-slate-400 block">Durasi</span><span class="font-bold text-slate-900">{{ $draft->ad_duration_days }} hari</span></div>
                    <div><span class="text-slate-400 block">Mulai Tayang</span><span class="font-bold text-slate-900">{{ $draft->ad_start_date?->translatedFormat('d F Y') }}</span></div>
                    @if(!empty($draft->media_files))
                        <div><span class="text-slate-400 block">Media</span><span class="font-bold text-slate-900">{{ count($draft->media_files) }} file diunggah</span></div>
                    @endif
                </div>

                <div class="border-t border-slate-100 pt-4">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wider font-bold">Total Bayar</p>
                    <p class="text-3xl font-black text-red-600 mt-1">Rp {{ number_format($draft->amount, 0, ',', '.') }}</p>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 text-[11px] text-slate-500 leading-relaxed">
                    Nomor Invoice sementara: <span class="font-mono font-bold text-slate-800">{{ $draft->invoice_number }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('booking.step3') }}" class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm">← Kembali</a>
        <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-black px-8 py-3.5 rounded-xl shadow-xl shadow-red-600/30 transition inline-flex items-center gap-2 active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Konfirmasi & Terbitkan Tagihan
        </button>
    </div>
</form>
@endsection