<?php

use App\Models\User;
use App\Models\PengajuanDokumen;
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

test('B.5: Full End-to-End Approval Lifecycle Verification', function () {
    $submissionService = app(DocumentSubmissionService::class);

    // 1. Setup Users & Roles
    $opdUser = User::create([
        'name' => 'Pengaju OPD E2E',
        'username' => '198501012010011099',
        'email' => 'opde2e@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    $adminHukum = User::create([
        'name' => 'Admin Hukum E2E',
        'username' => '198001012005011099',
        'email' => 'adminhukume2e@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $adminHukum->assignRole('admin_hukum');

    $kabagHukum = User::create([
        'name' => 'Kabag Hukum E2E',
        'username' => '197501012000011099',
        'email' => 'kabaghukume2e@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $kabagHukum->assignRole('kabag_hukum');

    // Step 1: Submit (OPD)
    $f1 = $submissionService->submit($opdUser, 'Ranperda E2E', 'ranperda_e2e.docx', 1, 'Perihal E2E');
    $dokId = $f1->dokumen_id;
    expect($f1->status_dokumen_key)->toBe(1); // ST01: File Terkirim
    expect($f1->status_pengajuan_key)->toBe(1); // SP01: Pengajuan

    // Step 2: Approve (Admin Hukum) -> ST05 / SP02
    $f2 = $submissionService->approveAdminHukum($adminHukum, $dokId, 'Acc Admin Hukum');
    expect($f2->status_dokumen_key)->toBe(5); // ST05: File Disetujui Admin Hukum
    expect($f2->status_pengajuan_key)->toBe(2); // SP02: Diproses

    // Step 3: Revisi (Kabag) -> ST03 / SP02
    $f3 = $submissionService->requestRevision($kabagHukum, $dokId, 'Revisi pasal 2');
    expect($f3->status_dokumen_key)->toBe(3); // ST03: File Minta Diperbarui
    expect($f3->status_pengajuan_key)->toBe(2); // SP02: Diproses (kembali ke Admin)

    // Step 4: Teruskan ke OPD (Admin Hukum) -> ST03 / SP03
    $f4 = $submissionService->forwardRevisionToOpd($adminHukum, $dokId, 'Tambahan admin');
    expect($f4->status_dokumen_key)->toBe(3); // ST03: File Minta Diperbarui
    expect($f4->status_pengajuan_key)->toBe(3); // SP03: Ditolak / Perlu Revisi OPD

    // Step 5: Kirim ulang (OPD) -> ST02 / SP01
    $f5 = $submissionService->resubmit($opdUser, $dokId, 'Ranperda E2E Rev1', 'ranperda_e2e_rev1.docx', 'Perbaikan pasal 2');
    expect($f5->status_dokumen_key)->toBe(2); // ST02: File Terkirim (Diperbaiki)
    expect($f5->status_pengajuan_key)->toBe(1); // SP01: Pengajuan

    // Step 6: Approve (Admin Hukum) -> ST05 / SP02
    $f6 = $submissionService->approveAdminHukum($adminHukum, $dokId, 'Acc Admin Hukum Rev1');
    expect($f6->status_dokumen_key)->toBe(5); // ST05: File Disetujui Admin Hukum
    expect($f6->status_pengajuan_key)->toBe(2); // SP02: Diproses

    // Step 7: Approve (Kabag, Final) -> ST06 / SP04
    $f7 = $submissionService->approveKabagHukum($kabagHukum, $dokId, 'Acc Final Kabag');
    expect($f7->status_dokumen_key)->toBe(6); // ST06: File Disetujui Kabag Hukum (Final)
    expect($f7->status_pengajuan_key)->toBe(4); // SP04: Disetujui

    // Verify history grain count = exactly 7 rows in ff_pengajuan_dokumen for this thread
    $historyCount = PengajuanDokumen::where('dokumen_id', $dokId)->count();
    expect($historyCount)->toBe(7);
});
