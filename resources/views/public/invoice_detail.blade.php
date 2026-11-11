@extends('layouts.public')

@section('title', 'Faktur Tagihan ' . $invoice->invoice_number . ' — PT Lampung Post')

@section('content')
    @php
        $fmt = config('ad_booking.formats')[$invoice->ad_format] ?? null;
        $isSelfBooking = !empty($invoice->category) || !empty($invoice->ad_title);
        $billingName = $invoice->billing_name ?? ($invoice->advertiser_name ?? '-');
        $billingEmail = $invoice->billing_email ?? ($invoice->advertiser_contact ?? '-');
        $billingPhone = $invoice->billing_phone ?? '-';
        $billingNpwp = $invoice->billing_npwp_nik ?? null;
        $billingAddress = $invoice->billing_address ?? null;
    @endphp

    <div class="bg-[var(--color-bg)] py-10 lg:py-16 print:bg-white print:py-0">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6 print:px-0 print:max-w-full">

            {{-- Top Toolbar (Non-printable) --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden">
                <a href="{{ route('public.pay.form') }}"
                   class="inline-flex items-center gap-2 text-[10px] font-bold text-[var(--color-text-muted)] hover:text-[var(--color-brand)] transition uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Cari Tagihan Lain
                </a>

                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" onclick="copyInvoiceLink()" id="btn-copy-url"
                            class="px-4 py-2 rounded-xl bg-white border border-[var(--color-border)] text-[var(--color-text-main)] hover:border-[var(--color-border-hover)] text-xs font-bold transition inline-flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-[var(--color-text-muted)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Salin Link</span>
                    </button>

                    <a href="{{ route('pay.download', $invoice->invoice_number) }}"
                       class="px-4 py-2 rounded-xl bg-white border border-[var(--color-border)] text-[var(--color-text-main)] hover:border-[var(--color-border-hover)] text-xs font-bold transition inline-flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Unduh PDF</span>
                    </a>

                    <button type="button" onclick="window.print()"
                            class="px-4 py-2 rounded-xl bg-[var(--color-text-main)] hover:bg-black text-white text-xs font-bold shadow-sm transition inline-flex items-center gap-2 active:scale-95">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak Faktur</span>
                    </button>
                </div>
            </div>

            {{-- Action Card (Unpaid) --}}
            @if ($invoice->status === 'unpaid')
                <div class="hairline-card p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6 print:hidden border-2 border-[var(--color-brand)]">
                    <div class="space-y-1.5">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)]">Konfirmasi Pelunasan</p>
                        <h3 class="text-xl sm:text-2xl font-editorial font-semibold text-[var(--color-text-main)]">Siap untuk Membayar Tagihan Ini?</h3>
                        <p class="text-xs sm:text-sm text-[var(--color-text-muted)] max-w-lg leading-relaxed">
                            Klik tombol di samping untuk diarahkan ke Payment Gateway Midtrans. Anda dapat memilih QRIS, Virtual Account Bank, atau e-Wallet favorit Anda.
                        </p>
                    </div>

                    <form action="{{ route('public.pay.process', $invoice->invoice_number) }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button type="submit"
                                class="w-full sm:w-auto bg-[var(--color-brand)] hover:bg-red-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-sm transition-all active:scale-95 text-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span>Bayar Sekarang (Midtrans)</span>
                        </button>
                    </form>
                </div>
            @else
                {{-- Paid Notice --}}
                @php $paidPayment = $invoice->payments->where('status', 'success')->first(); @endphp
                @if ($paidPayment)
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold shrink-0">✓</div>
                            <div>
                                <h4 class="font-bold text-sm text-emerald-950">Tagihan Telah Lunas</h4>
                                <p class="text-xs text-emerald-700 mt-0.5">Kuitansi resmi berstempel digital telah diterbitkan.</p>
                            </div>
                        </div>
                        <a href="{{ route('receipt.download', $paidPayment->id) }}"
                           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Unduh Kuitansi PDF
                        </a>
                    </div>
                @endif
            @endif

            {{-- Official Invoice Document Sheet --}}
            <div class="bg-white border border-[var(--color-border)] rounded-2xl p-6 sm:p-10 lg:p-12 text-[var(--color-text-main)] relative print:border-none print:shadow-none print:p-0 print:m-0 print:rounded-none">

                {{-- Letterhead --}}
                <div class="pb-6 border-b border-[var(--color-border)] mb-8 flex flex-col sm:flex-row sm:items-start justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-[var(--color-brand)] text-white font-bold flex items-center justify-center text-lg shrink-0">LP</div>
                        <div>
                            <h2 class="text-xl font-editorial font-semibold text-[var(--color-text-main)] tracking-tight">PT LAMPUNG POST</h2>
                            <p class="text-xs text-[var(--color-text-muted)] font-medium mt-0.5">PT Masa Kini Mandiri (Lampung Post Media Group)</p>
                            <p class="text-[11px] text-[var(--color-text-muted)] mt-1">Penerbitan Surat Kabar Harian, Portal Berita Siber & Jasa Periklanan</p>
                        </div>
                    </div>

                    <div class="text-left sm:text-right text-[11px] text-[var(--color-text-muted)] space-y-0.5 sm:pl-4">
                        <p class="font-medium text-[var(--color-text-main)]">Jl. Soekarno Hatta No. 108, Rajabasa, Bandar Lampung 35144</p>
                        <p>Telp: (0721) 783693 / 783694 • Fax: (0721) 783695</p>
                        <p>Email: <span class="text-[var(--color-text-main)] font-medium">keuangan@lampungpost.co.id</span></p>
                        <p>www.lampungpost.co.id</p>
                        <p class="font-mono font-medium text-[var(--color-text-main)]">NPWP: 01.325.882.1-322.000</p>
                    </div>
                </div>

                {{-- Invoice Document Header Strip --}}
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-8">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-[var(--color-brand)] block mb-2">
                            Commercial Invoice / Faktur Penagihan
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-editorial font-semibold tracking-tight text-[var(--color-text-main)]">
                            {{ $invoice->invoice_number }}
                        </h1>
                        <p class="text-xs text-[var(--color-text-muted)] mt-1">Dokumen Penagihan Elektronik Sah PT Lampung Post</p>
                    </div>

                    <div class="sm:text-right">
                        @if ($invoice->status === 'paid')
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Lunas / Paid
                            </span>
                        @elseif($invoice->status === 'unpaid')
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                Menunggu Pembayaran
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[var(--color-bg)] text-[var(--color-text-muted)] border border-[var(--color-border)]">
                                {{ strtoupper($invoice->status) }}
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Billed By & Billed To --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-8">
                    <div class="bg-[var(--color-bg)] rounded-xl p-5 border border-[var(--color-border)]">
                        <span class="text-[10px] font-bold text-[var(--color-brand)] uppercase tracking-widest block mb-3 pb-2 border-b border-[var(--color-border)]">
                            Penerbit Tagihan (Billed By)
                        </span>
                        <p class="font-bold text-sm text-[var(--color-text-main)]">PT LAMPUNG POST</p>
                        <p class="text-xs text-[var(--color-text-muted)] mt-1">Divisi Keuangan, Iklan & Sirkulasi Media</p>
                        <p class="text-xs text-[var(--color-text-muted)] mt-2">Petugas: <span class="font-semibold text-[var(--color-text-main)]">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</span></p>
                    </div>

                    <div class="bg-[var(--color-bg)] rounded-xl p-5 border border-[var(--color-border)]">
                        <span class="text-[10px] font-bold text-[var(--color-brand)] uppercase tracking-widest block mb-3 pb-2 border-b border-[var(--color-border)]">
                            Ditujukan Kepada (Billed To)
                        </span>
                        <p class="font-bold text-sm text-[var(--color-text-main)]">{{ $billingName }}</p>
                        @if ($billingEmail !== '-')
                            <p class="text-xs text-[var(--color-text-muted)] mt-1 break-all">{{ $billingEmail }}</p>
                        @endif
                        @if ($billingPhone !== '-')
                            <p class="text-xs text-[var(--color-text-muted)] mt-1">Telp/WA: {{ $billingPhone }}</p>
                        @endif
                        @if ($billingNpwp)
                            <p class="text-xs text-[var(--color-text-muted)] mt-1">NPWP/NIK: {{ $billingNpwp }}</p>
                        @endif
                        @if ($billingAddress)
                            <p class="text-[11px] text-[var(--color-text-muted)] mt-2 leading-relaxed border-t border-[var(--color-border)] pt-2">{{ $billingAddress }}</p>
                        @else
                            <p class="text-xs text-[var(--color-text-muted)] mt-2">Mitra Pengiklan Resmi Lampung Post</p>
                        @endif
                    </div>
                </div>

                {{-- Meta Strip (Dates) --}}
                <div class="bg-[var(--color-brand-light)] rounded-xl p-4 border-l-2 border-[var(--color-brand)] mb-8 grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                    <div>
                        <span class="text-[var(--color-text-muted)] block text-[10px] font-bold uppercase tracking-widest mb-1">Tanggal Diterbitkan</span>
                        <span class="font-bold text-[var(--color-text-main)]">{{ $invoice->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <div>
                        <span class="text-[var(--color-text-muted)] block text-[10px] font-bold uppercase tracking-widest mb-1">Jatuh Tempo</span>
                        <span class="font-bold text-[var(--color-brand)]">{{ $invoice->due_date->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <span class="text-[var(--color-text-muted)] block text-[10px] font-bold uppercase tracking-widest mb-1">Status Pelunasan</span>
                        <span class="font-bold uppercase {{ $invoice->status === 'paid' ? 'text-emerald-700' : 'text-amber-700' }}">
                            {{ $invoice->status === 'paid' ? 'LUNAS' : 'BELUM DILUNASI' }}
                        </span>
                    </div>
                </div>

                {{-- Itemized Table --}}
                <div class="overflow-x-auto mb-6">
                    <table class="w-full text-left text-xs sm:text-sm border-collapse">
                        <thead>
                            <tr class="bg-[var(--color-bg)] text-[var(--color-text-main)] uppercase text-[10px] tracking-widest font-bold border-y border-[var(--color-border)]">
                                <th class="py-3 px-4 text-center w-12">No</th>
                                <th class="py-3 px-4">Deskripsi Layanan & Spesifikasi</th>
                                <th class="py-3 px-4 text-center">Durasi</th>
                                <th class="py-3 px-4 text-center w-20">Qty</th>
                                <th class="py-3 px-4 text-right">Subtotal (IDR)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--color-border)] text-[var(--color-text-main)]">
                            <tr>
                                <td class="py-4 px-4 text-center font-bold text-[var(--color-text-muted)] align-top">1</td>
                                <td class="py-4 px-4 align-top">
                                    <p class="font-bold text-[var(--color-text-main)] text-sm leading-snug">
                                        @if ($invoice->ad_title)
                                            {{ $invoice->ad_title }}
                                        @else
                                            Penayangan Slot Iklan: {{ $invoice->ad_slot ?? 'Custom' }}
                                        @endif
                                    </p>

                                    @if ($invoice->category)
                                        <p class="text-xs text-[var(--color-text-muted)] mt-1.5">
                                            <span class="font-bold text-[var(--color-text-main)]">Kategori:</span>
                                            {{ $invoice->category }}
                                            @if ($invoice->subcategory)
                                                › {{ $invoice->subcategory }}
                                            @endif
                                        </p>
                                    @endif

                                    @if ($fmt)
                                        <p class="text-xs text-[var(--color-text-muted)] mt-1">
                                            <span class="font-bold text-[var(--color-text-main)]">Format:</span> {{ $fmt['name'] }}
                                            <span class="text-[var(--color-text-muted)]">({{ $fmt['size'] }})</span>
                                        </p>
                                    @endif

                                    @if ($invoice->ad_text)
                                        <p class="text-xs text-[var(--color-text-muted)] mt-2 leading-relaxed italic border-l-2 border-[var(--color-border)] pl-3">
                                            {{ \Illuminate\Support\Str::limit($invoice->ad_text, 300) }}
                                        </p>
                                    @elseif($invoice->description)
                                        <p class="text-xs text-[var(--color-text-muted)] mt-1 leading-relaxed">
                                            {{ $invoice->description }}
                                        </p>
                                    @endif

                                    @if (!empty($invoice->media_files))
                                        <p class="text-[11px] text-[var(--color-text-muted)] mt-2">
                                            📎 {{ count($invoice->media_files) }} file media dilampirkan
                                        </p>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center align-top">
                                    <span class="font-bold text-[var(--color-text-main)] block">{{ $invoice->ad_duration_days ?? 7 }} Hari</span>
                                    <span class="text-[11px] text-[var(--color-text-muted)]">
                                        Mulai: {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d M Y') : '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center font-semibold text-[var(--color-text-main)] align-top">1 Paket</td>
                                <td class="py-4 px-4 text-right font-bold text-[var(--color-text-main)] align-top">
                                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Media Preview --}}
                @if (!empty($invoice->media_files))
                    <div class="bg-[var(--color-bg)] rounded-xl p-5 border border-[var(--color-border)] mb-6">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-4 h-4 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-[10px] font-bold text-[var(--color-text-main)] uppercase tracking-widest">Lampiran Media ({{ count($invoice->media_files) }} File)</span>
                        </div>
                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                            @foreach ($invoice->media_files as $path)
                                <a href="{{ Storage::url($path) }}" target="_blank"
                                   class="relative rounded-lg overflow-hidden border border-[var(--color-border)] bg-white aspect-square hover:border-[var(--color-brand)] hover:shadow-[var(--shadow-ambient)] transition group">
                                    @if (\Illuminate\Support\Str::endsWith(strtolower($path), ['.jpg', '.jpeg', '.png', '.webp']))
                                        <img src="{{ Storage::url($path) }}" class="w-full h-full object-cover" alt="media">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-[var(--color-text-muted)] bg-[var(--color-bg)]">
                                            <svg class="w-6 h-6 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-[9px] font-bold">PDF</span>
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                        <p class="text-[10px] text-[var(--color-text-muted)] mt-2 italic">*Klik untuk membuka file ukuran penuh.</p>
                    </div>
                @endif

                {{-- Financial Calculation --}}
                <div class="border-t border-[var(--color-border)] pt-4 mb-6">
                    <div class="flex flex-col sm:items-end space-y-2 text-xs sm:text-sm">
                        <div class="flex justify-between sm:w-80 text-[var(--color-text-muted)]">
                            <span>Subtotal Tagihan:</span>
                            <span class="font-bold text-[var(--color-text-main)]">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between sm:w-80 text-[var(--color-text-muted)]">
                            <span>PPN (Pajak Pertambahan Nilai):</span>
                            <span class="font-bold text-[var(--color-text-main)]">Termasuk (Rp 0)</span>
                        </div>
                        <div class="flex justify-between sm:w-80 text-[var(--color-text-muted)]">
                            <span>Biaya Administrasi:</span>
                            <span class="font-bold text-emerald-600">Gratis (Rp 0)</span>
                        </div>
                        <div class="flex justify-between sm:w-80 pt-3 border-t-2 border-[var(--color-text-main)] items-baseline">
                            <span class="text-xs font-bold text-[var(--color-text-main)] uppercase tracking-widest">Total Tagihan:</span>
                            <span class="text-2xl sm:text-3xl font-editorial font-semibold text-[var(--color-brand)]">
                                Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Terbilang --}}
                <div class="bg-[var(--color-bg)] border border-dashed border-[var(--color-border-hover)] rounded-lg p-3.5 text-xs text-[var(--color-text-main)] italic mb-8">
                    <span class="font-bold text-[var(--color-text-main)] not-italic">Terbilang:</span>
                    {{ \App\Support\Terbilang::rupiah($invoice->amount) }}
                </div>

                {{-- Payment Instructions (Dual Channel) --}}
                <div class="grid sm:grid-cols-2 gap-4 mb-8">
                    <div class="bg-[var(--color-bg)] rounded-xl p-5 border border-[var(--color-border)]">
                        <div class="flex items-center gap-2 mb-2 text-[var(--color-text-main)] font-bold text-[10px] uppercase tracking-widest">
                            <svg class="w-4 h-4 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span>1. Pembayaran Digital Instan</span>
                        </div>
                        <p class="text-xs text-[var(--color-text-muted)] leading-relaxed mb-3">
                            Selesaikan transaksi secara real-time via Payment Gateway (QRIS Semua Bank, Mandiri, BCA, BRI, BNI, GoPay, ShopeePay).
                        </p>
                        <div class="flex flex-wrap gap-1.5 text-[10px] font-bold text-[var(--color-text-main)]">
                            <span class="bg-white px-2 py-0.5 rounded border border-[var(--color-border)]">QRIS</span>
                            <span class="bg-white px-2 py-0.5 rounded border border-[var(--color-border)]">BCA VA</span>
                            <span class="bg-white px-2 py-0.5 rounded border border-[var(--color-border)]">Mandiri VA</span>
                            <span class="bg-white px-2 py-0.5 rounded border border-[var(--color-border)]">BNI</span>
                            <span class="bg-white px-2 py-0.5 rounded border border-[var(--color-border)]">GoPay</span>
                        </div>
                    </div>

                    <div class="bg-[var(--color-bg)] rounded-xl p-5 border border-[var(--color-border)]">
                        <div class="flex items-center gap-2 mb-2 text-[var(--color-text-main)] font-bold text-[10px] uppercase tracking-widest">
                            <svg class="w-4 h-4 text-[var(--color-brand)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span>2. Rekening Resmi Perusahaan</span>
                        </div>
                        <div class="space-y-1.5 text-xs text-[var(--color-text-main)]">
                            <p><strong>BCA:</strong> <span class="font-mono font-bold">023-8899-777</span> (a.n. PT LAMPUNG POST)</p>
                            <p><strong>Mandiri:</strong> <span class="font-mono font-bold">114-00-998877-6</span> (a.n. PT LAMPUNG POST)</p>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="bg-amber-50 border-l-2 border-amber-500 rounded-r-lg p-4 text-[11px] text-amber-900 leading-relaxed mb-10">
                    <p class="font-bold text-amber-950 mb-1">Ketentuan Pembayaran & Penayangan:</p>
                    <ol class="list-decimal list-inside space-y-0.5">
                        <li>Tagihan ini sah diterbitkan oleh PT Lampung Post sebagai surat tagihan pembayaran resmi.</li>
                        <li>Materi iklan akan diproses tayang setelah pembayaran berhasil diverifikasi oleh sistem keuangan.</li>
                        <li>Kuitansi resmi berformat PDF berstempel digital diterbitkan langsung secara otomatis setelah transaksi lunas.</li>
                    </ol>
                </div>

                {{-- Signature Block --}}
                <div class="grid grid-cols-2 gap-8 text-center text-xs pt-4 border-t border-[var(--color-border)]">
                    <div>
                        <p class="text-[var(--color-text-muted)]">Penerima Tagihan (Pengiklan)</p>
                        <div class="h-20 flex items-center justify-center my-2">
                            @if ($invoice->hasSignature())
                                <img src="{{ $invoice->signature_data }}" alt="Signature" class="max-h-16 max-w-[180px] object-contain">
                            @else
                                <span class="text-[10px] text-[var(--color-text-muted)] italic">— belum ditandatangani —</span>
                            @endif
                        </div>
                        <p class="font-bold text-[var(--color-text-main)] border-t border-[var(--color-border)] pt-1.5 inline-block min-w-[160px] max-w-[220px] truncate">
                            {{ $invoice->signed_by_name ?? ($invoice->billing_name ?? 'Pengiklan') }}
                        </p>
                        <p class="text-[11px] text-[var(--color-text-muted)]">Penanggung Jawab Pesanan</p>
                        @if ($invoice->signed_at)
                            <p class="text-[10px] text-emerald-600 mt-1">
                                ✓ Ditandatangani {{ $invoice->signed_at->translatedFormat('d M Y, H:i') }} WIB
                            </p>
                        @endif
                    </div>

                    <div>
                        <p class="text-[var(--color-text-muted)]">Bandar Lampung, {{ $invoice->created_at->translatedFormat('d F Y') }}</p>
                        <div class="h-20 flex items-center justify-center my-2">
                            <span class="text-[10px] font-mono text-[var(--color-brand)] bg-[var(--color-brand-light)] border border-[var(--color-brand-muted)] px-3 py-1 rounded-md uppercase font-bold tracking-wider">
                                Signed Digitally
                            </span>
                        </div>
                        <p class="font-bold text-[var(--color-text-main)] border-t border-[var(--color-border)] pt-1.5 inline-block min-w-[160px]">
                            {{ $invoice->creator->name ?? 'Admin Keuangan' }}
                        </p>
                        <p class="text-[11px] text-[var(--color-text-muted)]">Divisi Keuangan PT Lampung Post</p>
                    </div>
                </div>

                {{-- Print footer --}}
                <div class="mt-8 pt-4 border-t border-[var(--color-border)] text-center text-[10px] text-[var(--color-text-muted)]">
                    Dokumen ini dicetak dari Portal E-Payment Resmi PT Lampung Post • Verifikasi keaslian: {{ route('public.pay.show', $invoice->invoice_number) }}
                </div>
            </div>


        </div>
    </div>

    @push('scripts')
        <script>
            function copyInvoiceLink() {
                navigator.clipboard.writeText(window.location.href).then(function () {
                    const btn = document.getElementById('btn-copy-url');
                    if (btn) {
                        const orig = btn.innerHTML;
                        btn.innerHTML = '<span class="text-emerald-600 font-bold">✓ Link Tersalin</span>';
                        setTimeout(() => btn.innerHTML = orig, 2000);
                    }
                });
            }
        </script>
    @endpush
@endsection