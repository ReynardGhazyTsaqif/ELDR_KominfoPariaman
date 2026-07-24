<x-app-layout>
    @php
        $user = Auth::user();
        $subjekService = app(\App\Services\SubjekService::class);
        $userSubjek = $user ? $subjekService->findOrCreateForUser($user) : null;

        // Role-based scoping for dashboard statistics
        if ($user && ($user->hasRole('admin_opd') || $user->hasRole('admin_desa'))) {
            $opdDokumenIds = \App\Models\PengajuanDokumen::where('subjek_key', $userSubjek->subjek_key)->pluck('dokumen_id')->unique();
            $latestIds = \App\Models\PengajuanDokumen::selectRaw('MAX(id_fact) as max_id')
                ->whereIn('dokumen_id', $opdDokumenIds)
                ->groupBy('dokumen_id');
        } else {
            $latestIds = \App\Models\PengajuanDokumen::selectRaw('MAX(id_fact) as max_id')
                ->groupBy('dokumen_id');
        }

        $allLatest = \App\Models\PengajuanDokumen::with([
            'subjek', 'dokumen', 'jenisDokumen', 'perihalDokumen', 'statusDokumen', 'statusPengajuan'
        ])->whereIn('id_fact', $latestIds)->get();

        $totalCount = $allLatest->count();
        $disetujuiCount = $allLatest->filter(fn($doc) => ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3)->count();
        $diprosesCount = $allLatest->reject(fn($doc) => $doc->status_dokumen_key == 6 || in_array($doc->status_pengajuan_key, [3, 4]) || $doc->status_dokumen_key == 3)->count();
        $ditolakCount = $allLatest->filter(fn($doc) => $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3)->count();

        // 5 Dokumen Terakhir
        $recentDocuments = \App\Models\PengajuanDokumen::with([
            'subjek', 'dokumen', 'jenisDokumen', 'perihalDokumen', 'statusDokumen', 'statusPengajuan'
        ])->whereIn('id_fact', $latestIds)->orderBy('id_fact', 'desc')->take(5)->get();

        // Breakdown per Jenis Dokumen
        $jenisList = \App\Models\JenisDokumen::all();
        $jenisBreakdown = $jenisList->map(function($j) use ($allLatest) {
            $docsOfJenis = $allLatest->where('jenis_dokumen_key', $j->jenis_dokumen_key);
            return (object)[
                'nama' => $j->jenis_dokumen,
                'diproses' => $docsOfJenis->reject(fn($doc) => $doc->status_dokumen_key == 6 || in_array($doc->status_pengajuan_key, [3, 4]) || $doc->status_dokumen_key == 3)->count(),
                'revisi' => $docsOfJenis->filter(fn($doc) => $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3)->count(),
                'disetujui' => $docsOfJenis->filter(fn($doc) => ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3)->count(),
                'total' => $docsOfJenis->count(),
            ];
        });
    @endphp

    @if($user && ($user->hasRole('admin_opd') || $user->hasRole('admin_desa')))
        @include('dashboards.admin_opd')
    @elseif($user && $user->hasRole('admin_hukum'))
        @include('dashboards.admin_hukum')
    @elseif($user && $user->hasRole('kabag_hukum'))
        @include('dashboards.kabag_hukum')
    @elseif($user && $user->hasRole('super_admin'))
        @include('dashboards.super_admin')
    @else
        @include('dashboards.admin_opd')
    @endif
</x-app-layout>
