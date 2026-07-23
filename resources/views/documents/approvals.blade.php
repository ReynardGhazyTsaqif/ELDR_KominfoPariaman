<x-app-layout>
    @php
        // Subquery id_fact terbaru per dokumen_id thread
        $latestIds = \App\Models\PengajuanDokumen::selectRaw('MAX(id_fact) as max_id')
            ->groupBy('dokumen_id');

        $allLatest = \App\Models\PengajuanDokumen::with([
            'subjek', 
            'dokumen', 
            'jenisDokumen', 
            'perihalDokumen', 
            'statusDokumen', 
            'statusPengajuan'
        ])->whereIn('id_fact', $latestIds)->get();

        $menungguReviewCount = $allLatest->reject(function($doc) {
            return in_array($doc->status_dokumen_key, [5, 6, 3]) || in_array($doc->status_pengajuan_key, [3, 4]);
        })->count();
        $sedangDirevisiCount = $allLatest->filter(function($doc) {
            return $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3;
        })->count();
        $disetujuiCount = $allLatest->filter(function($doc) {
            return ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3;
        })->count();
        $totalPengajuanCount = $allLatest->count();

        $pendingDocIds = $allLatest->reject(function($doc) {
            return in_array($doc->status_dokumen_key, [5, 6, 3]) || in_array($doc->status_pengajuan_key, [3, 4]);
        })->pluck('id_fact');

        $pendingDocs = \App\Models\PengajuanDokumen::with([
            'subjek', 
            'dokumen', 
            'jenisDokumen', 
            'perihalDokumen', 
            'statusDokumen', 
            'statusPengajuan'
        ])->whereIn('id_fact', $pendingDocIds)
          ->orderBy('id_fact', 'desc')
          ->paginate(15);
    @endphp

    <div class="space-y-6">
        <!-- Page Header & Top Action Buttons -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Antrian Persetujuan Dokumen</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Kelola dan tinjau draf dokumen hukum OPD & Desa yang memerlukan verifikasi Bagian Hukum.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('documents.index') }}" class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs rounded-xl flex items-center gap-2 transition-all shadow-xs">
                    <span>Lihat Seluruh Repositori Dokumen</span>
                </a>
            </div>
        </div>

        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card 1: Menunggu Review -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU REVIEW</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($menungguReviewCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>

            <!-- Card 2: Sedang Direvisi -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">SEDANG DIREVISI</h4>
                    <p class="text-3xl font-black text-amber-600 mt-1 tracking-tight">{{ number_format($sedangDirevisiCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
            </div>

            <!-- Card 3: Disetujui -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TELAH DISETUJUI</h4>
                    <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">{{ number_format($disetujuiCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Card 4: Total Transaksi -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-all">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL PENGAJUAN</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">{{ number_format($totalPengajuanCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Antrian Dokumen Menunggu Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base font-extrabold text-[#061D38]">Daftar Dokumen Menunggu Verifikasi</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">ID THREAD</th>
                            <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-6">PERIHAL</th>
                            <th class="py-3.5 px-6">PENGAJU (OPD/DESA)</th>
                            <th class="py-3.5 px-6 text-center">TANGGAL MASUK</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @forelse($pendingDocs as $doc)
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-mono text-xs font-extrabold text-[#061D38]">
                                    #DOC-{{ str_pad($doc->dokumen_id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-[#061D38] hover:underline block">
                                        {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="bg-slate-100 text-slate-700 font-extrabold px-2.5 py-1 rounded text-[10px] uppercase">
                                        {{ $doc->jenisDokumen->jenis_dokumen ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-600 max-w-xs truncate" title="{{ $doc->perihalDokumen->perihal_dokumen ?? '' }}">
                                    {{ $doc->perihalDokumen->perihal_dokumen ?? '-' }}
                                </td>
                                <td class="py-4 px-6 text-xs font-bold text-gray-600">
                                    {{ $doc->subjek->unit_kerja ?? $doc->subjek->nama_subjek ?? '-' }}
                                </td>
                                <td class="py-4 px-6 text-center text-xs text-gray-500 font-medium">
                                    {{ $doc->created_at ? $doc->created_at->format('d M Y, H:i') : '-' }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all inline-block">
                                        Review & ACC
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm font-bold text-gray-600">Antrian persetujuan kosong</p>
                                        <p class="text-xs text-gray-400">Tidak ada pengajuan dokumen baru yang menunggu verifikasi saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination Bar -->
            @if($pendingDocs->hasPages())
                <div class="p-4 bg-gray-50/60 border-t border-gray-100">
                    {{ $pendingDocs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
