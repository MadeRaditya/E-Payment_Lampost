@extends('public.booking.layout', ['currentStep' => 1])

@section('title', 'Step 1 — Kategori & Format Iklan')

@section('content')
<form action="{{ route('booking.step1.store') }}" method="POST" class="space-y-6" id="form-step1">
    @csrf

    @if($errors->any())
        <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-2xl text-xs">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
        <h2 class="text-xl font-black text-slate-900 mb-1">Pilih Tipe Penempatan</h2>
        <p class="text-xs text-slate-500 mb-6">Di mana iklan Anda akan ditayangkan?</p>

        <div class="grid sm:grid-cols-2 gap-4">
            @foreach($placementTypes as $key => $pt)
                @php $selected = old('placement_type', $draft->placement_type ?? '') === $key; @endphp
                <label class="cursor-pointer group">
                    <input type="radio" name="placement_type" value="{{ $key }}" class="peer sr-only" {{ $selected ? 'checked' : '' }} required>
                    <div class="border-2 border-slate-200 rounded-2xl p-6 peer-checked:border-red-600 peer-checked:bg-red-50/60 peer-checked:shadow-lg transition h-full">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                {{ $key === 'online' ? 'bg-blue-100 text-blue-600' : 'bg-amber-100 text-amber-600' }} peer-checked:bg-red-600 peer-checked:text-white transition">
                                @if($key === 'online')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                @else
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-black text-base text-slate-900">{{ $pt['name'] }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $pt['description'] }}</p>
                    </div>
                </label>
            @endforeach
        </div>
    </div>


    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
        <h3 class="text-base font-black text-slate-900 mb-5">Kategori & Judul Iklan</h3>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="category" id="category" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat => $subs)
                        <option value="{{ $cat }}" {{ old('category', $draft->category ?? $preselectedCategory ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sub-Kategori <span class="text-red-500">*</span></label>
                <select name="subcategory" id="subcategory" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                    <option value="">-- Pilih Kategori Dahulu --</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Iklan <span class="text-red-500">*</span></label>
                <input type="text" name="ad_title" value="{{ old('ad_title', $draft->ad_title ?? '') }}" required maxlength="150"
                       placeholder="cth: Rumah 2 Lantai Strategis di Pusat Kota"
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
        <h3 class="text-base font-black text-slate-900 mb-1">Bentuk / Format Iklan <span class="text-red-500">*</span></h3>
        <p class="text-xs text-slate-500 mb-5">Format tersedia menyesuaikan tipe penempatan yang Anda pilih.</p>

        <div id="format-empty-msg" class="p-6 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-center">
            <p class="text-xs text-slate-400 italic">Pilih tipe penempatan terlebih dahulu.</p>
        </div>

        <div id="format-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 hidden"></div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-red-600/30 transition inline-flex items-center gap-2">
            Lanjut ke Step 2
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</form>

<script>
    const categoryData = @json($categories);
    const formatsData  = @json($formats);

    const placementRadios = document.querySelectorAll('input[name="placement_type"]');
    const categorySelect  = document.getElementById('category');
    const subSelect       = document.getElementById('subcategory');
    const formatGrid      = document.getElementById('format-grid');
    const formatEmptyMsg  = document.getElementById('format-empty-msg');

    const oldSub    = @json(old('subcategory', $draft->subcategory ?? ''));
    const oldFormat = @json(old('ad_format', $draft->ad_format ?? $preselectedFormat ?? ''));
    const urlCategory = @json($preselectedCategory ?? null);

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

        Object.entries(formatsData).forEach(([key, fmt]) => {
            if (fmt.placement !== placement) return;

            const isSelected = oldFormat === key;
            const label = document.createElement('label');
            label.className = 'cursor-pointer group';
            label.innerHTML = `
                <input type="radio" name="ad_format" value="${key}" class="peer sr-only" ${isSelected ? 'checked' : ''} required>
                <div class="border-2 border-slate-200 rounded-2xl p-4 peer-checked:border-red-600 peer-checked:bg-red-50/60 peer-checked:shadow-lg transition h-full flex flex-col">
                    <div class="bg-slate-100 rounded-xl h-24 mb-3 flex items-center justify-center border border-slate-200">
                        <div class="text-center">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">${fmt.size}</p>
                        </div>
                    </div>
                    <p class="font-black text-sm text-slate-900 group-hover:text-red-700">${fmt.name}</p>
                    <p class="text-[11px] text-slate-500 mt-2 leading-relaxed flex-1">${fmt.description}</p>
                    <p class="mt-3 text-xs font-black text-red-600">Mulai Rp ${new Intl.NumberFormat('id-ID').format(fmt.base_price)}</p>
                </div>
            `;
            formatGrid.appendChild(label);
        });
    }

    placementRadios.forEach(r => r.addEventListener('change', renderFormats));

    function populateSubs() {
        const cat = categorySelect.value;
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

    categorySelect.addEventListener('change', populateSubs);

    if (urlCategory && !categorySelect.value) {
        categorySelect.value = urlCategory;
    }
    if (categorySelect.value) populateSubs();
    renderFormats();
</script>
@endsection