<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('dokumen', 'documents.index')
    ->middleware(['auth'])
    ->name('documents.index');

Route::view('dokumen/detail', 'documents.show')
    ->middleware(['auth'])
    ->name('documents.show');

Route::view('dokumen/create', 'documents.create')
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.create');

Route::view('dokumen/revisi', 'documents.revision')
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.revision');

Route::view('dokumen/persetujuan', 'documents.approvals')
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.approvals');

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

Route::view('direktori-pegawai', 'pegawai.index')
    ->middleware(['auth'])
    ->name('pegawai.index');

Route::view('users', 'users.index')
    ->middleware(['auth', 'role:super_admin'])
    ->name('users.index');

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
