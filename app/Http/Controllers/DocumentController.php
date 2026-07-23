<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen;
use App\Models\PengajuanDokumen;
use App\Models\JenisDokumen;
use App\Models\PerihalDokumen;
use App\Models\StatusPengajuan;
use App\Models\User;
use App\Services\DocumentSubmissionService;
use App\Services\SubjekService;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    protected DocumentSubmissionService $submissionService;

    public function __construct(DocumentSubmissionService $submissionService)
    {
        $this->submissionService = $submissionService;
    }

    /**
     * Verifikasi kepemilikan dokumen untuk role admin_opd & admin_desa (IDOR protection)
     */
    private function isAuthorizedForDocument(User $user, int $dokumenId): bool
    {
        if ($user->hasRole(['admin_hukum', 'kabag_hukum', 'super_admin'])) {
            return true;
        }

        if ($user->hasRole(['admin_opd', 'admin_desa'])) {
            $subjekService = app(SubjekService::class);
            $userSubjek = $subjekService->findOrCreateForUser($user);

            $firstHistory = PengajuanDokumen::where('dokumen_id', $dokumenId)
                ->orderBy('id_fact', 'asc')
                ->first();

            if ($firstHistory && $firstHistory->subjek_key !== $userSubjek->subjek_key) {
                return false;
            }
        }

        return true;
    }

    /**
     * Halaman Daftar Dokumen dengan filter, pencarian, & paginasi (Termasuk Tab Persetujuan)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jenisKey = $request->input('jenis');
        $statusKey = $request->input('status');
        $isApprovalTab = $request->routeIs('documents.approvals') || $request->input('tab') === 'approvals';

        // Role-based scoping to get latest thread IDs for user
        $user = Auth::user();
        if ($user && ($user->hasRole('admin_opd') || $user->hasRole('admin_desa'))) {
            $subjekService = app(SubjekService::class);
            $subjek = $subjekService->findOrCreateForUser($user);
            $opdDokumenIds = PengajuanDokumen::where('subjek_key', $subjek->subjek_key)->pluck('dokumen_id')->unique();
            $latestIds = PengajuanDokumen::selectRaw('MAX(id_fact) as max_id')
                ->whereIn('dokumen_id', $opdDokumenIds)
                ->groupBy('dokumen_id');
        } else {
            $latestIds = PengajuanDokumen::selectRaw('MAX(id_fact) as max_id')
                ->groupBy('dokumen_id');
        }

        $query = PengajuanDokumen::with([
            'subjek', 
            'dokumen', 
            'jenisDokumen', 
            'perihalDokumen', 
            'statusDokumen', 
            'statusPengajuan'
        ])
        ->whereIn('id_fact', $latestIds);

        if ($isApprovalTab) {
            // Tab Persetujuan: Hanya tampilkan dokumen yang belum disetujui/selesai/dikembalikan
            $query->whereNotIn('status_dokumen_key', [5, 6, 3])
                  ->whereNotIn('status_pengajuan_key', [3, 4]);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('dokumen', function($dq) use ($search) {
                    $dq->where('dokumen_judul', 'like', "%{$search}%");
                })->orWhereHas('perihalDokumen', function($pq) use ($search) {
                    $pq->where('perihal_dokumen', 'like', "%{$search}%");
                });
            });
        }

        if ($jenisKey) {
            $query->where('jenis_dokumen_key', $jenisKey);
        }

        if ($statusKey) {
            $query->where('status_pengajuan_key', $statusKey);
        }

        $documents = $query->orderBy('id_fact', 'desc')->paginate(10)->withQueryString();

        // Hitung statistik KPI dari data fakta terbaru
        $allLatest = PengajuanDokumen::whereIn('id_fact', $latestIds)->get();
        $totalCount = $allLatest->count();
        $disetujuiCount = $allLatest->filter(function($doc) {
            return ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3;
        })->count();
        $diprosesCount = $allLatest->reject(function($doc) {
            return $doc->status_dokumen_key == 6 || in_array($doc->status_pengajuan_key, [3, 4]) || $doc->status_dokumen_key == 3;
        })->count();
        $ditolakCount = $allLatest->filter(function($doc) {
            return $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3;
        })->count();

        return view('documents.index', [
            'isApprovalTab' => $isApprovalTab,
            'documents' => $documents,
            'totalCount' => $totalCount,
            'disetujuiCount' => $disetujuiCount,
            'diprosesCount' => $diprosesCount,
            'ditolakCount' => $ditolakCount,
            'jenisList' => JenisDokumen::all(),
            'statusList' => StatusPengajuan::all(),
            'search' => $search,
            'jenisKey' => $jenisKey,
            'statusKey' => $statusKey,
        ]);
    }

    /**
     * Download file fisik dokumen
     */
    public function download($dokumenKey)
    {
        $user = Auth::user();
        if ($user && ($user->hasRole('admin_opd') || $user->hasRole('admin_desa'))) {
            $fact = PengajuanDokumen::where('dokumen_key', $dokumenKey)->orderBy('id_fact', 'asc')->first();
            if ($fact) {
                if (!$this->isAuthorizedForDocument($user, (int)$fact->dokumen_id)) {
                    abort(403, 'Anda tidak memiliki hak akses ke dokumen ini.');
                }
            }
        }

        $dokumen = Dokumen::findOrFail($dokumenKey);
        
        $downloadName = $dokumen->dokumen_judul;
        $ext = pathinfo($dokumen->nama_file, PATHINFO_EXTENSION);
        if ($ext && !str_ends_with(strtolower($downloadName), '.' . strtolower($ext))) {
            $downloadName .= '.' . $ext;
        }

        // Check disk storage path
        if (Storage::disk('public')->exists('documents/' . $dokumen->nama_file)) {
            return Storage::disk('public')->download('documents/' . $dokumen->nama_file, $downloadName);
        } elseif (Storage::exists('documents/' . $dokumen->nama_file)) {
            return Storage::download('documents/' . $dokumen->nama_file, $downloadName);
        }

        return back()->with('error', 'Berkas fisik tidak ditemukan di storage.');
    }

    /**
     * Tampilkan detail dokumen & audit trail berdasarkan dokumen_id (thread)
     */
    public function show($id)
    {
        $user = Auth::user();
        if ($user && !$this->isAuthorizedForDocument($user, (int)$id)) {
            abort(403, 'Anda tidak memiliki hak akses ke dokumen ini.');
        }

        $history = PengajuanDokumen::with([
            'subjek', 
            'dokumen', 
            'jenisDokumen', 
            'perihalDokumen', 
            'statusDokumen', 
            'statusPengajuan'
        ])
        ->where('dokumen_id', $id)
        ->orderBy('id_fact', 'asc')
        ->get();

        if ($history->isEmpty()) {
            return view('documents.show', ['history' => null, 'latest' => null]);
        }

        // Bug 2: Sembunyikan catatan revisi Kabag Hukum dari OPD/Desa jika belum diteruskan oleh Admin Hukum
        if ($user && ($user->hasRole('admin_opd') || $user->hasRole('admin_desa'))) {
            $latestItem = $history->last();
            if ($latestItem && $latestItem->status_dokumen_key == 3) {
                $actorIsKabag = false;
                if ($latestItem->subjek) {
                    $actorIsKabag = User::where('subjek_key', $latestItem->subjek_key)
                        ->get()
                        ->contains(fn($u) => $u->hasRole('kabag_hukum'));
                }
                if (!$actorIsKabag && str_contains(strtolower($latestItem->keterangan ?? ''), 'kabag')) {
                    $actorIsKabag = true;
                }

                if ($actorIsKabag) {
                    $history = $history->reject(function($item) use ($latestItem) {
                        return $item->id_fact == $latestItem->id_fact;
                    })->values();
                }
            }
        }

        $latest = $history->last();

        return view('documents.show', [
            'dokumenId' => $id,
            'history' => $history,
            'latest' => $latest,
        ]);
    }

    /**
     * Form pengajuan dokumen baru (POST)
     */
    public function store(Request $request)
    {
        // Support field names from form
        $judulFile = $request->input('judul_file') ?? $request->input('nama_file');
        $jenisKey = $request->input('jenis_dokumen_key') ?? $request->input('jenis_dokumen');

        $request->merge([
            'judul_file' => $judulFile,
            'jenis_dokumen_key' => $jenisKey,
        ]);

        $request->validate([
            'judul_file' => 'required|string|max:255',
            'jenis_dokumen_key' => 'required|integer',
            'perihal' => 'required|string',
            'file_dokumen' => 'required|file|mimes:doc,docx|max:20480', // Max 20MB doc/docx
            'catatan' => 'nullable|string',
        ]);

        $file = $request->file('file_dokumen');
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $file->storeAs('documents', $filename, 'public');

        $pengajuan = $this->submissionService->submit(
            Auth::user(),
            $judulFile,
            $filename,
            (int)$jenisKey,
            $request->input('perihal'),
            $request->input('catatan')
        );

        return redirect()->route('documents.show', ['id' => $pengajuan->dokumen_id])
            ->with('success', 'Dokumen berhasil diajukan!');
    }

    /**
     * Tampilkan form modal minta revisi untuk dokumen spesifik
     */
    public function revisionForm($id = null)
    {
        $user = Auth::user();
        if ($user && !$user->hasRole(['admin_hukum', 'kabag_hukum', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
        }

        if (!$id) {
            $latestDoc = PengajuanDokumen::orderBy('id_fact', 'desc')->first();
            $id = $latestDoc ? $latestDoc->dokumen_id : 1;
        }

        $history = PengajuanDokumen::with(['dokumen'])->where('dokumen_id', $id)->first();
        $dokumen = $history ? $history->dokumen : Dokumen::find($id);

        return view('documents.revision', [
            'dokumenId' => $id,
            'dokumen' => $dokumen,
        ]);
    }

    /**
     * Kirim permintaan revisi (POST)
     */
    public function submitRevision(Request $request, $dokumenId)
    {
        $user = Auth::user();
        if ($user && !$user->hasRole(['admin_hukum', 'kabag_hukum', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk meminta revisi.');
        }

        $catatan = $request->input('catatan_revisi') ?? $request->input('catatan') ?? 'Permintaan revisi oleh verifikator.';

        $request->validate([
            'catatan_revisi' => 'nullable|string',
            'catatan' => 'nullable|string',
            'file_revisi' => 'nullable|file|mimes:doc,docx,pdf|max:20480',
            'file_pendukung' => 'nullable|file|mimes:doc,docx,pdf|max:20480',
        ]);

        $fileRevisiName = null;
        $fileObj = $request->file('file_revisi') ?? $request->file('file_pendukung');
        if ($fileObj) {
            $fileRevisiName = time() . '_rev_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $fileObj->getClientOriginalName());
            $fileObj->storeAs('documents', $fileRevisiName, 'public');
        }

        try {
            $this->submissionService->requestRevision(
                $user,
                (int)$dokumenId,
                $catatan,
                $fileRevisiName
            );

            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('success', 'Permintaan revisi berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Meneruskan revisi dari Kabag Hukum ke OPD / Desa oleh Admin Hukum (POST)
     */
    public function forwardRevision(Request $request, $dokumenId)
    {
        $user = Auth::user();
        if ($user && !$user->hasRole(['admin_hukum', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk meneruskan revisi.');
        }

        $catatanTambahan = $request->input('catatan_tambahan');
        try {
            $this->submissionService->forwardRevisionToOpd($user, (int)$dokumenId, $catatanTambahan);

            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('success', 'Permintaan revisi dari Kabag Hukum berhasil diteruskan ke OPD/Desa!');
        } catch (\Exception $e) {
            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Action Setuju / ACC (POST)
     */
    public function approve(Request $request, $dokumenId)
    {
        $user = Auth::user();
        if ($user && !$user->hasRole(['admin_hukum', 'kabag_hukum', 'super_admin'])) {
            abort(403, 'Anda tidak memiliki hak akses untuk menyetujui dokumen.');
        }

        $catatan = $request->input('catatan', 'Disetujui');

        $latest = PengajuanDokumen::where('dokumen_id', $dokumenId)
            ->latest('id_fact')
            ->first();

        if (!$latest) {
            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('error', 'Dokumen tidak ditemukan.');
        }

        try {
            if ($user->hasRole('kabag_hukum')) {
                $this->submissionService->approveKabagHukum($user, (int)$dokumenId, $catatan);
            } else {
                // Bug 5 Guard: Status dokumen harus 1 atau 2 (baru dikirim / dikirim ulang OPD)
                if (!in_array($latest->status_dokumen_key, [1, 2])) {
                    return redirect()->route('documents.show', ['id' => $dokumenId])
                        ->with('error', 'Dokumen tidak dalam status yang dapat disetujui oleh Admin Hukum.');
                }

                $this->submissionService->approveAdminHukum($user, (int)$dokumenId, $catatan);
            }

            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('success', 'Persetujuan dokumen berhasil diproses!');
        } catch (\Exception $e) {
            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Halaman Riwayat Audit Trail Pengajuan Dokumen (OPD / Desa / Verifikator)
     */
    public function history(Request $request)
    {
        $user = Auth::user();
        $subjekService = app(SubjekService::class);
        $subjek = $subjekService->findOrCreateForUser($user);

        $query = PengajuanDokumen::with([
            'subjek',
            'dokumen', 
            'jenisDokumen', 
            'perihalDokumen', 
            'statusDokumen', 
            'statusPengajuan'
        ]);

        if ($user && ($user->hasRole('admin_opd') || $user->hasRole('admin_desa'))) {
            $opdDokumenIds = PengajuanDokumen::where('subjek_key', $subjek->subjek_key)->pluck('dokumen_id')->unique();
            $query->whereIn('dokumen_id', $opdDokumenIds);
        }

        $historyList = $query->orderBy('id_fact', 'desc')->paginate(15);

        return view('documents.history', [
            'historyList' => $historyList,
            'userSubjek' => $subjek,
        ]);
    }

    /**
     * Kirim ulang dokumen hasil revisi oleh OPD / Desa (POST)
     */
    public function resubmit(Request $request, $dokumenId)
    {
        $user = Auth::user();
        if ($user && !$this->isAuthorizedForDocument($user, (int)$dokumenId)) {
            abort(403, 'Anda tidak memiliki hak akses ke dokumen ini.');
        }

        $request->validate([
            'judul_file' => 'required|string|max:255',
            'file_dokumen' => 'required|file|mimes:doc,docx|max:20480', // Max 20MB doc/docx
            'catatan' => 'nullable|string',
        ]);

        $file = $request->file('file_dokumen');
        $filename = time() . '_resub_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $file->storeAs('documents', $filename, 'public');

        try {
            $this->submissionService->resubmit(
                $user,
                (int)$dokumenId,
                $request->input('judul_file'),
                $filename,
                $request->input('catatan')
            );

            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('success', 'Berkas perbaikan berhasil dikirim ulang! Status dokumen kini diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('documents.show', ['id' => $dokumenId])
                ->with('error', $e->getMessage());
        }
    }
}

