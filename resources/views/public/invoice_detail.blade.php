@extends('layouts.public')

@section('title', 'Faktur Tagihan ' . $invoice->invoice_number . ' — PT Lampung Post')

@section('content')
@php
    $fmt = config('ad_booking.formats')[$invoice->ad_format] ?? null;
    $isSelfBooking = !empty($invoice->category) || !empty($invoice->ad_title);
    $billingName = $invoice->billing_name ?? $invoice->advertiser_name ?? '-';
    $billingEmail = $invoice->billing_email ?? $invoice->advertiser_contact ?? '-';
    $billingPhone = $invoice->billing_phone ?? '-';
    $billingNpwp = $invoice->billing_npwp_nik ?? null;
    $billingAddress = $invoice->billing_address ?? null;
@endphp

<div class="py-10 lg:py-16 bg-slate-100/70">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Top Toolbar (Non-printable) -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden">
            <a href="{{ route('public.pay.form') }}" 
               class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Cari Tagihan Lain</span>
            </a>

            <!-- Action Buttons Group -->
            <div class="flex flex-wrap items-center gap-2.5">
                <button type="button" onclick="copyInvoiceLink()" id="btn-copy-url"
                        class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold shadow-2xs transition inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    <span>Salin Link</span>
                </button>

                <a href="{{ route('pay.download', $invoice->invoice_number) }}" 
                   class="px-3.5 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 text-xs font-semibold shadow-2xs transition inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Unduh PDF</span>
                </a>

                <button type="button" onclick="window.print()" 
                        class="px-3.5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-semibold shadow-2xs transition inline-flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    <span>Cetak Faktur</span>
                </button>
            </div>
        </div>

        <!-- Official Commercial Invoice Document Sheet (A4 Proportion) -->
        <div class="bg-white border border-slate-200/90 shadow-2xl rounded-3xl p-6 sm:p-10 lg:p-12 text-slate-800 relative overflow-hidden print:border-none print:shadow-none print:p-0 print:m-0 print:rounded-none">
            
            <!-- Top Corporate Accent Bar -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-red-600 via-red-700 to-slate-900 print:hidden"></div>

            <!-- Letterhead / Kop Surat Resmi -->
            <div class="pb-6 border-b-2 border-red-600 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-600 to-red-700 text-white font-extrabold flex items-center justify-center text-2xl shadow-md shadow-red-600/20 flex-shrink-0">
                        LP
                    </div>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black tracking-tight text-slate-950">PT LAMPUNG POST</h2>
                        <p class="text-xs text-slate-500 font-medium">PT Masa Kini Mandiri (Lampung Post Media Group)</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Penerbitan Surat Kabar Harian, Portal Berita Siber & Jasa Periklanan</p>
                    </div>
                </div>

                <div class="text-left sm:text-right text-xs text-slate-500 space-y-0.5 sm:border-l-0 border-l-2 border-slate-200 pl-3 sm:pl-0">
                    <p class="font-medium text-slate-700">Jl. Soekarno Hatta No. 108, Rajabasa, Bandar Lampung 35144</p>
                    <p>Telp: (0721) 783693 / 783694 • Fax: (0721) 783695</p>
                    <p>Email: <span class="text-slate-700 font-medium">keuangan@lampungpost.co.id</span> • www.lampungpost.co.id</p>
                    <p class="font-mono text-[11px] text-slate-600">NPWP: 01.325.882.1-322.000</p>
                </div>
            </div>

            <!-- Invoice Document Header Strip -->
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-8">
                <div>
                    <span class="text-[11px] font-extrabold uppercase tracking-widest text-red-600 block mb-1">
                        Commercial Invoice / Faktur Penagihan
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-black font-mono tracking-tight text-slate-900">
                        {{ $invoice->invoice_number }}
                    </h1>
                    <p class="text-xs text-slate-400 mt-1">
                        Dokumen Penagihan Elektronik Sah PT Lampung Post
                    </p>
                </div>

                <div class="sm:text-right">
                    @if($invoice->status === 'paid')
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-emerald-50 text-emerald-700 border-2 border-emerald-300">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Lunas / Paid
                        </span>
                    @elseif($invoice->status === 'unpaid')
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-amber-50 text-amber-700 border-2 border-amber-300">
                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                            Menunggu Pembayaran
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-300">
                            {{ strtoupper($invoice->status) }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Billed By & Billed To Cards -->
            <div class="grid sm:grid-cols-2 gap-4 mb-8">
                <!-- Billed By -->
                <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/80">
                    <span class="text-[11px] font-bold text-red-600 uppercase tracking-wider block mb-2 pb-1 border-b border-slate-200">
                        Penerbit Tagihan (Billed By)
                    </span>
                    <p class="font-extrabold text-sm text-slate-900">PT LAMPUNG POST</p>
                    <p class="text-xs text-slate-600 mt-0.5">Divisi Keuangan, Iklan & Sirkulasi Media</p>
                    <p class="text-xs text-slate-500 mt-1">Petugas: <span class="font-semibold text-slate-700">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</span></p>
                </div>

                <!-- Billed To (UPDATED dengan billing fields) -->
                <div class="bg-slate-50/80 rounded-2xl p-5 border border-slate-200/80">
                    <span class="text-[11px] font-bold text-red-600 uppercase tracking-wider block mb-2 pb-1 border-b border-slate-200">
                        Ditujukan Kepada (Billed To)
                    </span>
                    <p class="font-extrabold text-sm text-slate-900">{{ $billingName }}</p>
                    
                    @if($billingEmail !== '-')
                        <p class="text-xs text-slate-600 font-mono mt-0.5 break-all">{{ $billingEmail }}</p>
                    @endif

                    @if($billingPhone !== '-')
                        <p class="text-xs text-slate-600 mt-0.5">Telp/WA: <span class="font-mono">{{ $billingPhone }}</span></p>
                    @endif

                    @if($billingNpwp)
                        <p class="text-xs text-slate-600 font-mono mt-0.5">NPWP/NIK: {{ $billingNpwp }}</p>
                    @endif

                    @if($billingAddress)
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed border-t border-slate-200 pt-2">{{ $billingAddress }}</p>
                    @else
                        <p class="text-xs text-slate-500 mt-1">Mitra Pengiklan Resmi Lampung Post</p>
                    @endif
                </div>
            </div>

            <!-- Meta Strip (Dates) -->
            <div class="bg-red-50/60 rounded-xl p-3.5 border-l-4 border-red-600 mb-8 grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs">
                <div>
                    <span class="text-slate-500 block">Tanggal Diterbitkan:</span>
                    <span class="font-bold text-slate-900">{{ $invoice->created_at->translatedFormat('d F Y') }}</span>
                </div>
                <div>
                    <span class="text-slate-500 block">Batas Waktu Bayar (Jatuh Tempo):</span>
                    <span class="font-bold text-red-700">{{ $invoice->due_date->translatedFormat('d F Y') }}</span>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <span class="text-slate-500 block">Status Pelunasan:</span>
                    <span class="font-bold uppercase {{ $invoice->status === 'paid' ? 'text-emerald-700' : 'text-amber-700' }}">
                        {{ $invoice->status === 'paid' ? 'LUNAS' : 'BELUM DILUNASI' }}
                    </span>
                </div>
            </div>

            <!-- Itemized Table (UPDATED dengan konten booking baru) -->
            <div class="overflow-x-auto mb-6">
                <table class="w-full text-left text-xs sm:text-sm border-collapse">
                    <thead>
                        <tr class="bg-slate-900 text-white uppercase text-[11px] tracking-wider font-bold">
                            <th class="py-3.5 px-4 rounded-l-xl text-center w-12">No</th>
                            <th class="py-3.5 px-4">Deskripsi Layanan & Spesifikasi</th>
                            <th class="py-3.5 px-4 text-center">Durasi / Periode</th>
                            <th class="py-3.5 px-4 text-center w-20">Qty</th>
                            <th class="py-3.5 px-4 rounded-r-xl text-right">Subtotal (IDR)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-800">
                        <tr>
                            <td class="py-4 px-4 text-center font-bold text-slate-400 align-top">1</td>
                            <td class="py-4 px-4 align-top">
                                <!-- Judul Iklan / Slot Iklan -->
                                <p class="font-extrabold text-slate-900 text-sm sm:text-base leading-tight">
                                    @if($invoice->ad_title)
                                        {{ $invoice->ad_title }}
                                    @else
                                        Penayangan Slot Iklan: {{ $invoice->ad_slot ?? 'Custom' }}
                                    @endif
                                </p>

                                <!-- Kategori & Sub-Kategori -->
                                @if($invoice->category)
                                    <p class="text-xs text-slate-600 mt-1.5">
                                        <span class="font-bold text-slate-700">Kategori:</span> {{ $invoice->category }}
                                        @if($invoice->subcategory) › {{ $invoice->subcategory }} @endif
                                    </p>
                                @endif

                                <!-- Format Iklan -->
                                @if($fmt)
                                    <p class="text-xs text-slate-600 mt-1">
                                        <span class="font-bold text-slate-700">Format:</span> {{ $fmt['name'] }}
                                        <span class="text-slate-400">({{ $fmt['size'] }})</span>
                                    </p>
                                @endif

                                <!-- Teks Iklan -->
                                @if($invoice->ad_text)
                                    <p class="text-xs text-slate-500 mt-2 leading-relaxed italic border-l-2 border-slate-200 pl-3">
                                        {{ \Illuminate\Support\Str::limit($invoice->ad_text, 300) }}
                                    </p>
                                @elseif($invoice->description)
                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                        {{ $invoice->description }}
                                    </p>
                                @endif

                                <!-- Media Info -->
                                @if(!empty($invoice->media_files))
                                    <p class="text-[11px] text-slate-400 mt-2">
                                        📎 {{ count($invoice->media_files) }} file media dilampirkan
                                    </p>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-center align-top">
                                <span class="font-bold text-slate-900 block">{{ $invoice->ad_duration_days ?? 7 }} Hari</span>
                                <span class="text-[11px] text-slate-400">
                                    Mulai: {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d M Y') : '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-center font-semibold text-slate-700 align-top">1 Paket</td>
                            <td class="py-4 px-4 text-right font-black text-slate-900 text-sm sm:text-base align-top">
                                Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Media Preview Section (HANYA muncul jika ada media) -->
            @if(!empty($invoice->media_files))
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 mb-6">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-xs font-black text-slate-900 uppercase tracking-wider">Lampiran Media ({{ count($invoice->media_files) }} File)</span>
                    </div>
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        @foreach($invoice->media_files as $path)
                            <a href="{{ Storage::url($path) }}" target="_blank"
                               class="relative rounded-xl overflow-hidden border border-slate-200 bg-white aspect-square hover:border-red-500 hover:shadow-md transition group">
                                @if(\Illuminate\Support\Str::endsWith(strtolower($path), ['.jpg','.jpeg','.png','.webp']))
                                    <img src="{{ Storage::url($path) }}" class="w-full h-full object-cover" alt="media">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                        <svg class="w-6 h-6 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span class="text-[9px] font-bold">PDF</span>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>
                    <p class="text-[10px] text-slate-400 mt-2 italic">*Klik untuk membuka file ukuran penuh.</p>
                </div>
            @endif

            <!-- Financial Calculation Block -->
            <div class="border-t border-slate-200 pt-4 mb-6">
                <div class="flex flex-col sm:items-end space-y-2 text-xs sm:text-sm">
                    <div class="flex justify-between sm:w-80 text-slate-600">
                        <span>Subtotal Tagihan:</span>
                        <span class="font-bold text-slate-900">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between sm:w-80 text-slate-600">
                        <span>PPN (Pajak Pertambahan Nilai):</span>
                        <span class="font-bold text-slate-900">Termasuk (Rp 0)</span>
                    </div>
                    <div class="flex justify-between sm:w-80 text-slate-600">
                        <span>Biaya Administrasi:</span>
                        <span class="font-bold text-emerald-600">Gratis (Rp 0)</span>
                    </div>
                    <div class="flex justify-between sm:w-80 pt-3 border-t-2 border-slate-900 items-baseline">
                        <span class="text-sm font-black text-slate-900 uppercase tracking-wider">Total Tagihan:</span>
                        <span class="text-2xl sm:text-3xl font-black text-red-600">
                            Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Terbilang Box -->
            <div class="bg-slate-50 border border-dashed border-slate-300 rounded-xl p-3.5 text-xs text-slate-700 italic mb-8">
                <span class="font-bold text-slate-900 not-italic">Terbilang:</span> 
                {{ \App\Support\Terbilang::rupiah($invoice->amount) }}
            </div>

            <!-- Payment Instructions (Dual Channel) -->
            <div class="grid sm:grid-cols-2 gap-4 mb-8">
                <!-- Channel 1: Online Gateway -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <div class="flex items-center gap-2 mb-2 text-slate-900 font-bold text-xs uppercase tracking-wider">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span>1. Pembayaran Digital Instan</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed mb-3">
                        Selesaikan transaksi secara real-time via Payment Gateway (QRIS Semua Bank, Mandiri, BCA, BRI, BNI, GoPay, ShopeePay).
                    </p>
                    <div class="flex flex-wrap gap-1.5 text-[10px] font-bold text-slate-600">
                        <span class="bg-white px-2 py-0.5 rounded border border-slate-200">QRIS</span>
                        <span class="bg-white px-2 py-0.5 rounded border border-slate-200">BCA VA</span>
                        <span class="bg-white px-2 py-0.5 rounded border border-slate-200">Mandiri VA</span>
                        <span class="bg-white px-2 py-0.5 rounded border border-slate-200">BNI</span>
                        <span class="bg-white px-2 py-0.5 rounded border border-slate-200">GoPay</span>
                    </div>
                </div>

                <!-- Channel 2: Transfer Bank Manual -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <div class="flex items-center gap-2 mb-2 text-slate-900 font-bold text-xs uppercase tracking-wider">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        <span>2. Rekening Resmi Perusahaan</span>
                    </div>
                    <div class="space-y-1.5 text-xs text-slate-700">
                        <p><strong>BCA:</strong> <span class="font-mono font-bold">023-8899-777</span> (a.n. PT LAMPUNG POST)</p>
                        <p><strong>Mandiri:</strong> <span class="font-mono font-bold">114-00-998877-6</span> (a.n. PT LAMPUNG POST)</p>
                    </div>
                </div>
            </div>

            <!-- Terms & Conditions -->
            <div class="bg-amber-50/70 border-l-4 border-amber-500 rounded-r-xl p-4 text-[11px] text-amber-900 leading-relaxed mb-10">
                <p class="font-bold text-amber-950 mb-1">Ketentuan Pembayaran & Penayangan:</p>
                <ol class="list-decimal list-inside space-y-0.5 text-amber-800">
                    <li>Tagihan ini sah diterbitkan oleh PT Lampung Post sebagai surat tagihan pembayaran resmi.</li>
                    <li>Materi iklan akan diproses tayang setelah pembayaran berhasil diverifikasi oleh sistem keuangan.</li>
                    <li>Kuitansi resmi berformat PDF berstempel digital diterbitkan langsung secara otomatis setelah transaksi lunas.</li>
                </ol>
            </div>

            <!-- Corporate Signature Block (UPDATED dengan billing_name) -->
            <div class="grid grid-cols-2 gap-8 text-center text-xs pt-4 border-t border-slate-200">
                <div>
                    <p class="text-slate-500">Penerima Tagihan (Pengiklan)</p>
                    <div class="h-16"></div>
                    <p class="font-bold text-slate-900 border-t border-slate-300 pt-1.5 inline-block min-w-[160px] max-w-[220px] truncate">
                        {{ $billingName }}
                    </p>
                    <p class="text-[11px] text-slate-400">Penanggung Jawab Pesanan</p>
                </div>

                <div>
                    <p class="text-slate-500">Bandar Lampung, {{ $invoice->created_at->translatedFormat('d F Y') }}</p>
                    <div class="h-16 flex items-center justify-center">
                        <span class="text-[10px] font-mono text-red-600 bg-red-50 border border-red-200 px-3 py-1 rounded-md uppercase font-bold tracking-wider">
                            Signed Digitally
                        </span>
                    </div>
                    <p class="font-bold text-slate-900 border-t border-slate-300 pt-1.5 inline-block min-w-[160px]">
                        {{ $invoice->creator->name ?? 'Admin Keuangan' }}
                    </p>
                    <p class="text-[11px] text-slate-400">Divisi Keuangan PT Lampung Post</p>
                </div>
            </div>

            <!-- Bottom Print Footer Notice -->
            <div class="mt-8 pt-4 border-t border-slate-100 text-center text-[10px] text-slate-400">
                Dokumen ini dicetak dari Portal E-Payment Resmi PT Lampung Post • Verifikasi keaslian: {{ route('public.pay.show', $invoice->invoice_number) }}
            </div>

        </div>

        <!-- Action Card for Payment Checkout (Non-Printable) -->
        @if($invoice->status === 'unpaid')
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-6 print:hidden">
                <div class="space-y-1">
                    <span class="text-xs uppercase tracking-wider font-bold text-red-200">Konfirmasi Pelunasan</span>
                    <h3 class="text-xl sm:text-2xl font-black">Siap untuk Membayar Tagihan Ini?</h3>
                    <p class="text-xs sm:text-sm text-red-100 max-w-lg leading-relaxed">
                        Klik tombol di samping untuk diarahkan ke Payment Gateway Midtrans. Anda dapat memilih QRIS, Virtual Account Bank, atau e-Wallet favorit Anda.
                    </p>
                </div>

                <form action="{{ route('public.pay.process', $invoice->invoice_number) }}" method="POST" class="flex-shrink-0">
                    @csrf
                    <button type="submit" 
                            class="w-full sm:w-auto bg-white hover:bg-slate-100 text-red-700 font-extrabold px-8 py-4 rounded-2xl shadow-xl transition-all active:scale-95 text-sm flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        <span>Bayar Sekarang (Midtrans)</span>
                    </button>
                </form>
            </div>
        @else
            <!-- If Paid, display link to receipt -->
            @php
                $paidPayment = $invoice->payments->where('status', 'success')->first();
            @endphp
            @if($paidPayment)
                <div class="bg-emerald-50 border border-emerald-200 rounded-3xl p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 print:hidden">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold">✓</div>
                        <div>
                            <h4 class="font-bold text-sm text-emerald-950">Tagihan Telah Lunas</h4>
                            <p class="text-xs text-emerald-700">Kuitansi resmi berstempel digital telah diterbitkan.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('receipt.download', $paidPayment->id) }}" 
                           class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition">
                            Unduh Kuitansi PDF
                        </a>
                    </div>
                </div>
            @endif
        @endif

    </div>
</div>

@push('scripts')
<script>
    function copyInvoiceLink() {
        navigator.clipboard.writeText(window.location.href).then(function() {
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