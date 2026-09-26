@extends('public.booking.layout', ['currentStep' => 2])

@section('title', 'Step 2 — Isi & Jadwal Iklan')

@section('content')
<form action="{{ route('booking.step2.store') }}" method="POST" class="space-y-6" id="form-step2">
    @csrf

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-black text-slate-900 mb-1">Isi & Jadwal Iklan</h2>
                <p class="text-xs text-slate-500 mb-6">Tuliskan teks iklan dan tentukan kapan iklan akan dimuat.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teks / Isi Iklan <span class="text-red-500">*</span></label>
                        <textarea name="ad_text" rows="6" required maxlength="2000" id="ad_text"
                                  placeholder="Tuliskan detail iklan Anda, seperti spesifikasi, harga, kontak, dll."
                                  class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">{{ old('ad_text', $draft->ad_text) }}</textarea>
                        <p class="text-[11px] text-slate-400 mt-1"><span id="char-count">0</span> / 2000 karakter</p>
                        @error('ad_text')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tanggal Dimuat <span class="text-red-500">*</span></label>
                            <input type="date" name="ad_start_date" id="ad_start_date"
                                   value="{{ old('ad_start_date', $draft->ad_start_date?->format('Y-m-d') ?? date('Y-m-d')) }}"
                                   min="{{ date('Y-m-d') }}" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                            @error('ad_start_date')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Durasi (Hari) <span class="text-red-500">*</span></label>
                            <input type="number" name="ad_duration_days" id="ad_duration_days"
                                   value="{{ old('ad_duration_days', $draft->ad_duration_days ?? 7) }}"
                                   min="1" max="90" required
                                   class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                            @error('ad_duration_days')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
                <h3 class="text-sm font-black text-slate-900 mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Preview Iklan Anda
                </h3>
                <div class="bg-slate-100 rounded-2xl p-6 border border-slate-200">
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200 space-y-3">
                        <p class="text-[10px] font-bold text-red-600 uppercase tracking-widest" id="pv-category">— Kategori —</p>
                        <h4 class="text-lg font-black text-slate-900 leading-tight" id="pv-title">{{ $draft->ad_title }}</h4>
                        <p class="text-sm text-slate-700 whitespace-pre-line leading-relaxed" id="pv-text">{{ $draft->ad_text ?: 'Teks iklan Anda akan muncul di sini...' }}</p>
                        <div class="pt-3 border-t border-slate-100 flex justify-between items-center text-xs text-slate-500">
                            <span id="pv-date">Dimuat: —</span>
                            <span class="font-bold text-red-600" id="pv-format">{{ config('ad_booking.formats')[$draft->ad_format]['name'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-slate-900 to-slate-800 text-white rounded-3xl p-6 shadow-xl sticky top-4">
                <p class="text-[11px] font-bold text-red-400 uppercase tracking-widest mb-1">Estimasi Total</p>
                <h3 class="text-xs text-slate-300 mb-4">Perkiraan biaya pemesanan Anda</h3>

                <div class="space-y-2 text-xs border-b border-slate-700 pb-4 mb-4">
                    <div class="flex justify-between"><span class="text-slate-400">Format:</span><span class="font-semibold" id="sum-format">—</span></div>
                    <div class="flex justify-between"><span class="text-slate-400">Base Price:</span><span class="font-semibold" id="sum-base">Rp 0</span></div>
                    <div class="flex justify-between"><span class="text-slate-400">Per Hari:</span><span class="font-semibold" id="sum-perday">Rp 0</span></div>
                    <div class="flex justify-between"><span class="text-slate-400">Durasi:</span><span class="font-semibold" id="sum-duration">0 hari</span></div>
                </div>

                <div class="flex justify-between items-baseline">
                    <span class="text-xs text-slate-300">TOTAL:</span>
                    <span class="text-2xl font-black text-red-400" id="sum-total">Rp 0</span>
                </div>

                <p class="text-[10px] text-slate-400 mt-4 leading-relaxed">*Harga belum termasuk PPN. Total final akan dihitung ulang saat submit.</p>
            </div>
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('booking.step1') }}" class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm">← Kembali</a>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-red-600/30 transition inline-flex items-center gap-2">
            Lanjut ke Step 3
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</form>

<script>
    const formats = @json(config('ad_booking.formats'));
    const currentFormat = @json($draft->ad_format);
    const draftCategory = @json($draft->category);
    const draftSub = @json($draft->subcategory);
    const draftTitle = @json($draft->ad_title);

    const durationInput = document.getElementById('ad_duration_days');
    const dateInput = document.getElementById('ad_start_date');
    const textInput = document.getElementById('ad_text');

    function formatRupiah(n) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(n);
    }

    function updatePreview() {
        const duration = parseInt(durationInput.value) || 1;
        const fmt = formats[currentFormat] || null;
        if (!fmt) return;

        const base = fmt.base_price;
        const perDay = fmt.per_day;
        const total = base + (perDay * duration);

        document.getElementById('sum-format').textContent = fmt.name;
        document.getElementById('sum-base').textContent = formatRupiah(base);
        document.getElementById('sum-perday').textContent = formatRupiah(perDay);
        document.getElementById('sum-duration').textContent = duration + ' hari';
        document.getElementById('sum-total').textContent = formatRupiah(total);

        document.getElementById('pv-text').textContent = textInput.value || 'Teks iklan Anda akan muncul di sini...';
        document.getElementById('pv-category').textContent = (draftCategory || '—') + ' › ' + (draftSub || '—');
        document.getElementById('pv-date').textContent = 'Dimuat: ' + (dateInput.value || '—');
        document.getElementById('pv-format').textContent = fmt.name;

        document.getElementById('char-count').textContent = textInput.value.length;
    }

    [durationInput, dateInput, textInput].forEach(el => el.addEventListener('input', updatePreview));
    updatePreview();
</script>
@endsection