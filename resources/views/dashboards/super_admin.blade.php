<div class="space-y-6">
    <!-- 1. Top 4 Summary Cards (Super Admin System Overview) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: TOTAL PENGAJUAN DOKUMEN -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">TOTAL PENGAJUAN</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($totalCount ?? 0) }}</p>
                <span class="text-[10px] text-gray-400 font-medium block">Total Berkas Terdaftar</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#062447] flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>

        <!-- Card 2: DOKUMEN SEDANG DIPROSES -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">SEDANG DIPROSES</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($diprosesCount ?? 0) }}</p>
                <span class="text-[10px] text-gray-400 font-medium block">Tahap Verifikasi &amp; Review</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </div>
        </div>

        <!-- Card 3: PERLU REVISI -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">PERLU REVISI</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($ditolakCount ?? 0) }}</p>
                <span class="text-[10px] text-gray-400 font-medium block">Menunggu Perbaikan Berkas</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>

        <!-- Card 4: DISETUJUI FINAL (SAH) -->
        <div class="bg-white rounded-2xl p-6 shadow-2xs border border-gray-200/80 hover:shadow-md transition-all flex items-center justify-between">
            <div class="space-y-1">
                <h4 class="text-xs font-extrabold text-gray-500 uppercase tracking-wider block">DISETUJUI FINAL</h4>
                <p class="text-3xl font-black text-[#062447] tracking-tight">{{ number_format($disetujuiCount ?? 0) }}</p>
                <span class="text-[10px] text-gray-400 font-medium block">Telah Disahkan Kabag Hukum</span>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 shadow-2xs">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- 2. Rincian per Jenis Dokumen Table (Alpine.js Pagination: 5 Items/Page) -->
    <div x-data="{
        page: 1,
        pageSize: 5,
        get totalPages() {
            return Math.ceil({{ isset($jenisBreakdown) ? count($jenisBreakdown) : 0 }} / this.pageSize) || 1;
        }
    }" class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs p-6 space-y-4">
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
                        <th class="py-3 px-4 text-center">DIPROSES</th>
                        <th class="py-3 px-4 text-center">PERLU REVISI</th>
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

        @if(isset($jenisBreakdown) && count($jenisBreakdown) > 5)
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

    <!-- 3. Pengajuan Dokumen Terkini Table -->
    <div class="bg-white rounded-2xl border border-gray-200/80 shadow-2xs overflow-hidden">
        <div class="px-6 py-4 bg-[#F8FAFC] border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-base font-extrabold text-[#062447]">Pengajuan Dokumen Terkini</h3>
                <span class="text-xs text-gray-400 font-medium">Monitoring transaksi pengajuan seluruh instansi</span>
            </div>
            <a href="{{ route('documents.index') }}" class="text-xs font-extrabold text-[#062447] hover:underline flex items-center gap-1">
                <span>Lihat Semua Dokumen</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
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
                    @forelse($recentDocuments as $doc)
                        @php
                            $statusText = $doc->statusDokumen->status ?? 'Pengajuan';
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
                                    Detail
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
                                    <p class="text-sm font-bold text-gray-600">Belum ada pengajuan dokumen</p>
                                    <p class="text-xs text-gray-400">Seluruh berkas pengajuan instansi akan ditampilkan di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
