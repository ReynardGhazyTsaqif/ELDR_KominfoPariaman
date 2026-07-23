<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\UnitKerja;

class PegawaiUnitKerjaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Unit Kerja OPD Utama Kota Pariaman
        $unitKerjaData = [
            [
                'unit_kerja_kode' => 'UK-01',
                'unit_kerja_nama' => 'Dinas Komunikasi dan Informatika (Diskominfo)',
                'unit_kerja_status' => '1',
                'satker_kode' => 'SK-01',
                'satker_nama' => 'Diskominfo Kota Pariaman',
                'satker_status' => '1',
            ],
            [
                'unit_kerja_kode' => 'UK-02',
                'unit_kerja_nama' => 'Bagian Hukum Sekretariat Daerah',
                'unit_kerja_status' => '1',
                'satker_kode' => 'SK-02',
                'satker_nama' => 'Setdako Pariaman',
                'satker_status' => '1',
            ],
            [
                'unit_kerja_kode' => 'UK-03',
                'unit_kerja_nama' => 'Dinas Pemberdayaan Masyarakat dan Desa (DPMD)',
                'unit_kerja_status' => '1',
                'satker_kode' => 'SK-03',
                'satker_nama' => 'DPMD Kota Pariaman',
                'satker_status' => '1',
            ],
            [
                'unit_kerja_kode' => 'UK-04',
                'unit_kerja_nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang (PUPR)',
                'unit_kerja_status' => '1',
                'satker_kode' => 'SK-04',
                'satker_nama' => 'PUPR Kota Pariaman',
                'satker_status' => '1',
            ],
            [
                'unit_kerja_kode' => 'UK-05',
                'unit_kerja_nama' => 'Dinas Pendidikan, Pemuda dan Olahraga',
                'unit_kerja_status' => '1',
                'satker_kode' => 'SK-05',
                'satker_nama' => 'Disdikpora Kota Pariaman',
                'satker_status' => '1',
            ],
        ];

        foreach ($unitKerjaData as $uk) {
            UnitKerja::updateOrCreate(
                ['unit_kerja_kode' => $uk['unit_kerja_kode']],
                $uk
            );
        }

        // 2. Seed Data Pegawai Sampel
        $pegawaiData = [
            [
                'pns_id' => 'PNS-001',
                'nip' => 198501012010011005,
                'nama_pegawai' => 'Budi Darmawan, S.Kom',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.Kom',
                'tempat_lahir' => 'Pariaman',
                'tanggal_lahir' => '1985-01-01',
                'alamat' => 'Jl. Merdeka No. 12, Kota Pariaman',
                'no_ktp' => 1377010101850001,
                'agama' => 'Islam',
                'tingkat_pendidikan' => 'S1',
                'jurusan_pendidikan' => 'Teknik Informatika',
                'status_pegawai' => 'PNS',
                'jenis_pegawai' => 'Staf OPD',
                'kode_unit_kerja_siasn' => 'UK-01',
            ],
            [
                'pns_id' => 'PNS-002',
                'nip' => 197805122005011002,
                'nama_pegawai' => 'Rahmat Hidayat, S.H.',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.H.',
                'tempat_lahir' => 'Pariaman',
                'tanggal_lahir' => '1978-05-12',
                'alamat' => 'Jl. Sudirman No. 45, Kota Pariaman',
                'no_ktp' => 1377011205780002,
                'agama' => 'Islam',
                'tingkat_pendidikan' => 'S1',
                'jurusan_pendidikan' => 'Ilmu Hukum',
                'status_pegawai' => 'PNS',
                'jenis_pegawai' => 'Admin Hukum',
                'kode_unit_kerja_siasn' => 'UK-02',
            ],
            [
                'pns_id' => 'PNS-003',
                'nip' => 197203151998031004,
                'nama_pegawai' => 'Drs. H. Hendra Utama, M.H.',
                'gelar_depan' => 'Drs. H.',
                'gelar_belakang' => 'M.H.',
                'tempat_lahir' => 'Padang',
                'tanggal_lahir' => '1972-03-15',
                'alamat' => 'Jl. Veteran No. 8, Kota Pariaman',
                'no_ktp' => 1377011503720003,
                'agama' => 'Islam',
                'tingkat_pendidikan' => 'S2',
                'jurusan_pendidikan' => 'Magister Hukum',
                'status_pegawai' => 'PNS',
                'jenis_pegawai' => 'Kabag Hukum',
                'kode_unit_kerja_siasn' => 'UK-02',
            ],
        ];

        foreach ($pegawaiData as $peg) {
            Pegawai::updateOrCreate(
                ['nip' => $peg['nip']],
                $peg
            );
        }
    }
}
