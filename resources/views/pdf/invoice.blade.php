<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }} — PT Lampung Post</title>
    <style>
        @page {
            margin: 20mm 18mm 20mm 18mm;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9.5px;
            color: #1f2937;
            line-height: 1.4;
        }
        
        .top-accent {
            height: 5px;
            background-color: #dc2626;
            margin-bottom: 18px;
        }
        
        .header-table {
            width: 100%;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 2px solid #dc2626;
        }
        .header-table td {
            vertical-align: middle;
        }
        .logo-box {
            display: inline-block;
            width: 44px;
            height: 44px;
            background-color: #dc2626;
            color: #ffffff;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            line-height: 44px;
            border-radius: 4px;
        }
        .brand-title {
            font-size: 17px;
            font-weight: bold;
            color: #111827;
            margin-left: 10px;
            letter-spacing: 0.5px;
        }
        .brand-subtitle {
            font-size: 8.5px;
            color: #6b7280;
            margin-left: 10px;
        }
        .company-meta {
            text-align: right;
            font-size: 8.5px;
            color: #4b5563;
            line-height: 1.45;
        }
        
        .doc-header {
            width: 100%;
            margin-bottom: 18px;
        }
        .doc-header td {
            vertical-align: top;
        }
        .doc-title {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .doc-number {
            font-size: 12px;
            font-weight: bold;
            color: #dc2626;
            margin-top: 2px;
            font-family: DejaVu Sans Mono, monospace;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 16px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 3px;
        }
        .status-paid {
            background-color: #dcfce7;
            border: 1px solid #16a34a;
            color: #15803d;
        }
        .status-unpaid {
            background-color: #fef3c7;
            border: 1px solid #d97706;
            color: #b45309;
        }
        .status-expired {
            background-color: #f3f4f6;
            border: 1px solid #9ca3af;
            color: #4b5563;
        }
        
        .parties-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .parties-table > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }
        .party-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 10px 14px;
            border-radius: 4px;
        }
        .party-box.left {
            margin-right: 6px;
        }
        .party-box.right {
            margin-left: 6px;
        }
        .party-heading {
            font-size: 8.5px;
            font-weight: bold;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 3px;
        }
        .party-name {
            font-size: 11px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 2px;
        }
        .party-detail {
            font-size: 8.5px;
            color: #4b5563;
            line-height: 1.4;
        }
        
        .meta-strip {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            background-color: #fef2f2;
            border-left: 3px solid #dc2626;
            padding: 6px 10px;
        }
        .meta-strip td {
            padding: 4px 8px;
            font-size: 9px;
        }
        .meta-strip .meta-label {
            color: #7f1d1d;
            font-weight: bold;
        }
        .meta-strip .meta-val {
            color: #111827;
            font-weight: bold;
        }
        
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .items-table th {
            background-color: #1e293b;
            color: #ffffff;
            font-size: 8.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 8px 10px;
            text-align: left;
        }
        .items-table th.text-right {
            text-align: right;
        }
        .items-table th.text-center {
            text-align: center;
        }
        .items-table td {
            padding: 9px 10px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 9px;
            vertical-align: top;
        }
        .items-table td.text-right {
            text-align: right;
        }
        .items-table td.text-center {
            text-align: center;
        }
        
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .summary-table td {
            padding: 5px 10px;
            font-size: 9px;
        }
        .summary-table .col-blank {
            width: 55%;
        }
        .summary-table .col-label {
            width: 20%;
            color: #4b5563;
            text-align: right;
        }
        .summary-table .col-val {
            width: 25%;
            color: #111827;
            font-weight: bold;
            text-align: right;
        }
        .grand-total-row td {
            padding: 10px 10px;
            background-color: #dc2626;
            color: #ffffff !important;
            font-size: 11px;
            font-weight: bold;
        }
        .grand-total-row .col-val {
            font-size: 14px;
            color: #ffffff !important;
            letter-spacing: 0.5px;
        }
        
        .terbilang-box {
            background-color: #f8fafc;
            border: 1px dashed #cbd5e1;
            padding: 7px 12px;
            font-size: 8.5px;
            color: #334155;
            margin-bottom: 18px;
            font-style: italic;
        }
        
        .payment-instruct {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .payment-instruct > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }
        .instruct-card {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            border-radius: 4px;
        }
        .instruct-card.left {
            margin-right: 5px;
        }
        .instruct-card.right {
            margin-left: 5px;
        }
        .instruct-title {
            font-size: 8.5px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
        .instruct-desc {
            font-size: 8px;
            color: #64748b;
            line-height: 1.4;
        }
        .bank-item {
            margin-top: 4px;
            font-size: 8.5px;
            color: #1f2937;
        }
        
        .terms-box {
            background-color: #fffbeb;
            border-left: 3px solid #f59e0b;
            padding: 7px 10px;
            font-size: 8px;
            color: #92400e;
            margin-bottom: 20px;
            line-height: 1.35;
        }
        
        .signatures {
            width: 100%;
            page-break-inside: avoid;
        }
        .signatures td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 8.5px;
        }
        .sig-space {
            height: 50px;
        }
        .sig-name {
            font-weight: bold;
            color: #111827;
            border-top: 1px solid #9ca3af;
            display: inline-block;
            padding-top: 3px;
            min-width: 160px;
        }
        .sig-role {
            color: #6b7280;
            font-size: 8px;
        }
        
        .footer {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 7.5px;
            color: #9ca3af;
            line-height: 1.5;
        }
        .verify-link {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="top-accent"></div>

    <!-- Official Letterhead Header -->
    <table class="header-table">
        <tr>
            <td style="width: 55%;">
                <table>
                    <tr>
                        <td style="width: 50px;">
                            <div class="logo-box">LP</div>
                        </td>
                        <td>
                            <div class="brand-title">{{ $company['name'] }}</div>
                            <div class="brand-subtitle">{{ $company['legal_name'] }} • Surat Kabar & Media Siber</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="company-meta" style="width: 45%;">
                {{ $company['address'] }}<br>
                Telp: {{ $company['phone'] }} • Email: {{ $company['email'] }}<br>
                NPWP: {{ $company['npwp'] }} • Website: {{ $company['website'] }}
            </td>
        </tr>
    </table>

    <!-- Document Heading & Status -->
    <table class="doc-header">
        <tr>
            <td style="width: 65%;">
                <div class="doc-title">Faktur Tagihan Resmi</div>
                <div class="doc-number">{{ $invoice->invoice_number }}</div>
            </td>
            <td style="width: 35%; text-align: right;">
                @if($invoice->status === 'paid')
                    <div class="status-badge status-paid">LUNAS / PAID</div>
                @elseif($invoice->status === 'unpaid')
                    <div class="status-badge status-unpaid">MENUNGGU PEMBAYARAN</div>
                @else
                    <div class="status-badge status-expired">{{ strtoupper($invoice->status) }}</div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Dates Strip -->
    <table class="meta-strip">
        <tr>
            <td>
                <span class="meta-label">Tanggal Diterbitkan:</span> 
                <span class="meta-val">{{ $invoice->created_at->translatedFormat('d F Y') }}</span>
            </td>
            <td>
                <span class="meta-label">Batas Waktu Bayar:</span> 
                <span class="meta-val">{{ $invoice->due_date->translatedFormat('d F Y') }}</span>
            </td>
            <td>
                <span class="meta-label">Petugas Finance:</span> 
                <span class="meta-val">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</span>
            </td>
        </tr>
    </table>

    <!-- Parties Involved (Billed By & Billed To) -->
    <table class="parties-table">
        <tr>
            <td>
                <div class="party-box left">
                    <div class="party-heading">Penerbit Tagihan</div>
                    <div class="party-name">{{ $company['name'] }}</div>
                    <div class="party-detail">
                        Divisi Keuangan, Iklan & Sirkulasi<br>
                        Telp: {{ $company['phone'] }}<br>
                        Email: {{ $company['email'] }}
                    </div>
                </div>
            </td>
            <td>
                <div class="party-box right">
                    <div class="party-heading">Ditujukan Kepada (Pengiklan)</div>
                    <div class="party-name">{{ $invoice->advertiser_name }}</div>
                    <div class="party-detail">
                        Kontak: {{ $invoice->advertiser_contact }}<br>
                        Penempatan: {{ $invoice->ad_slot }}<br>
                        ID Pelanggan: Klien Resmi Lampung Post
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Itemized Services Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th class="text-center" style="width: 6%;">No</th>
                <th style="width: 44%;">Deskripsi Layanan & Spesifikasi</th>
                <th class="text-center" style="width: 16%;">Periode Tayang</th>
                <th class="text-center" style="width: 10%;">Qty</th>
                <th class="text-right" style="width: 24%;">Subtotal (IDR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td>
                    <strong>Penayangan Slot Iklan: {{ $invoice->ad_slot }}</strong><br>
                    <span style="color: #64748b; font-size: 8px;">{{ $invoice->description }}</span>
                </td>
                <td class="text-center">
                    {{ $invoice->ad_duration_days }} Hari<br>
                    <span style="color: #64748b; font-size: 7.5px;">Mulai: {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d/m/Y') : '-' }}</span>
                </td>
                <td class="text-center">1 Paket</td>
                <td class="text-right" style="font-weight: bold;">
                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Financial Calculation Summary -->
    <table class="summary-table">
        <tr>
            <td class="col-blank"></td>
            <td class="col-label">Subtotal Tagihan:</td>
            <td class="col-val">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="col-blank"></td>
            <td class="col-label">PPN / Bea Administrasi:</td>
            <td class="col-val">Termasuk (Rp 0)</td>
        </tr>
        <tr class="grand-total-row">
            <td style="background-color: #ffffff;"></td>
            <td style="text-transform: uppercase;">Total Tagihan:</td>
            <td class="col-val">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <!-- Terbilang Box -->
    <div class="terbilang-box">
        <strong>Terbilang:</strong> {{ \App\Support\Terbilang::rupiah($invoice->amount) }}
    </div>

    <!-- Official Payment Instructions -->
    <table class="payment-instruct">
        <tr>
            <td>
                <div class="instruct-card left">
                    <div class="instruct-title">1. Pembayaran Digital Real-Time</div>
                    <div class="instruct-desc">
                        Gunakan portal pembayaran mandiri Lampung Post untuk membayar via <strong>QRIS Semua Bank & e-Wallet</strong> (BCA, Mandiri, GoPay, OVO, ShopeePay) atau <strong>Virtual Account</strong>.<br>
                        Tautan bayar: <span style="color: #dc2626; font-family: monospace;">{{ $payment_url }}</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="instruct-card right">
                    <div class="instruct-title">2. Transfer Rekening Resmi Perusahaan</div>
                    <div class="instruct-desc">
                        @foreach($company['bank_accounts'] as $acc)
                            <div class="bank-item">
                                <strong>{{ $acc['bank'] }}</strong>: <span style="font-family: monospace; font-weight: bold;">{{ $acc['account_number'] }}</span> (a.n. {{ $acc['account_name'] }})
                            </div>
                        @endforeach
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Terms & Legal Notice -->
    <div class="terms-box">
        <strong>Ketentuan & Keterangan:</strong><br>
        1. Tagihan ini sah diterbitkan secara elektronik oleh PT Lampung Post sebagai dasar penagihan layanan iklan/kemitraan.<br>
        2. Mohon selesaikan pembayaran sebelum tanggal jatuh tempo agar slot tayang tidak dibatalkan secara otomatis oleh sistem.<br>
        3. Kuitansi resmi berformat PDF berstempel sah akan diterbitkan secara otomatis setelah dana berhasil diverifikasi.
    </div>

    <!-- Signature Section -->
    <table class="signatures">
        <tr>
            <td>
                <div>Penerima / Pengiklan</div>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $invoice->advertiser_name }}</div>
                <div class="sig-role">Penanggung Jawab Iklan</div>
            </td>
            <td>
                <div>Bandar Lampung, {{ $invoice->created_at->translatedFormat('d F Y') }}</div>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</div>
                <div class="sig-role">Bagian Keuangan PT Lampung Post</div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Faktur tagihan elektronik ini diterbitkan secara otomatis oleh Sistem E-Payment PT Lampung Post.<br>
        Verifikasi keaslian & status pembayaran secara online melalui: <span class="verify-link">{{ $payment_url }}</span>
    </div>

</body>
</html>
