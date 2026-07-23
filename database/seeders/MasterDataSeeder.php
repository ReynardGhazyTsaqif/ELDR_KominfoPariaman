<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed D_JENIS_DOKUMEN
        $jenisDokumen = [
            ['jenis_dokumen_key' => 1, 'kode_jenis_dokumen' => 'K01', 'jenis_dokumen' => 'Perda/Perwako'],
            ['jenis_dokumen_key' => 2, 'kode_jenis_dokumen' => 'K02', 'jenis_dokumen' => 'SK/Keputusan (WALIKOTA / SEKDA)'],
            ['jenis_dokumen_key' => 3, 'kode_jenis_dokumen' => 'K03', 'jenis_dokumen' => 'Perdes/Perkades'],
        ];

        foreach ($jenisDokumen as $row) {
            DB::table('d_jenis_dokumen')->updateOrInsert(
                ['jenis_dokumen_key' => $row['jenis_dokumen_key']],
                [
                    'kode_jenis_dokumen' => $row['kode_jenis_dokumen'],
                    'jenis_dokumen' => $row['jenis_dokumen'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        // 2. Seed D_STATUS_DOKUMEN (Detail - 6 status)
        $statusDokumen = [
            ['status_key' => 1, 'status_kode' => 'ST01', 'status' => 'File Terkirim'],
            ['status_key' => 2, 'status_kode' => 'ST02', 'status' => 'File Terkirim (Diperbaiki)'],
            ['status_key' => 3, 'status_kode' => 'ST03', 'status' => 'File Minta Diperbarui'],
            ['status_key' => 4, 'status_kode' => 'ST04', 'status' => 'File Revisi'],
            ['status_key' => 5, 'status_kode' => 'ST05', 'status' => 'File Disetujui Admin Hukum'],
            ['status_key' => 6, 'status_kode' => 'ST06', 'status' => 'File Disetujui Kabag Hukum'],
        ];

        foreach ($statusDokumen as $row) {
            DB::table('d_status_dokumen')->updateOrInsert(
                ['status_key' => $row['status_key']],
                [
                    'status_kode' => $row['status_kode'],
                    'status' => $row['status'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }

        // 3. Seed D_STATUS_PENGAJUAN (Ringkas - 4 status)
        $statusPengajuan = [
            ['status_key' => 1, 'status_kode' => 'SP01', 'status' => 'Pengajuan'],
            ['status_key' => 2, 'status_kode' => 'SP02', 'status' => 'Diproses'],
            ['status_key' => 3, 'status_kode' => 'SP03', 'status' => 'Ditolak'],
            ['status_key' => 4, 'status_kode' => 'SP04', 'status' => 'Disetujui'],
        ];

        foreach ($statusPengajuan as $row) {
            DB::table('d_status_pengajuan')->updateOrInsert(
                ['status_key' => $row['status_key']],
                [
                    'status_kode' => $row['status_kode'],
                    'status' => $row['status'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}
