<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }} — PT Lampung Post</title>
    <style>
        @page {
            margin: 18mm 16mm 18mm 16mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9.5px;
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
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #64748B;
        }

        .text-muted { color: #64748B; }
        .text-main  { color: #0F172A; }
        .text-brand { color: #DC2626; }

        /* ---------- Top accent ---------- */
        .top-accent {
            height: 4px;
            background-color: #DC2626;
            border-radius: 2px;
            margin-bottom: 20px;
        }

        /* ---------- Letterhead ---------- */
        .header-table {
            width: 100%;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid #E2E8F0;
        }
        .header-table td { vertical-align: middle; }

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
            letter-spacing: 0.5px;
        }

        .brand-title {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 16px;
            font-weight: bold;
            color: #0F172A;
            letter-spacing: -0.02em;
        }

        .brand-subtitle {
            font-size: 8px;
            color: #64748B;
            margin-top: 1px;
        }

        .company-meta {
            text-align: right;
            font-size: 8px;
            color: #64748B;
            line-height: 1.55;
        }

        /* ---------- Document header ---------- */
        .doc-header {
            width: 100%;
            margin-bottom: 16px;
        }
        .doc-header td { vertical-align: top; }

        .doc-eyebrow {
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #DC2626;
            margin-bottom: 3px;
        }

        .doc-title {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 19px;
            font-weight: bold;
            color: #0F172A;
            letter-spacing: -0.02em;
            line-height: 1.15;
        }

        .doc-number {
            font-size: 11px;
            font-weight: bold;
            color: #DC2626;
            margin-top: 3px;
            font-family: DejaVu Sans Mono, monospace;
            letter-spacing: 0.3px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            font-size: 8.5px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            border-radius: 20px;
            border: 1px solid;
        }
        .status-paid    { background-color: #ECFDF5; border-color: #A7F3D0; color: #047857; }
        .status-unpaid  { background-color: #FFFBEB; border-color: #FCD34D; color: #B45309; }
        .status-expired { background-color: #F8FAFC; border-color: #E2E8F0; color: #64748B; }

        /* ---------- Meta strip ---------- */
        .meta-strip {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            background-color: #FEF2F2;
            border-left: 2px solid #DC2626;
        }
        .meta-strip td {
            padding: 6px 10px;
            font-size: 8.5px;
            vertical-align: top;
        }
        .meta-strip .meta-label {
            display: block;
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748B;
            margin-bottom: 1px;
        }
        .meta-strip .meta-val {
            color: #0F172A;
            font-weight: bold;
        }

        /* ---------- Party boxes ---------- */
        .parties-table {
            width: 100%;
            margin-bottom: 18px;
            border-collapse: separate;
            border-spacing: 6px 0;
        }
        .parties-table > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }
        .party-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 10px 12px;
            border-radius: 4px;
        }
        .party-heading {
            font-size: 7.5px;
            font-weight: bold;
            color: #DC2626;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin-bottom: 5px;
            padding-bottom: 4px;
            border-bottom: 1px solid #E2E8F0;
        }
        .party-name {
            font-size: 10px;
            font-weight: bold;
            color: #0F172A;
            margin-bottom: 2px;
        }
        .party-detail {
            font-size: 8px;
            color: #64748B;
            line-height: 1.5;
        }
        .party-detail strong { color: #0F172A; }

        /* ---------- Items table ---------- */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .items-table th {
            background-color: #0F172A;
            color: #FFFFFF;
            font-size: 7.5px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            padding: 8px 10px;
            text-align: left;
        }
        .items-table th.text-right  { text-align: right; }
        .items-table th.text-center { text-align: center; }

        .items-table td {
            padding: 9px 10px;
            border-bottom: 1px solid #E2E8F0;
            font-size: 8.5px;
            vertical-align: top;
            color: #0F172A;
        }
        .items-table td.text-right  { text-align: right; }
        .items-table td.text-center { text-align: center; }

        .item-title {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 10.5px;
            font-weight: bold;
            color: #0F172A;
            letter-spacing: -0.01em;
            line-height: 1.3;
            margin-bottom: 3px;
        }
        .item-sub {
            font-size: 8px;
            color: #64748B;
            line-height: 1.5;
        }
        .item-sub strong { color: #0F172A; }
        .item-quote {
            font-size: 8px;
            color: #64748B;
            font-style: italic;
            line-height: 1.5;
            padding-left: 8px;
            border-left: 2px solid #E2E8F0;
            margin-top: 4px;
        }

        /* ---------- Summary ---------- */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }
        .summary-table td {
            padding: 5px 10px;
            font-size: 8.5px;
        }
        .summary-table .col-blank { width: 55%; }
        .summary-table .col-label {
            width: 20%;
            color: #64748B;
            text-align: right;
        }
        .summary-table .col-val {
            width: 25%;
            color: #0F172A;
            font-weight: bold;
            text-align: right;
        }

        .grand-total-row td {
            padding: 10px 10px;
            background-color: #DC2626;
            color: #FFFFFF !important;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .grand-total-row .col-label { color: #FFFFFF !important; }
        .grand-total-row .col-val {
            font-family: DejaVu Serif, Georgia, serif;
            font-size: 15px;
            color: #FFFFFF !important;
            letter-spacing: -0.02em;
            text-transform: none;
            letter-spacing: 0.3px;
        }

        /* ---------- Terbilang ---------- */
        .terbilang-box {
            background-color: #F8FAFC;
            border: 1px dashed #CBD5E1;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 8.5px;
            color: #0F172A;
            margin-bottom: 16px;
            font-style: italic;
        }
        .terbilang-box strong { font-style: normal; color: #0F172A; }

        /* ---------- Payment instructions ---------- */
        .payment-instruct {
            width: 100%;
            border-collapse: separate;
            border-spacing: 6px 0;
            margin-bottom: 14px;
        }
        .payment-instruct > tbody > tr > td {
            width: 50%;
            vertical-align: top;
            padding: 0;
        }
        .instruct-card {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 10px 12px;
            border-radius: 4px;
        }
        .instruct-title {
            font-size: 7.5px;
            font-weight: bold;
            color: #0F172A;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .instruct-desc {
            font-size: 8px;
            color: #64748B;
            line-height: 1.5;
        }
        .instruct-desc strong { color: #0F172A; }
        .bank-item {
            margin-top: 4px;
            font-size: 8px;
            color: #0F172A;
        }
        .bank-account {
            font-family: DejaVu Sans Mono, monospace;
            font-weight: bold;
            color: #0F172A;
        }

        /* ---------- Terms ---------- */
        .terms-box {
            background-color: #FFFBEB;
            border-left: 2px solid #F59E0B;
            border-radius: 0 4px 4px 0;
            padding: 8px 12px;
            font-size: 8px;
            color: #92400E;
            margin-bottom: 18px;
            line-height: 1.55;
        }
        .terms-box strong { color: #78350F; }

        /* ---------- Signatures ---------- */
        .signatures {
            width: 100%;
            page-break-inside: avoid;
            padding-top: 12px;
            border-top: 1px solid #E2E8F0;
            margin-top: 18px;
        }
        .signatures td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 8.5px;
        }
        .sig-space { height: 55px; }
        .sig-name {
            font-weight: bold;
            color: #0F172A;
            border-top: 1px solid #CBD5E1;
            display: inline-block;
            padding-top: 4px;
            min-width: 160px;
        }
        .sig-role {
            color: #64748B;
            font-size: 8px;
        }
        .sig-date {
            color: #64748B;
            font-size: 8px;
            margin-bottom: 4px;
        }
        .digital-badge {
            display: inline-block;
            font-family: DejaVu Sans Mono, monospace;
            color: #DC2626;
            background-color: #FEF2F2;
            border: 1px solid #FCA5A5;
            padding: 4px 10px;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-top: 14px;
            text-transform: uppercase;
            border-radius: 4px;
        }

        /* ---------- Footer ---------- */
        .footer {
            margin-top: 18px;
            padding-top: 10px;
            border-top: 1px solid #E2E8F0;
            text-align: center;
            font-size: 7.5px;
            color: #94A3B8;
            line-height: 1.6;
        }
        .verify-link {
            color: #DC2626;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="top-accent"></div>

    <!-- Letterhead -->
    <table class="header-table">
        <tr>
            <td style="width: 55%;">
                <table>
                    <tr>
                        <td style="width: 48px;">
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
                NPWP: {{ $company['npwp'] }} • {{ $company['website'] }}
            </td>
        </tr>
    </table>

    <!-- Document Header -->
    <table class="doc-header">
        <tr>
            <td style="width: 65%;">
                <div class="doc-eyebrow">Commercial Invoice / Faktur Penagihan</div>
                <div class="doc-title">Faktur Tagihan Resmi</div>
                <div class="doc-number">{{ $invoice->invoice_number }}</div>
            </td>
            <td style="width: 35%; text-align: right;">
                @if ($invoice->status === 'paid')
                    <div class="status-badge status-paid">Lunas / Paid</div>
                @elseif($invoice->status === 'unpaid')
                    <div class="status-badge status-unpaid">Menunggu Pembayaran</div>
                @else
                    <div class="status-badge status-expired">{{ strtoupper($invoice->status) }}</div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Meta Strip -->
    <table class="meta-strip">
        <tr>
            <td style="width: 33%;">
                <span class="meta-label">Tanggal Diterbitkan</span>
                <span class="meta-val">{{ $invoice->created_at->translatedFormat('d F Y') }}</span>
            </td>
            <td style="width: 33%;">
                <span class="meta-label">Batas Waktu Bayar</span>
                <span class="meta-val">{{ $invoice->due_date->translatedFormat('d F Y') }}</span>
            </td>
            <td style="width: 34%;">
                <span class="meta-label">Petugas Finance</span>
                <span class="meta-val">{{ $invoice->creator->name ?? 'Admin Keuangan' }}</span>
            </td>
        </tr>
    </table>

    <!-- Parties -->
    <table class="parties-table">
        <tr>
            <td>
                <div class="party-box">
                    <div class="party-heading">Penerbit Tagihan (Billed By)</div>
                    <div class="party-name">{{ $company['name'] }}</div>
                    <div class="party-detail">
                        Divisi Keuangan, Iklan & Sirkulasi<br>
                        Telp: {{ $company['phone'] }}<br>
                        Email: {{ $company['email'] }}
                    </div>
                </div>
            </td>
            <td>
                <div class="party-box">
                    <div class="party-heading">Ditujukan Kepada (Billed To)</div>
                    <div class="party-name">{{ $invoice->billing_name ?? $invoice->advertiser_name }}</div>
                    <div class="party-detail">
                        {{ $invoice->billing_email ?? $invoice->advertiser_contact }}
                        @if ($invoice->billing_npwp_nik)
                            <br>NPWP/NIK: {{ $invoice->billing_npwp_nik }}
                        @endif
                        @if ($invoice->billing_phone)
                            <br>Telp: {{ $invoice->billing_phone }}
                        @endif
                        @if ($invoice->billing_address)
                            <br><span style="color: #64748B;">{{ $invoice->billing_address }}</span>
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Items Table -->
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
                <td class="text-center" style="color: #94A3B8; font-weight: bold;">1</td>
                <td>
                    <div class="item-title">
                        {{ $invoice->ad_title ?? 'Penayangan Slot Iklan: ' . ($invoice->ad_slot ?? '-') }}
                    </div>
                    @if ($invoice->category)
                        <div class="item-sub">
                            <strong>Kategori:</strong> {{ $invoice->category }} › {{ $invoice->subcategory }}
                        </div>
                    @endif
                    @if ($invoice->ad_format)
                        @php $fmt = config('ad_booking.formats')[$invoice->ad_format] ?? null; @endphp
                        @if ($fmt)
                            <div class="item-sub">
                                <strong>Format:</strong> {{ $fmt['name'] }} ({{ $fmt['size'] }})
                            </div>
                        @endif
                    @endif
                    @if ($invoice->ad_text ?? $invoice->description)
                        <div class="item-quote">
                            {{ $invoice->ad_text ?? $invoice->description }}
                        </div>
                    @endif
                </td>
                <td class="text-center">
                    <span style="font-weight: bold; color: #0F172A; display: block;">
                        {{ $invoice->ad_duration_days ?? 7 }} Hari
                    </span>
                    <span style="font-size: 8px; color: #94A3B8;">
                        Mulai: {{ $invoice->ad_start_date ? $invoice->ad_start_date->translatedFormat('d M Y') : '-' }}
                    </span>
                </td>
                <td class="text-center" style="font-weight: bold; color: #0F172A;">1 Paket</td>
                <td class="text-right" style="font-weight: bold; color: #0F172A;">
                    Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Summary -->
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
            <td style="background-color: #FFFFFF;"></td>
            <td class="col-label">Total Tagihan</td>
            <td class="col-val">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <!-- Terbilang -->
    <div class="terbilang-box">
        <strong>Terbilang:</strong> {{ \App\Support\Terbilang::rupiah($invoice->amount) }}
    </div>

    <!-- Payment Instructions -->
    <table class="payment-instruct">
        <tr>
            <td>
                <div class="instruct-card">
                    <div class="instruct-title">1. Pembayaran Digital Real-Time</div>
                    <div class="instruct-desc">
                        Gunakan portal pembayaran mandiri Lampung Post untuk membayar via
                        <strong>QRIS Semua Bank &amp; e-Wallet</strong> (BCA, Mandiri, GoPay, OVO, ShopeePay)
                        atau <strong>Virtual Account</strong>.<br>
                        Tautan bayar:
                        <span style="color: #DC2626; font-family: DejaVu Sans Mono, monospace;">{{ $payment_url }}</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="instruct-card">
                    <div class="instruct-title">2. Transfer Rekening Resmi Perusahaan</div>
                    <div class="instruct-desc">
                        @foreach ($company['bank_accounts'] as $acc)
                            <div class="bank-item">
                                <strong>{{ $acc['bank'] }}</strong>:
                                <span class="bank-account">{{ $acc['account_number'] }}</span>
                                (a.n. {{ $acc['account_name'] }})
                            </div>
                        @endforeach
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Terms -->
    <div class="terms-box">
        <strong>Ketentuan &amp; Keterangan:</strong><br>
        1. Tagihan ini sah diterbitkan secara elektronik oleh PT Lampung Post sebagai dasar penagihan layanan iklan/kemitraan.<br>
        2. Mohon selesaikan pembayaran sebelum tanggal jatuh tempo agar slot tayang tidak dibatalkan secara otomatis oleh sistem.<br>
        3. Kuitansi resmi berformat PDF berstempel sah akan diterbitkan secara otomatis setelah dana berhasil diverifikasi.
    </div>

    <!-- Signatures -->
    <table class="signatures">
        <tr>
            <td>
                <div class="sig-date">Penerima Tagihan (Pengiklan)</div>
                <div class="sig-space">
                    @if ($invoice->hasSignature())
                        <img src="{{ $invoice->signature_data }}" alt="Signature"
                             style="max-height: 55px; max-width: 180px; display: block; margin: 3px auto;">
                    @endif
                </div>
                <div class="sig-name">
                    {{ $invoice->signed_by_name ?? $invoice->billing_name }}
                </div>
                <div class="sig-role">Penanggung Jawab Pesanan</div>
            </td>

            <td>
                <div class="sig-date">
                    Bandar Lampung, {{ $invoice->created_at->translatedFormat('d F Y') }}
                </div>
                <div class="sig-space">
                    <span class="digital-badge">Signed Digitally</span>
                </div>
                <div class="sig-name">
                    {{ $invoice->creator->name ?? 'Admin Keuangan' }}
                </div>
                <div class="sig-role">Divisi Keuangan PT Lampung Post</div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Faktur tagihan elektronik ini diterbitkan secara otomatis oleh Sistem E-Payment PT Lampung Post.<br>
        Verifikasi keaslian &amp; status pembayaran secara online melalui:
        <span class="verify-link">{{ $payment_url }}</span>
    </div>

</body>

</html>