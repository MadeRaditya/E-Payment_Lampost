@extends('layouts.admin')

@section('title', 'Tagihan ' . $invoice->invoice_number)
@section('page-title', 'Detail Tagihan Iklan')

@section('content')
<div class="space-y-6">

    @php
        $fmt = config('ad_booking.formats')[$invoice->ad_format] ?? null;
        $isSelfBooking = !empty($invoice->category) || !empty($invoice->ad_title);
        $paidPayment = $invoice->payments->where('status', 'success')->first();
    @endphp

    <!-- Breadcrumb & Status -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('invoices.index') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Daftar Tagihan</span>
        </a>

        @php
            $statusBadge = match($invoice->status) {
                'paid'    => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'bg-emerald-500', 'Lunas (Paid)'],
                'unpaid'  => ['bg-amber-50 text-amber-700 border-amber-200', 'bg-amber-500 animate-pulse', 'Menunggu Pembayaran'],
                'draft'   => ['bg-slate-100 text-slate-600 border-slate-300', 'bg-slate-400', 'Draft (Belum Selesai)'],
                'expired' => ['bg-slate-100 text-slate-600 border-slate-200', 'bg-slate-400', 'Kedaluwarsa'],
                default   => ['bg-rose-50 text-rose-700 border-rose-200', 'bg-rose-500', ucfirst($invoice->status)],
            };
        @endphp
        <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider border {{ $statusBadge[0] }}">
            <span class="w-2 h-2 rounded-full {{ $statusBadge[1] }}"></span>
            Status: {{ $statusBadge[2] }}
        </span>
    </div>

    <!-- Draft Alert -->
    @if($invoice->status === 'draft')
        <div class="bg-slate-50 border border-slate-300 text-slate-700 p-5 rounded-2xl flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-sm">Pesanan Ini Masih Berstatus Draft</p>
                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                    Customer belum menyelesaikan seluruh step pemesanan (kemungkinan berhenti di step 1-3). Anda dapat menghubungi customer di 
                    <span class="font-mono font-bold text-slate-700">{{ $invoice->billing_phone ?? 'kontak belum diisi' }}</span> 
                    untuk melanjutkan, atau menghapus draft ini jika sudah tidak relevan.
                </p>
            </div>
        </div>
    @endif

    <!-- Main Grid -->
    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- LEFT: Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Header Card -->
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 rounded-3xl p-7 sm:p-9 text-white shadow-xl relative overflow-hidden">
                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5 mb-2">
                            <span class="text-xs uppercase tracking-wider font-semibold text-red-300">ID Tagihan Resmi</span>
                            @if($isSelfBooking)
                                <span class="text-[10px] bg-red-500/20 border border-red-400/30 px-2 py-0.5 rounded text-red-200 font-bold">📱 Pesanan Mandiri</span>
                            @endif
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold font-mono tracking-tight text-white">
                            {{ $invoice->invoice_number }}
                        </h2>
                        <p class="text-xs text-slate-400 mt-2">
                            Dibuat: {{ $invoice->created_at->translatedFormat('d F Y, H:i') }} WIB
                            @if($invoice->creator)
                                • oleh <span class="text-slate-200 font-semibold">{{ $invoice->creator->name }}</span>
                            @endif
                        </p>
                    </div>

                    <div class="sm:text-right bg-slate-800/60 p-4 sm:p-5 rounded-2xl border border-slate-700/60">
                        <span class="text-xs uppercase tracking-wider text-slate-400 block font-medium">Total Kewajiban</span>
                        <p class="text-3xl font-black text-red-400 mt-1">
                            Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                        </p>
                        <span class="text-[11px] text-slate-400 mt-1 block">
                            Jatuh Tempo: <strong class="text-white">{{ $invoice->due_date->translatedFormat('d M Y') }}</strong>
                        </span>
                    </div>
                </div>
            </div>

            <!-- AD CONTENT SECTION -->
            @if($isSelfBooking)
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-base text-slate-900">Konten Iklan</h3>
                        <p class="text-xs text-slate-400">Data iklan yang diisi customer pada multi-step form.</p>
                    </div>
                </div>

                <!-- Kategori & Sub -->
                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Kategori</span>
                        <p class="font-bold text-sm text-slate-900">{{ $invoice->category ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Sub-Kategori</span>
                        <p class="font-bold text-sm text-slate-900">{{ $invoice->subcategory ?? '-' }}</p>
                    </div>
                </div>

                <!-- Judul -->
                <div class="bg-red-50/60 border-l-4 border-red-500 rounded-r-2xl p-4">
                    <span class="text-[10px] font-bold text-red-600 uppercase tracking-wider block mb-1">Judul Iklan</span>
                    <p class="font-black text-base text-slate-900 leading-snug">{{ $invoice->ad_title ?? '-' }}</p>
                </div>

                <!-- Format Iklan -->
                @if($fmt)
                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-red-600 text-white flex items-center justify-center font-black text-xs flex-shrink-0">
                        AD
                    </div>
                    <div class="flex-1">
                        <p class="font-black text-sm text-slate-900">{{ $fmt['name'] }}</p>
                        <p class="text-xs text-slate-500">{{ $fmt['size'] }} • {{ $fmt['description'] }}</p>
                    </div>
                </div>
                @endif

                <!-- Teks Iklan -->
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Teks / Isi Iklan</span>
                    <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 text-sm text-slate-800 whitespace-pre-line leading-relaxed">
                        {{ $invoice->ad_text ?? 'Belum diisi.' }}
                    </div>
                </div>

                <!-- Jadwal -->
                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Mulai Tayang</span>
                        <p class="font-bold text-sm text-slate-900">
                            {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Durasi</span>
                        <p class="font-bold text-sm text-slate-900">{{ $invoice->ad_duration_days ?? 0 }} Hari</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Jumlah Media</span>
                        <p class="font-bold text-sm text-slate-900">{{ count($invoice->media_files ?? []) }} File</p>
                    </div>
                </div>

                <!-- Media Preview Grid -->
                @if(!empty($invoice->media_files))
                <div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-3">Media / Lampiran</span>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        @foreach($invoice->media_files as $path)
                            <a href="{{ Storage::url($path) }}" target="_blank"
                               class="relative rounded-2xl overflow-hidden border border-slate-200 aspect-square hover:border-red-500 hover:shadow-lg transition group">
                                @if(\Illuminate\Support\Str::endsWith($path, ['.jpg','.jpeg','.png','.webp']))
                                    <img src="{{ Storage::url($path) }}" class="w-full h-full object-cover" alt="media">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                                        <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        <span class="text-[10px] font-bold">PDF</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <span class="text-white text-[10px] font-bold">Lihat</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- BILLING INFO SECTION -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-base text-slate-900">Data Pembayar</h3>
                        <p class="text-xs text-slate-400">Informasi penanggung jawab pembayaran & perpajakan.</p>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Nama / Perusahaan</span>
                        <p class="font-bold text-sm text-slate-900">{{ $invoice->billing_name ?? $invoice->advertiser_name ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">NPWP / NIK KTP</span>
                        <p class="font-mono font-bold text-sm text-slate-900">{{ $invoice->billing_npwp_nik ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Email</span>
                        <p class="font-bold text-sm text-slate-900 break-all">{{ $invoice->billing_email ?? $invoice->advertiser_contact ?? '-' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Telepon / WA</span>
                        <p class="font-bold text-sm text-slate-900">{{ $invoice->billing_phone ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Alamat</span>
                        <p class="text-sm text-slate-800 leading-relaxed">{{ $invoice->billing_address ?? '-' }}</p>
                    </div>
                    @if($invoice->payment_preference)
                    <div class="sm:col-span-2 flex items-center gap-3 bg-red-50/60 border border-red-200 rounded-2xl p-4">
                        <div class="w-9 h-9 rounded-xl bg-red-600 text-white flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-red-600 uppercase tracking-wider">Preferensi Pembayaran Customer</p>
                            <p class="font-bold text-sm text-slate-900">
                                {{ $invoice->payment_preference === 'online' ? 'Bayar Online (Midtrans Snap)' : 'Transfer Manual' }}
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Riwayat Pembayaran -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base text-slate-900">Riwayat Transaksi Gateway</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Catatan callback dan pembayaran dari Payment Gateway.</p>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">
                        {{ $invoice->payments->count() }} Percobaan
                    </span>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($invoice->payments as $payment)
                        <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/60 transition">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-sm text-slate-900">{{ strtoupper($payment->payment_method ?? 'Gateway Snap') }}</span>
                                    <span class="text-xs font-mono text-slate-400">#{{ $payment->reference_id ?? 'No-Ref' }}</span>
                                </div>
                                <p class="text-xs text-slate-500">
                                    {{ $payment->created_at->translatedFormat('d M Y, H:i') }} WIB
                                    @if($payment->paid_at) • Lunas: {{ $payment->paid_at->translatedFormat('d M Y, H:i') }} WIB @endif
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    {{ $payment->status === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                                       ($payment->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                    {{ $payment->status === 'success' ? 'Berhasil' : ucfirst($payment->status) }}
                                </span>
                                @if($payment->status === 'success')
                                    <a href="{{ route('receipt.download', $payment->id) }}" 
                                       class="px-3 py-1.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs transition shadow-xs flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        PDF
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-slate-400 text-xs">
                            Belum ada percobaan transaksi untuk tagihan ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- RIGHT: Sidebar Actions -->
        <div class="space-y-6">
            
            <!-- Public Payment Link -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Tautan Pembayaran Publik</h4>
                        <p class="text-[11px] text-slate-400">Bagikan ke pengiklan</p>
                    </div>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs font-mono text-slate-700 break-all select-all">
                    {{ route('public.pay.show', $invoice->invoice_number) }}
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="copyText('{{ route('public.pay.show', $invoice->invoice_number) }}', 'btn-copy-link')" id="btn-copy-link"
                            class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 rounded-xl text-xs transition flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Salin</span>
                    </button>
                    <a href="{{ route('public.pay.show', $invoice->invoice_number) }}" target="_blank"
                       class="w-full border border-slate-200 hover:bg-slate-100 text-slate-700 font-semibold py-2.5 rounded-xl text-xs transition text-center flex items-center justify-center gap-1">
                        Buka <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <!-- PDF Actions -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-8 h-8 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Dokumen Faktur</h4>
                        <p class="text-[11px] text-slate-400">Standar Komersial</p>
                    </div>
                </div>

                <a href="{{ route('invoices.download', $invoice->id) }}" 
                   class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Unduh PDF Faktur
                </a>
                <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank"
                   class="w-full border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold py-2 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                    Pratinjau / Cetak
                </a>
            </div>

            <!-- Receipt if Paid -->
            @if($invoice->status === 'paid' && $paidPayment)
                <div class="bg-emerald-50 rounded-3xl border border-emerald-200/80 p-6 shadow-xs space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-emerald-950">Kuitansi Sah Terbit</h4>
                            <p class="text-xs text-emerald-700">Otomatis dari sistem</p>
                        </div>
                    </div>
                    <div class="pt-2 space-y-2">
                        <a href="{{ route('receipt.download', $paidPayment->id) }}" 
                           class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                            Unduh Kuitansi PDF
                        </a>
                        <a href="{{ route('receipt.preview', $paidPayment->id) }}" target="_blank"
                           class="w-full bg-white hover:bg-emerald-100/60 text-emerald-800 border border-emerald-300 font-semibold py-2 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                            Pratinjau Kuitansi
                        </a>
                    </div>
                </div>
            @endif

            <!-- Management Actions -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                <h4 class="font-bold text-sm text-slate-900 mb-2">Tindakan Pengelolaan</h4>

                @if($invoice->status !== 'paid')
                    <a href="{{ route('invoices.edit', $invoice->id) }}" 
                       class="w-full flex items-center justify-center gap-2 p-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Data Tagihan
                    </a>

                    @if($invoice->status === 'draft')
                        <form action="{{ route('invoices.update', $invoice->id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="publish_draft" value="1">
                            <input type="hidden" name="billing_name" value="{{ $invoice->billing_name ?? 'Draft User' }}">
                            <input type="hidden" name="billing_npwp_nik" value="{{ $invoice->billing_npwp_nik ?? '-' }}">
                            <input type="hidden" name="billing_email" value="{{ $invoice->billing_email ?? 'draft@example.com' }}">
                            <input type="hidden" name="billing_phone" value="{{ $invoice->billing_phone ?? '-' }}">
                            <input type="hidden" name="billing_address" value="{{ $invoice->billing_address ?? '-' }}">
                            <input type="hidden" name="advertiser_name" value="{{ $invoice->advertiser_name ?? 'Draft' }}">
                            <input type="hidden" name="advertiser_contact" value="{{ $invoice->advertiser_contact ?? '-' }}">
                            <input type="hidden" name="ad_slot" value="{{ $invoice->ad_slot ?? $invoice->ad_format }}">
                            <input type="hidden" name="ad_duration_days" value="{{ $invoice->ad_duration_days ?? 7 }}">
                            <input type="hidden" name="ad_start_date" value="{{ $invoice->ad_start_date?->format('Y-m-d') ?? date('Y-m-d') }}">
                            <input type="hidden" name="amount" value="{{ $invoice->amount ?: 500000 }}">
                            <input type="hidden" name="description" value="{{ $invoice->description ?? 'Draft' }}">
                            <input type="hidden" name="due_date" value="{{ $invoice->due_date->format('Y-m-d') }}">
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2 p-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs transition shadow-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Finalisasi Draft → Terbitkan
                            </button>
                        </form>
                    @endif

                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus tagihan ini secara permanen?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 p-3 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus Tagihan
                        </button>
                    </form>
                @else
                    <div class="p-3 rounded-xl bg-slate-50 text-slate-500 text-xs text-center border border-slate-100">
                        Tagihan lunas. Data dikunci untuk kepatuhan audit keuangan.
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyText(text, btnId) {
        navigator.clipboard.writeText(text).then(function() {
            const btn = document.getElementById(btnId);
            if (btn) {
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<span class="text-emerald-400 font-bold">✓ Tersalin</span>';
                setTimeout(() => btn.innerHTML = originalHtml, 2000);
            }
        });
    }
</script>
@endpush
@endsection