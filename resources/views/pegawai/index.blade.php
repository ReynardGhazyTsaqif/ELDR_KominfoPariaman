<x-app-layout>
    <div class="space-y-6" x-data="{
        showDetailModal: false,
        selectedPegawai: null
    }">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Direktori Pegawai ASN</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">
                    Direktori referensi data pegawai Aparatur Sipil Negara (ASN) Pemerintah Kota Pariaman (Read-Only).
                </p>
            </div>
            <div class="px-4 py-2 bg-blue-50 text-[#062447] text-xs font-extrabold rounded-xl border border-blue-100 flex items-center gap-2">
                <span>ℹ️ Synced with SIASN / Master Data</span>
            </div>
        </div>

        <!-- 1. KPI Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-[#061D38] text-white rounded-2xl p-6 shadow-md flex items-center justify-between">
                <div>
                    <h4 class="font-extrabold text-xs text-blue-200 uppercase tracking-wider">TOTAL PEGAWAI TERDAFTAR</h4>
                    <p class="text-4xl font-black text-white mt-1 tracking-tight">{{ number_format($totalPegawai ?? 0) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white/10 text-white flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5 5 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="font-extrabold text-xs text-gray-400 uppercase tracking-wider">TOTAL UNIT KERJA / OPD</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($unitKerjaList->count()) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#062447] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="font-extrabold text-xs text-gray-400 uppercase tracking-wider">AKSES DIREKTORI</h4>
                    <p class="text-sm font-semibold text-gray-700 mt-1">
                        Dapat diakses oleh seluruh pengguna terautentikasi.
                    </p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Search & Filter Bar -->
        <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-100/80">
            <form method="GET" action="{{ route('pegawai.index') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="relative flex-1 w-full">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari NIP atau nama pegawai..."
                           class="w-full px-4 py-2.5 pl-10 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <select name="unit_kerja" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none cursor-pointer">
                        <option value="">Semua Unit Kerja / OPD</option>
                        @foreach($unitKerjaList as $uk)
                            <option value="{{ $uk->unit_kerja_key }}" {{ ($unitFilter ?? '') == $uk->unit_kerja_key ? 'selected' : '' }}>{{ $uk->unit_kerja_nama }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="px-5 py-2.5 bg-[#062447] text-white font-bold text-xs rounded-xl hover:bg-[#0A3363] transition-all">Filter</button>
                    @if($search || $unitFilter)
                        <a href="{{ route('pegawai.index') }}" class="px-4 py-2.5 bg-gray-100 text-gray-600 font-bold text-xs rounded-xl hover:bg-gray-200 transition-all">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Grid Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">NIP ASN</th>
                            <th class="py-3.5 px-6">NAMA PEGAWAI</th>
                            <th class="py-3.5 px-6">UNIT KERJA / INSTANSI</th>
                            <th class="py-3.5 px-4 text-center">STATUS PEGAWAI</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @forelse($pegawais as $p)
                            @php
                                $namaLengkap = trim(($p->gelar_depan ? $p->gelar_depan . ' ' : '') . $p->nama_pegawai . ($p->gelar_belakang ? ', ' . $p->gelar_belakang : ''));
                                $unitKerjaNama = $p->unitKerja->first()?->unit_kerja_nama ?? '-';
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-mono text-xs font-extrabold text-[#061D38]">
                                    {{ $p->nip }}
                                </td>
                                <td class="py-4 px-6 font-extrabold text-[#061D38]">
                                    {{ $namaLengkap }}
                                </td>
                                <td class="py-4 px-6 text-xs text-gray-600 font-bold">
                                    <span class="inline-block bg-blue-50 text-[#062447] px-2.5 py-1 rounded-lg border border-blue-100">
                                        {{ $unitKerjaNama }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block bg-emerald-50 text-emerald-700 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">
                                        {{ $p->status_pegawai ?? 'PNS' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <button type="button"
                                            @click="selectedPegawai = {
                                                nip: '{{ $p->nip }}',
                                                nama: '{{ addslashes($namaLengkap) }}',
                                                unit: '{{ addslashes($unitKerjaNama) }}',
                                                status: '{{ $p->status_pegawai ?? 'PNS' }}',
                                                jenis: '{{ $p->jenis_pegawai ?? '-' }}',
                                                ttl: '{{ addslashes(($p->tempat_lahir ?? '-') . ', ' . ($p->tanggal_lahir ?? '-')) }}',
                                                alamat: '{{ addslashes($p->alamat ?? '-') }}',
                                                pendidikan: '{{ addslashes(($p->tingkat_pendidikan ?? '-') . ' ' . ($p->jurusan_pendidikan ?? '')) }}'
                                            }; showDetailModal = true"
                                            class="px-3.5 py-1.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold rounded-lg text-xs shadow-xs transition-all">
                                        Detail Pegawai
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400 font-medium">
                                    Tidak ada data pegawai ASN ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $pegawais->links() }}
            </div>
        </div>

        <!-- Detail Pegawai Modal -->
        <div x-show="showDetailModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl space-y-5 border border-gray-100" x-data>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-[#062447] flex items-center justify-center font-black">
                            👤
                        </div>
                        <div>
                            <h3 class="text-base font-extrabold text-[#061D38]">Detail Informasi Pegawai ASN</h3>
                            <p class="text-[11px] text-gray-500 font-medium">Data referensi kepegawaian Kota Pariaman</p>
                        </div>
                    </div>
                    <button type="button" @click="showDetailModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-lg">✕</button>
                </div>

                <template x-if="selectedPegawai">
                    <div class="space-y-4 text-xs font-semibold text-gray-700">
                        <div class="bg-gray-50 p-4 rounded-xl space-y-2 border border-gray-100">
                            <div>
                                <span class="text-gray-400 uppercase text-[10px] font-extrabold block">Nama Lengkap</span>
                                <span class="text-sm font-extrabold text-[#061D38]" x-text="selectedPegawai.nama"></span>
                            </div>
                            <div class="grid grid-cols-2 gap-2 pt-1 border-t border-gray-200/60">
                                <div>
                                    <span class="text-gray-400 uppercase text-[10px] font-extrabold block">NIP</span>
                                    <span class="font-mono text-gray-800" x-text="selectedPegawai.nip"></span>
                                </div>
                                <div>
                                    <span class="text-gray-400 uppercase text-[10px] font-extrabold block">Status Pegawai</span>
                                    <span class="text-emerald-700 font-extrabold" x-text="selectedPegawai.status"></span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2 px-1">
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-400">Unit Kerja / OPD:</span>
                                <span class="text-[#061D38] font-bold text-right" x-text="selectedPegawai.unit"></span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-400">Jenis Pegawai:</span>
                                <span class="text-gray-800 font-bold" x-text="selectedPegawai.jenis"></span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-400">Tempat, Tgl Lahir:</span>
                                <span class="text-gray-800" x-text="selectedPegawai.ttl"></span>
                            </div>
                            <div class="flex justify-between border-b border-gray-100 pb-2">
                                <span class="text-gray-400">Pendidikan:</span>
                                <span class="text-gray-800" x-text="selectedPegawai.pendidikan"></span>
                            </div>
                            <div class="flex justify-between pb-1">
                                <span class="text-gray-400">Alamat:</span>
                                <span class="text-gray-800 text-right" x-text="selectedPegawai.alamat"></span>
                            </div>
                        </div>
                    </div>
                </template>

                <div class="flex justify-end pt-3 border-t border-gray-100">
                    <button type="button" @click="showDetailModal = false" class="px-5 py-2 bg-[#062447] text-white font-bold rounded-xl text-xs shadow-xs">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
