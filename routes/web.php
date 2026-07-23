<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::redirect('/', 'login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard');

// Dokumen Workflow Routes
Route::get('dokumen', [DocumentController::class, 'index'])
    ->middleware(['auth'])
    ->name('documents.index');

Route::get('dokumen/detail/{id?}', [DocumentController::class, 'show'])
    ->middleware(['auth'])
    ->name('documents.show');

Route::get('dokumen/download/{dokumenKey}', [DocumentController::class, 'download'])
    ->middleware(['auth'])
    ->name('documents.download');

Route::get('dokumen/riwayat', [DocumentController::class, 'history'])
    ->middleware(['auth'])
    ->name('documents.history');

Route::view('dokumen/create', 'documents.create')
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.create');

Route::post('dokumen/store', [DocumentController::class, 'store'])
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.store');

Route::get('dokumen/revisi/{id?}', [DocumentController::class, 'revisionForm'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.revision');

Route::post('dokumen/revisi/{dokumenId}', [DocumentController::class, 'submitRevision'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.submitRevision');

Route::post('dokumen/teruskan-revisi/{dokumenId}', [DocumentController::class, 'forwardRevision'])
    ->middleware(['auth', 'role:admin_hukum|super_admin'])
    ->name('documents.forwardRevision');

Route::post('dokumen/kirim-ulang/{dokumenId}', [DocumentController::class, 'resubmit'])
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.resubmit');

Route::post('dokumen/approve/{dokumenId}', [DocumentController::class, 'approve'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.approve');

Route::get('dokumen/persetujuan', [DocumentController::class, 'index'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.approvals');

use App\Http\Controllers\UserController;
use App\Http\Controllers\MasterDesaController;
use App\Http\Controllers\MasterStafController;
use App\Http\Controllers\MasterJenisDokumenController;
use App\Http\Controllers\MasterStatusController;
use App\Http\Controllers\PegawaiDirectoryController;

// Super Admin Management Routes Group
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    // User Management
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Master Desa
    Route::get('master/desa', [MasterDesaController::class, 'index'])->name('master.desa');
    Route::post('master/desa', [MasterDesaController::class, 'store'])->name('master.desa.store');
    Route::put('master/desa/{id}', [MasterDesaController::class, 'update'])->name('master.desa.update');
    Route::post('master/desa/{id}/toggle-status', [MasterDesaController::class, 'toggleStatus'])->name('master.desa.toggleStatus');
    Route::delete('master/desa/{id}', [MasterDesaController::class, 'destroy'])->name('master.desa.destroy');

    // Master Staf & Masyarakat
    Route::get('master/staf', [MasterStafController::class, 'index'])->name('master.staf');
    Route::post('master/staf', [MasterStafController::class, 'store'])->name('master.staf.store');
    Route::put('master/staf/{id}', [MasterStafController::class, 'update'])->name('master.staf.update');
    Route::delete('master/staf/{id}', [MasterStafController::class, 'destroy'])->name('master.staf.destroy');

    // Master Jenis Dokumen
    Route::get('master/jenis', [MasterJenisDokumenController::class, 'index'])->name('master.jenis');
    Route::post('master/jenis', [MasterJenisDokumenController::class, 'store'])->name('master.jenis.store');
    Route::put('master/jenis/{id}', [MasterJenisDokumenController::class, 'update'])->name('master.jenis.update');
    Route::delete('master/jenis/{id}', [MasterJenisDokumenController::class, 'destroy'])->name('master.jenis.destroy');

    // Master Status (Read-only for keys, edit labels only)
    Route::get('master/status', [MasterStatusController::class, 'index'])->name('master.status');
    Route::put('master/status/dokumen/{id}', [MasterStatusController::class, 'updateDokumenLabel'])->name('master.status.updateDokumen');
    Route::put('master/status/pengajuan/{id}', [MasterStatusController::class, 'updatePengajuanLabel'])->name('master.status.updatePengajuan');
});

// Direktori Pegawai ASN (Read-Only)
// KETENTUAN ARSITEKTUR: Accessible for all authenticated internal roles (admin_opd, admin_desa, admin_hukum, kabag_hukum, super_admin)
// as a general reference directory for searching ASN details (NIP, Nama, Unit Kerja) during document drafting & verification.
Route::get('direktori-pegawai', [PegawaiDirectoryController::class, 'index'])
    ->middleware(['auth'])
    ->name('pegawai.index');
Route::get('direktori-pegawai/{id}', [PegawaiDirectoryController::class, 'show'])
    ->middleware(['auth'])
    ->name('pegawai.show');

// Error Page Routes
Route::view('error-404', 'errors.404')
    ->middleware(['auth'])
    ->name('errors.404');

Route::view('error-403', 'errors.403')
    ->middleware(['auth'])
    ->name('errors.403');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
