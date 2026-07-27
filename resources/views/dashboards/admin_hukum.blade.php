<div class="space-y-6">
    <!-- 1. Top Stat Cards (3 Columns - Harmonized with OPD Dashboard) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: MENUNGGU VERIFIKASI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center flex-shrink-0 shadow-2xs border border-amber-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">MENUNGGU VERIFIKASI</h4>
                <p class="text-3xl sm:text-4xl font-black text-amber-900 tracking-tight mt-0.5">{{ number_format($diprosesCount ?? 0) }}</p>
            </div>
        </div>

        <!-- Card 2: DISETUJUI ADMIN HUKUM -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0 shadow-2xs border border-emerald-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">DISETUJUI ADMIN HUKUM</h4>
                <p class="text-3xl sm:text-4xl font-black text-emerald-900 tracking-tight mt-0.5">{{ number_format($disetujuiCount ?? 0) }}</p>
            </div>
        </div>

        <!-- Card 3: DIMINTA REVISI OPD -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-700 flex items-center justify-center flex-shrink-0 shadow-2xs border border-rose-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">DIMINTA REVISI OPD</h4>
                <p class="text-3xl sm:text-4xl font-black text-rose-900 tracking-tight mt-0.5">{{ number_format($ditolakCount ?? 0) }}</p>
            </div>
        </div>
    </div>

    <!-- 2. Section: Daftar Pengajuan Masuk (Menunggu Verifikasi) -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <!-- Header Bar -->
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-base font-extrabold text-[#062447]">Daftar Pengajuan Masuk (Menunggu Verifikasi)</h3>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('documents.approvals') }}" class="text-xs font-bold text-[#062447] hover:underline flex items-center gap-1.5">
                    <span>Lihat Semua Antrian</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Table Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                        
                        <th class="py-4 px-6">NAMA DOKUMEN</th>
                        <th class="py-4 px-6">PENGIRIM (OPD/DESA)</th>
                        <th class="py-4 px-6">TANGGAL MASUK</th>
                        <th class="py-4 px-6 text-center">STATUS</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                    @forelse($recentDocuments as $index => $doc)
                        @php
                            $stKey = $doc->status_pengajuan_key;
                            $docStKey = $doc->status_dokumen_key;
                            $statusText = $doc->statusDokumen->status ?? 'File Terkirim';
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition-all">
                            
                            <td class="py-4 px-6">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-sm text-[#062447] hover:underline block leading-snug">
                                    {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                </a>
                                <span class="text-xs text-gray-400 font-mono block mt-1">
                                    ID: #DOC-{{ str_pad($doc->dokumen_id, 4, '0', STR_PAD_LEFT) }} • {{ $doc->jenisDokumen->jenis_dokumen ?? 'Peraturan' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-bold">
                                {{ $doc->subjek->unit_kerja ?? $doc->subjek->nama_subjek ?? '-' }}
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-600 font-medium whitespace-nowrap">
                                {{ $doc->created_at ? $doc->created_at->format('d M Y, H:i \W\I\B') : '-' }}
                            </td>
                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <span class="inline-block bg-amber-50 text-amber-800 border border-amber-200 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="px-4 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-xs transition-all inline-block">
                                    Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm font-bold text-gray-600">Tidak ada antrian pengajuan masuk</p>
                                    <p class="text-xs text-gray-400">Seluruh dokumen yang dikirim OPD/Desa telah ditindaklanjuti.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        
    </div>

    <!-- 3. Section: Rincian per Jenis Dokumen (Dynamic & Scalable) -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <svg class="w-5 h-5 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V7a2 2 0 00-2-2h-1.5a2 2 0 01-2-2V3.055" />
                </svg>
                <h3 class="text-base font-extrabold text-[#062447]">Rincian per Jenis Dokumen</h3>
            </div>
            
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pt-2">
            @if(isset($jenisBreakdown) && count($jenisBreakdown) > 0)
                @foreach($jenisBreakdown as $item)
                    <div class="bg-[#F8FAFC] hover:bg-white rounded-xl p-5 border border-gray-200/80 hover:border-gray-300 hover:shadow-xs transition-all space-y-3">
                        <div class="flex items-start justify-between gap-2">
                            <h4 class="text-xs font-black text-[#062447] uppercase tracking-wider line-clamp-1" title="{{ $item->nama }}">
                                {{ $item->nama }}
                            </h4>
                            <span class="px-2 py-0.5 bg-gray-200/70 text-gray-700 font-extrabold text-[10px] rounded-md whitespace-nowrap">
                                {{ $item->total }} Dokumen
                            </span>
                        </div>

                        <div class="pt-1 flex items-center justify-between text-[11px] font-bold text-gray-600 border-t border-gray-200/60">
                            <span class="text-amber-700 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                {{ $item->diproses }} Proses
                            </span>
                            <span class="text-emerald-700 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                {{ $item->disetujui }} Setuju
                            </span>
                            <span class="text-rose-700 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                {{ $item->revisi }} Revisi
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full py-6 text-center text-gray-400 text-xs font-medium">
                    Belum ada jenis dokumen terdaftar di master data.
                </div>
            @endif
        </div>
    </div>

    <!-- 4. Section: 2-Column Bottom Grid (Aktivitas Terbaru & Kinerja Review Minggu Ini) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left: Aktivitas Terbaru (Real-time Audit Trail) -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs flex flex-col justify-between space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="relative flex h-2.5 w-2.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <h3 class="text-base font-extrabold text-[#062447]">Aktivitas Terbaru</h3>
                </div>
                <span class="text-[11px] text-gray-400 font-medium">Real-time Fact Log</span>
            </div>

            <div class="space-y-4 text-xs font-medium text-gray-700">
                @if(isset($recentActivities) && count($recentActivities) > 0)
                    @foreach($recentActivities as $act)
                        @php
                            $stKey = $act->status_dokumen_key;
                            $dotClass = 'bg-amber-500';
                            if ($stKey == 6) {
                                $dotClass = 'bg-emerald-500';
                            } elseif ($stKey == 5) {
                                $dotClass = 'bg-blue-500';
                            } elseif ($stKey == 3 || $stKey == 4) {
                                $dotClass = 'bg-rose-500';
                            }
                        @endphp
                        <div class="flex items-start gap-3">
                            <span class="w-2 h-2 rounded-full {{ $dotClass }} mt-1.5 flex-shrink-0"></span>
                            <div>
                                <p class="leading-snug">
                                    <strong class="font-extrabold text-[#062447]">{{ $act->subjek->unit_kerja ?? $act->subjek->nama_subjek ?? 'OPD/Desa' }}</strong>: 
                                    <span class="font-bold text-gray-800">{{ $act->statusDokumen->status ?? 'Membuat Transaksi' }}</span> pada 
                                    <a href="{{ route('documents.show', ['id' => $act->dokumen_id]) }}" class="font-extrabold text-[#062447] hover:underline">
                                        {{ $act->dokumen->dokumen_judul ?? 'Dokumen #' . $act->dokumen_id }}
                                    </a>
                                </p>
                                <span class="text-[10px] text-gray-400 font-medium block mt-0.5">
                                    {{ $act->created_at ? $act->created_at->diffForHumans() : '-' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="py-4 text-center text-gray-400 text-xs">
                        Belum ada aktivitas transaksi terbaru.
                    </div>
                @endif
            </div>
        </div>

        <!-- Right: Kinerja Review Minggu Ini (Real-time Bar Chart) -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs flex flex-col justify-between space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-extrabold text-[#062447]">Kinerja Review Minggu Ini</h3>
                    <span class="text-[11px] text-gray-400 font-medium">Statistik Transaksi per Hari (Senin - Minggu)</span>
                </div>
                <span class="bg-[#062447] text-white text-xs font-extrabold px-3 py-1 rounded-lg">
                    {{ $totalWeekReviewed ?? 0 }} Total
                </span>
            </div>

            <!-- Real-time Bar Chart Component (Clean Direct Bars) -->
            <div class="pt-4 pb-1">
                <div class="h-28 flex items-end justify-between gap-3 px-2 border-b border-gray-100 pb-1">
                    @if(isset($weeklyPerformance) && count($weeklyPerformance) > 0)
                        @foreach($weeklyPerformance as $item)
                            @php
                                $barHeightPx = $item->count > 0 ? max(16, round(($item->count / ($maxDailyCount ?? 1)) * 80)) : 6;
                                $barBg = $item->isToday ? 'bg-[#062447]' : ($item->count > 0 ? 'bg-[#0A3363]' : 'bg-gray-200');
                            @endphp
                            <div class="flex-1 flex flex-col items-center justify-end h-full gap-1.5 group relative">
                                <!-- Tooltip on Hover -->
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity absolute -top-8 bg-gray-900 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-md pointer-events-none whitespace-nowrap z-10">
                                    {{ $item->count }} Dokumen ({{ $item->date }})
                                </div>

                                <!-- Count Badge -->
                                <span class="text-[10px] font-extrabold {{ $item->count > 0 ? 'text-[#062447]' : 'text-gray-400' }}">
                                    {{ $item->count }}
                                </span>

                                <!-- Direct Bar Element (No Track Background) -->
                                <div class="w-full max-w-[24px] rounded-t-lg {{ $barBg }} transition-all duration-300 group-hover:bg-[#F5BF38] shadow-2xs" style="height: {{ $barHeightPx }}px;"></div>

                                <!-- Day Label -->
                                <span class="text-[10px] font-extrabold uppercase mt-1 {{ $item->isToday ? 'text-[#062447] font-black' : 'text-gray-400' }}">
                                    {{ $item->day }}
                                </span>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- 2 Real Summary Boxes at Bottom -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-[#F8FAFC] border border-gray-200/80 p-4 rounded-xl space-y-1">
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">TOTAL MINGGU INI</span>
                    <p class="text-xl font-black text-[#062447]">{{ number_format($totalWeekReviewed ?? 0) }} Dokumen</p>
                </div>
                <div class="bg-[#F8FAFC] border border-gray-200/80 p-4 rounded-xl space-y-1">
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">HARI TERSIBUK</span>
                    <p class="text-xl font-black text-[#062447]">{{ $busiestDay->day ?? '-' }} <span class="text-xs font-bold text-gray-500">({{ $busiestDay->count ?? 0 }} doc)</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
