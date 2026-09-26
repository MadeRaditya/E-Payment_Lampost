@extends('public.booking.layout', ['currentStep' => 3])

@section('title', 'Step 3 — Unggah Media')

@section('content')
<form action="{{ route('booking.step3.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="form-media">
    @csrf

    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
        <h2 class="text-xl font-black text-slate-900 mb-1">Unggah Media / Foto Iklan</h2>
        <p class="text-xs text-slate-500 mb-6">
            <strong>Opsional.</strong> Tambahkan foto, banner, atau dokumen pendukung untuk iklan Anda. Maksimal 5MB per file (JPG, PNG, WEBP, PDF).
        </p>

        <label for="file-input" class="block cursor-pointer">
            <div class="border-2 border-dashed border-slate-300 hover:border-red-500 rounded-3xl p-10 text-center transition bg-slate-50/50 hover:bg-red-50/30">
                <div class="w-14 h-14 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                </div>
                <p class="font-bold text-sm text-slate-900">Klik untuk memilih file</p>
                <p class="text-xs text-slate-500 mt-1">atau drag & drop file ke area ini</p>
                <p class="text-[11px] text-slate-400 mt-3">Bisa pilih banyak file sekaligus</p>
            </div>
        </label>
        <input type="file" name="media[]" id="file-input" multiple accept="image/*,application/pdf" class="hidden">

        @error('media.*')<p class="text-rose-500 text-xs mt-2">{{ $message }}</p>@enderror

        <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-6"></div>

        @if(!empty($draft->media_files))
            <div class="mt-8 pt-6 border-t border-slate-200">
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">File yang Sudah Diunggah Sebelumnya</p>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($draft->media_files as $path)
                        <div class="relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 aspect-square">
                            @if(Str::endsWith($path, ['.jpg','.jpeg','.png','.webp']))
                                <img src="{{ Storage::url($path) }}" class="w-full h-full object-cover" alt="media">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs font-bold">PDF FILE</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-2xl text-xs text-amber-800">
            <strong>Ingin melewati step ini?</strong> Cukup klik "Lanjut ke Step 4" tanpa memilih file. Iklan Anda tetap dapat diproses tanpa media tambahan.
        </div>
    </div>

    <div class="flex justify-between">
        <a href="{{ route('booking.step2') }}" class="px-6 py-3.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-semibold text-sm">← Kembali</a>
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg shadow-red-600/30 transition inline-flex items-center gap-2">
            Lanjut ke Step 4
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </button>
    </div>
</form>

<script>
    const fileInput = document.getElementById('file-input');
    const previewGrid = document.getElementById('preview-grid');

    fileInput.addEventListener('change', (e) => {
        previewGrid.innerHTML = '';
        const files = Array.from(e.target.files).slice(0, 12); 
        files.forEach((file) => {
            const card = document.createElement('div');
            card.className = 'relative rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 aspect-square';

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = 'w-full h-full object-cover';
                card.appendChild(img);
            } else {
                card.innerHTML = '<div class="w-full h-full flex items-center justify-center text-slate-400 text-xs font-bold">PDF FILE</div>';
            }

            const overlay = document.createElement('div');
            overlay.className = 'absolute bottom-0 left-0 right-0 bg-black/60 text-white text-[10px] p-1.5 truncate';
            overlay.textContent = file.name;
            card.appendChild(overlay);

            previewGrid.appendChild(card);
        });
    });
</script>
@endsection