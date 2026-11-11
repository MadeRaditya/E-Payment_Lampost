@extends('public.booking.layout', ['currentStep' => 3])

@section('title', 'Unggah Aset — Pemesanan Iklan')

@section('content')
    <div class="mb-10 hidden lg:block">
        <h1 class="text-4xl font-editorial text-[var(--color-text-main)] mb-3">Aset Visual & Dokumen</h1>
        <p class="text-[var(--color-text-muted)] text-sm">Lampirkan foto properti, banner promosi, atau dokumen pendukung
            (Opsional).</p>
    </div>

    <form action="{{ route('booking.step3.store') }}" method="POST" enctype="multipart/form-data" id="form-step3"
        class="max-w-3xl space-y-10">
        @csrf

        <section class="hairline-card p-8">
            {{-- UPLOAD AREA --}}
            <label for="file-input" class="block cursor-pointer group">
                <div
                    class="bg-[var(--color-bg)] border border-[var(--color-border)] rounded-2xl p-12 text-center transition-all group-hover:border-[var(--color-brand)] group-hover:bg-[var(--color-brand-light)]">

                    <div
                        class="w-16 h-16 rounded-2xl bg-white shadow-sm border border-[var(--color-border)] text-[var(--color-text-main)] flex items-center justify-center mx-auto mb-6 transition-transform group-hover:scale-110 group-hover:text-[var(--color-brand)] group-hover:border-[var(--color-brand-muted)]">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>

                    <h3 class="text-base font-bold text-[var(--color-text-main)] mb-2">Pilih File atau Tarik ke Sini</h3>
                    <p class="text-xs text-[var(--color-text-muted)] max-w-sm mx-auto leading-relaxed">Mendukung format JPG,
                        PNG, WEBP, atau PDF. Maksimal 5MB per file. Anda dapat memilih beberapa file sekaligus.</p>
                </div>
            </label>
            <input type="file" name="media[]" id="file-input" multiple
                accept="image/jpeg,image/png,image/webp,application/pdf" class="hidden">

            @error('media.*')
                <div
                    class="mt-4 p-3 bg-red-50 text-red-700 text-xs font-medium rounded-lg border border-red-100 flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $message }}
                </div>
            @enderror

            {{-- NEW FILES PREVIEW --}}
            <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8 empty:hidden"></div>

            {{-- EXISTING FILES PREVIEW --}}
            @if (!empty($draft->media_files))
                <div class="mt-8 pt-6 border-t border-[var(--color-border)]">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xs font-bold text-[var(--color-text-main)] uppercase tracking-widest">Aset Tersimpan
                        </h4>
                        <span class="text-xs font-medium text-[var(--color-text-muted)]">{{ count($draft->media_files) }}
                            File</span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach ($draft->media_files as $path)
                            <div
                                class="relative rounded-xl overflow-hidden border border-[var(--color-border)] bg-[var(--color-bg)] aspect-square group">
                                @if (Str::endsWith($path, ['.jpg', '.jpeg', '.png', '.webp']))
                                    <img src="{{ Storage::url($path) }}" class="w-full h-full object-cover" alt="media">
                                @else
                                    <div
                                        class="w-full h-full flex flex-col items-center justify-center text-[var(--color-text-muted)] gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-[10px] font-bold tracking-widest">PDF</span>
                                    </div>
                                @endif
                                <div
                                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                    <span
                                        class="text-[10px] text-white font-medium px-2 text-center break-all line-clamp-2">{{ basename($path) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        <div class="flex items-center justify-between">
            <a href="{{ route('booking.step2') }}"
                class="text-sm font-semibold text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition-colors">←
                Kembali</a>
            <button type="submit"
                class="bg-[var(--color-text-main)] hover:bg-black text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition-all focus:ring-4 focus:ring-slate-300 active:scale-95 flex items-center gap-3">
                <span>Lanjutkan ke Tahap 4</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </form>

    @push('scripts')
        <script>
            const fileInput = document.getElementById('file-input');
            const previewGrid = document.getElementById('preview-grid');

            fileInput.addEventListener('change', (e) => {
                previewGrid.innerHTML = '';
                const files = Array.from(e.target.files).slice(0, 12);

                if (files.length > 0) {
                    previewGrid.classList.remove('hidden');
                } else {
                    previewGrid.classList.add('hidden');
                }

                files.forEach((file) => {
                    const card = document.createElement('div');
                    card.className =
                        'relative rounded-xl overflow-hidden border border-[var(--color-border)] bg-[var(--color-bg)] aspect-square group';

                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.className = 'w-full h-full object-cover';
                        card.appendChild(img);
                    } else {
                        card.innerHTML = `
                    <div class="w-full h-full flex flex-col items-center justify-center text-[var(--color-text-muted)] gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        <span class="text-[10px] font-bold tracking-widest">PDF</span>
                    </div>`;
                    }

                    const overlay = document.createElement('div');
                    overlay.className =
                        'absolute bottom-0 left-0 right-0 bg-black/70 text-white text-[10px] p-2 truncate backdrop-blur-md';
                    overlay.textContent = file.name;
                    card.appendChild(overlay);

                    previewGrid.appendChild(card);
                });
            });
        </script>
    @endpush
@endsection
