<?php

return [
    'placement_types' => [
        'online' => [
            'name'        => 'Online — Portal Berita',
            'description' => 'Tayang di website lampungpost.co.id & platform digital',
            'icon'        => 'globe',
            'color'       => 'blue',
        ],
        'offline' => [
            'name'        => 'Offline — Koran Cetak',
            'description' => 'Tayang di surat kabar harian Lampung Post edisi cetak',
            'icon'        => 'newspaper',
            'color'       => 'amber',
        ],
    ],

    'categories' => [
        'Properti' => [
            'Rumah Dijual', 'Apartemen Dijual', 'Tanah Dijual',
            'Ruko / Kios Dijual', 'Kos & Sewa', 'Properti Lainnya',
        ],
        'Otomotif' => [
            'Mobil Dijual', 'Motor Dijual', 'Mobil Sewa',
            'Bengkel & Servis', 'Aksesoris & Sparepart', 'Otomotif Lainnya',
        ],
        'Karir & Pendidikan' => [
            'Lowongan Kerja', 'Pelatihan & Kursus', 'Freelance',
            'Beasiswa', 'Karir Lainnya',
        ],
        'Ragam' => [
            'Jasa', 'Barang & Elektronik', 'Event & Hiburan',
            'Kesehatan', 'Undangan & Ucapan', 'Ragam Lainnya',
        ],
        'Kemitraan' => [
            'Investasi', 'Franchise / Waralaba', 'Kemitraan Usaha', 'Kemitraan Lainnya',
        ],
        'Perbankan & Keuangan' => [
            'Kredit & Pinjaman', 'Asuransi', 'Investasi', 'Keuangan Lainnya',
        ],
        'Elektronik & Gadget' => [
            'Handphone & Tablet', 'Laptop & Komputer',
            'Elektronik Rumah Tangga', 'Kamera & Fotografi',
        ],
    ],

    'formats' => [
        'display_banner' => [
            'name'        => 'Display Banner',
            'placement'   => 'online',
            'size'        => '970 × 250 px',
            'base_price'  => 500000,
            'per_day'     => 30000,
            'description' => 'Banner horizontal premium di bagian atas halaman.',
        ],
        'sidebar' => [
            'name'        => 'Sidebar Banner',
            'placement'   => 'online',
            'size'        => '300 × 250 px',
            'base_price'  => 300000,
            'per_day'     => 15000,
            'description' => 'Tampil di kolom kanan seluruh halaman artikel.',
        ],
        'in_article' => [
            'name'        => 'In-Article Banner',
            'placement'   => 'online',
            'size'        => '728 × 90 px',
            'base_price'  => 400000,
            'per_day'     => 20000,
            'description' => 'Disisipkan di tengah isi berita saat pembaca fokus.',
        ],
        'footer' => [
            'name'        => 'Footer Banner',
            'placement'   => 'online',
            'size'        => '970 × 90 px',
            'base_price'  => 250000,
            'per_day'     => 10000,
            'description' => 'Banner di bagian bawah seluruh halaman.',
        ],

        'half_page' => [
            'name'        => 'Setengah Halaman Koran',
            'placement'   => 'offline',
            'size'        => 'Half Page',
            'base_price'  => 800000,
            'per_day'     => 25000,
            'description' => 'Iklan menempati setengah halaman koran cetak.',
        ],
        'quarter_page' => [
            'name'        => 'Seperempat Halaman Koran',
            'placement'   => 'offline',
            'size'        => 'Quarter Page',
            'base_price'  => 500000,
            'per_day'     => 15000,
            'description' => 'Iklan menempati seperempat halaman koran cetak.',
        ],
        'full_page' => [
            'name'        => 'Halaman Penuh Koran',
            'placement'   => 'offline',
            'size'        => 'Full Page',
            'base_price'  => 1500000,
            'per_day'     => 50000,
            'description' => 'Iklan satu halaman penuh di koran cetak.',
        ],
        'advertorial' => [
            'name'        => 'Advertorial (Artikel Berbayar)',
            'placement'   => 'offline',
            'size'        => 'Artikel + Foto',
            'base_price'  => 1000000,
            'per_day'     => 20000,
            'description' => 'Artikel berbentuk berita yang memuat pesan iklan.',
        ],
        'kolom' => [
            'name'        => 'Iklan Kolom / Baris',
            'placement'   => 'offline',
            'size'        => '1 Kolom × 5 Baris',
            'base_price'  => 150000,
            'per_day'     => 5000,
            'description' => 'Iklan baris klasik untuk promosi singkat.',
        ],
    ],
];