<div class="space-y-6">
    <!-- 1. Top Stat Cards (3 Columns) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1: MENUNGGU TINDAK LANJUT -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-start justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">MENUNGGU TINDAK LANJUT</h4>
                <p class="text-4xl font-black text-[#062447] tracking-tight mt-1">{{ number_format($diprosesCount ?? 24) }}</p>
                <span class="text-xs font-bold text-amber-700 mt-2 block">8 Prioritas Tinggi</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-[#FEF3C7] text-[#D97706] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Card 2: DISETUJUI BULAN INI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-start justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">DISETUJUI BULAN INI</h4>
                <p class="text-4xl font-black text-[#062447] tracking-tight mt-1">{{ number_format($disetujuiCount ?? 112) }}</p>
                <span class="text-xs font-bold text-emerald-600 mt-2 block flex items-center gap-1">
                    <span>↑ 12% dari bulan lalu</span>
                </span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-[#DCFCE7] text-[#166534] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Card 3: DIMINTA REVISI BULAN INI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-start justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider">DIMINTA REVISI BULAN INI</h4>
                <p class="text-4xl font-black text-[#062447] tracking-tight mt-1">{{ number_format($ditolakCount ?? 48) }}</p>
                <span class="text-xs font-bold text-amber-700 mt-2 block">Rata-rata 2x per dokumen</span>
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
            <div class="flex items-center gap-3">
                <button type="button" class="bg-white border border-gray-300 text-[#062447] font-bold text-xs px-3.5 py-1.5 rounded-lg shadow-2xs hover:bg-gray-50 transition-all cursor-pointer">
                    Filter
                </button>
                <a href="{{ route('documents.approvals') }}" class="bg-[#062447] text-white font-bold text-xs px-4 py-1.5 rounded-lg shadow-xs hover:bg-[#0A3363] transition-all cursor-pointer">
                    Ekspor Rekap
                </a>
            </div>
        </div>

        <!-- Table Data -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                        <th class="py-4 px-6 w-20">URUTAN</th>
                        <th class="py-4 px-6">NAMA DOKUMEN (+ID)</th>
                        <th class="py-4 px-6">OPD/DESA PENGIRIM</th>
                        <th class="py-4 px-6">DURASI MENUNGGU</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm font-semibold text-gray-700">
                    @forelse($recentDocuments as $index => $doc)
                        @php
                            $stKey = $doc->status_pengajuan_key;
                            $docStKey = $doc->status_dokumen_key;
                            
                            $durationBadge = 'bg-[#F3F4F6] text-[#374151]';
                            $durationText = '18 jam';
                            
                            if ($index == 0) {
                                $durationBadge = 'bg-[#FEE2E2] text-[#991B1B]';
                                $durationText = '4 hari';
                            } elseif ($index == 1) {
                                $durationBadge = 'bg-[#FEF3C7] text-[#92400E]';
                                $durationText = '2 hari';
                            }
                        @endphp
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-[#062447] text-base">
                                #{{ $index + 1 }}
                            </td>
                            <td class="py-4 px-6">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-sm text-[#062447] hover:underline block leading-snug">
                                    {{ $doc->dokumen->dokumen_judul ?? 'Rancangan Dokumen Hukum #' . $doc->dokumen_id }}
                                </a>
                                <span class="text-xs text-gray-400 font-mono block mt-1">
                                    REG-2026-X00{{ $doc->dokumen_id }} • {{ $doc->jenisDokumen->jenis_dokumen ?? 'Perda' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-bold">
                                {{ $doc->subjek->subjek_nama ?? 'Dinas Pekerjaan Umum & Penataan Ruang' }}
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 {{ $durationBadge }} font-bold px-3 py-1 rounded-md text-xs">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{ $durationText }}</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="px-4 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-lg shadow-xs transition-all inline-block">
                                    Review
                                </a>
                            </td>
                        </tr>
                    @empty
                        <!-- Default Mock Rows if No Dynamic Data -->
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-[#062447] text-base">#1</td>
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-sm text-[#062447] block">Rancangan Perda Tata Ruang Wilayah</span>
                                <span class="text-xs text-gray-400 font-mono block mt-1">REG-2026-X001 • Perda</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-bold">Dinas Pekerjaan Umum &amp; Penataan Ruang</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 bg-[#FEE2E2] text-[#991B1B] font-bold px-3 py-1 rounded-md text-xs">
                                    <span>🕒 4 hari</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.approvals') }}" class="px-4 py-1.5 bg-[#062447] text-white font-bold text-xs rounded-lg shadow-xs transition-all inline-block">
                                    Review
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-[#062447] text-base">#2</td>
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-sm text-[#062447] block">SK Walikota Panitia HUT Pariaman</span>
                                <span class="text-xs text-gray-400 font-mono block mt-1">REG-2026-SK042 • SK</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-bold">Sekretariat Daerah</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 bg-[#FEF3C7] text-[#92400E] font-bold px-3 py-1 rounded-md text-xs">
                                    <span>🕒 2 hari</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.approvals') }}" class="px-4 py-1.5 bg-[#062447] text-white font-bold text-xs rounded-lg shadow-xs transition-all inline-block">
                                    Review
                                </a>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/70 transition-all">
                            <td class="py-4 px-6 font-black text-[#062447] text-base">#3</td>
                            <td class="py-4 px-6">
                                <span class="font-extrabold text-sm text-[#062447] block">Perdes Anggaran Desa Naras</span>
                                <span class="text-xs text-gray-400 font-mono block mt-1">REG-2026-PD009 • Perdes</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-gray-700 font-bold">Kantor Desa Naras I</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center gap-1.5 bg-[#F3F4F6] text-[#374151] font-bold px-3 py-1 rounded-md text-xs">
                                    <span>🕒 18 jam</span>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.approvals') }}" class="px-4 py-1.5 bg-[#062447] text-white font-bold text-xs rounded-lg shadow-xs transition-all inline-block">
                                    Review
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Link -->
        <div class="px-6 py-3.5 bg-[#F8FAFC] border-t border-gray-200 text-center">
            <a href="{{ route('documents.approvals') }}" class="text-xs font-bold text-[#062447] hover:underline">
                Lihat Seluruh Antrian (14 Dokumen Lainnya)
            </a>
        </div>
    </div>

    <!-- 3. Section: Rincian per Jenis Dokumen -->
    <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs space-y-4">
        <div class="flex items-center gap-2.5">
            <svg class="w-5 h-5 text-[#062447]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5a2.5 2.5 0 002.5-2.5V7a2 2 0 00-2-2h-1.5a2 2 0 01-2-2V3.055" />
            </svg>
            <h3 class="text-base font-extrabold text-[#062447]">Rincian per Jenis Dokumen</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <!-- Card 1: PERDA / PERWAKO -->
            <div class="bg-[#F8FAFC] rounded-xl p-5 border border-gray-200/80 flex items-end justify-between">
                <div class="space-y-1">
                    <h4 class="text-xs font-extrabold text-gray-500 uppercase">PERDA / PERWAKO</h4>
                    <p class="text-3xl font-black text-[#062447]">12</p>
                    <span class="text-xs text-gray-400 font-medium block">Dokumen Aktif</span>
                </div>
                <div class="text-right border-b-2 border-rose-500 pb-1">
                    <span class="text-xs font-bold text-rose-600 block">4 Mendesak</span>
                </div>
            </div>

            <!-- Card 2: SURAT KEPUTUSAN (SK) -->
            <div class="bg-[#F8FAFC] rounded-xl p-5 border border-gray-200/80 flex items-end justify-between">
                <div class="space-y-1">
                    <h4 class="text-xs font-extrabold text-gray-500 uppercase">SURAT KEPUTUSAN (SK)</h4>
                    <p class="text-3xl font-black text-[#062447]">38</p>
                    <span class="text-xs text-gray-400 font-medium block">Dokumen Aktif</span>
                </div>
                <div class="text-right border-b-2 border-amber-500 pb-1">
                    <span class="text-xs font-bold text-amber-600 block">12 Review</span>
                </div>
            </div>

            <!-- Card 3: PERATURAN DESA -->
            <div class="bg-[#F8FAFC] rounded-xl p-5 border border-gray-200/80 flex items-end justify-between">
                <div class="space-y-1">
                    <h4 class="text-xs font-extrabold text-gray-500 uppercase">PERATURAN DESA</h4>
                    <p class="text-3xl font-black text-[#062447]">09</p>
                    <span class="text-xs text-gray-400 font-medium block">Dokumen Aktif</span>
                </div>
                <div class="text-right border-b-2 border-emerald-500 pb-1">
                    <span class="text-xs font-bold text-emerald-600 block">Selesai 2</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Section: 2-Column Bottom Grid (Aktivitas Terbaru & Kinerja Review Minggu Ini) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left: Aktivitas Terbaru -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs flex flex-col justify-between space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-extrabold text-[#062447]">Aktivitas Terbaru</h3>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <div class="space-y-4 text-xs font-medium text-gray-700">
                <div class="flex items-start gap-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p><strong class="font-extrabold text-[#062447]">Admin Hukum</strong> menyetujui <span class="font-bold">SK Peresmian Taman</span></p>
                        <span class="text-[11px] text-gray-400 block mt-0.5">10 Menit yang lalu</span>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p><strong class="font-extrabold text-[#062447]">Sistem</strong> mengirim notifikasi revisi ke <span class="font-bold">Dinas Kesehatan</span></p>
                        <span class="text-[11px] text-gray-400 block mt-0.5">42 Menit yang lalu</span>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <span class="w-2 h-2 rounded-full bg-blue-500 mt-1.5 flex-shrink-0"></span>
                    <div>
                        <p><strong class="font-extrabold text-[#062447]">OPD Disdikpora</strong> mengunggah draf baru: <span class="font-bold">Kurikulum Lokal v2</span></p>
                        <span class="text-[11px] text-gray-400 block mt-0.5">1 Jam yang lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Kinerja Review Minggu Ini -->
        <div class="bg-white rounded-2xl border border-gray-200/80 p-6 shadow-2xs flex flex-col justify-between space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-extrabold text-[#062447]">Kinerja Review Minggu Ini</h3>
                <span class="bg-[#DCFCE7] text-[#166534] text-xs font-bold px-2.5 py-1 rounded-md flex items-center gap-1">
                    <span>📈 +5.2%</span>
                </span>
            </div>

            <!-- Days Header Bar -->
            <div class="flex items-center justify-between text-[11px] font-bold text-gray-400 uppercase px-2 pt-4">
                <span>SEN</span>
                <span>SEL</span>
                <span>RAB</span>
                <span>KAM</span>
                <span>JUM</span>
                <span>SAB</span>
                <span>MIN</span>
            </div>

            <!-- 2 Summary Boxes at Bottom -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-[#F8FAFC] border border-gray-200 p-4 rounded-xl">
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">WAKTU REVIEW RATA-RATA</span>
                    <p class="text-xl font-black text-[#062447] mt-1">14.2 Jam</p>
                </div>

                <div class="bg-[#F8FAFC] border border-gray-200 p-4 rounded-xl">
                    <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider block">TARGET TERCAPAI</span>
                    <p class="text-xl font-black text-emerald-600 mt-1">92%</p>
                </div>
            </div>
        </div>
    </div>
</div>
