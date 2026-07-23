<x-app-layout>
    <div class="space-y-6">
        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Dokumen -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL DOKUMEN</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($totalCount ?? 0) }}</p>
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
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI</h4>
                    <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">{{ number_format($disetujuiCount ?? 0) }}</p>
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
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DIPROSES</h4>
                    <p class="text-3xl font-black text-amber-600 mt-1 tracking-tight">{{ number_format($diprosesCount ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Ditolak / Revisi -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DITOLAK / REVISI</h4>
                    <p class="text-3xl font-black text-rose-500 mt-1 tracking-tight">{{ number_format($ditolakCount ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-500 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Filter Card Container -->
        <form action="{{ route('documents.index') }}" method="GET" class="bg-white rounded-2xl shadow-xs border border-gray-100/80 p-6 space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Cari Nama / Perihal -->
                <div>
                    <label for="search" class="block text-xs font-bold text-gray-700 mb-2">Cari Nama File / Perihal</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ $search ?? '' }}" placeholder="Masukkan kata kunci..."
                               class="w-full px-3.5 py-2.5 pl-9 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Jenis Dokumen -->
                <div>
                    <label for="jenis" class="block text-xs font-bold text-gray-700 mb-2">Jenis Dokumen</label>
                    <div class="relative">
                        <select id="jenis" name="jenis" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                            <option value="">Semua Jenis Dokumen</option>
                            @if(isset($jenisList))
                                @foreach($jenisList as $j)
                                    <option value="{{ $j->jenis_dokumen_key }}" {{ ($jenisKey ?? '') == $j->jenis_dokumen_key ? 'selected' : '' }}>
                                        {{ $j->jenis_dokumen }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-xs font-bold text-gray-700 mb-2">Status Pengajuan</label>
                    <div class="relative">
                        <select id="status" name="status" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                            <option value="">Semua Status Pengajuan</option>
                            @if(isset($statusList))
                                @foreach($statusList as $st)
                                    <option value="{{ $st->status_key }}" {{ ($statusKey ?? '') == $st->status_key ? 'selected' : '' }}>
                                        {{ $st->status }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <svg class="w-4 h-4 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Buttons Right Aligned -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('documents.index') }}" class="px-5 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-sm rounded-xl transition-all shadow-xs">
                    Reset Filter
                </a>
                <button type="submit" class="px-5 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-sm rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cari Dokumen</span>
                </button>
            </div>
        </form>

        <!-- 3. Daftar Dokumen Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-6">PERIHAL</th>
                            <th class="py-3.5 px-6">TANGGAL UPLOAD</th>
                            <th class="py-3.5 px-4 text-center">STATUS</th>
                            <th class="py-3.5 px-6">OPD/DESA PENGAJU</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @if(isset($documents) && $documents->count() > 0)
                            @foreach($documents as $doc)
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
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center flex-shrink-0 font-black text-[10px]">
                                                DOC
                                            </div>
                                            <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-[#061D38] hover:underline">
                                                {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-600 font-bold">
                                        {{ $doc->jenisDokumen->jenis_dokumen ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-600 max-w-xs truncate" title="{{ $doc->perihalDokumen->perihal_dokumen ?? '' }}">
                                        {{ $doc->perihalDokumen->perihal_dokumen ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-500 font-medium">
                                        {{ $doc->created_at ? $doc->created_at->format('d M Y, H:i') : '-' }}
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <span class="inline-block {{ $badgeClass }} font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                            {{ strtoupper($statusLabel) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-xs font-bold text-gray-600">
                                        {{ $doc->subjek->unit_kerja ?? $doc->subjek->nama_subjek ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" title="Lihat Detail & Audit Trail" class="p-1.5 text-[#061D38] hover:bg-gray-100 rounded-lg transition-all cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            @if($doc->dokumen_key)
                                                <a href="{{ route('documents.download', ['dokumenKey' => $doc->dokumen_key]) }}" title="Unduh Berkas Word" class="p-1.5 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="py-12 text-center text-gray-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-sm font-bold text-gray-600">Belum ada dokumen yang ditemukan</p>
                                        <p class="text-xs text-gray-400">Silakan ajukan dokumen baru atau ubah kriteria pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination Bar -->
            @if(isset($documents) && $documents->hasPages())
                <div class="p-4 bg-gray-50/60 border-t border-gray-100">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
