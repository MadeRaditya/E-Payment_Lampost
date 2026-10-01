<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil admin pertama
        $admin = User::first();

        if (!$admin) {
            $this->command->error('❌ User admin belum ada. Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        $demoSignature = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';

        $invoices = [
            [
                'invoice_number'     => 'INV-' . date('Ymd') . '-A001',
                'created_by'         => $admin->id,
                'placement_type'     => 'online',
                'category'           => 'Properti',
                'subcategory'        => 'Rumah Dijual',
                'ad_title'           => 'Rumah 2 Lantai Strategis di Pusat Kota',
                'ad_format'          => 'display_banner',
                'ad_text'            => "Dijual rumah 2 lantai dengan lokasi strategis di pusat kota.\nLT 120m² / LB 180m², 3 KT, 2 KM, garasi 2 mobil.\nHarga: Rp 850 juta nego. Hub: 0812-xxxx-xxxx",
                'ad_start_date'      => now()->addDays(2),
                'ad_duration_days'   => 14,
                'ad_slot'            => 'display_banner',
                'amount'             => 500000 + (30000 * 14), 
                'description'        => 'Rumah 2 Lantai Strategis di Pusat Kota',
                'status'             => 'unpaid',
                'due_date'           => now()->addDays(7),

                'billing_name'       => 'PT Maju Jaya Properti',
                'billing_npwp_nik'   => '01.234.567.8-901.000',
                'billing_email'      => 'finance@majujaya.com',
                'billing_phone'      => '0812-3456-7890',
                'billing_address'    => 'Jl. Sudirman No. 45, Bandar Lampung, Lampung 35141',
                'payment_preference' => 'online',

                'advertiser_name'    => 'PT Maju Jaya Properti',
                'advertiser_contact' => 'finance@majujaya.com',

                'signature_data'     => $demoSignature,
                'signed_at'          => now(),
                'signed_by_name'     => 'Budi Santoso',
                'signed_ip'          => '127.0.0.1',
            ],

            [
                'invoice_number'     => 'INV-' . date('Ymd') . '-A002',
                'created_by'         => $admin->id,
                'placement_type'     => 'offline',
                'category'           => 'Otomotif',
                'subcategory'        => 'Mobil Dijual',
                'ad_title'           => 'Promo Spesial Toyota Avanza 2024',
                'ad_format'          => 'quarter_page',
                'ad_text'            => "Dapatkan diskon hingga Rp 20 juta untuk pembelian Toyota Avanza 2024.\nDP mulai 20%, cicilan ringan, bonus aksesoris lengkap.\nHubungi dealer resmi Auto2000 Lampung.",
                'ad_start_date'      => now()->addDays(3),
                'ad_duration_days'   => 3,
                'ad_slot'            => 'quarter_page',
                'amount'             => 500000 + (15000 * 3),
                'description'        => 'Promo Spesial Toyota Avanza 2024',
                'status'             => 'unpaid',
                'due_date'           => now()->addDays(10),

                'billing_name'       => 'Auto2000 Lampung',
                'billing_npwp_nik'   => '02.345.678.9-012.000',
                'billing_email'      => 'sales@auto2000.co.id',
                'billing_phone'      => '0821-9876-5432',
                'billing_address'    => 'Jl. Raden Intan No. 100, Bandar Lampung',
                'payment_preference' => 'manual',

                'advertiser_name'    => 'Auto2000 Lampung',
                'advertiser_contact' => 'sales@auto2000.co.id',

                'signature_data'     => $demoSignature,
                'signed_at'          => now(),
                'signed_by_name'     => 'Andi Wijaya',
                'signed_ip'          => '127.0.0.1',
            ],

            [
                'invoice_number'     => 'INV-' . date('Ymd') . '-A003',
                'created_by'         => $admin->id,
                'placement_type'     => 'online',
                'category'           => 'Karir & Pendidikan',
                'subcategory'        => 'Lowongan Kerja',
                'ad_title'           => 'Lowongan Staff Marketing & Digital',
                'ad_format'          => 'in_article',
                'ad_text'            => "Dibutuhkan segera Staff Marketing & Digital untuk perusahaan retail terkemuka.\nKualifikasi: D3/S1, pengalaman 1 tahun, menguasai social media ads.\nKirim CV ke: hrd@suksesmandiri.com",
                'ad_start_date'      => now()->subDays(3),
                'ad_duration_days'   => 10,
                'ad_slot'            => 'in_article',
                'amount'             => 400000 + (20000 * 10),
                'description'        => 'Lowongan Staff Marketing & Digital',
                'status'             => 'paid',
                'due_date'           => now()->subDays(5),

                'billing_name'       => 'CV Sukses Mandiri',
                'billing_npwp_nik'   => '03.456.789.0-123.000',
                'billing_email'      => 'hrd@suksesmandiri.com',
                'billing_phone'      => '0857-1234-5678',
                'billing_address'    => 'Jl. Ahmad Yani No. 22, Bandar Lampung',
                'payment_preference' => 'online',

                'advertiser_name'    => 'CV Sukses Mandiri',
                'advertiser_contact' => 'hrd@suksesmandiri.com',
            ],

            [
                'invoice_number'     => 'INV-' . date('Ymd') . '-A004',
                'created_by'         => $admin->id,
                'placement_type'     => 'online',
                'category'           => 'Ragam',
                'subcategory'        => 'Jasa',
                'ad_title'           => 'Jasa Service AC Panggilan 24 Jam',
                'ad_format'          => 'sidebar',
                'ad_text'            => null,
                'ad_start_date'      => now()->addDays(1),
                'ad_duration_days'   => 7,
                'ad_slot'            => 'sidebar',
                'amount'             => 300000 + (15000 * 7),
                'description'        => 'Jasa Service AC Panggilan 24 Jam',
                'status'             => 'draft',
                'due_date'           => now()->addDays(14),

                'billing_name'       => null,
                'billing_email'      => null,
                'billing_phone'      => null,
                'payment_preference' => null,

                'advertiser_name'    => 'Jasa Service AC Panggilan',
                'advertiser_contact' => '-',
            ],

            [
                'invoice_number'     => 'INV-' . date('Ymd') . '-A005',
                'created_by'         => $admin->id,
                'placement_type'     => 'offline',
                'category'           => 'Kemitraan',
                'subcategory'        => 'Franchise / Waralaba',
                'ad_title'           => 'Peluang Waralaba Kopi Kekinian',
                'ad_format'          => 'kolom',
                'ad_text'            => 'Investasi waralaba kopi mulai Rp 50 juta. BEP cepat, support penuh dari pusat. Info: 0813-1111-2222',
                'ad_start_date'      => now()->subDays(10),
                'ad_duration_days'   => 5,
                'ad_slot'            => 'kolom',
                'amount'             => 150000 + (5000 * 5),
                'description'        => 'Peluang Waralaba Kopi Kekinian',
                'status'             => 'expired',
                'due_date'           => now()->subDays(3),

                'billing_name'       => 'Kopi Nusantara',
                'billing_npwp_nik'   => '04.567.890.1-234.000',
                'billing_email'      => 'franchise@kopinusantara.id',
                'billing_phone'      => '0813-1111-2222',
                'billing_address'    => 'Jl. Pahlawan No. 15, Bandar Lampung',
                'payment_preference' => 'online',

                'advertiser_name'    => 'Kopi Nusantara',
                'advertiser_contact' => 'franchise@kopinusantara.id',

                'signature_data'     => $demoSignature,
                'signed_at'          => now()->subDays(8),
                'signed_by_name'     => 'Rina Sari',
                'signed_ip'          => '127.0.0.1',
            ],
        ];

        foreach ($invoices as $data) {
            Invoice::create($data);
        }

        $this->command->info('✅ ' . count($invoices) . ' invoice demo berhasil dibuat.');
        $this->command->info('   - 2 Online (1 unpaid, 1 paid)');
        $this->command->info('   - 2 Offline (1 unpaid, 1 expired)');
        $this->command->info('   - 1 Draft (parsial)');
    }
}