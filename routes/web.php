<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

Route::redirect('/', 'login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
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

Route::view('dokumen/persetujuan', 'documents.approvals')
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.approvals');

// Master Data Management Routes
Route::view('master/desa', 'master.desa')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.desa');

Route::view('master/staf', 'master.staf')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.staf');

Route::view('master/jenis', 'master.jenis')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.jenis');

Route::view('master/status', 'master.status')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.status');

// Direktori & Users Routes
Route::view('direktori-pegawai', 'pegawai.index')
    ->middleware(['auth'])
    ->name('pegawai.index');

Route::view('users', 'users.index')
    ->middleware(['auth', 'role:super_admin'])
    ->name('users.index');

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
