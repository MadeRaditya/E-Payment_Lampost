@extends('public.booking.layout', ['currentStep' => 2])

@section('title', 'Materi & Jadwal — Pemesanan Iklan')

@section('content')
    <div class="mb-10 hidden lg:block">
        <h1 class="text-4xl font-editorial text-[var(--color-text-main)] mb-3">Materi & Jadwal Tayang</h1>
        <p class="text-[var(--color-text-muted)] text-sm">Tuliskan konten iklan Anda dan tentukan durasi penayangannya.</p>
    </div>

    <form action="{{ route('booking.step2.store') }}" method="POST" id="form-step2"
        class="grid lg:grid-cols-[1fr_360px] gap-8 items-start">
        @csrf

        {{-- MAIN FORM COLUMN --}}
        <div class="space-y-12">
            {{-- SECTION 1: MATERI TEKS --}}
            <section>
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-[var(--color-text-main)]">1. Teks Iklan</h2>
                    <p class="text-[13px] text-[var(--color-text-muted)] mt-1">Gunakan bahasa yang jelas dan persuasif.
                        Sertakan narahubung jika perlu.</p>
                </div>

                <div class="hairline-card p-6">
                    <div class="relative">
                        <textarea name="ad_text" id="ad_text" rows="8" required maxlength="2000"
                            placeholder="Contoh: Dijual tanah seluas 500m2 di Jl. Sudirman. Lokasi strategis, cocok untuk ruko. Harga bisa nego. Hubungi 0812-XXXX-XXXX."
                            class="form-input resize-y py-4 leading-relaxed bg-[var(--color-bg)]">{{ old('ad_text', $draft->ad_text) }}</textarea>

                        <div class="absolute bottom-4 right-4 flex items-center gap-2">
                            <span id="char-count"
                                class="text-xs font-bold font-mono text-[var(--color-text-muted)]">0</span>
                            <span class="text-xs text-[var(--color-text-muted)]">/ 2000</span>
                        </div>
                    </div>
                    @error('ad_text')
                        <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            {{-- SECTION 2: JADWAL --}}
            <section>
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-[var(--color-text-main)]">2. Jadwal & Durasi</h2>
                    <p class="text-[13px] text-[var(--color-text-muted)] mt-1">Kapan iklan Anda ingin mulai dipublikasikan?
                    </p>
                </div>

                <div class="hairline-card p-6 grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="ad_start_date">Tanggal Mulai</label>
                        <input type="date" name="ad_start_date" id="ad_start_date"
                            value="{{ old('ad_start_date', $draft->ad_start_date?->format('Y-m-d') ?? date('Y-m-d')) }}"
                            min="{{ date('Y-m-d') }}" required class="form-input bg-[var(--color-bg)] cursor-pointer">
                        @error('ad_start_date')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="ad_duration_days">Durasi (Hari)</label>
                        <div class="relative">
                            <input type="number" name="ad_duration_days" id="ad_duration_days"
                                value="{{ old('ad_duration_days', $draft->ad_duration_days ?? 7) }}" min="1"
                                max="90" required class="form-input bg-[var(--color-bg)] pr-12">
                            <span
                                class="absolute inset-y-0 right-4 flex items-center text-xs font-bold text-[var(--color-text-muted)] pointer-events-none">Hari</span>
                        </div>
                        @error('ad_duration_days')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </section>

            <div class="pt-6 border-t border-[var(--color-border)] flex items-center justify-between">
                <a href="{{ route('booking.step1') }}"
                    class="text-sm font-semibold text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition-colors">←
                    Kembali</a>
                <button type="submit"
                    class="bg-[var(--color-text-main)] hover:bg-black text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition-all focus:ring-4 focus:ring-slate-300 active:scale-95 flex items-center gap-3">
                    <span>Lanjutkan ke Tahap 3</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- SIDEBAR: PREVIEW & PRICING --}}
        <div class="sticky top-24 space-y-6">

            {{-- AD PREVIEW --}}
            <div class="hairline-card overflow-hidden">
                <div class="bg-[var(--color-bg)] px-5 py-3 border-b border-[var(--color-border)] flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                    <span class="text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest">Live
                        Preview</span>
                </div>
                <div class="p-6">
                    <p class="text-[10px] font-bold text-[var(--color-brand)] uppercase tracking-widest mb-2"
                        id="pv-category">— Kategori —</p>
                    <h4 class="text-lg font-editorial text-[var(--color-text-main)] mb-3 leading-snug" id="pv-title">
                        {{ $draft->ad_title }}</h4>
                    <p class="text-sm text-[var(--color-text-muted)] whitespace-pre-line leading-relaxed" id="pv-text">
                        {{ $draft->ad_text ?: 'Teks iklan Anda akan muncul di sini...' }}</p>

                    <div
                        class="mt-6 pt-4 border-t border-[var(--color-border)] flex justify-between items-center text-[11px]">
                        <span class="text-[var(--color-text-muted)] font-medium" id="pv-date">Dimuat: —</span>
                        <span class="font-bold text-[var(--color-text-main)] bg-[var(--color-bg)] px-2 py-1 rounded"
                            id="pv-format">{{ config('ad_booking.formats')[$draft->ad_format]['name'] ?? '' }}</span>
                    </div>
                </div>
            </div>


            {{-- PRICING SUMMARY --}}
            <div class="hairline-card !bg-white !text-slate-900 p-6 shadow-xl">

                <h3
                    class="text-[10px] font-bold text-[var(--color-brand)] uppercase tracking-widest mb-4 border-b border-slate-200 pb-3">
                    Estimasi Biaya
                </h3>

                <div class="space-y-3 text-sm font-medium border-b border-slate-200 pb-4 mb-4">

                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Tipe Format</span>
                        <span class="text-slate-900 font-bold text-right" id="sum-format">—</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Harga Dasar</span>
                        <span class="text-slate-900 font-bold" id="sum-base">Rp 0</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Tarif / Hari</span>
                        <span class="text-slate-900 font-bold" id="sum-perday">Rp 0</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-500">Durasi Tayang</span>
                        <span class="text-[var(--color-brand)] font-bold" id="sum-duration">0 hari</span>
                    </div>

                </div>

                <div class="flex justify-between items-end gap-3">

                    <span class="text-xs text-slate-900 font-bold uppercase tracking-widest">
                        Subtotal
                    </span>

                    <span class="text-2xl font-black text-[var(--color-brand)] leading-none text-right" id="sum-total">
                        Rp 0
                    </span>

                </div>

                <p class="text-[10px] text-slate-500 mt-4 leading-relaxed">
                    *Belum termasuk PPN 11%. Harga final akan dihitung pada tahap pembayaran.
                </p>

            </div>

        </div>
    </form>

    @push('scripts')
        <script>
            const formats = @json($formats);
            const currentFormat = "{{ $draft->ad_format ?? ($draft->ad_slot ?? '') }}";
            const draftCategory = "{{ $draft->category ?? '' }}";
            const draftSub = "{{ $draft->subcategory ?? '' }}";
            const draftTitle = "{{ $draft->ad_title ?? '' }}";

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

                // Format date string for preview
                const dateVal = dateInput.value;
                let dateStr = '—';
                if (dateVal) {
                    const d = new Date(dateVal);
                    dateStr = d.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                }
                document.getElementById('pv-date').textContent = 'Dimuat: ' + dateStr;
                document.getElementById('pv-format').textContent = fmt.name;

                document.getElementById('char-count').textContent = textInput.value.length;

                // Visual indicator when nearing limit
                const charCountEl = document.getElementById('char-count');
                if (textInput.value.length > 1900) {
                    charCountEl.classList.add('text-red-500');
                    charCountEl.classList.remove('text-[var(--color-text-muted)]');
                } else {
                    charCountEl.classList.remove('text-red-500');
                    charCountEl.classList.add('text-[var(--color-text-muted)]');
                }
            }

            [durationInput, dateInput, textInput].forEach(el => el.addEventListener('input', updatePreview));
            updatePreview();
        </script>
    @endpush
@endsection
