<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    /**
     * Seed Master Data Desa & Kelurahan Se-Kota Pariaman
     * Berdasarkan Kode Wilayah Kepmendagri 2025 (Kode Kota Pariaman: 13.77)
     * Sumber Rujukan: https://github.com/yonatanyl/KODE-WILAYAH-KEPMENDAGRI-2025
     */
    public function run(): void
    {
        $desaData = [
            // --- 13.77.01 : KECAMATAN PARIAMAN TENGAH ---
            ['desa_kode' => '1377011001', 'desa_nama' => 'Kelurahan Alai Gelombang'],
            ['desa_kode' => '1377011002', 'desa_nama' => 'Kelurahan Jawa I'],
            ['desa_kode' => '1377011003', 'desa_nama' => 'Kelurahan Jawa II'],
            ['desa_kode' => '1377011004', 'desa_nama' => 'Kelurahan Jawi-Jawi II'],
            ['desa_kode' => '1377011005', 'desa_nama' => 'Kelurahan Kampung Jawa I'],
            ['desa_kode' => '1377011006', 'desa_nama' => 'Kelurahan Kampung Jawa II'],
            ['desa_kode' => '1377011007', 'desa_nama' => 'Kelurahan Kampung Perak'],
            ['desa_kode' => '1377011008', 'desa_nama' => 'Kelurahan Kampung Pondok'],
            ['desa_kode' => '1377011009', 'desa_nama' => 'Kelurahan Karan Aur'],
            ['desa_kode' => '1377011010', 'desa_nama' => 'Kelurahan Lohong'],
            ['desa_kode' => '1377011011', 'desa_nama' => 'Kelurahan Pasir'],
            ['desa_kode' => '1377011012', 'desa_nama' => 'Kelurahan Pauh Barat'],
            ['desa_kode' => '1377011013', 'desa_nama' => 'Kelurahan Pauh Timur'],
            ['desa_kode' => '1377011014', 'desa_nama' => 'Kelurahan Pondok II'],
            ['desa_kode' => '1377011015', 'desa_nama' => 'Kelurahan Rawang'],
            ['desa_kode' => '1377011016', 'desa_nama' => 'Kelurahan Taratak'],
            ['desa_kode' => '1377012017', 'desa_nama' => 'Desa Air Santok'],
            ['desa_kode' => '1377012018', 'desa_nama' => 'Desa Cimparuh'],
            ['desa_kode' => '1377012019', 'desa_nama' => 'Desa Jati Mudik'],
            ['desa_kode' => '1377012020', 'desa_nama' => 'Desa Kampung Baru'],
            ['desa_kode' => '1377012021', 'desa_nama' => 'Desa Munggu II'],
            ['desa_kode' => '1377012022', 'desa_nama' => 'Desa Pauh Kurai Taji'],

            // --- 13.77.02 : KECAMATAN PARIAMAN UTARA ---
            ['desa_kode' => '1377022001', 'desa_nama' => 'Desa Ampalu'],
            ['desa_kode' => '1377022002', 'desa_nama' => 'Desa Apar'],
            ['desa_kode' => '1377022003', 'desa_nama' => 'Desa Balai Naras'],
            ['desa_kode' => '1377022004', 'desa_nama' => 'Desa Cubadak Air'],
            ['desa_kode' => '1377022005', 'desa_nama' => 'Desa Cubadak Air Selatan'],
            ['desa_kode' => '1377022006', 'desa_nama' => 'Desa Cubadak Air Utara'],
            ['desa_kode' => '1377022007', 'desa_nama' => 'Desa Mangguang'],
            ['desa_kode' => '1377022008', 'desa_nama' => 'Desa Naras I'],
            ['desa_kode' => '1377022009', 'desa_nama' => 'Desa Naras Hilir'],
            ['desa_kode' => '1377022010', 'desa_nama' => 'Desa Padang Birik-Birik'],
            ['desa_kode' => '1377022011', 'desa_nama' => 'Desa Sikapak Barat'],
            ['desa_kode' => '1377022012', 'desa_nama' => 'Desa Sikapak Timur'],
            ['desa_kode' => '1377022013', 'desa_nama' => 'Desa Sintuk'],
            ['desa_kode' => '1377022014', 'desa_nama' => 'Desa Sungai Pasak'],
            ['desa_kode' => '1377022015', 'desa_nama' => 'Desa Tanjung Sabar'],
            ['desa_kode' => '1377022016', 'desa_nama' => 'Desa Tungkal Selatan'],
            ['desa_kode' => '1377022017', 'desa_nama' => 'Desa Tungkal Utara'],

            // --- 13.77.03 : KECAMATAN PARIAMAN SELATAN ---
            ['desa_kode' => '1377032001', 'desa_nama' => 'Desa Balai Kurai Taji'],
            ['desa_kode' => '1377032002', 'desa_nama' => 'Desa Batang Tajabut'],
            ['desa_kode' => '1377032003', 'desa_nama' => 'Desa Kampung Coban'],
            ['desa_kode' => '1377032004', 'desa_nama' => 'Desa Marabau'],
            ['desa_kode' => '1377032005', 'desa_nama' => 'Desa Marunggi'],
            ['desa_kode' => '1377032006', 'desa_nama' => 'Desa Padang Sarai'],
            ['desa_kode' => '1377032007', 'desa_nama' => 'Desa Palak Aneh'],
            ['desa_kode' => '1377032008', 'desa_nama' => 'Desa Pasir Sunur'],
            ['desa_kode' => '1377032009', 'desa_nama' => 'Desa Pauh Barat (Selatan)'],
            ['desa_kode' => '1377032010', 'desa_nama' => 'Desa Pungkat'],
            ['desa_kode' => '1377032011', 'desa_nama' => 'Desa Rambai'],
            ['desa_kode' => '1377032012', 'desa_nama' => 'Desa Sikabu'],
            ['desa_kode' => '1377032013', 'desa_nama' => 'Desa Simpang'],
            ['desa_kode' => '1377032014', 'desa_nama' => 'Desa Sunur'],
            ['desa_kode' => '1377032015', 'desa_nama' => 'Desa Taluak'],
            ['desa_kode' => '1377032016', 'desa_nama' => 'Desa Toboh Palabah'],

            // --- 13.77.04 : KECAMATAN PARIAMAN TIMUR ---
            ['desa_kode' => '1377042001', 'desa_nama' => 'Desa Batang Kabung'],
            ['desa_kode' => '1377042002', 'desa_nama' => 'Desa Bungo Tanjung'],
            ['desa_kode' => '1377042003', 'desa_nama' => 'Desa Cubadak Mentawa'],
            ['desa_kode' => '1377042004', 'desa_nama' => 'Desa Kajai'],
            ['desa_kode' => '1377042005', 'desa_nama' => 'Desa Kampung Kandang'],
            ['desa_kode' => '1377042006', 'desa_nama' => 'Desa Kampung Tangah'],
            ['desa_kode' => '1377042007', 'desa_nama' => 'Desa Kapa Surondang'],
            ['desa_kode' => '1377042008', 'desa_nama' => 'Desa Koto Marapak'],
            ['desa_kode' => '1377042009', 'desa_nama' => 'Desa Padang Sago'],
            ['desa_kode' => '1377042010', 'desa_nama' => 'Desa Pakasai'],
            ['desa_kode' => '1377042011', 'desa_nama' => 'Desa Seberang Giri'],
            ['desa_kode' => '1377042012', 'desa_nama' => 'Desa Sungai Sirah'],
            ['desa_kode' => '1377042013', 'desa_nama' => 'Desa Talago Sarik'],
            ['desa_kode' => '1377042014', 'desa_nama' => 'Desa Tanjung Aur'],
            ['desa_kode' => '1377042015', 'desa_nama' => 'Desa Sungai Geringging'],
            ['desa_kode' => '1377042016', 'desa_nama' => 'Desa Air Santok (Timur)'],
        ];

        foreach ($desaData as $d) {
            Desa::updateOrCreate(
                ['desa_kode' => $d['desa_kode']],
                [
                    'desa_nama' => $d['desa_nama'],
                    'f_status' => '1',
                ]
            );
        }
    }
}
