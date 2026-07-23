<?php

namespace App\Services;

use App\Models\Dokumen;
use App\Models\PerihalDokumen;
use App\Models\PengajuanDokumen;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DocumentSubmissionService
{
    protected SubjekService $subjekService;

    public function __construct(SubjekService $subjekService)
    {
        $this->subjekService = $subjekService;
    }

    /**
     * Helper guard untuk memastikan dokumen belum berstatus final (ST06)
     */
    private function ensureNotFinal(PengajuanDokumen $latest): void
    {
        if ($latest->status_dokumen_key == 6) {
            throw new \Exception("Dokumen sudah final dan tidak dapat diubah lagi.");
        }
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
        return DB::transaction(function () use (
            $user, $judulFile, $namaFileFisik, $jenisDokumenKey, $perihalText, $catatan
        ) {
            $subjek = $this->subjekService->findOrCreateForUser($user);

            // Bug 6: Lock table row read to prevent race condition when querying MAX(dokumen_id) concurrently
            $maxDokumenId = PengajuanDokumen::lockForUpdate()->max('dokumen_id');
            $nextDokumenId = ($maxDokumenId ?? 0) + 1;

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
        });
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
        return DB::transaction(function () use ($user, $dokumenId, $catatan, $fileRevisiFisik) {
            $actorSubjek = $this->subjekService->findOrCreateForUser($user);
            $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
                ->lockForUpdate()
                ->latest('id_fact')
                ->firstOrFail();

            // Guard dokumen final
            $this->ensureNotFinal($latest);

            $dokumenKey = $latest->dokumen_key;

            if ($fileRevisiFisik) {
                $dokumenLama = Dokumen::find($latest->dokumen_key);
                $dokumenBaru = Dokumen::create([
                    'dokumen_judul' => ($dokumenLama->dokumen_judul ?? 'Revisi') . ' (Revisi)',
                    'nama_file' => $fileRevisiFisik,
                ]);
                $dokumenKey = $dokumenBaru->dokumen_key;
            }

            $dateKey = (int) now()->format('Ymd');

            // Jika dipanggil oleh Kabag Hukum -> kembalikan ke Admin Hukum dulu
            if ($user->hasRole('kabag_hukum')) {
                return PengajuanDokumen::create([
                    'dokumen_id' => $dokumenId,
                    'subjek_key' => $actorSubjek->subjek_key, // Record actor Kabag Hukum
                    'dokumen_key' => $dokumenKey,
                    'jenis_dokumen_key' => $latest->jenis_dokumen_key,
                    'perihal_dokumen_key' => $latest->perihal_dokumen_key,
                    'catatan_dokumen' => $catatan,
                    'keterangan' => 'Permintaan Revisi oleh Kabag Hukum',
                    'status_dokumen_key' => 3,   // ST03: File Minta Diperbarui
                    'status_pengajuan_key' => 2, // SP02: Diproses (Kembali ke Admin Hukum)
                    'tanggal_pengajuan_key' => $dateKey,
                ]);
            }

            // Jika dipanggil oleh Admin Hukum -> dikembalikan ke OPD/Desa
            $statusDokumenKey = $fileRevisiFisik ? 4 : 3;
            $keterangan = $fileRevisiFisik ? 'File Revisi Dikirim ke OPD (Dengan Lampiran)' : 'Revisi Dikembalikan ke OPD oleh Admin Hukum';

            return PengajuanDokumen::create([
                'dokumen_id' => $dokumenId,
                'subjek_key' => $actorSubjek->subjek_key, // Record actor Admin Hukum
                'dokumen_key' => $dokumenKey,
                'jenis_dokumen_key' => $latest->jenis_dokumen_key,
                'perihal_dokumen_key' => $latest->perihal_dokumen_key,
                'catatan_dokumen' => $catatan,
                'keterangan' => $keterangan,
                'status_dokumen_key' => $statusDokumenKey,
                'status_pengajuan_key' => 3, // SP03: Ditolak / Perlu Revisi OPD
                'tanggal_pengajuan_key' => $dateKey,
            ]);
        });
    }

    /**
     * Meneruskan revisi dari Kabag Hukum ke OPD oleh Admin Hukum
     */
    public function forwardRevisionToOpd(User $user, int $dokumenId, ?string $catatanTambahan = null): PengajuanDokumen
    {
        return DB::transaction(function () use ($user, $dokumenId, $catatanTambahan) {
            $actorSubjek = $this->subjekService->findOrCreateForUser($user);
            $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
                ->lockForUpdate()
                ->latest('id_fact')
                ->firstOrFail();

            // Guard dokumen final
            $this->ensureNotFinal($latest);

            $catatanGabungan = $latest->catatan_dokumen;
            if ($catatanTambahan) {
                $catatanGabungan .= "\n[Catatan Tambahan Admin Hukum]: " . $catatanTambahan;
            }

            $dateKey = (int) now()->format('Ymd');

            return PengajuanDokumen::create([
                'dokumen_id' => $dokumenId,
                'subjek_key' => $actorSubjek->subjek_key, // Record actor Admin Hukum
                'dokumen_key' => $latest->dokumen_key,
                'jenis_dokumen_key' => $latest->jenis_dokumen_key,
                'perihal_dokumen_key' => $latest->perihal_dokumen_key,
                'catatan_dokumen' => $catatanGabungan,
                'keterangan' => 'Revisi Diteruskan ke OPD oleh Admin Hukum',
                'status_dokumen_key' => 3,   // ST03: File Minta Diperbarui
                'status_pengajuan_key' => 3, // SP03: Ditolak / Perlu Revisi OPD
                'tanggal_pengajuan_key' => $dateKey,
            ]);
        });
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
        return DB::transaction(function () use ($user, $dokumenId, $judulFile, $namaFileFisik, $catatan) {
            $actorSubjek = $this->subjekService->findOrCreateForUser($user);
            $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
                ->lockForUpdate()
                ->latest('id_fact')
                ->firstOrFail();

            // Guard dokumen final
            $this->ensureNotFinal($latest);

            $dokumen = Dokumen::create([
                'dokumen_judul' => $judulFile,
                'nama_file' => $namaFileFisik,
            ]);

            $dateKey = (int) now()->format('Ymd');

            return PengajuanDokumen::create([
                'dokumen_id' => $dokumenId,
                'subjek_key' => $actorSubjek->subjek_key, // Record actor OPD / Desa
                'dokumen_key' => $dokumen->dokumen_key,
                'jenis_dokumen_key' => $latest->jenis_dokumen_key,
                'perihal_dokumen_key' => $latest->perihal_dokumen_key,
                'catatan_dokumen' => $catatan,
                'keterangan' => 'File Terkirim (Diperbaiki)',
                'status_dokumen_key' => 2,   // ST02: File Terkirim (Diperbaiki)
                'status_pengajuan_key' => 1, // SP01: Pengajuan
                'tanggal_pengajuan_key' => $dateKey,
            ]);
        });
    }

    /**
     * Persetujuan oleh Admin Hukum -> lanjut ke Kabag
     */
    public function approveAdminHukum(User $user, int $dokumenId, ?string $catatan = null): PengajuanDokumen
    {
        return DB::transaction(function () use ($user, $dokumenId, $catatan) {
            $actorSubjek = $this->subjekService->findOrCreateForUser($user);
            $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
                ->lockForUpdate()
                ->latest('id_fact')
                ->firstOrFail();

            // Guard dokumen final
            $this->ensureNotFinal($latest);

            // Guard check-then-act: cegah double approve jika sudah disetujui sebelumnya
            if (in_array($latest->status_dokumen_key, [5, 6])) {
                throw new \Exception("Dokumen sudah disetujui sebelumnya.");
            }

            $dateKey = (int) now()->format('Ymd');

            return PengajuanDokumen::create([
                'dokumen_id' => $dokumenId,
                'subjek_key' => $actorSubjek->subjek_key, // Record actor Admin Hukum
                'dokumen_key' => $latest->dokumen_key,
                'jenis_dokumen_key' => $latest->jenis_dokumen_key,
                'perihal_dokumen_key' => $latest->perihal_dokumen_key,
                'catatan_dokumen' => $catatan ?? 'Setuju Admin Hukum',
                'keterangan' => 'File Disetujui Admin Hukum',
                'status_dokumen_key' => 5,   // ST05: File Disetujui Admin Hukum
                'status_pengajuan_key' => 2, // SP02: Diproses
                'tanggal_pengajuan_key' => $dateKey,
            ]);
        });
    }

    /**
     * Persetujuan final oleh Kabag Hukum
     */
    public function approveKabagHukum(User $user, int $dokumenId, ?string $catatan = null): PengajuanDokumen
    {
        return DB::transaction(function () use ($user, $dokumenId, $catatan) {
            $actorSubjek = $this->subjekService->findOrCreateForUser($user);
            $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
                ->lockForUpdate()
                ->latest('id_fact')
                ->firstOrFail();

            // Guard dokumen final
            $this->ensureNotFinal($latest);

            // Validasi status dokumen harus 5 (File Disetujui Admin Hukum)
            if ($latest->status_dokumen_key != 5) {
                throw new \Exception("Dokumen belum disetujui Admin Hukum, tidak bisa langsung diproses Kabag.");
            }

            $dateKey = (int) now()->format('Ymd');

            return PengajuanDokumen::create([
                'dokumen_id' => $dokumenId,
                'subjek_key' => $actorSubjek->subjek_key, // Record actor Kabag Hukum
                'dokumen_key' => $latest->dokumen_key,
                'jenis_dokumen_key' => $latest->jenis_dokumen_key,
                'perihal_dokumen_key' => $latest->perihal_dokumen_key,
                'catatan_dokumen' => $catatan ?? 'Setuju Kabag Hukum (Final)',
                'keterangan' => 'File Disetujui Kabag Hukum',
                'status_dokumen_key' => 6,   // ST06: File Disetujui Kabag Hukum
                'status_pengajuan_key' => 4, // SP04: Disetujui
                'tanggal_pengajuan_key' => $dateKey,
            ]);
        });
    }
}

