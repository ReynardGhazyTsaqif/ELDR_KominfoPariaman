<x-app-layout>
    <div class="space-y-6">
        <!-- Tab Navigation Bar for Verifiers -->
        @if(Auth::user() && Auth::user()->hasRole(['admin_hukum', 'kabag_hukum', 'super_admin']))
            <div class="flex items-center gap-3 bg-white p-2.5 rounded-2xl shadow-xs border border-gray-100/80">
                <a href="{{ route('documents.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition-all flex items-center gap-2 {{ empty($isApprovalTab) ? 'bg-[#062447] text-white shadow-sm' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span>Repositori Seluruh Dokumen</span>
                </a>
                <a href="{{ route('documents.approvals') }}" class="px-5 py-2.5 rounded-xl text-xs font-extrabold transition-all flex items-center gap-2 {{ !empty($isApprovalTab) ? 'bg-[#062447] text-white shadow-sm' : 'bg-gray-50 text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Antrian Persetujuan Dokumen</span>
                </a>
            </div>
        @endif
        <!-- 1. Top Row: 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total Dokumen -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL DOKUMEN</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($totalCount ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-[#061D38] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 01-2-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>

            <!-- Disetujui -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DISETUJUI</h4>
                    <p class="text-3xl font-black text-emerald-900 mt-1 tracking-tight">{{ number_format($disetujuiCount ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center flex-shrink-0 border border-emerald-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Diproses -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DIPROSES</h4>
                    <p class="text-3xl font-black text-amber-900 mt-1 tracking-tight">{{ number_format($diprosesCount ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center flex-shrink-0 border border-amber-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Ditolak / Revisi -->
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 hover:shadow-md transition-all flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DITOLAK / REVISI</h4>
                    <p class="text-3xl font-black text-rose-900 mt-1 tracking-tight">{{ number_format($ditolakCount ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-700 flex items-center justify-center flex-shrink-0 border border-rose-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Single Combined Toolbar Filter & Search -->
        <form id="filterForm" action="{{ route('documents.index') }}" method="GET" class="bg-white rounded-2xl shadow-xs border border-gray-100/80 p-3.5 flex flex-col md:flex-row items-center gap-3">
            <!-- Search Input (Flex Grow) -->
            <div class="relative flex-1 w-full">
                <input type="text" id="searchInput" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama dokumen atau perihal..."
                       oninput="debouncedSubmit()"
                       class="w-full px-3.5 py-2.5 pl-9 bg-gray-50/60 border border-gray-200 rounded-xl text-xs font-semibold text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <!-- Filter Jenis -->
            <div class="relative w-full md:w-52 flex-shrink-0">
                <select name="jenis" onchange="document.getElementById('filterForm').submit()" class="w-full px-3.5 py-2.5 bg-gray-50/60 border border-gray-200 rounded-xl text-xs font-bold text-gray-700 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                    <option value="">Semua Jenis Dokumen</option>
                    @if(isset($jenisList))
                        @foreach($jenisList as $j)
                            <option value="{{ $j->jenis_dokumen_key }}" {{ ($jenisKey ?? '') == $j->jenis_dokumen_key ? 'selected' : '' }}>
                                {{ $j->jenis_dokumen }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <svg class="w-3.5 h-3.5 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <!-- Filter Status -->
            <div class="relative w-full md:w-56 flex-shrink-0">
                <select name="status" onchange="document.getElementById('filterForm').submit()" class="w-full px-3.5 py-2.5 bg-gray-50/60 border border-gray-200 rounded-xl text-xs font-bold text-gray-700 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                    <option value="">Semua Status Pengajuan</option>
                    @if(isset($statusList))
                        @foreach($statusList as $st)
                            <option value="{{ $st->status_key }}" {{ ($statusKey ?? '') == $st->status_key ? 'selected' : '' }}>
                                {{ $st->status }}
                            </option>
                        @endforeach
                    @endif
                </select>
                <svg class="w-3.5 h-3.5 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <!-- Reset Button if filter active -->
            @if(!empty($search) || !empty($jenisKey) || !empty($statusKey))
                <a href="{{ route('documents.index') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-xl transition-all whitespace-nowrap flex items-center gap-1.5 flex-shrink-0" title="Reset Filter">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Reset Filter</span>
                </a>
            @endif
        </form>

        <script>
            let debounceTimer;
            function debouncedSubmit() {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 400);
            }
            document.addEventListener("DOMContentLoaded", function() {
                const input = document.getElementById('searchInput');
                if (input && input.value) {
                    input.focus();
                    const val = input.value;
                    input.value = '';
                    input.value = val;
                }
            });
        </script>

        <!-- 3. Daftar Dokumen Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">NAMA DOKUMEN</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-6">PERIHAL</th>
                            <th class="py-3.5 px-4 text-center">STATUS DOKUMEN</th>
                            <th class="py-3.5 px-6">OPD/DESA PENGAJU</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @if(isset($documents) && $documents->count() > 0)
                            @foreach($documents as $doc)
                                @php
                                    $docStKey = $doc->status_dokumen_key;
                                    $statusText = $doc->statusDokumen->status ?? ($doc->statusPengajuan->status ?? 'File Terkirim');

                                    if ($docStKey == 6) {
                                        $badgeClass = 'bg-emerald-50 text-emerald-800 border border-emerald-200';
                                    } elseif (in_array($docStKey, [3, 4])) {
                                        $badgeClass = 'bg-rose-50 text-rose-800 border border-rose-200';
                                    } elseif ($docStKey == 5) {
                                        $badgeClass = 'bg-amber-50 text-amber-800 border border-amber-200';
                                    } else {
                                        $badgeClass = 'bg-slate-100 text-slate-800 border border-slate-200';
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-all">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('documents.show', ['id' => $doc->dokumen_id]) }}" class="font-extrabold text-[#061D38] hover:underline block leading-snug">
                                            {{ $doc->dokumen->dokumen_judul ?? 'Dokumen #' . $doc->dokumen_id }}
                                        </a>
                                        <span class="text-[10px] text-gray-400 font-mono font-bold block mt-0.5">
                                            ID: #DOC-{{ str_pad($doc->dokumen_id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-600 font-bold whitespace-nowrap">
                                        {{ $doc->jenisDokumen->jenis_dokumen ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-600 max-w-xs truncate" title="{{ $doc->perihalDokumen->perihal_dokumen ?? '' }}">
                                        {{ $doc->perihalDokumen->perihal_dokumen ?? '-' }}
                                    </td>
                                    <td class="py-4 px-4 text-center whitespace-nowrap">
                                        <span class="inline-block {{ $badgeClass }} font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                            {{ strtoupper($statusText) }}
                                        </span>
                                        <span class="block text-[10px] text-gray-400 font-medium mt-1">
                                            {{ $doc->created_at ? $doc->created_at->format('d M Y, H:i \W\I\B') : '-' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-xs font-bold text-gray-600">
                                        {{ $doc->subjek->unit_kerja ?? $doc->subjek->nama_subjek ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
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
                                <td colspan="6" class="py-12 text-center text-gray-400 font-medium">
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
            @if(isset($documents) && $documents->count() > 0)
                <div class="px-6 py-4 bg-gray-50/60 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-semibold text-gray-500">
                    @if($documents->hasPages())
                        <div class="w-full">
                            {{ $documents->links() }}
                        </div>
                    @else
                        <div>
                            Menampilkan <span class="font-extrabold text-gray-800">{{ $documents->firstItem() ?? 1 }}</span>–<span class="font-extrabold text-gray-800">{{ $documents->lastItem() ?? $documents->count() }}</span> dari <span class="font-extrabold text-gray-800">{{ $documents->total() }}</span> total dokumen
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
