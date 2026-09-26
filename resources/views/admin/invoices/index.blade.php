@extends('layouts.admin')

@section('title', 'Manajemen Tagihan')
@section('page-title', 'Daftar Tagihan Iklan')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Tagihan</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Kelola tagihan iklan, pesanan pelanggan, dan status pembayaran.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('invoices.create') }}" 
               class="inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold text-xs sm:text-sm px-5 py-3 rounded-xl shadow-md shadow-red-600/20 active:scale-95 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Buat Tagihan Manual</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs">
            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Tagihan</p>
            <p class="text-2xl font-black text-slate-900 mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs">
            <p class="text-[11px] font-bold text-amber-500 uppercase tracking-wider">Menunggu Bayar</p>
            <p class="text-2xl font-black text-amber-600 mt-1">{{ $stats['unpaid'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs">
            <p class="text-[11px] font-bold text-emerald-500 uppercase tracking-wider">Lunas</p>
            <p class="text-2xl font-black text-emerald-600 mt-1">{{ $stats['paid'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs">
            <p class="text-[11px] font-bold text-red-500 uppercase tracking-wider">Total Pendapatan</p>
            <p class="text-lg font-black text-red-600 mt-1 truncate">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <form method="GET" action="{{ route('invoices.index') }}" 
          class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs flex flex-col md:flex-row gap-3 items-center">
        <div class="relative flex-1 w-full">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" 
                   placeholder="Cari invoice, judul iklan, atau nama pengiklan..."
                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm focus:bg-white focus:border-red-500 outline-none transition">
        </div>

        <div class="w-full md:w-40">
            <select name="status" onchange="this.form.submit()" 
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm focus:bg-white focus:border-red-500 outline-none font-medium text-slate-700">
                <option value="">Semua Status</option>
                <option value="draft"   {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="unpaid"  {{ request('status') === 'unpaid' ? 'selected' : '' }}>Menunggu Bayar</option>
                <option value="paid"    {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
                <option value="failed"  {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
            </select>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto">
            <button type="submit" class="flex-1 md:flex-none px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs sm:text-sm font-semibold transition">Cari</button>
            @if(request('q') || request('status'))
                <a href="{{ route('invoices.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs sm:text-sm font-semibold transition">Reset</a>
            @endif
        </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">ID Tagihan</th>
                        <th class="px-6 py-4">Pengiklan</th>
                        <th class="px-6 py-4">Kategori & Format</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4">Jatuh Tempo</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($invoices as $invoice)
                        @php
                            $fmt = config('ad_booking.formats')[$invoice->ad_format] ?? null;
                            $isSelfBooking = !empty($invoice->category) || !empty($invoice->ad_title);
                        @endphp
                        <tr class="hover:bg-slate-50/70 transition group">
                            <!-- Invoice Number -->
                            <td class="px-6 py-4 align-top">
                                <a href="{{ route('invoices.show', $invoice->id) }}" 
                                   class="font-mono font-bold text-sm text-slate-900 group-hover:text-red-600 transition block">
                                    {{ $invoice->invoice_number }}
                                </a>
                                <span class="text-[11px] text-slate-400">
                                    {{ $invoice->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                                @if($isSelfBooking)
                                    <span class="inline-block mt-1 text-[10px] font-bold text-red-600 bg-red-50 px-1.5 py-0.5 rounded">
                                        📱 Pesanan Mandiri
                                    </span>
                                @endif
                            </td>

                            <!-- Advertiser -->
                            <td class="px-6 py-4 align-top">
                                <p class="font-bold text-slate-900 text-sm leading-tight">
                                    {{ $invoice->billing_name ?? $invoice->advertiser_name ?? '-' }}
                                </p>
                                <span class="text-xs text-slate-500 font-mono mt-0.5 block">
                                    {{ $invoice->billing_phone ?? $invoice->advertiser_contact ?? '-' }}
                                </span>
                            </td>

                            <!-- Category & Format -->
                            <td class="px-6 py-4 align-top">
                                @if($invoice->category)
                                    <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-700 mb-1">
                                        {{ $invoice->category }}
                                    </span>
                                    <span class="text-[11px] text-slate-500 block truncate max-w-[180px]" title="{{ $invoice->ad_title }}">
                                        {{ $invoice->ad_title ?? 'Tanpa judul' }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                                @if($fmt)
                                    <span class="text-[11px] text-red-600 font-semibold block mt-0.5">{{ $fmt['name'] }}</span>
                                @endif
                            </td>

                            <!-- Amount -->
                            <td class="px-6 py-4 align-top">
                                <p class="font-black text-slate-900 text-sm">
                                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                </p>
                                @if(!empty($invoice->media_files))
                                    <span class="text-[10px] text-slate-400 mt-0.5 inline-flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                        {{ count($invoice->media_files) }} file
                                    </span>
                                @endif
                            </td>

                            <!-- Due Date -->
                            <td class="px-6 py-4 align-top">
                                @php $isOverdue = in_array($invoice->status, ['unpaid','draft']) && $invoice->due_date->isPast(); @endphp
                                <span class="text-xs font-semibold {{ $isOverdue ? 'text-rose-600' : 'text-slate-700' }} block">
                                    {{ $invoice->due_date->translatedFormat('d M Y') }}
                                </span>
                                @if($isOverdue)
                                    <span class="text-[10px] text-rose-500 font-bold uppercase tracking-wider">Overdue</span>
                                @endif
                            </td>

                            <!-- Status Badge -->
                            <td class="px-6 py-4 text-center align-top">
                                @php
                                    $badge = match($invoice->status) {
                                        'paid'    => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'bg-emerald-500', 'Lunas'],
                                        'unpaid'  => ['bg-amber-50 text-amber-700 border-amber-200', 'bg-amber-500', 'Menunggu'],
                                        'draft'   => ['bg-slate-100 text-slate-600 border-slate-300', 'bg-slate-400', 'Draft'],
                                        'expired' => ['bg-slate-100 text-slate-600 border-slate-200', 'bg-slate-400', 'Kedaluwarsa'],
                                        default   => ['bg-rose-50 text-rose-700 border-rose-200', 'bg-rose-500', ucfirst($invoice->status)],
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border {{ $badge[0] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $badge[1] }}"></span>
                                    {{ $badge[2] }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right align-top">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('invoices.show', $invoice->id) }}" 
                                       class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition">
                                        Detail
                                    </a>
                                    @if($invoice->status !== 'paid')
                                        <a href="{{ route('invoices.edit', $invoice->id) }}" 
                                           class="p-1.5 rounded-lg text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                                <h4 class="text-base font-bold text-slate-800">Tidak ada tagihan ditemukan</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                                    @if(request('q') || request('status'))
                                        Coba ubah filter atau reset pencarian.
                                    @else
                                        Mulai buat tagihan baru atau tunggu pesanan masuk dari customer.
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($invoices->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>

</div>
@endsection