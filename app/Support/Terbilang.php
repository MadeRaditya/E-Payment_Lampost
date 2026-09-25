<?php

namespace App\Support;

class Terbilang
{
    private static array $bilangan = [
        '',
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas',
    ];

    public static function make(float|int|string $angka): string
    {
        $angka = abs((float) $angka);

        if ($angka < 12) {
            $hasil = self::$bilangan[(int) $angka];
        } elseif ($angka < 20) {
            $hasil = self::make($angka - 10) . ' Belas';
        } elseif ($angka < 100) {
            $hasil = self::make((int) ($angka / 10)) . ' Puluh ' . self::make(fmod($angka, 10));
        } elseif ($angka < 200) {
            $hasil = 'Seratus ' . self::make($angka - 100);
        } elseif ($angka < 1000) {
            $hasil = self::make((int) ($angka / 100)) . ' Ratus ' . self::make(fmod($angka, 100));
        } elseif ($angka < 2000) {
            $hasil = 'Seribu ' . self::make($angka - 1000);
        } elseif ($angka < 1000000) {
            $hasil = self::make((int) ($angka / 1000)) . ' Ribu ' . self::make(fmod($angka, 1000));
        } elseif ($angka < 1000000000) {
            $hasil = self::make((int) ($angka / 1000000)) . ' Juta ' . self::make(fmod($angka, 1000000));
        } elseif ($angka < 1000000000000) {
            $hasil = self::make((int) ($angka / 1000000000)) . ' Miliar ' . self::make(fmod($angka, 1000000000));
        } else {
            $hasil = self::make((int) ($angka / 1000000000000)) . ' Triliun ' . self::make(fmod($angka, 1000000000000));
        }

        return trim(preg_replace('/\s+/', ' ', $hasil));
    }

    public static function rupiah(float|int|string $angka): string
    {
        $hasil = self::make($angka);
        return $hasil ? $hasil . ' Rupiah' : 'Nol Rupiah';
    }
}
