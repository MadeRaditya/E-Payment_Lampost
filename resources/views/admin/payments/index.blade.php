@extends('layouts.admin')

@section('title', 'Riwayat Pembayaran')
@section('page-title', 'Log Transaksi Payment Gateway')

@section('content')
<div class="space-y-6">

    <!-- Header Description -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">Riwayat Pembayaran Masuk</h2>
            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Audit menyeluruh transaksi digital yang diproses melalui Payment Gateway Midtrans.</p>
        </div>
    </div>

    <!-- Search & Filter Form -->
    <form method="GET" action="{{ route('payments.index') }}" 
          class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-xs flex flex-col md:flex-row gap-3 items-center">
        <!-- Search Input -->
        <div class="relative flex-1 w-full">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari ID tagihan atau nama pengiklan..."
                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm focus:bg-white focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none transition">
        </div>

        <!-- Status Filter Select -->
        <div class="w-full md:w-56">
            <select name="status" onchange="this.form.submit()" 
                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm focus:bg-white focus:border-red-500 outline-none transition font-medium text-slate-700">
                <option value="">Semua Status</option>
                <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Berhasil (Success)</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu (Pending)</option>
                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal (Failed)</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Kedaluwarsa (Expired)</option>
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-2 w-full md:w-auto">
            <button type="submit" 
                    class="flex-1 md:flex-none px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs sm:text-sm font-semibold transition">
                Filter
            </button>
            @if(request('q') || request('status'))
                <a href="{{ route('payments.index') }}" 
                   class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs sm:text-sm font-semibold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Payments Data Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Waktu Transaksi</th>
                        <th class="px-6 py-4">ID Tagihan</th>
                        <th class="px-6 py-4">Pengiklan</th>
                        <th class="px-6 py-4">Metode & Referensi</th>
                        <th class="px-6 py-4">Nominal</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-slate-50/70 transition duration-150 group">
                        
                        <!-- Transaction Timestamp -->
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900 text-xs block">
                                {{ $payment->created_at->translatedFormat('d M Y') }}
                            </span>
                            <span class="text-[11px] text-slate-400 font-mono">
                                {{ $payment->created_at->format('H:i:s') }} WIB
                            </span>
                        </td>

                        <!-- Invoice Number -->
                        <td class="px-6 py-4 font-mono font-bold text-xs">
                            @if($payment->invoice)
                                <a href="{{ route('invoices.show', $payment->invoice->id) }}" class="text-slate-900 group-hover:text-red-600 transition hover:underline">
                                    {{ $payment->invoice->invoice_number }}
                                </a>
                            @else
                                <span class="text-slate-400">-</span>
                            @endif
                        </td>

                        <!-- Advertiser Name -->
                        <td class="px-6 py-4">
                            <p class="font-bold text-slate-900 text-xs leading-tight">
                                {{ $payment->invoice->advertiser_name ?? '-' }}
                            </p>
                            <span class="text-[11px] text-slate-400">
                                {{ $payment->invoice->ad_slot ?? 'Iklan' }}
                            </span>
                        </td>

                        <!-- Method & Gateway Reference -->
                        <td class="px-6 py-4">
                            <span class="inline-block px-2.5 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700 mb-0.5">
                                {{ strtoupper($payment->payment_method ?? 'Online Payment') }}
                            </span>
                            <span class="text-[11px] font-mono text-slate-400 truncate max-w-[140px] block" title="{{ $payment->reference_id }}">
                                {{ $payment->reference_id ? Str::limit($payment->reference_id, 16) : '-' }}
                            </span>
                        </td>

                        <!-- Amount -->
                        <td class="px-6 py-4">
                            <p class="font-black text-slate-900 text-sm">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </p>
                        </td>

                        <!-- Status Badge -->
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                {{ $payment->status === 'success' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 
                                   ($payment->status === 'pending' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $payment->status === 'success' ? 'bg-emerald-500' : ($payment->status === 'pending' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                {{ $payment->status === 'success' ? 'Berhasil' : ucfirst($payment->status) }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('payments.show', $payment->id) }}" 
                                   class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition" title="Lihat Detail Transaksi">
                                    Inspeksi
                                </a>
                                @if($payment->status === 'success')
                                    <a href="{{ route('receipt.download', $payment->id) }}" 
                                       class="px-2.5 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold transition" title="Unduh Kuitansi">
                                        Kuitansi
                                    </a>
                                @endif
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            </div>
                            <h4 class="text-base font-bold text-slate-800">Tidak ada data transaksi pembayaran</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                                Semua transaksi dari Midtrans Snap akan tercatat di halaman ini secara otomatis.
                            </p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($payments->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $payments->links() }}
            </div>
        @endif
    </div>

</div>
@endsection