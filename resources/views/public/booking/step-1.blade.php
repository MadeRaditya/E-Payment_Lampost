@extends('public.booking.layout', ['currentStep' => 1])

@section('title', 'Step 1 — Kategori & Format Iklan')

@section('content')
<form action="{{ route('booking.step1.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
        <h2 class="text-xl font-black text-slate-900 mb-1">Pilih Kategori & Format Iklan</h2>
        <p class="text-xs text-slate-500 mb-6">Tentukan jenis iklan yang ingin Anda pasang di Lampung Post.</p>

        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="category" id="category" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat => $subs)
                        <<option value="{{ $cat }}" {{ old('category', $draft->category ?? $preselectedCategory ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Sub-Kategori <span class="text-red-500">*</span></label>
                <select name="subcategory" id="subcategory" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                    <option value="">-- Pilih Kategori Dahulu --</option>
                </select>
                @error('subcategory')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Iklan <span class="text-red-500">*</span></label>
                <input type="text" name="ad_title" value="{{ old('ad_title', $draft->ad_title ?? '') }}" required maxlength="150"
                       placeholder="cth: Rumah 2 Lantai Strategis di Pusat Kota"
                       class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:bg-white focus:border-red-500 outline-none">
                @error('ad_title')<p class="text-rose-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
        <h3 class="text-base font-black text-slate-900 mb-1">Bentuk / Format Iklan <span class="text-red-500">*</span></h3>
        <p class="text-xs text-slate-500 mb-5">Pilih ilustrasi bagaimana iklan Anda akan ditampilkan.</p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($formats as $key => $f)
                @php $selected = old('ad_format', $draft->ad_format ?? $preselectedFormat ?? '') === $key; @endphp
                <label class="cursor-pointer group">
                    <input type="radio" name="ad_format" value="{{ $key }}" class="peer sr-only" {{ $selected ? 'checked' : '' }} required>
                    <div class="border-2 border-slate-200 rounded-2xl p-4 peer-checked:border-red-600 peer-checked:bg-red-50/60 peer-checked:shadow-lg transition h-full flex flex-col">
                        <!-- Ilustrasi -->
                        <div class="bg-slate-100 rounded-xl h-28 mb-3 flex items-center justify-center overflow-hidden border border-slate-200 relative">
                            @if($key === 'display_banner')
                                <div class="w-full px-3"><div class="h-8 bg-gradient-to-r from-red-500 to-red-700 rounded-md flex items-center justify-center text-white text-[10px] font-black tracking-wider">BANNER 970×250</div></div>
                            @elseif($key === 'half_page')
                                <div class="w-16 h-20 bg-gradient-to-br from-red-500 to-red-700 rounded-md flex items-center justify-center text-white text-[9px] font-black">HALF<br>PAGE</div>
                            @elseif($key === 'quarter_page')
                                <div class="w-12 h-14 bg-gradient-to-br from-red-500 to-red-700 rounded-md flex items-center justify-center text-white text-[9px] font-black">1/4<br>PAGE</div>
                            @elseif($key === 'full_page')
                                <div class="w-20 h-24 bg-gradient-to-br from-red-500 to-red-700 rounded-md flex items-center justify-center text-white text-[10px] font-black">FULL PAGE</div>
                            @elseif($key === 'advertorial')
                                <div class="w-full px-3 space-y-1">
                                    <div class="h-2 bg-red-500 rounded w-3/4"></div>
                                    <div class="h-2 bg-slate-300 rounded"></div>
                                    <div class="h-2 bg-slate-300 rounded w-5/6"></div>
                                    <div class="h-2 bg-slate-300 rounded w-2/3"></div>
                                </div>
                            @elseif($key === 'kolom')
                                <div class="w-24 border border-dashed border-slate-400 rounded p-2 space-y-1">
                                    <div class="h-1.5 bg-red-500 rounded"></div>
                                    <div class="h-1.5 bg-slate-300 rounded"></div>
                                    <div class="h-1.5 bg-slate-300 rounded"></div>
                                </div>
                            @endif
                        </div>

                        <p class="font-black text-sm text-slate-900 group-hover:text-red-700">{{ $f['name'] }}</p>
                        <p class="text-[11px] text-slate-500 mt-0.5">{{ $f['size'] }}</p>
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed flex-1">{{ $f['description'] }}</p>
                        <p class="mt-3 text-xs font-black text-red-600">Mulai Rp {{ number_format($f['base_price'], 0, ',', '.') }}</p>
                    </div>
                </label>
            @endforeach
        </div>
        @error('ad_format')<p class="text-rose-500 text-xs mt-2">{{ $message }}</p>@enderror
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
    const categorySelect = document.getElementById('category');
    const subSelect = document.getElementById('subcategory');
    const oldSub = @json(old('subcategory', $draft->subcategory ?? ''));
    const urlCategory = @json($preselectedCategory ?? null);
    if (urlCategory && !categorySelect.value) {
        categorySelect.value = urlCategory;
        populateSubs();
    }

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
    if (categorySelect.value) populateSubs();
</script>
@endsection