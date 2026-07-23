<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Masyarakat;
use App\Models\UnitKerja;
use App\Models\Desa;
use App\Services\SubjekService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed initial user accounts for all 5 roles.
     */
    public function run(): void
    {
        $subjekService = app(SubjekService::class);

        // 1. Super Admin
        $superAdmin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Super Administrator',
                'email' => 'admin@pariamankota.go.id',
                'password' => Hash::make('password'),
                'tipe_login' => 'pegawai',
                'is_active' => true,
            ]
        );
        $superAdmin->assignRole('super_admin');

        // 2. Admin OPD
        $pegawaiOpd = Pegawai::firstOrCreate(
            ['nip' => '199001012015011001'],
            ['nama_pegawai' => 'Admin Kominfo (OPD)']
        );
        $unitKerjaOpd = UnitKerja::firstOrCreate(['unit_kerja_nama' => 'Dinas Kominfo']);
        $pegawaiOpd->unitKerja()->syncWithoutDetaching([$unitKerjaOpd->unit_kerja_key]);

        $adminOpd = User::firstOrCreate(
            ['username' => '199001012015011001'],
            [
                'name' => 'Admin Dinas Kominfo',
                'email' => 'opd@pariamankota.go.id',
                'password' => Hash::make('password'),
                'tipe_login' => 'pegawai',
                'is_active' => true,
            ]
        );
        $adminOpd->assignRole('admin_opd');
        $subjekService->findOrCreateForUser($adminOpd);

        // 3. Admin Desa
        $desa = Desa::firstOrCreate(['desa_nama' => 'Desa Pariaman Utara']);
        $masyarakat = Masyarakat::firstOrCreate(
            ['nik' => '1371010101900001'],
            ['nama_masyarakat' => 'Staf Desa Pariaman Utara']
        );
        $masyarakat->desa()->syncWithoutDetaching([$desa->desa_key]);

        $adminDesa = User::firstOrCreate(
            ['username' => '1371010101900001'],
            [
                'name' => 'Staf Desa Pariaman Utara',
                'email' => 'desa@pariamankota.go.id',
                'password' => Hash::make('password'),
                'tipe_login' => 'masyarakat',
                'is_active' => true,
            ]
        );
        $adminDesa->assignRole('admin_desa');
        $subjekService->findOrCreateForUser($adminDesa);

        // 4. Admin Hukum
        $pegawaiHukum = Pegawai::firstOrCreate(
            ['nip' => '198001012005011003'],
            ['nama_pegawai' => 'Tim Admin Hukum']
        );
        $unitKerjaHukum = UnitKerja::firstOrCreate(['unit_kerja_nama' => 'Bagian Hukum Setdako']);
        $pegawaiHukum->unitKerja()->syncWithoutDetaching([$unitKerjaHukum->unit_kerja_key]);

        $adminHukum = User::firstOrCreate(
            ['username' => '198001012005011003'],
            [
                'name' => 'Tim Admin Hukum',
                'email' => 'hukum@pariamankota.go.id',
                'password' => Hash::make('password'),
                'tipe_login' => 'pegawai',
                'is_active' => true,
            ]
        );
        $adminHukum->assignRole('admin_hukum');
        $subjekService->findOrCreateForUser($adminHukum);

        // 5. Kabag Hukum
        $pegawaiKabag = Pegawai::firstOrCreate(
            ['nip' => '197501012000011004'],
            ['nama_pegawai' => 'Kepala Bagian Hukum']
        );
        $pegawaiKabag->unitKerja()->syncWithoutDetaching([$unitKerjaHukum->unit_kerja_key]);

        $kabagHukum = User::firstOrCreate(
            ['username' => '197501012000011004'],
            [
                'name' => 'Kepala Bagian Hukum',
                'email' => 'kabag@pariamankota.go.id',
                'password' => Hash::make('password'),
                'tipe_login' => 'pegawai',
                'is_active' => true,
            ]
        );
        $kabagHukum->assignRole('kabag_hukum');
        $subjekService->findOrCreateForUser($kabagHukum);
    }
}
