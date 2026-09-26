@extends('layouts.admin')

@section('title', 'Edit Tagihan ' . $invoice->invoice_number)
@section('page-title', 'Perbarui Data Tagihan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Breadcrumb -->
    <div class="flex items-center justify-between">
        <a href="{{ route('invoices.show', $invoice->id) }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Detail Tagihan</span>
        </a>
        <span class="text-xs font-mono font-bold text-slate-700 bg-slate-100 px-3 py-1 rounded-lg">{{ $invoice->invoice_number }}</span>
    </div>

    @if($invoice->payments->where('status', 'pending')->count() > 0)
        <div class="bg-amber-50 border border-amber-200 text-amber-900 p-5 rounded-2xl flex items-start gap-4">
            <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <div>
                <p class="font-bold text-sm">Transaksi Pending Terdeteksi</p>
                <p class="text-xs text-amber-700 mt-1">Mengubah nominal berpotensi memicu ketidaksesuaian pada token pembayaran Midtrans.</p>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl text-xs">
            <p class="font-bold mb-1">Periksa kembali input Anda:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('invoices.update', $invoice->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- ============================================ -->
        <!-- SECTION 1: KONTEN IKLAN                       -->
        <!-- ============================================ -->
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
                    <select name="category" id="edit_category" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(config('ad_booking.categories') as $cat => $subs)
                            <option value="{{ $cat }}" {{ old('category', $invoice->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sub-Kategori</label>
                    <select name="subcategory" id="edit_subcategory" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="">-- Pilih Kategori Dahulu --</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Iklan</label>
                    <input type="text" name="ad_title" value="{{ old('ad_title', $invoice->ad_title) }}" maxlength="150"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Format Iklan</label>
                    <select name="ad_format" id="edit_ad_format" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="">-- Pilih Format --</option>
                        @foreach(config('ad_booking.formats') as $key => $f)
                            <option value="{{ $key }}" {{ old('ad_format', $invoice->ad_format) === $key ? 'selected' : '' }}>
                                {{ $f['name'] }} — {{ $f['size'] }} (Mulai Rp {{ number_format($f['base_price'], 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teks / Isi Iklan</label>
                    <textarea name="ad_text" rows="4" maxlength="2000"
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">{{ old('ad_text', $invoice->ad_text) }}</textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 2: JADWAL & NOMINAL                   -->
        <!-- ============================================ -->
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
                    <input type="date" name="ad_start_date" 
                           value="{{ old('ad_start_date', $invoice->ad_start_date?->format('Y-m-d') ?? date('Y-m-d')) }}"
                           required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Durasi (Hari) <span class="text-red-500">*</span></label>
                    <input type="number" name="ad_duration_days" id="edit_duration"
                           value="{{ old('ad_duration_days', $invoice->ad_duration_days ?? 7) }}" min="1" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>

                <!-- NOMINAL dengan FORMAT RUPIAH + AUTO-CALC -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nominal Tagihan (IDR) <span class="text-red-500">*</span>
                    </label>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center font-bold text-slate-500 text-sm">Rp</span>
                            <!-- Tampilan terformat -->
                            <input type="text" id="amount_display" inputmode="numeric"
                                   value="{{ old('amount', (int) $invoice->amount) }}"
                                   class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-base font-black text-slate-900 focus:bg-white focus:border-red-500 outline-none tracking-wide">
                            <!-- Nilai mentah yang dikirim ke server -->
                            <input type="hidden" name="amount" id="amount_raw" value="{{ old('amount', (int) $invoice->amount) }}">
                        </div>
                        <button type="button" id="btn_autocalc"
                                class="px-4 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition inline-flex items-center justify-center gap-2 whitespace-nowrap">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Hitung Otomatis</span>
                        </button>
                    </div>
                    <div class="mt-2 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                        <p class="text-xs text-slate-400" id="amount_preview"></p>
                        <p id="autocalc_note" class="text-xs font-semibold text-emerald-600 hidden items-center gap-1">
                            <svg class="w-3.5 h-3.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            Nominal dihitung otomatis dari Format × Durasi
                        </p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Jatuh Tempo <span class="text-red-500">*</span></label>
                    <input type="date" name="due_date" 
                           value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Singkat</label>
                    <input type="text" name="description" value="{{ old('description', $invoice->description) }}" maxlength="500"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 3: DATA PEMBAYAR                      -->
        <!-- ============================================ -->
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
                    <input type="text" name="billing_name" 
                           value="{{ old('billing_name', $invoice->billing_name ?? $invoice->advertiser_name) }}" 
                           required maxlength="150"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NPWP / NIK</label>
                    <input type="text" name="billing_npwp_nik" 
                           value="{{ old('billing_npwp_nik', $invoice->billing_npwp_nik) }}" maxlength="50"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="billing_email" 
                           value="{{ old('billing_email', $invoice->billing_email ?? $invoice->advertiser_contact) }}" maxlength="150"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Telepon / WhatsApp</label>
                    <input type="text" name="billing_phone" 
                           value="{{ old('billing_phone', $invoice->billing_phone) }}" maxlength="30"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Preferensi Pembayaran</label>
                    <select name="payment_preference" 
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                        <option value="online" {{ old('payment_preference', $invoice->payment_preference) === 'online' ? 'selected' : '' }}>Bayar Online (Midtrans)</option>
                        <option value="manual" {{ old('payment_preference', $invoice->payment_preference) === 'manual' ? 'selected' : '' }}>Transfer Manual</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Lengkap</label>
                    <textarea name="billing_address" rows="2" maxlength="500"
                              class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">{{ old('billing_address', $invoice->billing_address) }}</textarea>
                </div>
            </div>
        </div>

        <!-- ============================================ -->
        <!-- SECTION 4: MEDIA (Opsional)                   -->
        <!-- ============================================ -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-8 h-8 rounded-xl bg-red-600 text-white font-extrabold flex items-center justify-center text-xs">4</span>
                <div>
                    <h3 class="font-bold text-base text-slate-900">Media / Lampiran</h3>
                    <p class="text-xs text-slate-400">Tambahkan file baru. File lama tetap tersimpan.</p>
                </div>
            </div>

            <!-- Existing Media -->
            @if(!empty($invoice->media_files))
                <div>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">File Sudah Ada</p>
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        @foreach($invoice->media_files as $path)
                            <div class="relative rounded-xl overflow-hidden border border-slate-200 bg-slate-50 aspect-square">
                                @if(\Illuminate\Support\Str::endsWith(strtolower($path), ['.jpg','.jpeg','.png','.webp']))
                                    <img src="{{ Storage::url($path) }}" class="w-full h-full object-cover" alt="media">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400 text-[10px] font-bold">PDF</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <label for="file-input" class="block cursor-pointer">
                <div class="border-2 border-dashed border-slate-300 hover:border-red-500 rounded-2xl p-6 text-center transition bg-slate-50/50 hover:bg-red-50/30">
                    <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <p class="font-bold text-xs text-slate-900">Tambah File Baru</p>
                    <p class="text-[11px] text-slate-500 mt-0.5">JPG, PNG, WEBP, PDF • Maks 5MB</p>
                </div>
            </label>
            <input type="file" name="media[]" id="file-input" multiple accept="image/*,application/pdf" class="hidden">

            <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-3"></div>
        </div>

        <!-- ============================================ -->
        <!-- ACTIONS                                        -->
        <!-- ============================================ -->
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('invoices.show', $invoice->id) }}" 
               class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm transition">
                Batalkan
            </a>
            <button type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-sm shadow-lg shadow-red-600/30 active:scale-95 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // ============ DATA FORMAT ============
    const formats = @json(config('ad_booking.formats'));

    // ============ ELEMENT REFS ============
    const amountDisplay = document.getElementById('amount_display');
    const amountRaw     = document.getElementById('amount_raw');
    const amountPreview = document.getElementById('amount_preview');
    const formatSelect  = document.getElementById('edit_ad_format');
    const durationInput = document.getElementById('edit_duration');
    const btnAutoCalc   = document.getElementById('btn_autocalc');
    const autoCalcNote  = document.getElementById('autocalc_note');

    // Di mode edit, default MANUAL (jangan timpa nilai existing)
    let isAutoCalc = false;

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
        const fmt = formats[formatSelect.value];
        const dur = parseInt(durationInput.value) || 1;
        if (!fmt) return null;
        return fmt.base_price + (fmt.per_day * dur);
    }

    function triggerAutoCalc() {
        const total = calculateFromFormat();
        if (total !== null) {
            updateAmount(total);
            autoCalcNote.classList.remove('hidden');
            autoCalcNote.classList.add('flex');
        } else {
            alert('Pilih Format Iklan terlebih dahulu untuk auto-calculate.');
        }
    }

    // ============ EVENTS ============
    // User ketik manual → matikan auto-calc
    amountDisplay.addEventListener('input', (e) => {
        const raw = parseNumber(e.target.value);
        e.target.value = formatNumber(raw);
        amountRaw.value = raw;
        amountPreview.textContent = 'Terbaca: Rp ' + formatNumber(raw);
        isAutoCalc = false;
        autoCalcNote.classList.add('hidden');
        autoCalcNote.classList.remove('flex');
    });

    if (formatSelect) {
        formatSelect.addEventListener('change', () => { if (isAutoCalc) triggerAutoCalc(); });
    }
    if (durationInput) {
        durationInput.addEventListener('input', () => { if (isAutoCalc) triggerAutoCalc(); });
    }
    if (btnAutoCalc) {
        btnAutoCalc.addEventListener('click', () => {
            isAutoCalc = true;
            triggerAutoCalc();
        });
    }

    // ============ INIT ============
    // Format tampilan awal dari nilai existing
    updateAmount(parseNumber(amountRaw.value));

    // ============ SUB-CATEGORY DINAMIS ============
    const categoryData = @json(config('ad_booking.categories'));
    const catSelect = document.getElementById('edit_category');
    const subSelect = document.getElementById('edit_subcategory');
    const oldSub = @json(old('subcategory', $invoice->subcategory));

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