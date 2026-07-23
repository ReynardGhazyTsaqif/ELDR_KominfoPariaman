<?php

namespace App\Services;

use App\Models\Dokumen;
use App\Models\PerihalDokumen;
use App\Models\PengajuanDokumen;
use App\Models\User;

class DocumentSubmissionService
{
    protected SubjekService $subjekService;

    public function __construct(SubjekService $subjekService)
    {
        $this->subjekService = $subjekService;
    }

    /**
     * Pengajuan awal dokumen oleh Admin OPD / Admin Desa
     */
    public function submit(
        User $user,
        string $judulFile,
        string $namaFileFisik,
        int $jenisDokumenKey,
        string $perihalText,
        ?string $catatan = null
    ): PengajuanDokumen {
        $subjek = $this->subjekService->findOrCreateForUser($user);

        // Buat thread dokumen_id baru
        $nextDokumenId = (PengajuanDokumen::max('dokumen_id') ?? 0) + 1;

        $dokumen = Dokumen::create([
            'dokumen_judul' => $judulFile,
            'nama_file' => $namaFileFisik,
        ]);

        $perihal = PerihalDokumen::create([
            'perihal_dokumen' => $perihalText,
        ]);

        $dateKey = (int) now()->format('Ymd');

        return PengajuanDokumen::create([
            'dokumen_id' => $nextDokumenId,
            'subjek_key' => $subjek->subjek_key,
            'dokumen_key' => $dokumen->dokumen_key,
            'jenis_dokumen_key' => $jenisDokumenKey,
            'perihal_dokumen_key' => $perihal->perihal_dokumen_key,
            'catatan_dokumen' => $catatan,
            'keterangan' => 'File Terkirim',
            'status_dokumen_key' => 1,   // ST01: File Terkirim
            'status_pengajuan_key' => 1, // SP01: Pengajuan
            'tanggal_pengajuan_key' => $dateKey,
        ]);
    }

    /**
     * Permintaan revisi oleh Admin Hukum atau Kabag Hukum
     */
    public function requestRevision(
        User $user,
        int $dokumenId,
        string $catatan,
        ?string $fileRevisiFisik = null
    ): PengajuanDokumen {
        $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
            ->latest('id_fact')
            ->firstOrFail();

        $subjek = $this->subjekService->findOrCreateForUser($user);
        $dokumenKey = $latest->dokumen_key;

        if ($fileRevisiFisik) {
            $dokumenLama = Dokumen::find($latest->dokumen_key);
            $dokumenBaru = Dokumen::create([
                'dokumen_judul' => ($dokumenLama->dokumen_judul ?? 'Revisi') . ' (Revisi)',
                'nama_file' => $fileRevisiFisik,
            ]);
            $dokumenKey = $dokumenBaru->dokumen_key;
        }

        $statusDokumenKey = $fileRevisiFisik ? 4 : 3; // 4: File Revisi (Upload), 3: File Minta Diperbarui (Tanpa upload)
        $keterangan = $fileRevisiFisik ? 'File Revisi (Dengan Lampiran)' : 'File Minta Diperbarui';

        $dateKey = (int) now()->format('Ymd');

        return PengajuanDokumen::create([
            'dokumen_id' => $dokumenId,
            'subjek_key' => $subjek->subjek_key,
            'dokumen_key' => $dokumenKey,
            'jenis_dokumen_key' => $latest->jenis_dokumen_key,
            'perihal_dokumen_key' => $latest->perihal_dokumen_key,
            'catatan_dokumen' => $catatan,
            'keterangan' => $keterangan,
            'status_dokumen_key' => $statusDokumenKey,
            'status_pengajuan_key' => 3, // SP03: Ditolak / Revisi
            'tanggal_pengajuan_key' => $dateKey,
        ]);
    }

    /**
     * Kirim ulang berkas hasil perbaikan oleh pengaju
     */
    public function resubmit(
        User $user,
        int $dokumenId,
        string $judulFile,
        string $namaFileFisik,
        ?string $catatan = null
    ): PengajuanDokumen {
        $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
            ->latest('id_fact')
            ->firstOrFail();

        $subjek = $this->subjekService->findOrCreateForUser($user);

        $dokumen = Dokumen::create([
            'dokumen_judul' => $judulFile,
            'nama_file' => $namaFileFisik,
        ]);

        $dateKey = (int) now()->format('Ymd');

        return PengajuanDokumen::create([
            'dokumen_id' => $dokumenId,
            'subjek_key' => $subjek->subjek_key,
            'dokumen_key' => $dokumen->dokumen_key,
            'jenis_dokumen_key' => $latest->jenis_dokumen_key,
            'perihal_dokumen_key' => $latest->perihal_dokumen_key,
            'catatan_dokumen' => $catatan,
            'keterangan' => 'File Terkirim (Diperbaiki)',
            'status_dokumen_key' => 2,   // ST02: File Terkirim (Diperbaiki)
            'status_pengajuan_key' => 1, // SP01: Pengajuan
            'tanggal_pengajuan_key' => $dateKey,
        ]);
    }

    /**
     * Persetujuan oleh Admin Hukum -> lanjut ke Kabag
     */
    public function approveAdminHukum(User $user, int $dokumenId, ?string $catatan = null): PengajuanDokumen
    {
        $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
            ->latest('id_fact')
            ->firstOrFail();

        $subjek = $this->subjekService->findOrCreateForUser($user);
        $dateKey = (int) now()->format('Ymd');

        return PengajuanDokumen::create([
            'dokumen_id' => $dokumenId,
            'subjek_key' => $subjek->subjek_key,
            'dokumen_key' => $latest->dokumen_key,
            'jenis_dokumen_key' => $latest->jenis_dokumen_key,
            'perihal_dokumen_key' => $latest->perihal_dokumen_key,
            'catatan_dokumen' => $catatan ?? 'Setuju Admin Hukum',
            'keterangan' => 'File Disetujui Admin Hukum',
            'status_dokumen_key' => 5,   // ST05: File Disetujui Admin Hukum
            'status_pengajuan_key' => 2, // SP02: Diproses
            'tanggal_pengajuan_key' => $dateKey,
        ]);
    }

    /**
     * Persetujuan final oleh Kabag Hukum
     */
    public function approveKabagHukum(User $user, int $dokumenId, ?string $catatan = null): PengajuanDokumen
    {
        $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
            ->latest('id_fact')
            ->firstOrFail();

        $subjek = $this->subjekService->findOrCreateForUser($user);
        $dateKey = (int) now()->format('Ymd');

        return PengajuanDokumen::create([
            'dokumen_id' => $dokumenId,
            'subjek_key' => $subjek->subjek_key,
            'dokumen_key' => $latest->dokumen_key,
            'jenis_dokumen_key' => $latest->jenis_dokumen_key,
            'perihal_dokumen_key' => $latest->perihal_dokumen_key,
            'catatan_dokumen' => $catatan ?? 'Setuju Kabag Hukum (Final)',
            'keterangan' => 'File Disetujui Kabag Hukum',
            'status_dokumen_key' => 6,   // ST06: File Disetujui Kabag Hukum
            'status_pengajuan_key' => 4, // SP04: Disetujui
            'tanggal_pengajuan_key' => $dateKey,
        ]);
    }
}
