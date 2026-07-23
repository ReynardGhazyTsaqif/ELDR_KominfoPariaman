<?php

namespace App\Observers;

use App\Models\PengajuanDokumen;
use App\Models\DashboardFact;
use Illuminate\Support\Facades\DB;

class PengajuanDokumenObserver
{
    /**
     * Handle the PengajuanDokumen "created" event.
     */
    public function created(PengajuanDokumen $pengajuan): void
    {
        $this->syncDashboardFact($pengajuan);
    }

    /**
     * Handle the PengajuanDokumen "updated" event.
     */
    public function updated(PengajuanDokumen $pengajuan): void
    {
        $this->syncDashboardFact($pengajuan);
    }

    protected function syncDashboardFact(PengajuanDokumen $pengajuan): void
    {
        if (!$pengajuan->tanggal_pengajuan_key) {
            return;
        }

        $count = DB::table('ff_pengajuan_dokumen')
            ->where('status_pengajuan_key', $pengajuan->status_pengajuan_key)
            ->where('jenis_dokumen_key', $pengajuan->jenis_dokumen_key)
            ->where('tanggal_pengajuan_key', $pengajuan->tanggal_pengajuan_key)
            ->count();

        DashboardFact::updateOrCreate(
            [
                'status_pengajuan_key' => $pengajuan->status_pengajuan_key,
                'jenis_dokumen_key' => $pengajuan->jenis_dokumen_key,
                'tanggal_pengajuan_key' => $pengajuan->tanggal_pengajuan_key,
            ],
            [
                'total_dokumen_pengajuan' => $count,
            ]
        );
    }
}
