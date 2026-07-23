<?php

use App\Models\User;
use App\Models\Desa;
use App\Models\Masyarakat;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use App\Models\Dokumen;
use App\Models\PengajuanDokumen;
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

test('Bug 1: IDOR - admin_opd A cannot access/download/resubmit document of admin_opd B', function () {
    $submissionService = app(DocumentSubmissionService::class);

    // Create User OPD A
    $userA = User::create([
        'name' => 'User OPD A',
        'username' => '199001012015011001',
        'email' => 'opda@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userA->assignRole('admin_opd');

    // Create User OPD B
    $userB = User::create([
        'name' => 'User OPD B',
        'username' => '199001012015011002',
        'email' => 'opdb@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userB->assignRole('admin_opd');

    // Submit document by OPD B
    $docB = $submissionService->submit($userB, 'Dokumen OPD B', 'file_b.docx', 1, 'Perihal B');

    // User A attempts to view, download, or resubmit User B's document
    $this->actingAs($userA);

    // 1. show()
    $responseShow = $this->get(route('documents.show', ['id' => $docB->dokumen_id]));
    $responseShow->assertStatus(403);

    // 2. download()
    $responseDownload = $this->get(route('documents.download', ['dokumenKey' => $docB->dokumen_key]));
    $responseDownload->assertStatus(403);

    // 3. resubmit()
    $file = \Illuminate\Http\UploadedFile::fake()->create('rev.docx', 100);
    $responseResubmit = $this->post(route('documents.resubmit', ['dokumenId' => $docB->dokumen_id]), [
        'judul_file' => 'Revisi B',
        'file_dokumen' => $file,
    ]);
    $responseResubmit->assertStatus(403);
});

test('Bug 2: Kabag revision row is hidden from OPD until forwarded by Admin Hukum', function () {
    $submissionService = app(DocumentSubmissionService::class);

    $userOpd = User::create([
        'name' => 'User OPD',
        'username' => '199001012015011003',
        'email' => 'opd2@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userOpd->assignRole('admin_opd');

    $adminHukum = User::create([
        'name' => 'Admin Hukum',
        'username' => '198001012005011003',
        'email' => 'adminhukum2@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $adminHukum->assignRole('admin_hukum');

    $kabagHukum = User::create([
        'name' => 'Kabag Hukum',
        'username' => '197501012000011004',
        'email' => 'kabaghukum2@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $kabagHukum->assignRole('kabag_hukum');

    // 1. OPD submits document
    $doc = $submissionService->submit($userOpd, 'Draft Perda', 'draft.docx', 1, 'Perihal');
    $dokId = $doc->dokumen_id;

    // 2. Admin Hukum approves -> status 5
    $submissionService->approveAdminHukum($adminHukum, $dokId);

    // 3. Kabag Hukum requests revision -> status 3 (unforwarded)
    $submissionService->requestRevision($kabagHukum, $dokId, 'Koreksi rahasia Kabag');

    // OPD views document detail -> should NOT see Kabag revision row
    $this->actingAs($userOpd);
    $response = $this->get(route('documents.show', ['id' => $dokId]));
    $response->assertStatus(200);
    $response->assertDontSee('Koreksi rahasia Kabag');

    // Admin Hukum forwards revision to OPD
    $this->actingAs($adminHukum);
    $submissionService->forwardRevisionToOpd($adminHukum, $dokId, 'Catatan tambahan admin');

    // OPD views document detail -> NOW sees forwarded revision note
    $this->actingAs($userOpd);
    $response2 = $this->get(route('documents.show', ['id' => $dokId]));
    $response2->assertStatus(200);
    $response2->assertSee('Koreksi rahasia Kabag');
});

test('Bug 3: Kabag cannot approve document without Admin Hukum approval (status != 5)', function () {
    $submissionService = app(DocumentSubmissionService::class);

    $userOpd = User::create([
        'name' => 'User OPD',
        'username' => '199001012015011004',
        'email' => 'opd3@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userOpd->assignRole('admin_opd');

    $kabagHukum = User::create([
        'name' => 'Kabag Hukum',
        'username' => '197501012000011005',
        'email' => 'kabaghukum3@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $kabagHukum->assignRole('kabag_hukum');

    // OPD submits document (status 1)
    $doc = $submissionService->submit($userOpd, 'Draft Perda 3', 'draft3.docx', 1, 'Perihal 3');

    // Kabag attempts to approve directly without Admin Hukum approval
    expect(function () use ($submissionService, $kabagHukum, $doc) {
        $submissionService->approveKabagHukum($kabagHukum, $doc->dokumen_id);
    })->toThrow(\Exception::class, 'Dokumen belum disetujui Admin Hukum, tidak bisa langsung diproses Kabag.');
});

test('Bug 4: Final document (ST06) cannot be modified', function () {
    $submissionService = app(DocumentSubmissionService::class);

    $userOpd = User::create([
        'name' => 'User OPD',
        'username' => '199001012015011005',
        'email' => 'opd4@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userOpd->assignRole('admin_opd');

    $adminHukum = User::create([
        'name' => 'Admin Hukum',
        'username' => '198001012005011005',
        'email' => 'adminhukum4@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $adminHukum->assignRole('admin_hukum');

    $kabagHukum = User::create([
        'name' => 'Kabag Hukum',
        'username' => '197501012000011006',
        'email' => 'kabaghukum4@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $kabagHukum->assignRole('kabag_hukum');

    // Complete workflow to status 6 (Final)
    $doc = $submissionService->submit($userOpd, 'Draft Perda Final', 'draft_final.docx', 1, 'Perihal');
    $dokId = $doc->dokumen_id;
    $submissionService->approveAdminHukum($adminHukum, $dokId);
    $submissionService->approveKabagHukum($kabagHukum, $dokId); // Now status 6

    // Attempt mutations on final document
    expect(fn() => $submissionService->requestRevision($adminHukum, $dokId, 'rev'))
        ->toThrow(\Exception::class, 'Dokumen sudah final dan tidak dapat diubah lagi.');

    expect(fn() => $submissionService->resubmit($userOpd, $dokId, 'rev.docx', 'rev.docx'))
        ->toThrow(\Exception::class, 'Dokumen sudah final dan tidak dapat diubah lagi.');

    expect(fn() => $submissionService->approveAdminHukum($adminHukum, $dokId))
        ->toThrow(\Exception::class, 'Dokumen sudah final dan tidak dapat diubah lagi.');
});

test('Bug 5: Admin Hukum cannot approve document with invalid status', function () {
    $submissionService = app(DocumentSubmissionService::class);

    $userOpd = User::create([
        'name' => 'User OPD',
        'username' => '199001012015011006',
        'email' => 'opd5@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userOpd->assignRole('admin_opd');

    $adminHukum = User::create([
        'name' => 'Admin Hukum',
        'username' => '198001012005011006',
        'email' => 'adminhukum5@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $adminHukum->assignRole('admin_hukum');

    // OPD submits document
    $doc = $submissionService->submit($userOpd, 'Draft Perda 5', 'draft5.docx', 1, 'Perihal 5');
    $dokId = $doc->dokumen_id;

    // Admin Hukum approves once -> status becomes 5
    $submissionService->approveAdminHukum($adminHukum, $dokId);

    // Admin Hukum tries to approve again via controller (when status is 5)
    $this->actingAs($adminHukum);
    $response = $this->post(route('documents.approve', ['dokumenId' => $dokId]));
    $response->assertRedirect(route('documents.show', ['id' => $dokId]));
    $response->assertSessionHas('error', 'Dokumen tidak dalam status yang dapat disetujui oleh Admin Hukum.');
});

test('Bug 6: submit() generates incremented dokumen_id within DB transaction using lockForUpdate', function () {
    $submissionService = app(DocumentSubmissionService::class);

    $userOpd = User::create([
        'name' => 'User OPD Concurrent',
        'username' => '199001012015011007',
        'email' => 'opd6@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $userOpd->assignRole('admin_opd');

    $doc1 = $submissionService->submit($userOpd, 'Dokumen 1', 'file1.docx', 1, 'Perihal 1');
    $doc2 = $submissionService->submit($userOpd, 'Dokumen 2', 'file2.docx', 1, 'Perihal 2');

    expect($doc1->dokumen_id)->toBe(1);
    expect($doc2->dokumen_id)->toBe(2);
});
