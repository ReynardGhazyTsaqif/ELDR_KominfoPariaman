<?php

namespace App\Http\Controllers;

/**
 * =========================================================================================
 * CATATAN PENTING ARSITEKTUR KONTROLLER STATUS:
 * Primary keys dan status_kode pada tabel d_status_dokumen (ST01-ST06) serta d_status_pengajuan (SP01-SP04)
 * DI-HARDCODE sebagai nilai acuan logika bisnis pada DocumentSubmissionService dan DocumentController
 * (seperti validasi skip-level approval, final-lock dokumen ST06, dsb).
 *
 * OLEH KARENA ITU:
 * 1. DILARANG membuat method create/store atau delete/destroy untuk menambah/menghapus baris status baru secara bebas.
 * 2. Form pengeditan HANYA DIZINKAN untuk mengedit kolom label/deskripsi visual ('status').
 * 3. Nilai integer primary key ('status_key') dan kode status ('status_kode') SIFATNYA READ-ONLY.
 * =========================================================================================
 */

use App\Http\Requests\UpdateStatusLabelRequest;
use App\Models\StatusDokumen;
use App\Models\StatusPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterStatusController extends Controller
{
    private function authorizeSuperAdmin(): void
    {
        $user = Auth::user();
        if (!$user || !$user->hasRole('super_admin')) {
            abort(403, 'Anda tidak memiliki hak akses sebagai Super Administrator.');
        }
    }

    public function index()
    {
        $this->authorizeSuperAdmin();

        $statusDokumenList = StatusDokumen::orderBy('status_key', 'asc')->get();
        $statusPengajuanList = StatusPengajuan::orderBy('status_key', 'asc')->get();

        return view('master.status', [
            'statusDokumenList' => $statusDokumenList,
            'statusPengajuanList' => $statusPengajuanList,
        ]);
    }

    public function updateDokumenLabel(UpdateStatusLabelRequest $request, $id)
    {
        $this->authorizeSuperAdmin();

        $statusDokumen = StatusDokumen::findOrFail($id);

        try {
            $statusDokumen->update([
                'status' => $request->status,
            ]);

            return redirect()->route('master.status')
                ->with('success', "Label status dokumen '{$statusDokumen->status_kode}' berhasil diperbarui!");
        } catch (\Exception $e) {
            return redirect()->route('master.status')
                ->with('error', 'Gagal memperbarui label status dokumen: ' . $e->getMessage());
        }
    }

    public function updatePengajuanLabel(UpdateStatusLabelRequest $request, $id)
    {
        $this->authorizeSuperAdmin();

        $statusPengajuan = StatusPengajuan::findOrFail($id);

        try {
            $statusPengajuan->update([
                'status' => $request->status,
            ]);

            return redirect()->route('master.status')
                ->with('success', "Label status pengajuan '{$statusPengajuan->status_kode}' berhasil diperbarui!");
        } catch (\Exception $e) {
            return redirect()->route('master.status')
                ->with('error', 'Gagal memperbarui label status pengajuan: ' . $e->getMessage());
        }
    }
}
