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

        // Role Info
        $roleName = 'Pengguna';
        if ($user->hasRole('super_admin')) $roleName = 'Super Administrator';
        elseif ($user->hasRole('kabag_hukum')) $roleName = 'Kepala Bagian Hukum';
        elseif ($user->hasRole('admin_hukum')) $roleName = 'Admin / Verifikator Bagian Hukum';
        elseif ($user->hasRole('admin_opd')) $roleName = 'Admin OPD';
        elseif ($user->hasRole('admin_desa')) $roleName = 'Staf / Admin Desa';
    @endphp

    <div class="space-y-6">
        <!-- Hero Welcome Header -->
        <div class="bg-gradient-to-r from-[#062447] via-[#0A3363] to-[#061D38] text-white rounded-2xl p-7 shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="space-y-1">
                <span class="inline-block bg-[#F5BF38] text-[#062447] font-extrabold text-[10px] uppercase px-2.5 py-0.5 rounded-md tracking-wider">
                    {{ strtoupper($roleName) }}
                </span>
                <h2 class="text-2xl font-black tracking-tight text-white">Selamat Datang, {{ $user->name }}</h2>
                <p class="text-xs text-blue-200 font-medium">
                    {{ $userSubjek->unit_kerja ? 'Unit / Instansi: ' . $userSubjek->unit_kerja : 'Sistem Integrasi Perancangan Dokumen Hukum Kota Pariaman' }}
                </p>
            </div>

            <!-- Role Action Button -->
            <div class="flex items-center gap-3">
                @if($user->hasRole(['admin_hukum', 'kabag_hukum', 'super_admin']))
                    <a href="{{ route('documents.approvals') }}" class="px-5 py-2.5 bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#062447] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Antrian Persetujuan Dokumen</span>
                    </a>
                @endif
                @if($user->hasRole(['admin_opd', 'admin_desa', 'super_admin']))
                    <a href="{{ route('documents.create') }}" class="px-5 py-2.5 bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#062447] font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-md transition-all flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Ajukan Dokumen Baru</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Pengajuan -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL DOKUMEN</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($totalCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI FINAL</h4>
                    <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">{{ number_format($disetujuiCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Diproses -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">SEDANG DIREVIEW</h4>
                    <p class="text-3xl font-black text-amber-600 mt-1 tracking-tight">{{ number_format($diprosesCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Perlu Revisi -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">PERLU REVISI</h4>
                    <p class="text-3xl font-black text-rose-500 mt-1 tracking-tight">{{ number_format($ditolakCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Section Breakdown per Jenis Dokumen (Untuk Verifikator & Super Admin) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-extrabold text-[#061D38]">Rincian Dokumen per Kategori Jenis</h3>
                <a href="{{ route('documents.index') }}" class="text-xs font-bold text-[#062447] hover:underline">Lihat Seluruh Repositori →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-4 text-center">DIPROSES</th>
                            <th class="py-3.5 px-4 text-center">PERLU REVISI</th>
                            <th class="py-3.5 px-4 text-center">DISETUJUI</th>
                            <th class="py-3.5 px-6 text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @if(isset($jenisBreakdown) && $jenisBreakdown->count() > 0)
                            @foreach($jenisBreakdown as $row)
                                <tr class="hover:bg-gray-50/50 transition-all">
                                    <td class="py-4 px-6 font-bold text-[#061D38]">{{ $row->nama }}</td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-block bg-amber-50 text-amber-700 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">{{ $row->diproses }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-block bg-rose-50 text-rose-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">{{ $row->revisi }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-block bg-emerald-50 text-emerald-600 font-extrabold px-3 py-1 rounded-full text-xs min-w-[40px]">{{ $row->disetujui }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-block bg-gray-100 text-gray-700 font-extrabold px-3.5 py-1 rounded-full text-xs min-w-[44px]">{{ $row->total }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 3. Daftar Pengajuan Terakhir Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5 text-[#061D38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="text-base font-extrabold text-[#061D38]">Daftar Pengajuan Terakhir</h3>
                </div>
                <a href="{{ route('documents.index') }}" class="text-xs font-bold text-[#061D38] hover:underline flex items-center gap-1">
                    Lihat Semua Dokumen →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">ID THREAD</th>
                            <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                            <th class="py-3.5 px-6">TANGGAL KIRIM</th>
                            <th class="py-3.5 px-4 text-center">STATUS</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @forelse($recentDocuments as $doc)
                            @php
                                $stKey = $doc->status_pengajuan_key;
                                $docStKey = $doc->status_dokumen_key;
                                $statusLabel = $doc->statusPengajuan->status ?? 'Pengajuan';
                                $badgeClass = 'bg-amber-50 text-amber-700';

                                if ($docStKey == 6 || ($stKey == 4 && $docStKey != 3)) {
                                    $statusLabel = 'Disetujui Final';
                                    $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                                } elseif ($docStKey == 3 || $stKey == 3) {
                                    $statusLabel = 'Perlu Revisi';
                                    $badgeClass = 'bg-rose-50 text-rose-700 border border-rose-200';
                                } elseif ($docStKey == 5) {
                                    $statusLabel = 'Proses Kabag Hukum';
                                    $badgeClass = 'bg-blue-50 text-blue-700 border border-blue-200';
                                } else {
                                    $statusLabel = 'Proses Admin Hukum';
                                    $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-200';
                                }
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-mono text-xs font-extrabold text-[#061D38]">
                                    #DOC-{{ str_pad($doc->dokumen_id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-[#061D38] hover:underline block">
                                        {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-500 font-medium">
                                    {{ $doc->created_at ? $doc->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block {{ $badgeClass }} font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                        {{ strtoupper($statusLabel) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all inline-block">
                                        Detail Dokumen
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-sm font-bold text-gray-600">Belum ada pengajuan dokumen</p>
                                        <p class="text-xs text-gray-400">Klik tombol "Ajukan Dokumen Baru" untuk memulai pengajuan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
