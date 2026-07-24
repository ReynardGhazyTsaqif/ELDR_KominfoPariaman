<div class="space-y-6">
    <!-- 1. Top Stat Cards (3 Columns with Color Bottom Border) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: MENUNGGU PERSETUJUAN FINAL -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 border-b-4 border-b-amber-400 hover:shadow-md transition-all flex items-start justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">MENUNGGU PERSETUJUAN FINAL</h4>
                <p class="text-4xl font-black text-[#062447] tracking-tight mt-1">{{ number_format($menungguKabagCount ?? $diprosesCount ?? 12) }}</p>
                <span class="text-xs font-bold text-amber-700 mt-2 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Dari Admin Hukum</span>
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-[#FEF3C7] text-[#D97706] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>

        <!-- Card 2: DISETUJUI FINAL BULAN INI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 border-b-4 border-b-emerald-500 hover:shadow-md transition-all flex items-start justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">DISETUJUI FINAL BULAN INI</h4>
                <p class="text-4xl font-black text-[#062447] tracking-tight mt-1">{{ number_format($disetujuiCount ?? 48) }}</p>
                <span class="text-xs font-bold text-emerald-600 mt-2 flex items-center gap-1">
                    <span>📈 +12% dari bulan lalu</span>
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-[#DCFCE7] text-[#166534] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Card 3: DIMINTA REVISI BULAN INI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 border-b-4 border-b-rose-500 hover:shadow-md transition-all flex items-start justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">DIMINTA REVISI BULAN INI</h4>
                <p class="text-4xl font-black text-[#062447] tracking-tight mt-1">{{ number_format($ditolakCount ?? 7) }}</p>
                <span class="text-xs font-bold text-rose-600 mt-2 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Membutuhkan atensi segera</span>
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-[#FEE2E2] text-[#DC2626] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. Section: ! Antrian Prioritas (Perlu Tindakan) -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <!-- Header Bar -->
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="text-rose-600 font-black text-lg">!</span>
                <h3 class="text-base font-extrabold text-[#062447]">Antrian Prioritas (Perlu Tindakan)</h3>
            </div>
            <span class="bg-gray-100 text-gray-700 text-xs font-extrabold px-3.5 py-1 rounded-full">
                {{ number_format($menungguKabagCount ?? 12) }} Dokumen Menunggu
            </span>
        </div>

        <!-- Table Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                        <th class="py-4 px-6 w-20">URUTAN</th>
                        <th class="py-4 px-6">NAMA DOKUMEN</th>
                        <th class="py-4 px-6">OPD/DESA PENGIRIM</th>
                        <th class="py-4 px-6">DURASI MENUNGGU</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                    @forelse($recentDocuments as $index => $doc)
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-blue-600 text-base">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-sm text-[#062447] hover:underline">
                                        {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                    </a>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-gray-400 font-mono">ID-2024-{{ str_pad($doc->dokumen_id, 3, '0', STR_PAD_LEFT) }}</span>
                                    <span class="bg-[#DCFCE7] text-[#166534] px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                        ● Disetujui Admin Hukum
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-semibold">
                                {{ $doc->subjek->subjek_nama ?? 'Instansi / OPD' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1 text-[#062447] font-bold text-xs">
                                    <span>⏰ {{ $doc->created_at ? $doc->created_at->diffForHumans() : '1 Hari' }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('documents.revision', ['id' => $doc->dokumen_id]) }}" class="border border-rose-300 text-rose-600 hover:bg-rose-50 font-extrabold text-xs px-3.5 py-1.5 rounded-lg shadow-2xs transition-all cursor-pointer">
                                        Revisi
                                    </a>
                                    <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs px-4 py-1.5 rounded-lg shadow-xs transition-all cursor-pointer">
                                        Setuju
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-blue-600 text-base">01</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-sm text-[#062447]">Perda Pengelolaan Sampah Regional</span>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-gray-400 font-mono">ID-2024-081</span>
                                    <span class="bg-[#DCFCE7] text-[#166534] px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                        ● Disetujui Admin Hukum
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-semibold">Dinas Lingkungan Hidup</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1 text-rose-600 font-bold text-xs">
                                    <span>⏰ 3 Hari</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('documents.approvals') }}" class="border border-rose-300 text-rose-600 hover:bg-rose-50 font-extrabold text-xs px-3.5 py-1.5 rounded-lg shadow-2xs transition-all cursor-pointer">
                                        Revisi
                                    </a>
                                    <a href="{{ route('documents.approvals') }}" class="bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs px-4 py-1.5 rounded-lg shadow-xs transition-all cursor-pointer">
                                        Setuju
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-blue-600 text-base">02</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2">
                                    <span class="font-extrabold text-sm text-[#062447]">SK Walikota Pengangkatan ASN</span>
                                </div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-gray-400 font-mono">ID-2024-092</span>
                                    <span class="bg-[#DCFCE7] text-[#166534] px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                        ● Disetujui Admin Hukum
                                    </span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-semibold">BKPSDM</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1 text-gray-500 font-bold text-xs">
                                    <span>⏰ 1 Hari</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('documents.approvals') }}" class="border border-rose-300 text-rose-600 hover:bg-rose-50 font-extrabold text-xs px-3.5 py-1.5 rounded-lg shadow-2xs transition-all cursor-pointer">
                                        Revisi
                                    </a>
                                    <a href="{{ route('documents.approvals') }}" class="bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs px-4 py-1.5 rounded-lg shadow-xs transition-all cursor-pointer">
                                        Setuju
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Link -->
        <div class="px-6 py-3.5 bg-[#F8FAFC] border-t border-gray-200 text-center">
            <a href="{{ route('documents.approvals') }}" class="text-xs font-bold text-[#062447] hover:underline">
                Lihat Semua Antrian Review
            </a>
        </div>
    </div>

    <!-- 3. Section: 2-Column Grid (Left: Rincian per Jenis Dokumen, Right: Kinerja & Aktivitas) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2-Column Span: Rincian per Jenis Dokumen Table -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-extrabold text-[#062447]">Rincian per Jenis Dokumen</h3>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 text-[11px] font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                            <th class="py-3 px-4">JENIS DOKUMEN</th>
                            <th class="py-3 px-4 text-center">MENUNGGU</th>
                            <th class="py-3 px-4 text-center">REVISI</th>
                            <th class="py-3 px-4 text-center">DISETUJUI</th>
                            <th class="py-3 px-4 text-center">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs font-bold text-gray-700">
                        @if(isset($jenisBreakdown) && $jenisBreakdown->count() > 0)
                            @foreach($jenisBreakdown as $row)
                                <tr class="hover:bg-gray-50/70">
                                    <td class="py-3.5 px-4 font-black text-[#062447]">{{ $row->nama }}</td>
                                    <td class="py-3.5 px-4 text-center text-amber-600">{{ str_pad($row->diproses, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-3.5 px-4 text-center text-rose-600">{{ str_pad($row->revisi, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-3.5 px-4 text-center text-emerald-600">{{ str_pad($row->disetujui, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="py-3.5 px-4 text-center font-black text-[#062447]">{{ str_pad($row->total, 2, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="hover:bg-gray-50/70">
                                <td class="py-3.5 px-4 font-black text-[#062447]">Perda / Perwako</td>
                                <td class="py-3.5 px-4 text-center text-amber-600">05</td>
                                <td class="py-3.5 px-4 text-center text-rose-600">02</td>
                                <td class="py-3.5 px-4 text-center text-emerald-600">12</td>
                                <td class="py-3.5 px-4 text-center font-black text-[#062447]">19</td>
                            </tr>
                            <tr class="hover:bg-gray-50/70">
                                <td class="py-3.5 px-4 font-black text-[#062447]">SK / Keputusan Walikota-Sekda</td>
                                <td class="py-3.5 px-4 text-center text-amber-600">04</td>
                                <td class="py-3.5 px-4 text-center text-rose-600">03</td>
                                <td class="py-3.5 px-4 text-center text-emerald-600">28</td>
                                <td class="py-3.5 px-4 text-center font-black text-[#062447]">35</td>
                            </tr>
                            <tr class="hover:bg-gray-50/70">
                                <td class="py-3.5 px-4 font-black text-[#062447]">Perdes / Perkades</td>
                                <td class="py-3.5 px-4 text-center text-amber-600">03</td>
                                <td class="py-3.5 px-4 text-center text-rose-600">02</td>
                                <td class="py-3.5 px-4 text-center text-emerald-600">08</td>
                                <td class="py-3.5 px-4 text-center font-black text-[#062447]">13</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right 1-Column Span: Stacked Cards (Kinerja & Aktivitas) -->
        <div class="space-y-6">
            <!-- Top Card: KINERJA REVIEW MINGGU INI -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs space-y-4">
                <h4 class="text-xs font-extrabold text-[#062447] uppercase tracking-wider">KINERJA REVIEW MINGGU INI</h4>
                
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1">
                            <span>Rata-rata Waktu Review Final</span>
                            <span class="text-[#062447] font-black">1.2 Hari</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-400 rounded-full w-3/4"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1">
                            <span>Dokumen Diselesaikan Final</span>
                            <span class="text-[#062447] font-black">{{ number_format($disetujuiCount ?? 48) }}</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-[#062447] rounded-full w-4/5"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Card: AKTIVITAS TERBARU -->
            <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs space-y-4">
                <h4 class="text-xs font-extrabold text-[#062447] uppercase tracking-wider">AKTIVITAS TERBARU</h4>
                
                <div class="space-y-3 text-xs font-medium text-gray-700">
                    <div class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 flex-shrink-0"></span>
                        <div>
                            <p class="font-bold text-[#062447]">Menyetujui Perda Lingkungan</p>
                            <span class="text-[10px] text-gray-400 block">15 Menit yang lalu</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                        <div>
                            <p class="font-bold text-[#062447]">Mengembalikan SK Pegawai untuk revisi</p>
                            <span class="text-[10px] text-gray-400 block">2 Jam yang lalu</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                        <div>
                            <p class="font-bold text-[#062447]">Melihat dokumen Perdes Pariaman Baru</p>
                            <span class="text-[10px] text-gray-400 block">3 Jam yang lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
