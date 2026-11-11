<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kuitansi {{ $receipt->receipt_number }}</title>
    <style>
        @page {
            margin: 22mm 18mm 22mm 18mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #0F172A;
            line-height: 1.5;
            background: #FFFFFF;
            -webkit-font-smoothing: antialiased;
        }

        /* ---------- Editorial typography ---------- */
        .font-serif {
            font-family: DejaVu Serif, Georgia, serif;
            letter-spacing: -0.02em;
        }

        .label {
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748B;
        }

        /* ---------- Top accent ---------- */
        .top-accent {
            height: 4px;
            background-color: #DC2626;
            border-radius: 2px;
            margin-bottom: 20px;
        }

        /* ---------- Header ---------- */
        .header {
            width: 100%;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 1px solid #E2E8F0;
        }
        .header td { vertical-align: middle; }

        .logo-box {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #DC2626;
            color: #FFFFFF;
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            line-height: 40px;
            border-radius: 4px;
        }

        .brand-name {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 16px;
            font-weight: bold;
            color: #0F172A;
            letter-spacing: -0.02em;
        }

        .brand-tagline {
            font-size: 8px;
            color: #64748B;
            margin-top: 1px;
        }

        .company-info {
            text-align: right;
            font-size: 8px;
            color: #64748B;
            line-height: 1.55;
        }

        /* ---------- Doc title ---------- */
        .doc-title {
            text-align: center;
            margin: 24px 0 6px 0;
        }

        .doc-title h1 {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #0F172A;
            text-transform: uppercase;
        }

        .doc-subtitle {
            text-align: center;
            font-size: 9px;
            color: #64748B;
            margin-bottom: 18px;
            font-family: DejaVu Sans Mono, monospace;
            letter-spacing: 0.5px;
        }

        /* ---------- Status badge ---------- */
        .badge-wrapper {
            text-align: center;
            margin-bottom: 22px;
        }

        .badge {
            display: inline-block;
            padding: 5px 32px;
            background-color: #ECFDF5;
            border: 1px solid #A7F3D0;
            color: #047857;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 4px;
            border-radius: 20px;
        }

        /* ---------- Section titles ---------- */
        .section-title {
            font-size: 8px;
            font-weight: bold;
            color: #DC2626;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 0 5px 10px;
            border-left: 2px solid #DC2626;
            background-color: #FEF2F2;
            margin-bottom: 8px;
        }

        /* ---------- Info table ---------- */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .info-table td {
            padding: 7px 0;
            font-size: 9.5px;
            vertical-align: top;
            border-bottom: 1px solid #F1F5F9;
        }
        .info-table td.label {
            color: #64748B;
            width: 38%;
            font-weight: normal;
            text-transform: none;
            letter-spacing: 0;
            font-size: 9.5px;
        }
        .info-table td.value {
            color: #0F172A;
            font-weight: bold;
            text-align: right;
        }

        /* ---------- Amount box ---------- */
        .amount-box {
            width: 100%;
            background-color: #DC2626;
            margin: 14px 0 18px 0;
            border-radius: 4px;
        }
        .amount-box td {
            padding: 16px 22px;
            color: #FFFFFF;
            vertical-align: middle;
        }
        .amount-box .label {
            font-size: 9px;
            letter-spacing: 2px;
            text-transform: uppercase;
            opacity: 0.9;
            color: #FFFFFF;
            font-weight: bold;
        }
        .amount-box .value {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 22px;
            font-weight: bold;
            text-align: right;
            letter-spacing: -0.02em;
        }

        /* ---------- Two-column info ---------- */
        .two-col {
            width: 100%;
            border-collapse: separate;
            border-spacing: 6px 0;
            margin-bottom: 14px;
        }
        .two-col > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }

        /* ---------- Ad detail table ---------- */
        .ad-table {
            width: 100%;
            border-collapse: collapse;
        }
        .ad-table td {
            padding: 6px 0;
            font-size: 9.5px;
            vertical-align: top;
            border-bottom: 1px solid #F1F5F9;
        }
        .ad-table td:first-child {
            color: #64748B;
            width: 40%;
        }
        .ad-table td:last-child {
            color: #0F172A;
            font-weight: bold;
        }

        /* ---------- Note ---------- */
        .note {
            background-color: #FFFBEB;
            border-left: 2px solid #F59E0B;
            border-radius: 0 4px 4px 0;
            padding: 8px 12px;
            font-size: 8.5px;
            color: #92400E;
            margin: 16px 0;
            line-height: 1.55;
        }
        .note strong { color: #78350F; }

        /* ---------- Signatures ---------- */
        .signature-table {
            width: 100%;
            margin-top: 22px;
            page-break-inside: avoid;
            padding-top: 12px;
            border-top: 1px solid #E2E8F0;
        }
        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 16px;
        }
        .signature-space {
            height: 55px;
        }
        .signature-line {
            border-top: 1px solid #CBD5E1;
            padding-top: 5px;
            font-size: 9px;
            color: #64748B;
        }
        .signature-name {
            font-weight: bold;
            color: #0F172A;
            font-size: 9.5px;
        }

        /* ---------- Footer ---------- */
        .footer {
            margin-top: 22px;
            padding-top: 10px;
            border-top: 1px solid #E2E8F0;
            text-align: center;
            font-size: 7.5px;
            color: #94A3B8;
            line-height: 1.6;
        }
        .footer .verify-url {
            color: #DC2626;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="top-accent"></div>

    <!-- Header -->
    <table class="header">
        <tr>
            <td style="width: 60%;">
                <table>
                    <tr>
                        <td style="width: 48px;">
                            <div class="logo-box">LP</div>
                        </td>
                        <td>
                            <div class="brand-name">PT LAMPUNG POST</div>
                            <div class="brand-tagline">Sistem Pembayaran Digital Resmi (E-Payment)</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td class="company-info" style="width: 40%;">
                Jl. Soekarno Hatta No. 108, Rajabasa, Bandar Lampung<br>
                Telp: (0721) 783693 / 783694<br>
                Email: keuangan@lampungpost.co.id<br>
                www.lampungpost.co.id
            </td>
        </tr>
    </table>

    <!-- Document Title -->
    <div class="doc-title">
        <h1>Kuitansi Pembayaran</h1>
    </div>
    <div class="doc-subtitle">No. {{ $receipt->receipt_number }}</div>

    <div class="badge-wrapper">
        <div class="badge">LUNAS</div>
    </div>

    <!-- Payment Info -->
    <div class="section-title">Informasi Pembayaran</div>
    <table class="info-table">
        <tr>
            <td class="label">Tanggal Pembayaran</td>
            <td class="value">
                {{ $payment->paid_at ? $payment->paid_at->translatedFormat('d F Y, H:i') : $payment->updated_at->translatedFormat('d F Y, H:i') }}
                WIB
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

    <!-- Amount Box -->
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

    <!-- Two-column: Sender / Ad -->
    <table class="two-col">
        <tr>
            <td>
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
            <td>
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

    <!-- Description -->
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

    <!-- Note -->
    <div class="note">
        <strong>Catatan:</strong> Kuitansi ini sah dan diterbitkan secara digital tanpa memerlukan tanda tangan basah.
        Verifikasi keaslian dokumen dapat dilakukan melalui tautan di bagian bawah.
    </div>

    <!-- Signatures -->
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
                <div class="signature-space">
                    @if ($invoice->hasSignature())
                        <img src="{{ $invoice->signature_data }}" alt="Signature"
                             style="max-height: 55px; max-width: 180px; display: block; margin: 3px auto;">
                    @endif
                </div>
                <div class="signature-line">
                    <div class="signature-name">
                        {{ $invoice->signed_by_name ?? ($invoice->advertiser_name ?? 'Pengiklan') }}
                    </div>
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