<?php

use App\Models\User;
use App\Models\Desa;
use App\Models\Masyarakat;
use App\Models\JenisDokumen;
use App\Models\StatusDokumen;
use App\Models\StatusPengajuan;
use App\Models\Pegawai;
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

test('Super Admin Modules: Access blocked (403) for non-super_admin roles', function () {
    $opdUser = User::create([
        'name' => 'User OPD Test',
        'username' => '199001012015011001',
        'email' => 'opdtest@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    $this->actingAs($opdUser);

    // Test access blocked to all super_admin endpoints
    $this->get(route('users.index'))->assertStatus(403);
    $this->get(route('master.desa'))->assertStatus(403);
    $this->get(route('master.staf'))->assertStatus(403);
    $this->get(route('master.jenis'))->assertStatus(403);
    $this->get(route('master.status'))->assertStatus(403);

    $this->post(route('users.store'), [
        'name' => 'Unauthorized User',
        'username' => '199001012015011002',
        'email' => 'unauth@pariamankota.go.id',
        'password' => 'password123',
        'role' => 'admin_opd',
    ])->assertStatus(403);
});

test('Module A (Users): super_admin can create, update, toggle status, and destroy unused user', function () {
    $superAdmin = User::create([
        'name' => 'Super Admin Test',
        'username' => 'superadmin_test',
        'email' => 'superadmin@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $superAdmin->assignRole('super_admin');

    $this->actingAs($superAdmin);

    // 1. Create User
    $response = $this->post(route('users.store'), [
        'name' => 'Staf OPD Baru',
        'username' => '199501012020011005',
        'email' => 'opdbaru@pariamankota.go.id',
        'password' => 'password123',
        'role' => 'admin_opd',
        'tipe_login' => 'pegawai',
    ]);

    $response->assertRedirect(route('users.index'));
    $response->assertSessionHas('success');

    $createdUser = User::where('username', '199501012020011005')->first();
    expect($createdUser)->not->toBeNull();
    expect($createdUser->subjek_key)->not->toBeNull();
    expect($createdUser->hasRole('admin_opd'))->toBeTrue();

    // 2. Update User
    $updateResponse = $this->put(route('users.update', ['id' => $createdUser->id]), [
        'name' => 'Staf OPD Updated',
        'username' => '199501012020011005',
        'email' => 'opdbaru_updated@pariamankota.go.id',
        'role' => 'admin_hukum',
        'tipe_login' => 'pegawai',
    ]);

    $updateResponse->assertRedirect(route('users.index'));
    $createdUser->refresh();
    expect($createdUser->name)->toBe('Staf OPD Updated');
    expect($createdUser->hasRole('admin_hukum'))->toBeTrue();

    // 3. Toggle Status (Deactivate)
    $toggleResponse = $this->post(route('users.toggleStatus', ['id' => $createdUser->id]));
    $toggleResponse->assertRedirect(route('users.index'));
    $createdUser->refresh();
    expect($createdUser->is_active)->toBeFalse();

    // 4. Delete Unused User -> Success
    $deleteResponse = $this->delete(route('users.destroy', ['id' => $createdUser->id]));
    $deleteResponse->assertRedirect(route('users.index'));
    $deleteResponse->assertSessionHas('success');
    expect(User::find($createdUser->id))->toBeNull();
});

test('Module A (Users): destroy is blocked for user with document history', function () {
    $superAdmin = User::create([
        'name' => 'Super Admin Test',
        'username' => 'superadmin_test',
        'email' => 'superadmin@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $superAdmin->assignRole('super_admin');

    $opdUser = User::create([
        'name' => 'User OPD History Test',
        'username' => '199001012015011999',
        'email' => 'history@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    $submissionService = app(DocumentSubmissionService::class);
    $submissionService->submit($opdUser, 'Ranperda User Delete Test', 'file_user.docx', 1, 'Perihal User Delete');

    $this->actingAs($superAdmin);

    $opdUser->refresh();

    $deleteResponse = $this->delete(route('users.destroy', ['id' => $opdUser->id]));
    $deleteResponse->assertRedirect(route('users.index'));
    $deleteResponse->assertSessionHas('error');
    expect(User::find($opdUser->id))->not->toBeNull();
});

test('Module B (Master Desa): super_admin can create, update, toggle status, and destroy unused desa', function () {
    $superAdmin = User::create([
        'name' => 'Super Admin Test',
        'username' => 'superadmin_test',
        'email' => 'superadmin@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $superAdmin->assignRole('super_admin');

    $this->actingAs($superAdmin);

    // 1. Create Desa
    $response = $this->post(route('master.desa.store'), [
        'desa_kode' => '1377012099',
        'desa_nama' => 'Desa Baru Test',
    ]);

    $response->assertRedirect(route('master.desa'));
    $desa = Desa::where('desa_kode', '1377012099')->first();
    expect($desa)->not->toBeNull();
    expect($desa->f_status)->toBe('1');

    // 2. Update Desa
    $updateResponse = $this->put(route('master.desa.update', ['id' => $desa->desa_key]), [
        'desa_kode' => '1377012099',
        'desa_nama' => 'Desa Baru Updated',
    ]);

    $updateResponse->assertRedirect(route('master.desa'));
    $desa->refresh();
    expect($desa->desa_nama)->toBe('Desa Baru Updated');

    // 3. Toggle Status
    $toggleResponse = $this->post(route('master.desa.toggleStatus', ['id' => $desa->desa_key]));
    $toggleResponse->assertRedirect(route('master.desa'));
    $desa->refresh();
    expect($desa->f_status)->toBe('0');

    // 4. Destroy Unused Desa -> Success
    $destroyResponse = $this->delete(route('master.desa.destroy', ['id' => $desa->desa_key]));
    $destroyResponse->assertRedirect(route('master.desa'));
    $destroyResponse->assertSessionHas('success');
    expect(Desa::find($desa->desa_key))->toBeNull();
});

test('Module C (Master Staf): super_admin can create, update, and destroy unused staf', function () {
    $superAdmin = User::create([
        'name' => 'Super Admin Test',
        'username' => 'superadmin_test',
        'email' => 'superadmin@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $superAdmin->assignRole('super_admin');

    $desa = Desa::create([
        'desa_kode' => '1377012001',
        'desa_nama' => 'Desa Ampalu',
        'f_status' => '1',
    ]);

    $this->actingAs($superAdmin);

    // 1. Create Staf
    $response = $this->post(route('master.staf.store'), [
        'nik' => '1377010101900001',
        'nama_masyarakat' => 'Staf Desa Ampalu',
        'desa_key' => $desa->desa_key,
    ]);

    $response->assertRedirect(route('master.staf'));
    $staf = Masyarakat::where('nik', '1377010101900001')->first();
    expect($staf)->not->toBeNull();

    // 2. Update Staf
    $updateResponse = $this->put(route('master.staf.update', ['id' => $staf->masyarakat_key]), [
        'nik' => '1377010101900001',
        'nama_masyarakat' => 'Staf Desa Ampalu Updated',
        'desa_key' => $desa->desa_key,
    ]);

    $updateResponse->assertRedirect(route('master.staf'));
    $staf->refresh();
    expect($staf->nama_masyarakat)->toBe('Staf Desa Ampalu Updated');

    // 3. Destroy Unused Staf -> Success
    $destroyResponse = $this->delete(route('master.staf.destroy', ['id' => $staf->masyarakat_key]));
    $destroyResponse->assertRedirect(route('master.staf'));
    $destroyResponse->assertSessionHas('success');
    expect(Masyarakat::find($staf->masyarakat_key))->toBeNull();
});

test('Module D (Master Jenis Dokumen): super_admin can CRUD and FK deletion constraint is enforced', function () {
    $superAdmin = User::create([
        'name' => 'Super Admin Test',
        'username' => 'superadmin_test',
        'email' => 'superadmin@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $superAdmin->assignRole('super_admin');

    $this->actingAs($superAdmin);

    // 1. Create Jenis Dokumen
    $response = $this->post(route('master.jenis.store'), [
        'kode_jenis_dokumen' => 'K99',
        'jenis_dokumen' => 'Instruksi Khusus Test',
    ]);

    $response->assertRedirect(route('master.jenis'));
    $jenis = JenisDokumen::where('kode_jenis_dokumen', 'K99')->first();
    expect($jenis)->not->toBeNull();

    // 2. Delete Unused Jenis Dokumen -> Success
    $deleteResponse = $this->delete(route('master.jenis.destroy', ['id' => $jenis->jenis_dokumen_key]));
    $deleteResponse->assertRedirect(route('master.jenis'));
    $deleteResponse->assertSessionHas('success');
    expect(JenisDokumen::find($jenis->jenis_dokumen_key))->toBeNull();

    // 3. Test Deleting Used Jenis Dokumen -> Blocked by FK check
    $opdUser = User::create([
        'name' => 'User OPD FK Test',
        'username' => '199001012015011098',
        'email' => 'fktest@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    $submissionService = app(DocumentSubmissionService::class);
    $doc = $submissionService->submit($opdUser, 'Ranperda FK Test', 'file_fk.docx', 1, 'Perihal FK');

    $fkDeleteResponse = $this->delete(route('master.jenis.destroy', ['id' => 1]));
    $fkDeleteResponse->assertRedirect(route('master.jenis'));
    $fkDeleteResponse->assertSessionHas('error');
    expect(JenisDokumen::find(1))->not->toBeNull();
});

test('Module E (Master Status): super_admin can update status labels', function () {
    $superAdmin = User::create([
        'name' => 'Super Admin Test',
        'username' => 'superadmin_test',
        'email' => 'superadmin@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $superAdmin->assignRole('super_admin');

    $this->actingAs($superAdmin);

    // Update Dokumen Label
    $response1 = $this->put(route('master.status.updateDokumen', ['id' => 1]), [
        'status' => 'File Terkirim (Updated Label)',
    ]);
    $response1->assertRedirect(route('master.status'));
    expect(StatusDokumen::find(1)->status)->toBe('File Terkirim (Updated Label)');

    // Update Pengajuan Label
    $response2 = $this->put(route('master.status.updatePengajuan', ['id' => 1]), [
        'status' => 'Pengajuan (Updated Label)',
    ]);
    $response2->assertRedirect(route('master.status'));
    expect(StatusPengajuan::find(1)->status)->toBe('Pengajuan (Updated Label)');
});

test('Module F (Direktori Pegawai): Authenticated user can view direktori pegawai with search', function () {
    $opdUser = User::create([
        'name' => 'User OPD Directory Test',
        'username' => '199001012015011097',
        'email' => 'dirtest@pariamankota.go.id',
        'password' => bcrypt('password'),
        'tipe_login' => 'pegawai',
    ]);
    $opdUser->assignRole('admin_opd');

    Pegawai::create([
        'nip' => '198001012005011099',
        'nama_pegawai' => 'Drs. Budi Santoso, M.Si',
        'status_pegawai' => 'PNS',
    ]);

    $this->actingAs($opdUser);

    $response = $this->get(route('pegawai.index', ['search' => 'Budi']));
    $response->assertStatus(200);
    $response->assertSee('Drs. Budi Santoso, M.Si');
});
