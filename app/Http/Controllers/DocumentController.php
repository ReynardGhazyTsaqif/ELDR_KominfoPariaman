<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen;
use App\Models\PengajuanDokumen;
use App\Models\JenisDokumen;
use App\Models\PerihalDokumen;
use App\Models\StatusPengajuan;
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
     * Halaman Daftar Dokumen dengan filter, pencarian, & paginasi
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jenisKey = $request->input('jenis');
        $statusKey = $request->input('status');

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

        $this->submissionService->requestRevision(
            Auth::user(),
            (int)$dokumenId,
            $catatan,
            $fileRevisiName
        );

        return redirect()->route('documents.show', ['id' => $dokumenId])
            ->with('success', 'Permintaan revisi berhasil dikirim!');
    }

    /**
     * Meneruskan revisi dari Kabag Hukum ke OPD / Desa oleh Admin Hukum (POST)
     */
    public function forwardRevision(Request $request, $dokumenId)
    {
        $catatanTambahan = $request->input('catatan_tambahan');
        $this->submissionService->forwardRevisionToOpd(Auth::user(), (int)$dokumenId, $catatanTambahan);

        return redirect()->route('documents.show', ['id' => $dokumenId])
            ->with('success', 'Permintaan revisi dari Kabag Hukum berhasil diteruskan ke OPD/Desa!');
    }

    /**
     * Action Setuju / ACC (POST)
     */
    public function approve(Request $request, $dokumenId)
    {
        $user = Auth::user();
        $catatan = $request->input('catatan', 'Disetujui');

        if ($user->hasRole('kabag_hukum')) {
            $this->submissionService->approveKabagHukum($user, (int)$dokumenId, $catatan);
        } else {
            $this->submissionService->approveAdminHukum($user, (int)$dokumenId, $catatan);
        }

        return redirect()->route('documents.show', ['id' => $dokumenId])
            ->with('success', 'Persetujuan dokumen berhasil diproses!');
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
        $request->validate([
            'judul_file' => 'required|string|max:255',
            'file_dokumen' => 'required|file|mimes:doc,docx|max:20480', // Max 20MB doc/docx
            'catatan' => 'nullable|string',
        ]);

        $file = $request->file('file_dokumen');
        $filename = time() . '_resub_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $file->storeAs('documents', $filename, 'public');

        $this->submissionService->resubmit(
            Auth::user(),
            (int)$dokumenId,
            $request->input('judul_file'),
            $filename,
            $request->input('catatan')
        );

        return redirect()->route('documents.show', ['id' => $dokumenId])
            ->with('success', 'Berkas perbaikan berhasil dikirim ulang! Status dokumen kini diperbarui.');
    }
}
