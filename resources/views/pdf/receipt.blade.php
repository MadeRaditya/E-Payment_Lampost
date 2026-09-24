<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi {{ $receipt->receipt_number }}</title>
    <style>
        @page {
            margin: 25mm 20mm 25mm 20mm;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #1f2937;
            line-height: 1.4;
        }
        
        .top-accent {
            height: 6px;
            background-color: #dc2626;
            margin-bottom: 20px;
        }
        
        .header {
            width: 100%;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #dc2626;
        }
        .header td {
            vertical-align: middle;
        }
        .logo-box {
            display: inline-block;
            width: 42px;
            height: 42px;
            background-color: #dc2626;
            color: #ffffff;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            line-height: 42px;
        }
        .brand-name {
            font-size: 18px;
            font-weight: bold;
            color: #111827;
            margin-left: 10px;
        }
        .brand-tagline {
            font-size: 9px;
            color: #6b7280;
            margin-left: 10px;
        }
        .company-info {
            text-align: right;
            font-size: 9px;
            color: #4b5563;
            line-height: 1.5;
        }
        
        .doc-title {
            text-align: center;
            margin: 25px 0 8px 0;
        }
        .doc-title h1 {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 4px;
            color: #111827;
            text-transform: uppercase;
        }
        .doc-subtitle {
            text-align: center;
            font-size: 10px;
            color: #6b7280;
            margin-bottom: 20px;
        }
        
        .badge-wrapper {
            text-align: center;
            margin-bottom: 25px;
        }
        .badge {
            display: inline-block;
            padding: 6px 40px;
            background-color: #dcfce7;
            border: 2px solid #16a34a;
            color: #15803d;
            font-size: 13px;
            font-weight: bold;
            letter-spacing: 4px;
        }
        
        .section-title {
            font-size: 10px;
            font-weight: bold;
            color: #dc2626;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 4px 0 4px 10px;
            border-left: 3px solid #dc2626;
            margin-bottom: 8px;
            background-color: #fef2f2;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .info-table td {
            padding: 7px 0;
            font-size: 10px;
            vertical-align: top;
            border-bottom: 1px dotted #e5e7eb;
        }
        .info-table td.label {
            color: #6b7280;
            width: 38%;
        }
        .info-table td.value {
            color: #111827;
            font-weight: bold;
            text-align: right;
        }
        
        .two-col {
            width: 100%;
            margin-bottom: 15px;
        }
        .two-col > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }
        .two-col td.col-left {
            padding-right: 8px;
        }
        .two-col td.col-right {
            padding-left: 8px;
        }
        
        .amount-box {
            width: 100%;
            background-color: #dc2626;
            margin: 15px 0 20px 0;
        }
        .amount-box td {
            padding: 18px 24px;
            color: #ffffff;
            vertical-align: middle;
        }
        .amount-box .label {
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            opacity: 0.9;
        }
        .amount-box .value {
            font-size: 24px;
            font-weight: bold;
            text-align: right;
            letter-spacing: 1px;
        }
        
        .ad-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ad-table td {
            padding: 6px 0;
            font-size: 10px;
            vertical-align: top;
            border-bottom: 1px dotted #e5e7eb;
        }
        .ad-table td:first-child {
            color: #6b7280;
            width: 40%;
        }
        .ad-table td:last-child {
            color: #111827;
            font-weight: bold;
        }
        
        .note {
            background-color: #fffbeb;
            border-left: 3px solid #f59e0b;
            padding: 8px 12px;
            font-size: 9px;
            color: #92400e;
            margin: 15px 0;
        }
        
        .signature-table {
            width: 100%;
            margin-top: 25px;
            page-break-inside: avoid;
        }
        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 20px;
        }
        .signature-space {
            height: 55px;
        }
        .signature-line {
            border-top: 1px solid #374151;
            padding-top: 5px;
            font-size: 10px;
            color: #4b5563;
        }
        .signature-name {
            font-weight: bold;
            color: #111827;
            font-size: 10px;
        }
        
        .footer {
            margin-top: 25px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8px;
            color: #9ca3af;
            line-height: 1.6;
        }
        .footer .verify-url {
            color: #dc2626;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="top-accent"></div>

    <table class="header">
        <tr>
            <td style="width: 60%;">
                <table>
                    <tr>
                        <td style="width: 50px;">
                            <div class="logo-box">A</div>
                        </td>
                        <td>
                            <div class="brand-name">{{ $company['name'] }}</div>
                            <div class="brand-tagline">Sistem Pembayaran Iklan Digital</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="company-info" style="width: 40%;">
                {{ $company['address'] }}<br>
                Telp: {{ $company['phone'] }}<br>
                Email: {{ $company['email'] }}<br>
                {{ $company['website'] }}
            </td>
        </tr>
    </table>

    <div class="doc-title">
        <h1>Kuitansi Pembayaran</h1>
    </div>
    <div class="doc-subtitle">No. {{ $receipt->receipt_number }}</div>

    <div class="badge-wrapper">
        <div class="badge">LUNAS</div>
    </div>

    <div class="section-title">Informasi Pembayaran</div>
    <table class="info-table">
        <tr>
            <td class="label">Tanggal Pembayaran</td>
            <td class="value">
                {{ $payment->paid_at ? $payment->paid_at->translatedFormat('d F Y, H:i') : $payment->updated_at->translatedFormat('d F Y, H:i') }} WIB
            </td>
        </tr>
        <tr>
            <td class="label">ID Tagihan</td>
            <td class="value">{{ $invoice->invoice_number }}</td>
        </tr>
        <tr>
            <td class="label">Metode Pembayaran</td>
            <td class="value">{{ strtoupper($payment->payment_method ?? 'Online Payment') }}</td>
        </tr>
        <tr>
            <td class="label">Referensi Gateway</td>
            <td class="value" style="font-family: DejaVu Sans Mono, monospace; font-size: 9px;">
                {{ $payment->reference_id ?? '-' }}
            </td>
        </tr>
    </table>

    <table class="amount-box">
        <tr>
            <td style="width: 50%;">
                <div class="label">Total Dibayarkan</div>
            </td>
            <td style="width: 50%;">
                <div class="value">Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
            </td>
        </tr>
    </table>

    <table class="two-col">
        <tr>
            <td class="col-left">
                <div class="section-title">Telah Diterima Dari</div>
                <table class="ad-table">
                    <tr>
                        <td>Nama</td>
                        <td>{{ $invoice->advertiser_name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Kontak</td>
                        <td>{{ $invoice->advertiser_contact ?? '-' }}</td>
                    </tr>
                </table>
            </td>
            <td class="col-right">
                <div class="section-title">Detail Iklan</div>
                <table class="ad-table">
                    <tr>
                        <td>Slot</td>
                        <td>{{ $invoice->ad_slot ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Durasi</td>
                        <td>{{ $invoice->ad_duration_days ? $invoice->ad_duration_days . ' hari' : '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title">Deskripsi</div>
    <table class="ad-table">
        <tr>
            <td style="width: 25%;">Mulai Tayang</td>
            <td>{{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>{{ $invoice->description }}</td>
        </tr>
    </table>

    <div class="note">
        <strong>Catatan:</strong> Kuitansi ini sah dan diterbitkan secara digital tanpa memerlukan tanda tangan basah. 
        Verifikasi keaslian dokumen dapat dilakukan melalui tautan di bagian bawah.
    </div>

    <table class="signature-table">
        <tr>
            <td>
                <div class="signature-space"></div>
                <div class="signature-line">
                    <div class="signature-name">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</div>
                    <div>Bagian Keuangan</div>
                </div>
            </td>
            <td>
                <div class="signature-space"></div>
                <div class="signature-line">
                    <div class="signature-name">{{ $invoice->advertiser_name ?? 'Pengiklan' }}</div>
                    <div>Penerima</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen ini diterbitkan secara elektronik dan sah tanpa tanda tangan basah.<br>
        Verifikasi keaslian: <span class="verify-url">{{ $verification_url }}</span>
    </div>

</body>
</html>