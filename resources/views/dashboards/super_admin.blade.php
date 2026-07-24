<div class="space-y-6">
    <!-- 1. Top 4 KPI Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pengajuan -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-extrabold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full inline-block">+5% ↗</span>
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">TOTAL PENGAJUAN</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($totalCount ?? 1240) }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>

        <!-- Diproses -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-extrabold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full inline-block">-2% ↘</span>
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">DIPROSES</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($diprosesCount ?? 85) }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
        </div>

        <!-- Perlu Revisi -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-extrabold text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full inline-block">+12% ↗</span>
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">PERLU REVISI</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($ditolakCount ?? 42) }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>

        <!-- Disetujui -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-[10px] font-extrabold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full inline-block">+8% ↗</span>
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">DISETUJUI</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($disetujuiCount ?? 1113) }}</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. Rincian per Jenis Dokumen Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200">
            <h3 class="text-base font-extrabold text-[#062447]">Rincian per Jenis Dokumen</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                        <th class="py-4 px-6">JENIS DOKUMEN</th>
                        <th class="py-4 px-6 text-center">DIPROSES</th>
                        <th class="py-4 px-6 text-center">PERLU REVISI</th>
                        <th class="py-4 px-6 text-center">DISETUJUI</th>
                        <th class="py-4 px-6 text-center">TOTAL</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs font-bold text-gray-700">
                    @if(isset($jenisBreakdown) && $jenisBreakdown->count() > 0)
                        @foreach($jenisBreakdown as $row)
                            <tr class="hover:bg-gray-50/70">
                                <td class="py-4 px-6 font-black text-[#062447]">{{ $row->nama }}</td>
                                <td class="py-4 px-6 text-center"><span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-bold">{{ $row->diproses }}</span></td>
                                <td class="py-4 px-6 text-center"><span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold">{{ $row->revisi }}</span></td>
                                <td class="py-4 px-6 text-center"><span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">{{ $row->disetujui }}</span></td>
                                <td class="py-4 px-6 text-center"><span class="bg-gray-100 text-gray-700 px-3.5 py-1 rounded-full text-xs font-black">{{ $row->total }}</span></td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="hover:bg-gray-50/70">
                            <td class="py-4 px-6 font-black text-[#062447]">Perda/Perwako</td>
                            <td class="py-4 px-6 text-center"><span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-bold">45</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold">12</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">501</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-gray-100 text-gray-700 px-3.5 py-1 rounded-full text-xs font-black">558</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50/70">
                            <td class="py-4 px-6 font-black text-[#062447]">SK/Keputusan Walikota-Sekda</td>
                            <td class="py-4 px-6 text-center"><span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-bold">32</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold">25</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">377</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-gray-100 text-gray-700 px-3.5 py-1 rounded-full text-xs font-black">434</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50/70">
                            <td class="py-4 px-6 font-black text-[#062447]">Perdes/Perkades</td>
                            <td class="py-4 px-6 text-center"><span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-xs font-bold">8</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-rose-100 text-rose-700 px-3 py-1 rounded-full text-xs font-bold">5</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold">235</span></td>
                            <td class="py-4 px-6 text-center"><span class="bg-gray-100 text-gray-700 px-3.5 py-1 rounded-full text-xs font-black">248</span></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- 3. Aktivitas Terbaru Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-base font-extrabold text-[#062447]">Aktivitas Terbaru</h3>
            <a href="{{ route('documents.index') }}" class="text-xs font-bold text-[#062447] hover:underline">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-xs font-extrabold text-gray-500 uppercase tracking-wider bg-[#F8FAFC]">
                        <th class="py-4 px-6">NAMA DOKUMEN</th>
                        <th class="py-4 px-6">OPD / DESA</th>
                        <th class="py-4 px-6">TANGGAL</th>
                        <th class="py-4 px-6 text-center">STATUS</th>
                        <th class="py-4 px-6 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs font-bold text-gray-700">
                    @forelse($recentDocuments as $doc)
                        <tr class="hover:bg-gray-50/70">
                            <td class="py-4 px-6 font-extrabold text-[#062447]">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="hover:underline">
                                    {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-gray-600">{{ $doc->subjek->subjek_nama ?? 'Instansi / OPD' }}</td>
                            <td class="py-4 px-6 text-gray-400 font-normal">{{ $doc->created_at ? $doc->created_at->format('d M Y, H:i') : '-' }}</td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase">
                                    {{ $doc->statusPengajuan->status ?? 'PENGAJUAN' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="text-[#062447] hover:text-blue-600 p-1.5 inline-block">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="hover:bg-gray-50/70">
                            <td class="py-4 px-6 font-extrabold text-[#062447]">Rancangan Perda Tata Ruang 2024</td>
                            <td class="py-4 px-6 text-gray-600">Bappeda Kota Pariaman</td>
                            <td class="py-4 px-6 text-gray-400 font-normal">24 Jun 2024, 14:20</td>
                            <td class="py-4 px-6 text-center"><span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-[10px] font-extrabold">PENGAJUAN</span></td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('documents.index') }}" class="text-[#062447] hover:text-blue-600 p-1.5 inline-block">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
