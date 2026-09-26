@extends('layouts.admin')

@section('title', 'Buat Tagihan Baru')
@section('page-title', 'Penerbitan Tagihan Iklan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Breadcrumb -->
    <div class="flex items-center justify-between">
        <a href="{{ route('invoices.index') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Daftar Tagihan</span>
        </a>
        <span class="text-xs text-slate-400 font-mono">Format Otomatis: INV-YYYYMMDD-XXXX</span>
    </div>

    <form action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl text-xs">
                <p class="font-bold mb-1">Periksa kembali input Anda:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        <!-- Section 1: Konten Iklan -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs">1</span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Konten Iklan</h3>
                    <p class="text-xs text-slate-400">Kategori, judul, format, dan teks iklan.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori</label>
                    <select name="category" id="create_category" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(config('ad_booking.categories') as $cat => $subs)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sub-Kategori</label>
                    <select name="subcategory" id="create_subcategory" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="">-- Pilih Kategori Dahulu --</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Iklan</label>
                    <input type="text" name="ad_title" value="{{ old('ad_title') }}" maxlength="150"
                           placeholder="cth: Rumah 2 Lantai Strategis di Pusat Kota"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Format Iklan</label>
                    <select name="ad_format" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="">-- Pilih Format --</option>
                        @foreach(config('ad_booking.formats') as $key => $f)
                            <option value="{{ $key }}" {{ old('ad_format') === $key ? 'selected' : '' }}>
                                {{ $f['name'] }} — {{ $f['size'] }} (Mulai Rp {{ number_format($f['base_price'], 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teks / Isi Iklan</label>
                    <textarea name="ad_text" rows="4" maxlength="2000"
                              placeholder="Detail iklan, spesifikasi, kontak, dll."
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">{{ old('ad_text') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 2: Jadwal & Harga -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs">2</span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Jadwal & Nominal</h3>
                    <p class="text-xs text-slate-400">Atur tanggal tayang, durasi, dan harga tagihan.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mulai Tayang <span class="text-red-500">*</span></label>
                    <input type="date" name="ad_start_date" value="{{ old('ad_start_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Durasi (Hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="ad_duration_days" value="{{ old('ad_duration_days', 7) }}" min="1" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nominal Tagihan (IDR) <span class="text-red-500">*</span></label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center font-bold text-slate-500 text-sm">Rp</span>
                            <input type="text" id="amount_display" inputmode="numeric"
                                value="{{ old('amount', 500000) }}"
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-base font-black text-slate-900 focus:bg-white focus:border-red-500 outline-none tracking-wide">
                            <input type="hidden" name="amount" id="amount_raw" value="{{ old('amount', 500000) }}">
                        </div>
                        <button type="button" id="btn_autocalc"
                                class="px-4 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition inline-flex items-center justify-center gap-2 shadow-xs whitespace-nowrap">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Hitung Otomatis</span>
                        </button>
                    </div>
                    <div class="mt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                        <p class="text-xs text-slate-400" id="amount_preview">Terbaca: Rp 500.000</p>
                        <p id="autocalc_note" class="text-xs font-semibold text-emerald-600 hidden items-center gap-1">
                            <svg class="w-3.5 h-3.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Nominal dihitung otomatis dari Format × Durasi
                        </p>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jatuh Tempo <span class="text-red-500">*</span></label>
                    <input type="date" name="due_date" value="{{ old('due_date', now()->addDays(7)->format('Y-m-d')) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Singkat (opsional)</label>
                    <input type="text" name="description" value="{{ old('description') }}" maxlength="500"
                           placeholder="cth: Penayangan banner promo produk peluncuran baru"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
            </div>
        </div>

        <!-- Section 3: Data Pembayar -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs">3</span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Data Pembayar</h3>
                    <p class="text-xs text-slate-400">Informasi penanggung jawab & perpajakan.</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama / Perusahaan <span class="text-red-500">*</span></label>
                    <input type="text" name="billing_name" value="{{ old('billing_name') }}" required maxlength="150"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NPWP / NIK</label>
                    <input type="text" name="billing_npwp_nik" value="{{ old('billing_npwp_nik') }}" maxlength="50"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="billing_email" value="{{ old('billing_email') }}" maxlength="150"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Telepon / WhatsApp</label>
                    <input type="text" name="billing_phone" value="{{ old('billing_phone') }}" maxlength="30"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Preferensi Pembayaran</label>
                    <select name="payment_preference" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="online" {{ old('payment_preference', 'online') === 'online' ? 'selected' : '' }}>Bayar Online (Midtrans)</option>
                        <option value="manual" {{ old('payment_preference') === 'manual' ? 'selected' : '' }}>Transfer Manual</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                    <textarea name="billing_address" rows="2" maxlength="500"
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">{{ old('billing_address') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Section 4: Media Upload -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs">4</span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Media / Lampiran (Opsional)</h3>
                    <p class="text-xs text-slate-400">Upload foto atau PDF pendukung. Maks 5MB per file.</p>
                </div>
            </div>

            <label for="file-input" class="block cursor-pointer">
                <div class="border-2 border-dashed border-slate-300 hover:border-red-500 rounded-2xl p-8 text-center transition bg-slate-50/50 hover:bg-red-50/30">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    </div>
                    <p class="font-bold text-sm text-slate-900">Klik untuk memilih file</p>
                    <p class="text-xs text-slate-500 mt-1">JPG, PNG, WEBP, PDF</p>
                </div>
            </label>
            <input type="file" name="media[]" id="file-input" multiple accept="image/*,application/pdf" class="hidden">

            <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-3"></div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('invoices.index') }}" 
               class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm">Batalkan</a>
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
    // ============ DATA FORMAT ============
    const formats = @json(config('ad_booking.formats'));

    // ============ ELEMENT REFS ============
    const amountDisplay = document.getElementById('amount_display');
    const amountRaw = document.getElementById('amount_raw');
    const amountPreview = document.getElementById('amount_preview');
    const formatSelect = document.querySelector('[name="ad_format"]');
    const durationInput = document.querySelector('[name="ad_duration_days"]');
    const btnAutoCalc = document.getElementById('btn_autocalc');
    const autoCalcNote = document.getElementById('autocalc_note');

    let isAutoCalc = true; // default: auto-calc aktif

    // ============ HELPERS ============
    function formatNumber(n) {
        return new Intl.NumberFormat('id-ID').format(n);
    }

    function parseNumber(str) {
        return parseInt(String(str).replace(/\D/g, ''), 10) || 0;
    }

    function updateAmount(raw) {
        raw = Math.max(0, parseInt(raw) || 0);
        amountRaw.value = raw;
        amountDisplay.value = formatNumber(raw);
        amountPreview.textContent = 'Terbaca: Rp ' + formatNumber(raw);
    }

    function calculateFromFormat() {
        const fmtKey = formatSelect.value;
        const dur = parseInt(durationInput.value) || 1;
        const fmt = formats[fmtKey];
        if (!fmt) return null;
        return fmt.base_price + (fmt.per_day * dur);
    }

    // ============ AUTO-CALC TRIGGER ============
    function triggerAutoCalc() {
        const total = calculateFromFormat();
        if (total !== null) {
            updateAmount(total);
            autoCalcNote.classList.remove('hidden');
            autoCalcNote.classList.add('flex');
        }
    }

    // ============ EVENT: USER MANUAL INPUT ============
    amountDisplay.addEventListener('input', (e) => {
        const raw = parseNumber(e.target.value);
        e.target.value = formatNumber(raw);
        amountRaw.value = raw;
        amountPreview.textContent = 'Terbaca: Rp ' + formatNumber(raw);

        // Matikan auto-calc saat user input manual
        isAutoCalc = false;
        autoCalcNote.classList.add('hidden');
        autoCalcNote.classList.remove('flex');
    });

    // ============ EVENT: FORMAT CHANGE ============
    if (formatSelect) {
        formatSelect.addEventListener('change', () => {
            if (isAutoCalc) triggerAutoCalc();
        });
    }

    // ============ EVENT: DURATION CHANGE ============
    if (durationInput) {
        durationInput.addEventListener('input', () => {
            if (isAutoCalc) triggerAutoCalc();
        });
    }

    // ============ EVENT: TOMBOL AUTO-CALC ============
    if (btnAutoCalc) {
        btnAutoCalc.addEventListener('click', () => {
            isAutoCalc = true;
            triggerAutoCalc();
        });
    }

    // ============ INIT ============
    // Format tampilan awal sesuai old value
    updateAmount(parseNumber(amountRaw.value) || 500000);

    // Kalau format sudah dipilih (dari old input), coba auto-calc
    if (formatSelect && formatSelect.value) {
        triggerAutoCalc();
    }

    // ============ SUB-CATEGORY DINAMIS ============
    const categoryData = @json(config('ad_booking.categories'));
    const catSelect = document.getElementById('create_category');
    const subSelect = document.getElementById('create_subcategory');
    const oldSub = @json(old('subcategory'));

    function populateSubs() {
        if (!catSelect || !subSelect) return;
        const cat = catSelect.value;
        subSelect.innerHTML = '<option value="">-- Pilih Sub-Kategori --</option>';
        if (cat && categoryData[cat]) {
            categoryData[cat].forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub;
                opt.textContent = sub;
                if (sub === oldSub) opt.selected = true;
                subSelect.appendChild(opt);
            });
        }
    }
    if (catSelect) {
        catSelect.addEventListener('change', populateSubs);
        if (catSelect.value) populateSubs();
    }

    // ============ MEDIA PREVIEW ============
    const fileInput = document.getElementById('file-input');
    const previewGrid = document.getElementById('preview-grid');
    if (fileInput && previewGrid) {
        fileInput.addEventListener('change', (e) => {
            previewGrid.innerHTML = '';
            Array.from(e.target.files).slice(0, 12).forEach(file => {
                const card = document.createElement('div');
                card.className = 'relative rounded-xl overflow-hidden border border-slate-200 bg-slate-50 aspect-square';
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className = 'w-full h-full object-cover';
                    card.appendChild(img);
                } else {
                    card.innerHTML = '<div class="w-full h-full flex items-center justify-center text-slate-400 text-xs font-bold">PDF</div>';
                }
                previewGrid.appendChild(card);
            });
        });
    }
</script>
@endpush
@endsection