<div class="space-y-6">
    <!-- 1. Top Stat Cards (3 Columns - Harmonized Design) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: MENUNGGU PERSETUJUAN FINAL -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center flex-shrink-0 shadow-2xs border border-amber-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">MENUNGGU ACC FINAL</h4>
                <p class="text-3xl sm:text-4xl font-black text-amber-900 tracking-tight mt-0.5">{{ number_format($menungguKabagCount ?? $diprosesCount ?? 0) }}</p>
            </div>
        </div>

        <!-- Card 2: DISETUJUI FINAL (SAH) -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0 shadow-2xs border border-emerald-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">DISETUJUI FINAL (SAH)</h4>
                <p class="text-3xl sm:text-4xl font-black text-emerald-900 tracking-tight mt-0.5">{{ number_format($disetujuiCount ?? 0) }}</p>
            </div>
        </div>

        <!-- Card 3: CATATAN REVISI INTERNAL -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-700 flex items-center justify-center flex-shrink-0 shadow-2xs border border-rose-100">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h4 class="text-[11px] font-extrabold text-gray-500 uppercase tracking-wider">CATATAN REVISI KABAG</h4>
                <p class="text-3xl sm:text-4xl font-black text-rose-900 tracking-tight mt-0.5">{{ number_format($ditolakCount ?? 0) }}</p>
            </div>
        </div>
    </div>

    <!-- 2. Section: Daftar Pengajuan Masuk (Menunggu ACC Kabag) -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <!-- Header Bar -->
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-base font-extrabold text-[#062447]">Daftar Pengajuan Masuk (Menunggu ACC Kabag)</h3>
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
                        <th class="py-4 px-4 text-center">STATUS DOKUMEN</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                    @forelse($recentDocuments as $index => $doc)
                        @php
                            $statusText = $doc->statusDokumen->status ?? 'Disetujui Admin Hukum';
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
                            <td class="py-4 px-4 text-center whitespace-nowrap">
                                <span class="inline-block bg-blue-50 text-blue-800 border border-blue-200 font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                    {{ strtoupper($statusText) }}
                                </span>
                                <span class="block text-[10px] text-gray-400 font-medium mt-1">
                                    {{ $doc->created_at ? $doc->created_at->format('d M Y, H:i \W\I\B') : '-' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="px-4 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-xs transition-all inline-block">
                                    Review &amp; ACC
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-gray-400 font-medium">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-sm font-bold text-gray-600">Tidak ada antrian persetujuan final</p>
                                    <p class="text-xs text-gray-400">Seluruh dokumen yang dikirim Admin Hukum telah disetujui / ditindaklanjuti.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        
    </div>

    <!-- 3. Section: 2-Column Grid (Left: Rincian per Jenis Dokumen, Right: Kinerja & Aktivitas) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2-Column Span: Rincian per Jenis Dokumen Table (Alpine.js Pagination: 7 Items/Page) -->
        <div x-data="{
            page: 1,
            pageSize: 7,
            get totalPages() {
                return Math.ceil({{ isset($jenisBreakdown) ? count($jenisBreakdown) : 0 }} / this.pageSize) || 1;
            }
        }" class="lg:col-span-2 bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <div>
                    <h3 class="text-base font-extrabold text-[#062447]">Rincian per Jenis Dokumen</h3>
                    <span class="text-[11px] text-gray-400 font-medium">Distribusi Pengajuan berdasarkan Kategori Master Data</span>
                </div>
                <span class="text-xs font-extrabold bg-blue-50 text-[#062447] px-3 py-1 rounded-full border border-blue-100">
                    {{ isset($jenisBreakdown) ? count($jenisBreakdown) : 0 }} Kategori
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3 px-4">JENIS DOKUMEN</th>
                            <th class="py-3 px-4 text-center">MENUNGGU</th>
                            <th class="py-3 px-4 text-center">REVISI</th>
                            <th class="py-3 px-4 text-center">DISETUJUI</th>
                            <th class="py-3 px-4 text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs font-extrabold text-gray-700">
                        @if(isset($jenisBreakdown) && $jenisBreakdown->count() > 0)
                            @foreach($jenisBreakdown as $index => $row)
                                <tr x-show="Math.floor({{ $index }} / pageSize) + 1 === page" class="hover:bg-gray-50/70 transition-all">
                                    <td class="py-3.5 px-4 font-black text-[#062447]">{{ $row->nama }}</td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        <span class="inline-block bg-amber-50 text-amber-800 font-black px-2.5 py-0.5 rounded-md border border-amber-100 text-[11px]">
                                            {{ str_pad($row->diproses, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        <span class="inline-block bg-rose-50 text-rose-800 font-black px-2.5 py-0.5 rounded-md border border-rose-100 text-[11px]">
                                            {{ str_pad($row->revisi, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        <span class="inline-block bg-emerald-50 text-emerald-800 font-black px-2.5 py-0.5 rounded-md border border-emerald-100 text-[11px]">
                                            {{ str_pad($row->disetujui, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                        <span class="inline-block bg-slate-100 text-[#062447] font-black px-3 py-0.5 rounded-md border border-slate-200 text-[11px]">
                                            {{ str_pad($row->total, 2, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-400 font-medium">
                                    Belum ada data rincian per jenis dokumen.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if(isset($jenisBreakdown) && count($jenisBreakdown) > 7)
                <div class="flex items-center justify-between border-t border-gray-100 pt-3 text-xs">
                    <span class="text-gray-400 font-semibold">
                        Halaman <span x-text="page" class="font-bold text-[#062447]"></span> dari <span x-text="totalPages" class="font-bold text-[#062447]"></span>
                    </span>
                    <div class="flex items-center gap-1.5">
                        <button type="button" @click="if(page > 1) page--" :disabled="page === 1" class="p-1.5 rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 disabled:opacity-40 disabled:cursor-not-allowed transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button type="button" @click="if(page < totalPages) page++" :disabled="page === totalPages" class="p-1.5 rounded-lg border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 disabled:opacity-40 disabled:cursor-not-allowed transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>

        <!-- Right 1-Column Span: Stacked Cards (Kinerja & Aktivitas) -->
        <div class="space-y-6">
            <!-- Top Card: KINERJA REVIEW MINGGU INI (Progress Bar Format) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="text-base font-extrabold text-[#062447]">Kinerja Review Minggu Ini</h3>
                    <span class="bg-emerald-50 text-emerald-800 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full border border-emerald-100">
                        {{ number_format($disetujuiCount ?? 0) }} Disetujui
                    </span>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1.5">
                            <span>Tingkat Persetujuan Final</span>
                            @php
                                $totalProcessed = ($disetujuiCount ?? 0) + ($ditolakCount ?? 0);
                                $approvalRate = $totalProcessed > 0 ? round((($disetujuiCount ?? 0) / $totalProcessed) * 100) : 0;
                            @endphp
                            <span class="text-emerald-700 font-black">{{ $approvalRate }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden p-0.5 border border-gray-100">
                            <div class="h-full bg-emerald-500 rounded-full transition-all duration-500" style="width: {{ $approvalRate }}%;"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1.5">
                            <span>Penyelesaian Antrian Masuk</span>
                            @php
                                $totalQueue = ($menungguKabagCount ?? 0) + ($disetujuiCount ?? 0);
                                $completionRate = $totalQueue > 0 ? round((($disetujuiCount ?? 0) / $totalQueue) * 100) : 0;
                            @endphp
                            <span class="text-[#062447] font-black">{{ $completionRate }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden p-0.5 border border-gray-100">
                            <div class="h-full bg-[#062447] rounded-full transition-all duration-500" style="width: {{ $completionRate }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Card: AKTIVITAS TERBARU (Max 3 Items) -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="text-base font-extrabold text-[#062447]">Aktivitas Terbaru</h3>
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" title="Real-time Feed"></span>
                </div>
                
                <div class="space-y-3.5 text-xs">
                    @if(isset($recentActivities) && count($recentActivities) > 0)
                        @foreach($recentActivities->take(3) as $act)
                            @php
                                $stKey = $act->status_dokumen_key;
                                $dotBg = $stKey == 6 ? 'bg-emerald-500' : ($stKey == 5 ? 'bg-amber-500' : (in_array($stKey, [3,4]) ? 'bg-rose-500' : 'bg-blue-500'));
                                $senderName = $act->subjek->unit_kerja ?? $act->subjek->nama_subjek ?? 'Pengaju';
                            @endphp
                            <div class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 rounded-full {{ $dotBg }} mt-1 flex-shrink-0"></span>
                                <div class="space-y-0.5">
                                    <p class="text-xs font-extrabold text-gray-800 leading-snug">
                                        {{ $senderName }}
                                        <span class="font-normal text-gray-600">mengirim pengajuan</span>
                                        <a href="{{ route('documents.show', ['id' => $act->dokumen_id]) }}" class="text-[#062447] hover:underline font-bold">
                                            "{{ $act->dokumen->dokumen_judul ?? 'Dokumen #' . $act->dokumen_id }}"
                                        </a>
                                    </p>
                                    <span class="text-[10px] text-gray-400 font-medium block">
                                        {{ $act->created_at ? $act->created_at->diffForHumans() : '-' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-gray-400 font-medium py-4 text-center">Belum ada aktivitas terbaru.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
