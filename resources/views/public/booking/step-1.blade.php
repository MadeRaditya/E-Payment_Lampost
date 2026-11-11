@extends('public.booking.layout', ['currentStep' => 1])

@section('title', 'Kategori & Format — Pemesanan Iklan')

@section('content')
    <div class="mb-10 hidden lg:block">
        <h1 class="text-4xl font-editorial text-[var(--color-text-main)] mb-3">Kategori & Format</h1>
        <p class="text-[var(--color-text-muted)] text-sm">Tentukan di mana dan bagaimana bentuk visual iklan Anda akan
            ditampilkan kepada pembaca.</p>
    </div>

    <form action="{{ route('booking.step1.store') }}" method="POST" id="form-step1" class="space-y-12">
        @csrf

        {{-- SECTION 1: PENEMPATAN --}}
        <section>
            <div class="mb-5 flex items-baseline justify-between">
                <h2 class="text-lg font-bold text-[var(--color-text-main)]">1. Tipe Penempatan</h2>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                @foreach ($placementTypes as $key => $pt)
                    @php $selected = old('placement_type', $draft->placement_type ?? '') === $key; @endphp
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="placement_type" value="{{ $key }}"
                            class="peer radio-peer sr-only" {{ $selected ? 'checked' : '' }} required>
                        <div class="radio-card hairline-card p-6 h-full flex flex-col relative overflow-hidden">

                            <!-- Check Indicator -->
                            <div
                                class="check-icon absolute top-6 right-6 w-5 h-5 rounded-full bg-[var(--color-brand)] text-white flex items-center justify-center opacity-0 scale-50 transition-all duration-300">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            <div
                                class="w-10 h-10 rounded-lg mb-4 flex items-center justify-center border border-[var(--color-border)] bg-[var(--color-bg)] group-hover:border-[var(--color-border-hover)] transition-colors">
                                @if ($key === 'online')
                                    <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-slate-700" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                @endif
                            </div>
                            <h3 class="font-bold text-base mb-1">{{ $pt['name'] }}</h3>
                            <p class="text-sm text-[var(--color-text-muted)]">{{ $pt['description'] }}</p>
                        </div>
                    </label>
                @endforeach
            </div>
        </section>

        {{-- SECTION 2: KATEGORI & JUDUL --}}
        <section>
            <div class="mb-5 flex items-baseline justify-between">
                <h2 class="text-lg font-bold text-[var(--color-text-main)]">2. Detail Kategori</h2>
            </div>

            <div class="hairline-card p-6 sm:p-8">
                <div class="grid sm:grid-cols-2 gap-6">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="category">Kategori Utama</label>
                        <div class="relative">
                            <select name="category" id="category" required
                                class="form-input appearance-none pr-10 cursor-pointer">
                                <option value="" disabled selected>Pilih Kategori...</option>
                                @foreach ($categories as $cat => $subs)
                                    <option value="{{ $cat }}"
                                        {{ old('category', $draft->category ?? ($preselectedCategory ?? '')) === $cat ? 'selected' : '' }}>
                                        {{ $cat }}</option>
                                @endforeach
                            </select>
                            <div
                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[var(--color-text-muted)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-kategori -->
                    <div>
                        <label class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="subcategory">Sub Kategori</label>
                        <div class="relative">
                            <select name="subcategory" id="subcategory" required
                                class="form-input appearance-none pr-10 cursor-pointer bg-[var(--color-bg)]">
                                <option value="" disabled selected>Pilih kategori dahulu</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-[var(--color-text-muted)]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="sm:col-span-2 border-t border-[var(--color-border)] pt-6 mt-2">
                        <label class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="ad_title">Judul Kampanye Iklan</label>
                        <input type="text" name="ad_title" id="ad_title"
                            value="{{ old('ad_title', $draft->ad_title ?? '') }}" required maxlength="150"
                            placeholder="Contoh: Lowongan Kerja Marketing Executive PT ABC"
                            class="form-input text-base py-3">
                        <p class="text-[11px] text-[var(--color-text-muted)] mt-2">Gunakan judul yang ringkas dan
                            merepresentasikan isi iklan. Maks. 150 karakter.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- SECTION 3: FORMAT IKLAN --}}
        <section>
            <div class="mb-5 flex items-baseline justify-between">
                <h2 class="text-lg font-bold text-[var(--color-text-main)]">3. Ukuran & Format</h2>
            </div>

            <div id="format-empty-msg" class="hairline-card border-dashed p-10 text-center bg-transparent">
                <p class="text-sm font-medium text-[var(--color-text-muted)]">Silakan pilih Tipe Penempatan di atas untuk
                    melihat format yang tersedia.</p>
            </div>

            <div id="format-grid" class="grid sm:grid-cols-2 gap-4 hidden"></div>
        </section>

        {{-- SUBMIT BUTTON --}}
        <div class="pt-6 border-t border-[var(--color-border)] flex justify-end">
            <button type="submit"
                class="bg-[var(--color-text-main)] hover:bg-black text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition-all focus:ring-4 focus:ring-slate-300 active:scale-95 flex items-center gap-3">
                <span>Lanjutkan ke Tahap 2</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            const categoryData = @json($categories);
            const formatsData = @json($formats);

            const placementRadios = document.querySelectorAll('input[name="placement_type"]');
            const categorySelect = document.getElementById('category');
            const subSelect = document.getElementById('subcategory');
            const formatGrid = document.getElementById('format-grid');
            const formatEmptyMsg = document.getElementById('format-empty-msg');

            const oldSub = @json(old('subcategory', $draft->subcategory ?? ''));
            const oldFormat = @json(old('ad_format', $draft->ad_format ?? ($preselectedFormat ?? '')));
            const urlCategory = @json($preselectedCategory ?? null);

            // Render Format Cards with High-Craft Styling
            function renderFormats() {
                const placement = document.querySelector('input[name="placement_type"]:checked')?.value;

                if (!placement) {
                    formatGrid.classList.add('hidden');
                    formatEmptyMsg.classList.remove('hidden');
                    return;
                }

                formatEmptyMsg.classList.add('hidden');
                formatGrid.classList.remove('hidden');
                formatGrid.innerHTML = '';

                let delay = 0;
                Object.entries(formatsData).forEach(([key, fmt]) => {
                    if (fmt.placement !== placement) return;

                    const isSelected = oldFormat === key;
                    const label = document.createElement('label');
                    label.className = 'relative cursor-pointer group';

                    // Staggered Animation Entry
                    label.style.animation = `staggerFade 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards ${delay}s`;
                    label.style.opacity = '0';
                    delay += 0.05;

                    label.innerHTML = `
                <input type="radio" name="ad_format" value="${key}" class="peer radio-peer sr-only" ${isSelected ? 'checked' : ''} required>
                <div class="radio-card hairline-card p-5 h-full flex flex-col relative overflow-hidden">
                    
                    <div class="check-icon absolute top-5 right-5 w-5 h-5 rounded-full bg-[var(--color-brand)] text-white flex items-center justify-center opacity-0 scale-50 transition-all duration-300">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>

                    <!-- Size Visualizer Box -->
                    <div class="bg-[var(--color-bg)] border border-[var(--color-border)] rounded-lg h-20 mb-4 flex flex-col items-center justify-center group-hover:border-[var(--color-border-hover)] transition-colors">
                        <span class="text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest">Dimensi</span>
                        <span class="text-sm font-black text-[var(--color-text-main)]">${fmt.size}</span>
                    </div>

                    <h3 class="font-bold text-base mb-1 text-[var(--color-text-main)] group-hover:text-[var(--color-brand)] transition-colors">${fmt.name}</h3>
                    <p class="text-xs text-[var(--color-text-muted)] flex-1 mb-4 leading-relaxed">${fmt.description}</p>
                    
                    <div class="pt-4 border-t border-[var(--color-border)] flex items-end justify-between">
                        <span class="text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest">Estimasi Tarif</span>
                        <span class="text-sm font-black text-[var(--color-brand)]">Rp ${new Intl.NumberFormat('id-ID').format(fmt.base_price)}</span>
                    </div>
                </div>
            `;
                    formatGrid.appendChild(label);
                });
            }

            placementRadios.forEach(r => r.addEventListener('change', renderFormats));

            // Handle Cascading Subcategories
            function populateSubs() {
                const cat = categorySelect.value;
                subSelect.innerHTML = '<option value="" disabled selected>Pilih Sub Kategori</option>';
                subSelect.classList.remove('bg-[var(--color-bg)]'); // Remove disabled look

                if (cat && categoryData[cat]) {
                    categoryData[cat].forEach(sub => {
                        const opt = document.createElement('option');
                        opt.value = sub;
                        opt.textContent = sub;
                        if (sub === oldSub) opt.selected = true;
                        subSelect.appendChild(opt);
                    });
                } else {
                    subSelect.classList.add('bg-[var(--color-bg)]');
                }
            }

            categorySelect.addEventListener('change', populateSubs);

            // Initialization
            if (urlCategory && !categorySelect.value) {
                categorySelect.value = urlCategory;
            }
            if (categorySelect.value) populateSubs();
            renderFormats();
        </script>
    @endpush
@endsection
