<!-- Kabag Hukum Dashboard (Final Approval & Executive Review) -->
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

    $menungguReviewCount = $allLatest->where('status_dokumen_key', 5)->count();
    $disetujuiCount = $allLatest->filter(function($doc) {
        return ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3;
    })->count();
    $revisiCount = $allLatest->filter(function($doc) {
        return $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3;
    })->count();

    $priorityQueue = $allLatest->where('status_dokumen_key', 5)->take(5);
    $jenisList = \App\Models\JenisDokumen::all();
@endphp

<div class="space-y-6">
    <!-- 1. Top Row: 3 KPI Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Card 1: Menunggu Persetujuan Final -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md transition-all border-b-4 border-b-amber-400">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">MENUNGGU PERSETUJUAN FINAL</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($menungguReviewCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
            <div class="px-6 py-2 bg-amber-50/50 text-xs font-semibold text-amber-700 flex items-center gap-1.5 border-t border-amber-100/50">
                <span>🛡️ Menunggu ACC Kabag Hukum</span>
            </div>
        </div>

        <!-- Card 2: Disetujui Final -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md transition-all border-b-4 border-b-emerald-500">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI FINAL</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">{{ number_format($disetujuiCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="px-6 py-2 bg-emerald-50/50 text-xs font-semibold text-emerald-700 flex items-center gap-1.5 border-t border-emerald-100/50">
                <span>✓ Dokumen telah disetujui resmi</span>
            </div>
        </div>

        <!-- Card 3: Diminta Revisi -->
        <div class="bg-white rounded-2xl shadow-xs border border-gray-100/80 overflow-hidden flex flex-col justify-between hover:shadow-md transition-all border-b-4 border-b-rose-500">
            <div class="p-6 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DIMINTA REVISI</h4>
                    <p class="text-3xl font-black text-gray-900 mt-1 tracking-tight">{{ number_format($revisiCount) }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>
            <div class="px-6 py-2 bg-rose-50/50 text-xs font-semibold text-rose-700 flex items-center gap-1.5 border-t border-rose-100/50">
                <span>⏰ Membutuhkan perbaikan pengaju</span>
            </div>
        </div>
    </div>

    <!-- 2. Antrian Prioritas (Perlu Tindakan) Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="text-amber-500 font-black text-lg">!</span>
                <h3 class="text-base font-extrabold text-[#061D38]">Antrian Review Final Kabag Hukum</h3>
            </div>
            <a href="{{ route('documents.approvals') }}" class="text-xs font-bold text-[#061D38] hover:underline">
                Lihat Semua Antrian →
            </a>
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
                                    <a href="{{ route('documents.show', ['id' => $row->dokumen_id]) }}" class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all">
                                        Periksa & ACC
                                    </a>
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
                                    <p class="text-sm font-bold text-gray-600">Tidak ada antrian persetujuan final</p>
                                    <p class="text-xs text-gray-400">Seluruh dokumen yang masuk telah diproses.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Bottom Grid: Rincian per Jenis Dokumen Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-6 space-y-4">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <h3 class="text-base font-extrabold text-[#061D38]">Rincian Transaksi per Jenis Dokumen</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                        <th class="py-3 px-4">JENIS DOKUMEN</th>
                        <th class="py-3 px-4 text-center">MENUNGGU REVIEW</th>
                        <th class="py-3 px-4 text-center">REVISI</th>
                        <th class="py-3 px-4 text-center">DISETUJUI</th>
                        <th class="py-3 px-4 text-center">TOTAL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-xs font-semibold text-gray-700">
                    @foreach($jenisList as $j)
                        @php
                            $jDocs = $allLatest->where('jenis_dokumen_key', $j->jenis_dokumen_key);
                            $jMenunggu = $jDocs->reject(function($doc) { return in_array($doc->status_dokumen_key, [5, 6, 3]) || in_array($doc->status_pengajuan_key, [3, 4]); })->count();
                            $jRevisi = $jDocs->filter(function($doc) { return $doc->status_pengajuan_key == 3 || $doc->status_dokumen_key == 3; })->count();
                            $jSetuju = $jDocs->filter(function($doc) { return ($doc->status_dokumen_key == 6 || $doc->status_pengajuan_key == 4) && $doc->status_dokumen_key != 3; })->count();
                        @endphp
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3.5 px-4 font-bold text-gray-900">{{ $j->jenis_dokumen }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-amber-600">{{ $jMenunggu }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-rose-600">{{ $jRevisi }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-emerald-600">{{ $jSetuju }}</td>
                            <td class="py-3.5 px-4 text-center font-black text-gray-900">{{ $jDocs->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
