<?php

use App\Models\User;
use App\Models\Desa;
use App\Models\Masyarakat;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use App\Models\Subjek;
use App\Models\Dokumen;
use App\Models\PengajuanDokumen;
use App\Models\DashboardFact;
use App\Services\SubjekService;
use App\Services\DocumentSubmissionService;
use Database\Seeders\RoleAndPermissionSeeder;
use Database\Seeders\MasterDataSeeder;
use Database\Seeders\DateDimensionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleAndPermissionSeeder::class);
    $this->seed(MasterDataSeeder::class);
    $this->seed(DateDimensionSeeder::class);
});

test('seeders populate master data and spatie roles correctly', function () {
    $this->assertDatabaseHas('roles', ['name' => 'super_admin']);
    $this->assertDatabaseHas('roles', ['name' => 'admin_opd']);
    $this->assertDatabaseHas('roles', ['name' => 'admin_desa']);
    $this->assertDatabaseHas('roles', ['name' => 'admin_hukum']);
    $this->assertDatabaseHas('roles', ['name' => 'kabag_hukum']);

    $this->assertDatabaseHas('d_jenis_dokumen', ['jenis_dokumen_key' => 1]);
    $this->assertDatabaseHas('d_status_dokumen', ['status_key' => 6]);
    $this->assertDatabaseHas('d_status_pengajuan', ['status_key' => 4]);
    $this->assertDatabaseHas('d_date', ['date_key' => 20260723]);
});

test('subjek service auto-generates d_subjek for pegawai and masyarakat', function () {
    // 1. User Pegawai
    $pegawai = Pegawai::create([
        'nip' => '199001012015011001',
        'nama_pegawai' => 'Ahmad Pegawai',
    ]);
    $unitKerja = UnitKerja::create([
        'unit_kerja_nama' => 'Dinas Kominfo',
    ]);
    $pegawai->unitKerja()->attach($unitKerja->unit_kerja_key);

    $userPegawai = User::create([
        'name' => 'Ahmad Pegawai',
        'username' => '199001012015011001',
        'email' => 'pegawai@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userPegawai->assignRole('admin_opd');

    $subjekService = app(SubjekService::class);
    $subjekPegawai = $subjekService->findOrCreateForUser($userPegawai);

    expect($subjekPegawai->nama_subjek)->toBe('Ahmad Pegawai');
    expect($subjekPegawai->tipe_subjek)->toBe('Pegawai');
    expect($subjekPegawai->unit_kerja)->toBe('Dinas Kominfo');

    // 2. User Masyarakat / Staf Desa
    $desa = Desa::create(['desa_nama' => 'Desa Pariaman Utara']);
    $masyarakat = Masyarakat::create([
        'nik' => '1371010101900001',
        'nama_masyarakat' => 'Budi Staf Desa',
    ]);
    $masyarakat->desa()->attach($desa->desa_key);

    $userDesa = User::create([
        'name' => 'Budi Staf Desa',
        'username' => '1371010101900001',
        'email' => 'desa@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'masyarakat',
    ]);
    $userDesa->assignRole('admin_desa');

    $subjekDesa = $subjekService->findOrCreateForUser($userDesa);
    expect($subjekDesa->nama_subjek)->toBe('Budi Staf Desa');
    expect($subjekDesa->tipe_subjek)->toBe('Masyarakat');
    expect($subjekDesa->unit_kerja)->toBe('Desa Pariaman Utara');
});

test('full document approval lifecycle follows star schema grain and updates fa_dashboard', function () {
    $subjekService = app(SubjekService::class);
    $submissionService = app(DocumentSubmissionService::class);

    // Setup Users & Roles
    $opdUser = User::create([
        'name' => 'Pengaju OPD',
        'username' => '198501012010011002',
        'email' => 'opd@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    $adminHukum = User::create([
        'name' => 'Admin Hukum',
        'username' => '198001012005011003',
        'email' => 'adminhukum@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $adminHukum->assignRole('admin_hukum');

    $kabagHukum = User::create([
        'name' => 'Kabag Hukum',
        'username' => '197501012000011004',
        'email' => 'kabaghukum@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $kabagHukum->assignRole('kabag_hukum');

    // Step 1: Submit awal
    $p1 = $submissionService->submit(
        $opdUser,
        'Draft Ranperda 2026',
        'draft_ranperda_2026.docx',
        1, // Perda/Perwako
        'Pengajuan draft ranperda tahun 2026',
        'Mohon ditinjau'
    );

    expect($p1->status_dokumen_key)->toBe(1); // File Terkirim
    expect($p1->status_pengajuan_key)->toBe(1); // Pengajuan

    // Verify fa_dashboard aggregated
    $this->assertDatabaseHas('fa_dashboard', [
        'status_pengajuan_key' => 1,
        'jenis_dokumen_key' => 1,
        'total_dokumen_pengajuan' => 1,
    ]);

    $dokumenId = $p1->dokumen_id;

    // Step 2: Admin Hukum Minta Revisi
    $p2 = $submissionService->requestRevision(
        $adminHukum,
        $dokumenId,
        'Perbaiki pasal 4 dan 5',
        'draft_ranperda_catatan_admin.docx'
    );

    expect($p2->dokumen_id)->toBe($dokumenId);
    expect($p2->status_dokumen_key)->toBe(4); // File Revisi
    expect($p2->status_pengajuan_key)->toBe(3); // Ditolak / Minta Revisi

    // Step 3: Resubmit oleh OPD
    $p3 = $submissionService->resubmit(
        $opdUser,
        $dokumenId,
        'Draft Ranperda 2026 (Revisi 1)',
        'draft_ranperda_rev1.docx',
        'Sudah diperbaiki pasal 4 dan 5'
    );

    expect($p3->status_dokumen_key)->toBe(2); // File Terkirim (Diperbaiki)
    expect($p3->status_pengajuan_key)->toBe(1); // Pengajuan

    // Step 4: Admin Hukum Setuju -> Lanjut ke Kabag
    $p4 = $submissionService->approveAdminHukum($adminHukum, $dokumenId, 'Sudah sesuai, teruskan ke Kabag');
    expect($p4->status_dokumen_key)->toBe(5); // File Disetujui Admin Hukum
    expect($p4->status_pengajuan_key)->toBe(2); // Diproses

    // Step 5: Kabag Hukum Setuju Final
    $p5 = $submissionService->approveKabagHukum($kabagHukum, $dokumenId, 'Disetujui secara resmi');
    expect($p5->status_dokumen_key)->toBe(6); // File Disetujui Kabag Hukum
    expect($p5->status_pengajuan_key)->toBe(4); // Disetujui

    // Total history facts in thread = 5
    expect(PengajuanDokumen::where('dokumen_id', $dokumenId)->count())->toBe(5);

    // Final state of fa_dashboard for status_pengajuan_key = 4 (Disetujui)
    $this->assertDatabaseHas('fa_dashboard', [
        'status_pengajuan_key' => 4,
        'jenis_dokumen_key' => 1,
        'total_dokumen_pengajuan' => 1,
    ]);
});
