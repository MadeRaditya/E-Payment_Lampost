@extends('layouts.admin')

@section('title', 'Tagihan ' . $invoice->invoice_number)
@section('page-title', 'Detail Tagihan Iklan')

@section('content')
<div class="space-y-6">

    <!-- Top Breadcrumb & Status Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <a href="{{ route('invoices.index') }}" 
           class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-slate-500 hover:text-red-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali ke Daftar Tagihan</span>
        </a>

        <!-- Fast Action Pill for Status -->
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                {{ $invoice->status === 'paid' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                   ($invoice->status === 'unpaid' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 
                   ($invoice->status === 'expired' ? 'bg-slate-100 text-slate-600 border border-slate-200' : 'bg-rose-50 text-rose-700 border border-rose-200')) }}">
                <span class="w-2 h-2 rounded-full {{ $invoice->status === 'paid' ? 'bg-emerald-500 animate-pulse' : ($invoice->status === 'unpaid' ? 'bg-amber-500' : 'bg-slate-400') }}"></span>
                Status: {{ $invoice->status === 'paid' ? 'Lunas (Paid)' : ($invoice->status === 'unpaid' ? 'Menunggu Pembayaran' : ucfirst($invoice->status)) }}
            </span>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Main Dossier -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Invoice Header Card -->
            <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 rounded-3xl p-7 sm:p-9 text-white shadow-xl border border-slate-800 relative overflow-hidden">
                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5 mb-2">
                            <span class="text-xs uppercase tracking-wider font-semibold text-red-300">ID Tagihan Resmi</span>
                            <button type="button" onclick="copyText('{{ $invoice->invoice_number }}', 'btn-copy-id')" id="btn-copy-id"
                                    class="text-[11px] bg-slate-800/80 hover:bg-slate-800 px-2.5 py-1 rounded-md text-slate-300 border border-slate-700/60 transition inline-flex items-center gap-1 font-sans">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                <span>Salin</span>
                            </button>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-extrabold font-mono tracking-tight text-white">
                            {{ $invoice->invoice_number }}
                        </h2>
                        <p class="text-xs text-slate-400 mt-2">
                            Diterbitkan oleh <span class="text-slate-200 font-semibold">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</span> pada {{ $invoice->created_at->translatedFormat('d F Y, H:i') }} WIB
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

            <!-- Details Section Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-xs space-y-6">
                <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">
                    Rincian Pesanan Iklan
                </h3>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Pihak Pengiklan</span>
                        <p class="font-extrabold text-base text-slate-900">{{ $invoice->advertiser_name ?? '-' }}</p>
                        <p class="text-xs text-slate-500 font-mono mt-1">{{ $invoice->advertiser_contact ?? '-' }}</p>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Posisi Slot Iklan</span>
                        <p class="font-extrabold text-base text-slate-900">{{ $invoice->ad_slot ?? '-' }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ $invoice->ad_duration_days ? $invoice->ad_duration_days . ' Hari Penayangan' : '-' }}</p>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Tanggal Mulai Tayang</span>
                        <p class="font-bold text-sm text-slate-900">
                            {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>

                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Batas Waktu Bayar</span>
                        <p class="font-bold text-sm text-slate-900">
                            {{ $invoice->due_date->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div class="sm:col-span-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Deskripsi & Catatan</span>
                        <p class="text-sm text-slate-800 leading-relaxed">{{ $invoice->description }}</p>
                    </div>
                </div>

                <!-- Itemized Cost Table -->
                <div class="border-t border-slate-100 pt-6">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Tabel Pembiayaan (Standar Faktur)</h4>
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-xs text-left">
                            <thead class="bg-slate-100/80 text-slate-700 font-bold uppercase text-[10px]">
                                <tr>
                                    <th class="py-2.5 px-3 w-10 text-center">No</th>
                                    <th class="py-2.5 px-3">Item Layanan</th>
                                    <th class="py-2.5 px-3 text-center">Durasi</th>
                                    <th class="py-2.5 px-3 text-center">Qty</th>
                                    <th class="py-2.5 px-3 text-right">Tarif (IDR)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-slate-700">
                                <tr>
                                    <td class="py-3 px-3 text-center font-bold text-slate-400">1</td>
                                    <td class="py-3 px-3 font-semibold text-slate-900">
                                        Slot Iklan: {{ $invoice->ad_slot }}
                                    </td>
                                    <td class="py-3 px-3 text-center">{{ $invoice->ad_duration_days }} Hari</td>
                                    <td class="py-3 px-3 text-center">1 Paket</td>
                                    <td class="py-3 px-3 text-right font-bold text-slate-900">
                                        Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-slate-50/70 border-t border-slate-200 font-semibold">
                                <tr>
                                    <td colspan="4" class="py-2 px-3 text-right text-slate-500">Subtotal:</td>
                                    <td class="py-2 px-3 text-right font-bold text-slate-900">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="py-2 px-3 text-right text-slate-500">PPN (Pajak Pertambahan Nilai):</td>
                                    <td class="py-2 px-3 text-right font-bold text-slate-900">Termasuk (Rp 0)</td>
                                </tr>
                                <tr class="bg-red-50/80 text-red-900 font-bold text-sm">
                                    <td colspan="4" class="py-3 px-3 text-right uppercase tracking-wider">Total Tagihan:</td>
                                    <td class="py-3 px-3 text-right text-red-700 font-black">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Terbilang -->
                    <div class="mt-3 p-3 bg-slate-50 rounded-xl border border-dashed border-slate-200 text-xs text-slate-600 italic">
                        <span class="font-bold text-slate-900 not-italic">Terbilang:</span> 
                        {{ \App\Support\Terbilang::rupiah($invoice->amount) }}
                    </div>
                </div>
            </div>

            <!-- Riwayat Pembayaran (Payment Attempts from Gateway) -->
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base text-slate-900">Riwayat Transaksi Gateway</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Catatan callback dan pembayaran masuk dari Payment Gateway</p>
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
                                    <span class="font-bold text-sm text-slate-900">
                                        {{ strtoupper($payment->payment_method ?? 'Gateway Snap') }}
                                    </span>
                                    <span class="text-xs font-mono text-slate-400">#{{ $payment->reference_id ?? 'No-Ref' }}</span>
                                </div>
                                <p class="text-xs text-slate-500">
                                    Waktu: {{ $payment->created_at->translatedFormat('d M Y, H:i') }} WIB 
                                    @if($payment->paid_at)
                                        • Lunas: {{ $payment->paid_at->translatedFormat('d M Y, H:i') }} WIB
                                    @endif
                                </p>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                    {{ $payment->status === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                                       ($payment->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $payment->status === 'success' ? 'bg-emerald-500' : ($payment->status === 'pending' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                    {{ $payment->status === 'success' ? 'Berhasil' : ucfirst($payment->status) }}
                                </span>

                                @if($payment->status === 'success')
                                    <a href="{{ route('receipt.download', $payment->id) }}" 
                                       class="px-3 py-1.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-semibold text-xs transition shadow-xs flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <span>PDF Kuitansi</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-10 text-center text-slate-400 text-xs">
                            Belum ada percobaan transaksi pembayaran untuk tagihan ini.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Right 1 Col: Operations, Sharing Link & Actions -->
        <div class="space-y-6">
            
            <!-- Public Payment Link Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-4">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Tautan Pembayaran Publik</h4>
                        <p class="text-[11px] text-slate-400">Bagikan tautan ini ke pengiklan</p>
                    </div>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs font-mono text-slate-700 break-all select-all">
                    {{ route('public.pay.show', $invoice->invoice_number) }}
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <button type="button" onclick="copyText('{{ route('public.pay.show', $invoice->invoice_number) }}', 'btn-copy-link')" id="btn-copy-link"
                            class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-2.5 rounded-xl text-xs transition flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Salin Link</span>
                    </button>
                    <a href="{{ route('public.pay.show', $invoice->invoice_number) }}" target="_blank"
                       class="w-full border border-slate-200 hover:bg-slate-100 text-slate-700 font-semibold py-2.5 rounded-xl text-xs transition text-center flex items-center justify-center gap-1">
                        <span>Buka Halaman</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <!-- Invoice PDF & Print Actions Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                <div class="flex items-center gap-2 mb-1">
                    <div class="w-8 h-8 rounded-xl bg-slate-900 text-white flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-slate-900">Dokumen Faktur Tagihan</h4>
                        <p class="text-[11px] text-slate-400">Format Resmi Standar Komersial</p>
                    </div>
                </div>

                <div class="space-y-2 pt-1">
                    <a href="{{ route('invoices.download', $invoice->id) }}" 
                       class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2 shadow-xs">
                        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh PDF Faktur</span>
                    </a>
                    <a href="{{ route('invoices.print', $invoice->id) }}" target="_blank"
                       class="w-full border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold py-2 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        <span>Pratinjau / Cetak Faktur</span>
                    </a>
                </div>
            </div>

            <!-- Receipt Download Box if Paid -->
            @php
                $paidPayment = $invoice->payments->where('status', 'success')->first();
            @endphp
            @if($invoice->status === 'paid' && $paidPayment)
                <div class="bg-emerald-50 rounded-3xl border border-emerald-200/80 p-6 shadow-xs space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-emerald-950">Kuitansi Pembayaran Sah</h4>
                            <p class="text-xs text-emerald-700">Diterbitkan otomatis oleh sistem</p>
                        </div>
                    </div>
                    <div class="pt-2 space-y-2">
                        <a href="{{ route('receipt.download', $paidPayment->id) }}" 
                           class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2 shadow-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            <span>Unduh Kuitansi PDF</span>
                        </a>
                        <a href="{{ route('receipt.preview', $paidPayment->id) }}" target="_blank"
                           class="w-full bg-white hover:bg-emerald-100/60 text-emerald-800 border border-emerald-300 font-semibold py-2 px-4 rounded-xl text-xs transition flex items-center justify-center gap-2">
                            <span>Pratinjau / Cetak Langsung</span>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Management Actions Card -->
            <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-xs space-y-3">
                <h4 class="font-bold text-sm text-slate-900 mb-2">Tindakan Pengelolaan</h4>

                @if($invoice->status !== 'paid')
                    <a href="{{ route('invoices.edit', $invoice->id) }}" 
                       class="w-full flex items-center justify-center gap-2 p-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-semibold text-xs transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        <span>Edit Data Tagihan</span>
                    </a>

                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" 
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan ini secara permanen?')">
                        @csrf 
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center gap-2 p-3 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            <span>Hapus Tagihan</span>
                        </button>
                    </form>
                @else
                    <div class="p-3 rounded-xl bg-slate-50 text-slate-500 text-xs text-center border border-slate-100">
                        Tagihan telah lunas. Data transaksi dikunci untuk kepatuhan audit keuangan.
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
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                }, 2000);
            }
        });
    }
</script>
@endpush
@endsection