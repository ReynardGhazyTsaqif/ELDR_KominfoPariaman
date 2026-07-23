<?php

use App\Models\User;
use App\Models\PengajuanDokumen;
use App\Services\DocumentSubmissionService;
use Database\Seeders\RoleAndPermissionSeeder;
use Database\Seeders\MasterDataSeeder;
use Database\Seeders\DateDimensionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RoleAndPermissionSeeder::class);
    $this->seed(MasterDataSeeder::class);
    $this->seed(DateDimensionSeeder::class);
});

test('B.6: Query count is optimized on document repository index page (N+1 Check)', function () {
    $submissionService = app(DocumentSubmissionService::class);

    $opdUser = User::create([
        'name' => 'User OPD Perf',
        'username' => '199001012015011088',
        'email' => 'opdperf@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    // Create 25 dummy documents
    for ($i = 1; $i <= 25; $i++) {
        $submissionService->submit($opdUser, "Dokumen Dummy $i", "file_$i.docx", 1, "Perihal Dummy $i");
    }

    $this->actingAs($opdUser);

    DB::enableQueryLog();

    $response = $this->get(route('documents.index'));
    $response->assertStatus(200);

    $queryLog = DB::getQueryLog();
    $queryCount = count($queryLog);

    // Ensure total queries executed for 25 items is less than 15 queries (no N+1 loops per document row)
    expect($queryCount)->toBeLessThan(15);
});
