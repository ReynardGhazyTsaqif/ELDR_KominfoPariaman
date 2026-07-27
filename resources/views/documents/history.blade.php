<x-app-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-black text-[#061D38] tracking-tight">Riwayat Audit Trail Dokumen</h2>
                <p class="text-xs text-gray-500 font-medium mt-1">
                    @if(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa')))
                        Rekam jejak dan audit trail seluruh transaksi pengajuan dokumen milik <span class="font-extrabold text-gray-800">{{ $userSubjek->unit_kerja ?? $userSubjek->nama_subjek }}</span>.
                    @else
                        Rekam jejak dan audit trail seluruh transaksi pengajuan dokumen <span class="font-extrabold text-gray-800">Pemerintah Kota Pariaman</span>.
                    @endif
                </p>
            </div>
            @if(Auth::user() && (Auth::user()->hasRole('admin_opd') || Auth::user()->hasRole('admin_desa') || Auth::user()->hasRole('super_admin')))
                <a href="{{ route('documents.create') }}" class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Pengajuan Baru</span>
                </a>
            @endif
        </div>

        <!-- History Audit Trail List Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">DOKUMEN</th>
                            <th class="py-3.5 px-6">JENIS DOKUMEN</th>
                            <th class="py-3.5 px-6">STATUS DOKUMEN</th>
                            <th class="py-3.5 px-6">CATATAN</th>
                            <th class="py-3.5 px-6 text-center">BERKAS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @if(isset($historyList) && $historyList->count() > 0)
                            @foreach($historyList as $item)
                                @php
                                    $stKey = $item->status_dokumen_key;
                                    $badgeClass = 'bg-slate-100 text-slate-700';
                                    if ($stKey == 6) {
                                        $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-200';
                                    } elseif ($stKey == 5) {
                                        $badgeClass = 'bg-blue-50 text-blue-700 border border-blue-200';
                                    } elseif ($stKey == 3 || $stKey == 4) {
                                        $badgeClass = 'bg-rose-50 text-rose-700 border border-rose-200';
                                    } elseif ($stKey == 1 || $stKey == 2) {
                                        $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-200';
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50/50 transition-all">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('documents.show', ['id' => $item->dokumen_id]) }}" class="font-extrabold text-[#061D38] hover:underline block leading-snug">
                                            {{ $item->dokumen->dokumen_judul ?? 'Dokumen #' . $item->dokumen_id }}
                                        </a>
                                        <span class="text-[10px] text-gray-400 font-mono font-bold block mt-0.5">
                                            ID: #DOC-{{ str_pad($item->dokumen_id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-600 font-bold whitespace-nowrap">
                                        {{ $item->jenisDokumen->jenis_dokumen ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        <span class="inline-block {{ $badgeClass }} font-extrabold px-3 py-1 rounded-full text-[10px] tracking-wider uppercase">
                                            {{ strtoupper($item->statusDokumen->status ?? 'File Terkirim') }}
                                        </span>
                                        <span class="block text-[10px] text-gray-400 font-medium mt-1">
                                            {{ $item->created_at ? $item->created_at->format('d M Y, H:i \W\I\B') : '-' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-xs text-gray-600" title="{{ $item->catatan_dokumen ?? '' }}">
                                        {{ $item->catatan_dokumen ? '"' . $item->catatan_dokumen . '"' : '-' }}
                                    </td>
                                    <td class="py-4 px-6 text-center whitespace-nowrap">
                                        @if($item->dokumen_key)
                                            <a href="{{ route('documents.download', ['dokumenKey' => $item->dokumen_key]) }}" title="Unduh Berkas Word" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-lg text-xs font-bold transition-all">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                                <span>Word</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm font-bold text-gray-600">Belum ada riwayat dokumen pengajuan</p>
                                        <p class="text-xs text-gray-400">Riwayat perbaikan, revisi, dan persetujuan dokumen Anda akan tercatat di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Table Pagination & Footer Bar -->
            @if(isset($historyList) && $historyList->count() > 0)
                <div class="px-6 py-4 bg-gray-50/60 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs font-semibold text-gray-500">
                    @if($historyList->hasPages())
                        <div class="w-full">
                            {{ $historyList->links() }}
                        </div>
                    @else
                        <div>
                            Menampilkan <span class="font-extrabold text-gray-800">{{ $historyList->firstItem() ?? 1 }}</span>–<span class="font-extrabold text-gray-800">{{ $historyList->lastItem() ?? $historyList->count() }}</span> dari <span class="font-extrabold text-gray-800">{{ $historyList->total() }}</span> total dokumen riwayat
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
