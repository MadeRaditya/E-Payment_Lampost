@extends('public.booking.layout', ['currentStep' => 4])

@section('title', 'Penyelesaian — Pemesanan Iklan')

@section('content')
    <div class="mb-10 hidden lg:block">
        <h1 class="text-4xl font-editorial text-[var(--color-text-main)] mb-3">Penyelesaian & Verifikasi</h1>
        <p class="text-[var(--color-text-muted)] text-sm">Lengkapi data penanggung jawab dan tanda tangani pesanan Anda.</p>
    </div>

    <form action="{{ route('booking.step4.store') }}" method="POST" id="form-step4"
        class="grid lg:grid-cols-[1fr_360px] gap-8 items-start">
        @csrf

        {{-- MAIN FORM COLUMN --}}
        <div class="space-y-12">

            {{-- SECTION 1: DATA BILLING --}}
            <section>
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-[var(--color-text-main)]">1. Data Kuitansi (Billing)</h2>
                    <p class="text-[13px] text-[var(--color-text-muted)] mt-1">Data ini akan tercetak pada kuitansi resmi
                        (Faktur Pajak).</p>
                </div>

                <div class="hairline-card p-6 sm:p-8 space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="billing_name">Nama Lengkap / Perusahaan</label>
                        <input type="text" name="billing_name" id="billing_name"
                            value="{{ old('billing_name', $draft->billing_name ?? $draft->advertiser_name) }}" required
                            maxlength="150" class="form-input bg-[var(--color-bg)]">
                        @error('billing_name')
                            <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                                for="billing_npwp_nik">NPWP / NIK KTP</label>
                            <input type="text" name="billing_npwp_nik" id="billing_npwp_nik"
                                value="{{ old('billing_npwp_nik', $draft->billing_npwp_nik) }}" required maxlength="50"
                                class="form-input bg-[var(--color-bg)] font-mono text-sm">
                            @error('billing_npwp_nik')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                                for="billing_email">Alamat Surel (Email)</label>
                            <input type="email" name="billing_email" id="billing_email"
                                value="{{ old('billing_email', $draft->billing_email ?? $draft->advertiser_contact) }}"
                                required maxlength="150" class="form-input bg-[var(--color-bg)]">
                            @error('billing_email')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                                for="billing_phone">No. Telepon / WhatsApp</label>
                            <input type="text" name="billing_phone" id="billing_phone"
                                value="{{ old('billing_phone', $draft->billing_phone) }}" required maxlength="30"
                                class="form-input bg-[var(--color-bg)]">
                            @error('billing_phone')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label
                                class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                                for="billing_address">Alamat Lengkap</label>
                            <textarea name="billing_address" id="billing_address" rows="3" required maxlength="500"
                                class="form-input bg-[var(--color-bg)] resize-y">{{ old('billing_address', $draft->billing_address) }}</textarea>
                            @error('billing_address')
                                <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </section>

            {{-- SECTION 2: PREFERENSI PEMBAYARAN --}}
            <section>
                <div class="mb-5">
                    <h2 class="text-lg font-bold text-[var(--color-text-main)]">2. Metode Pembayaran</h2>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="payment_preference" value="online" class="peer radio-peer sr-only"
                            checked>
                        <div class="radio-card hairline-card p-6 h-full flex flex-col relative overflow-hidden">

                            <div
                                class="check-icon absolute top-6 right-6 w-5 h-5 rounded-full bg-[var(--color-brand)] text-white flex items-center justify-center opacity-0 scale-50 transition-all duration-300">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            <div
                                class="w-10 h-10 rounded-lg mb-3 flex items-center justify-center border border-[var(--color-border)] bg-white">
                                <svg class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-base mb-1 text-[var(--color-text-main)]">Otomatis (Midtrans)</h3>
                            <p class="text-[13px] text-[var(--color-text-muted)] leading-relaxed">Verifikasi instan via
                                QRIS, Virtual Account, atau e-Wallet.</p>
                        </div>
                    </label>

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="payment_preference" value="manual" class="peer radio-peer sr-only">
                        <div class="radio-card hairline-card p-6 h-full flex flex-col relative overflow-hidden">

                            <div
                                class="check-icon absolute top-6 right-6 w-5 h-5 rounded-full bg-[var(--color-brand)] text-white flex items-center justify-center opacity-0 scale-50 transition-all duration-300">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>

                            <div
                                class="w-10 h-10 rounded-lg mb-3 flex items-center justify-center border border-[var(--color-border)] bg-white">
                                <svg class="w-5 h-5 text-slate-800" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-base mb-1 text-[var(--color-text-main)]">Transfer Manual</h3>
                            <p class="text-[13px] text-[var(--color-text-muted)] leading-relaxed">Transfer bank
                                konvensional. Membutuhkan verifikasi tim admin.</p>
                        </div>
                    </label>
                </div>
            </section>

            {{-- SECTION 3: TANDA TANGAN --}}
            <section>
                <div class="mb-5 flex items-end justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-[var(--color-text-main)]">3. Persetujuan & Tanda Tangan</h2>
                        <p class="text-[13px] text-[var(--color-text-muted)] mt-1">Sesuai ketentuan UU ITE, persetujuan
                            elektronik ini sah di mata hukum.</p>
                    </div>
                </div>

                <div class="hairline-card p-6 sm:p-8">
                    <div class="mb-6">
                        <label
                            class="block text-xs font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-2"
                            for="signed_by_name">Nama Penandatangan</label>
                        <input type="text" name="signed_by_name" id="signed_by_name" required maxlength="150"
                            value="{{ old('signed_by_name', $draft->billing_name) }}"
                            class="form-input bg-[var(--color-bg)] w-full max-w-sm">
                    </div>

                    <div
                        class="relative bg-[var(--color-bg)] border border-[var(--color-border)] rounded-xl overflow-hidden group">
                        <!-- The Canvas -->
                        <canvas id="signature-pad" class="w-full touch-none cursor-crosshair block"
                            style="height: 240px;"></canvas>

                        <!-- The Placeholder -->
                        <div id="signature-placeholder"
                            class="absolute inset-0 flex flex-col items-center justify-center text-[var(--color-text-muted)] pointer-events-none transition-opacity duration-300">
                            <svg class="w-6 h-6 mb-3 text-slate-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <p class="text-sm font-bold text-[var(--color-text-main)]">Goreskan Tanda Tangan Anda</p>
                            <p class="text-xs mt-1">Gunakan mouse atau sentuh layar</p>
                        </div>

                        <!-- Clear Button Overlay -->
                        <button type="button" id="btn-clear-signature"
                            class="absolute bottom-4 right-4 bg-white/80 backdrop-blur border border-[var(--color-border)] px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-widest text-[var(--color-text-main)] hover:bg-white hover:text-[var(--color-brand)] transition-colors shadow-sm z-10 flex items-center gap-1.5 opacity-0 group-hover:opacity-100">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Bersihkan
                        </button>
                    </div>
                    <input type="hidden" name="signature_data" id="signature_data">
                </div>
            </section>

            <div class="pt-6 border-t border-[var(--color-border)] flex items-center justify-between">
                <a href="{{ route('booking.step3') }}"
                    class="text-sm font-semibold text-[var(--color-text-muted)] hover:text-[var(--color-text-main)] transition-colors">←
                    Kembali</a>

                <button type="submit"
                    class="bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold px-8 py-4 rounded-xl shadow-lg shadow-red-600/20 transition-all focus:ring-4 focus:ring-red-100 active:scale-95 flex items-center gap-3">
                    <span class="text-base">Proses Pemesanan</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- SIDEBAR: ORDER SUMMARY --}}
        <div class="sticky top-24">
            <div class="hairline-card p-6 bg-white shadow-xl shadow-slate-200/50">
                <div class="border-b border-[var(--color-border)] pb-4 mb-5 text-center">
                    <h3 class="text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-1">ID
                        Pesanan (Draft)</h3>
                    <p class="font-mono text-lg font-bold text-[var(--color-text-main)] tracking-tight">
                        {{ $draft->invoice_number }}</p>
                </div>

                <div class="space-y-4 text-sm font-medium">
                    <div>
                        <span class="block text-xs text-[var(--color-text-muted)] mb-0.5">Penempatan</span>
                        <span
                            class="text-[var(--color-text-main)]">{{ config('ad_booking.formats')[$draft->ad_format]['name'] ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block text-xs text-[var(--color-text-muted)] mb-0.5">Durasi Penayangan</span>
                        <span class="text-[var(--color-text-main)]">{{ $draft->ad_duration_days }} Hari</span>
                    </div>
                    <div>
                        <span class="block text-xs text-[var(--color-text-muted)] mb-0.5">Mulai Tayang</span>
                        <span
                            class="text-[var(--color-text-main)]">{{ $draft->ad_start_date?->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                <div class="mt-6 pt-5 border-t border-[var(--color-border)]">
                    <span
                        class="block text-[10px] font-bold text-[var(--color-text-muted)] uppercase tracking-widest mb-1">Subtotal</span>
                    <p class="text-3xl font-editorial font-bold text-[var(--color-brand)] leading-none mb-1">Rp
                        {{ number_format($draft->amount, 0, ',', '.') }}</p>
                </div>

                <div
                    class="mt-5 p-4 bg-[var(--color-bg)] rounded-lg flex items-start gap-3 border border-[var(--color-border)]">
                    <svg class="w-4 h-4 shrink-0 text-[var(--color-text-muted)] mt-0.5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <p class="text-[11px] text-[var(--color-text-muted)] leading-relaxed font-medium">Transaksi diamankan.
                        Data Anda dilindungi oleh kebijakan privasi perusahaan.</p>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const canvas = document.getElementById('signature-pad');
                const placeholder = document.getElementById('signature-placeholder');
                const hiddenInput = document.getElementById('signature_data');
                const clearBtn = document.getElementById('btn-clear-signature');
                const form = document.getElementById('form-step4');

                let hasDrawn = false; // Flag to fix initial click issue

                // High-DPI Canvas Setup
                function resizeCanvas() {
                    const ratio = Math.max(window.devicePixelRatio || 1, 1);
                    // Save current state before resize
                    const dataURL = hasDrawn ? signaturePad.toDataURL() : null;

                    canvas.width = canvas.offsetWidth * ratio;
                    canvas.height = canvas.offsetHeight * ratio;
                    canvas.getContext('2d').scale(ratio, ratio);

                    // Restore state if it was drawn
                    if (dataURL && signaturePad) {
                        signaturePad.fromDataURL(dataURL);
                    }
                }

                const signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgba(255, 255, 255, 0)', // Transparent
                    penColor: 'rgb(15, 23, 42)', // Slate 900
                    minWidth: 1.2,
                    maxWidth: 2.8,
                    velocityFilterWeight: 0.7
                });

                // Initial sizing
                resizeCanvas();
                window.addEventListener('resize', resizeCanvas);

                signaturePad.addEventListener('beginStroke', () => {
                    hasDrawn = true;
                    placeholder.style.opacity = '0';
                });

                clearBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent form submission
                    signaturePad.clear();
                    hiddenInput.value = '';
                    hasDrawn = false;
                    placeholder.style.opacity = '1';
                });

                form.addEventListener('submit', function(e) {
                    if (signaturePad.isEmpty()) {
                        e.preventDefault();
                        alert('Tanda tangan wajib diisi sebagai bukti persetujuan sah.');
                        canvas.parentElement.classList.add('ring-2', 'ring-red-500', 'ring-offset-2');
                        setTimeout(() => {
                            canvas.parentElement.classList.remove('ring-2', 'ring-red-500',
                                'ring-offset-2');
                        }, 2000);
                        canvas.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        return false;
                    }
                    // Add a small delay to ensure canvas data is captured cleanly
                    hiddenInput.value = signaturePad.toDataURL('image/png');
                });
            });
        </script>
    @endpush
@endsection
