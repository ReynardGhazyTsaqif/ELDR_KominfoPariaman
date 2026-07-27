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

test('Section 1: 10-Step Business Flow Verification', function () {
    $submissionService = app(DocumentSubmissionService::class);

    // Setup Users & Roles
    $opdUser = User::create([
        'name' => 'Pengaju OPD Audit',
        'username' => '198501012010011999',
        'email' => 'opdaudit@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    $adminHukum = User::create([
        'name' => 'Admin Hukum Audit',
        'username' => '198001012005011999',
        'email' => 'adminhukumaudit@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $adminHukum->assignRole('admin_hukum');

    $kabagHukum = User::create([
        'name' => 'Kabag Hukum Audit',
        'username' => '197501012000011999',
        'email' => 'kabaghukumaudit@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $kabagHukum->assignRole('kabag_hukum');

    // 1.1 OPD submit dokumen baru
    $f1 = $submissionService->submit($opdUser, 'Ranperda Final Check', 'ranperda_final.docx', 1, 'Perihal Final Audit');
    $dokId = $f1->dokumen_id;
    expect($f1->status_dokumen_key)->toBe(1); // ST01
    expect($f1->status_pengajuan_key)->toBe(1); // SP01
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(1);

    // Cek antrian via Controller
    $this->actingAs($adminHukum);
    $resAdminQueue1 = $this->get(route('documents.approvals'));
    $resAdminQueue1->assertSee('Ranperda Final Check');

    $this->actingAs($kabagHukum);
    $resKabagQueue1 = $this->get(route('documents.approvals'));
    $resKabagQueue1->assertDontSee('Ranperda Final Check');

    // 1.2 Admin Hukum minta revisi (tanpa lampiran) -> balik LANGSUNG ke OPD
    $f2 = $submissionService->requestRevision($adminHukum, $dokId, 'Perbaiki Bab 1');
    expect($f2->status_dokumen_key)->toBe(3); // ST03
    expect($f2->status_pengajuan_key)->toBe(3); // SP03
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(2);

    $this->actingAs($opdUser);
    $resOpdShow1 = $this->get(route('documents.show', ['id' => $dokId]));
    $resOpdShow1->assertSee('Perbaiki Bab 1');

    // 1.3 OPD kirim ulang -> masuk antrian Admin Hukum (bukan Kabag)
    $f3 = $submissionService->resubmit($opdUser, $dokId, 'Ranperda Final Check Rev1', 'ranperda_rev1.docx', 'Sudah revisi Bab 1');
    expect($f3->status_dokumen_key)->toBe(2); // ST02
    expect($f3->status_pengajuan_key)->toBe(1); // SP01
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(3);

    $this->actingAs($adminHukum);
    $resAdminQueue2 = $this->get(route('documents.approvals'));
    $resAdminQueue2->assertSee('Ranperda Final Check Rev1');

    $this->actingAs($kabagHukum);
    $resKabagQueue2 = $this->get(route('documents.approvals'));
    $resKabagQueue2->assertDontSee('Ranperda Final Check Rev1');

    // 1.4 Admin Hukum setuju -> status ST05, pindah ke Kabag, HILANG dari Admin
    $f4 = $submissionService->approveAdminHukum($adminHukum, $dokId, 'Acc Admin Hukum Audit');
    expect($f4->status_dokumen_key)->toBe(5); // ST05
    expect($f4->status_pengajuan_key)->toBe(2); // SP02
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(4);

    $this->actingAs($kabagHukum);
    $resKabagQueue3 = $this->get(route('documents.approvals'));
    $resKabagQueue3->assertSee('Ranperda Final Check Rev1');

    $this->actingAs($adminHukum);
    $resAdminQueue3 = $this->get(route('documents.approvals'));
    $resAdminQueue3->assertDontSee('Ranperda Final Check Rev1');

    // 1.5 Kabag Hukum minta revisi -> masuk antrian Admin Hukum, OPD TIDAK BISA melihat catatan Kabag ini
    $f5 = $submissionService->requestRevision($kabagHukum, $dokId, 'Catatan Rahasia Kabag pasal 5');
    expect($f5->status_dokumen_key)->toBe(3); // ST03
    expect($f5->status_pengajuan_key)->toBe(2); // SP02
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(5);

    $this->actingAs($opdUser);
    $resOpdShow2 = $this->get(route('documents.show', ['id' => $dokId]));
    $resOpdShow2->assertDontSee('Catatan Rahasia Kabag pasal 5');

    // 1.6 OPD mencoba resubmit di tahap ini (sebelum diteruskan) -> DITOLAK
    // Note: Jika OPD mencoba resubmit, karena status_pengajuan_key masih 2 (Diproses), ini diperbolehkan atau ditolak?
    // Pada service resubmit, check: status final guard. Namun mari cek kelayakan resubmit.

    // 1.7 Admin Hukum klik "Teruskan ke OPD/Desa" -> baris fact BARU tercipta (ke-6), OPD baru bisa lihat catatan
    $f6 = $submissionService->forwardRevisionToOpd($adminHukum, $dokId, 'Tambahan admin untuk OPD');
    expect($f6->status_dokumen_key)->toBe(3); // ST03
    expect($f6->status_pengajuan_key)->toBe(3); // SP03
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(6);

    $this->actingAs($opdUser);
    $resOpdShow3 = $this->get(route('documents.show', ['id' => $dokId]));
    $resOpdShow3->assertSee('Catatan Rahasia Kabag pasal 5');

    // 1.8 OPD kirim ulang -> KEMBALI ke antrian Admin Hukum (bukan lompat ke Kabag)
    $f7 = $submissionService->resubmit($opdUser, $dokId, 'Ranperda Final Check Rev2', 'ranperda_rev2.docx', 'Sudah revisi Kabag');
    expect($f7->status_dokumen_key)->toBe(2); // ST02
    expect($f7->status_pengajuan_key)->toBe(1); // SP01
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(7);

    $this->actingAs($adminHukum);
    $resAdminQueue4 = $this->get(route('documents.approvals'));
    $resAdminQueue4->assertSee('Ranperda Final Check Rev2');

    $this->actingAs($kabagHukum);
    $resKabagQueue4 = $this->get(route('documents.approvals'));
    $resKabagQueue4->assertDontSee('Ranperda Final Check Rev2');

    // 1.9 Admin Hukum setuju lagi -> Kabag Hukum setuju final -> status ST06, dokumen FINAL
    $f8 = $submissionService->approveAdminHukum($adminHukum, $dokId, 'Acc Admin Hukum Rev2');
    expect($f8->status_dokumen_key)->toBe(5); // ST05
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(8);

    $f9 = $submissionService->approveKabagHukum($kabagHukum, $dokId, 'Acc Final Kabag Hukum');
    expect($f9->status_dokumen_key)->toBe(6); // ST06
    expect($f9->status_pengajuan_key)->toBe(4); // SP04
    expect(PengajuanDokumen::where('dokumen_id', $dokId)->count())->toBe(9);

    // Cek hilang dari semua antrian approval
    $this->actingAs($adminHukum);
    $this->get(route('documents.approvals'))->assertDontSee('Ranperda Final Check Rev2');

    $this->actingAs($kabagHukum);
    $this->get(route('documents.approvals'))->assertDontSee('Ranperda Final Check Rev2');

    // 1.10 Total baris ff_pengajuan_dokumen
    $totalRows = PengajuanDokumen::where('dokumen_id', $dokId)->count();
    expect($totalRows)->toBe(9);
});
