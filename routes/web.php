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

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
