@extends('layouts.public')

@section('title', 'Status Pembayaran')

@section('content')
    <section class="max-w-lg mx-auto px-4 py-16 lg:py-24">
        @php
            $isPaid = $invoice->status === 'paid';
        @endphp

        <div class="text-center mb-8">
            <div
                class="w-20 h-20 rounded-full mx-auto flex items-center justify-center mb-4
            {{ $isPaid ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                @if ($isPaid)
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                @else
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                @endif
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">
                {{ $isPaid ? 'Pembayaran Berhasil!' : 'Pembayaran Belum Selesai' }}
            </h1>
            <p class="text-gray-500">
                {{ $isPaid ? 'Terima kasih, pembayaran Anda telah kami terima.' : 'Silakan selesaikan pembayaran atau coba lagi.' }}
            </p>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-6">
            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">ID Tagihan</span>
                    <span class="font-semibold font-mono">{{ $invoice->invoice_number }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Pengiklan</span>
                    <span class="font-semibold">{{ $invoice->advertiser_name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Slot Iklan</span>
                    <span class="font-semibold">{{ $invoice->ad_slot }}</span>
                </div>
                <div class="flex justify-between text-sm pt-3 border-t border-gray-100">
                    <span class="text-gray-500 font-semibold">Total</span>
                    <span class="font-bold text-red-600 text-lg">Rp
                        {{ number_format($invoice->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            @if ($isPaid)
                @php
                    $successPayment = $invoice->payments->where('status', 'success')->first();
                @endphp

                @if ($successPayment)
                    <div class="space-y-2">
                        <a href="{{ route('receipt.download', $successPayment->id) }}"
                            class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition">
                            Download Kuitansi (PDF)
                        </a>
                        <a href="{{ route('receipt.preview', $successPayment->id) }}" target="_blank"
                            class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2.5 rounded-lg transition text-sm">
                            Lihat Kuitansi
                        </a>
                    </div>
                @endif
            @else
                <a href="{{ route('public.pay.show', $invoice->invoice_number) }}"
                    class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition">
                    Coba Bayar Lagi
                </a>
            @endif
        </div>
    </section>
@endsection
