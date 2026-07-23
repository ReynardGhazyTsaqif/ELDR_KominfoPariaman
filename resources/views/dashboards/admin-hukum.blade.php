<!-- Admin Hukum & Internal Reviewer Dynamic Dashboard -->
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

    $menungguReview = $allLatest->filter(function($doc) {
        return ($doc->status_dokumen_key == 3 && $doc->status_pengajuan_key == 2) || (!in_array($doc->status_dokumen_key, [5, 6, 3]) && !in_array($doc->status_pengajuan_key, [3, 4]));
    })->count();
    $disetujuiBulanIni = $allLatest->filter(function($doc) {
        return ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3;
    })->count();
    $revisiBulanIni = $allLatest->filter(function($doc) {
        return $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3;
    })->count();

    $priorityQueue = $allLatest->filter(function($doc) {
        return ($doc->status_dokumen_key == 3 && $doc->status_pengajuan_key == 2) || (!in_array($doc->status_dokumen_key, [5, 6, 3]) && !in_array($doc->status_pengajuan_key, [3, 4]));
    })->take(5);
    $recentActivities = \App\Models\PengajuanDokumen::with(['subjek', 'dokumen', 'statusDokumen'])
        ->orderBy('id_fact', 'desc')
        ->take(4)
        ->get();
@endphp

<div class="space-y-6">
    <!-- 1. Top Row: 3 KPI Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Menunggu Tindak Lanjut -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU TINDAK LANJUT</h4>
                <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($menungguReview) }}</p>
                <p class="text-xs font-bold text-amber-600 mt-1">
                    Dokumen masuk dalam antrian
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 022 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
        </div>

        <!-- Card 2: Disetujui -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI TOTAL</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">{{ number_format($disetujuiBulanIni) }}</p>
                <p class="text-xs font-bold text-emerald-600 mt-1 flex items-center gap-1">
                    <span>Telah selesai diverifikasi</span>
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Card 3: Diminta Revisi -->
        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-xs flex items-center justify-between hover:shadow-md transition-all">
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">PERLU REVISI</h4>
                <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">{{ number_format($revisiBulanIni) }}</p>
                <p class="text-xs font-bold text-orange-600 mt-1">
                    Dikembalikan ke pengaju
                </p>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. Antrian Prioritas (Perlu Tindakan) Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-2.5">
                <span class="text-rose-600 font-black text-lg">!</span>
                <h3 class="text-base font-extrabold text-[#061D38]">Antrian Review (Perlu Tindakan)</h3>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('documents.approvals') }}" class="px-4 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-sm transition-all">
                    Buka Antrian Lengkap →
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="py-3.5 px-6">ID THREAD</th>
                        <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                        <th class="py-3.5 px-6">OPD/DESA PENGIRIM</th>
                        <th class="py-3.5 px-6 text-center">TANGGAL MASUK</th>
                        <th class="py-3.5 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                    @forelse($priorityQueue as $row)
                        <tr class="hover:bg-gray-50/50 transition-all">
                            <td class="py-4 px-6 font-mono text-xs font-extrabold text-[#061D38]">
                                #DOC-{{ str_pad($row->dokumen_id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('documents.show', ['id' => $row->dokumen_id]) }}" class="font-bold text-[#061D38] hover:underline text-sm block">
                                    {{ $row->dokumen->dokumen_judul ?? 'Dokumen #' . $row->dokumen_id }}
                                </a>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="bg-blue-50 text-blue-700 font-extrabold px-2 py-0.5 rounded text-[10px]">
                                        Jenis: {{ $row->jenisDokumen->jenis_dokumen ?? '-' }}
                                    </span>
                                    @if($row->status_dokumen_key == 3 && $row->status_pengajuan_key == 2)
                                        <span class="bg-amber-100 text-amber-800 font-extrabold px-2 py-0.5 rounded text-[10px] flex items-center gap-1">
                                            <span>!</span> Revisi dari Kabag
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-600 text-xs font-bold">
                                {{ $row->subjek->unit_kerja ?? $row->subjek->nama_subjek ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-center text-xs text-gray-500 font-medium">
                                {{ $row->created_at ? $row->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @if($row->status_dokumen_key == 3 && $row->status_pengajuan_key == 2)
                                        <a href="{{ route('documents.show', ['id' => $row->dokumen_id]) }}" class="px-3.5 py-1.5 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-lg text-xs shadow-xs transition-all flex items-center gap-1">
                                            <span>Teruskan ke OPD</span>
                                        </a>
                                    @else
                                        <a href="{{ route('documents.show', ['id' => $row->dokumen_id]) }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all">
                                            Review
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-400 font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm font-bold text-gray-600">Tidak ada antrian dokumen yang perlu diverifikasi</p>
                                    <p class="text-xs text-gray-400">Seluruh dokumen yang diajukan telah diproses dengan baik.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Bottom 2 Columns Grid: Aktivitas Terbaru & Panduan Verifikator -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left: Aktivitas Terbaru Card -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100/80 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                    <h3 class="text-base font-extrabold text-[#061D38]">Aktivitas Transaksi Terbaru</h3>
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <div class="mt-6 space-y-5">
                    @forelse($recentActivities as $act)
                        <div class="flex items-start gap-3.5">
                            <div class="w-2.5 h-2.5 rounded-full bg-[#062447] flex-shrink-0 mt-1.5"></div>
                            <div>
                                <p class="text-xs text-gray-800 font-semibold">
                                    <span class="font-extrabold text-gray-900">{{ $act->subjek->nama_subjek ?? 'Pengaju' }}</span> — {{ $act->keterangan ?? $act->statusDokumen->status ?? 'Transaksi Dokumen' }}
                                </p>
                                <span class="text-[10px] text-gray-400 font-medium block mt-0.5">
                                    {{ $act->created_at ? $act->created_at->diffForHumans() : '-' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400">Belum ada rekaman aktivitas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right: Panduan Verifikator Card -->
        <div class="bg-[#062447] text-white rounded-2xl p-7 relative overflow-hidden flex flex-col justify-between shadow-md">
            <div class="relative z-10 max-w-md">
                <h3 class="text-lg font-extrabold text-white">Panduan Verifikator Hukum</h3>
                <p class="text-xs text-blue-100 font-medium leading-relaxed mt-2">
                    Lakukan pemeriksaan draf Word (.doc/.docx) pengajuan dari OPD dan Desa secara teliti. Berikan catatan koreksi spesifik jika mengajukan revisi.
                </p>
                <a href="{{ route('documents.approvals') }}" class="inline-block mt-6 bg-[#F5BF38] hover:bg-[#E0AE2F] text-[#062447] font-bold text-xs px-5 py-2.5 rounded-xl shadow transition-all">
                    Buka Antrian Persetujuan
                </a>
            </div>
        </div>
    </div>
</div>
