<x-app-layout>
    <div class="space-y-6" x-data="{
        showModal: false,
        modalTitle: '',
        updateUrl: '',
        form: { status_kode: '', status: '' }
    }">
        <!-- Flash Alerts -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold rounded-2xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm font-semibold rounded-2xl flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-sm rounded-2xl space-y-1">
                <p class="font-extrabold text-xs uppercase tracking-wider">Terdapat kesalahan pengisian form:</p>
                <ul class="list-disc list-inside text-xs font-semibold">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Page Header -->
        <div>
            <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Master Status Dokumen &amp; Pengajuan</h2>
            <p class="text-xs font-semibold text-gray-500 mt-1">
                Pengaturan deskripsi label visual status dokumen dan status pengajuan sistem ELDR.
            </p>
        </div>

        <!-- Architecture Notice Banner -->
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 shadow-xs flex items-start gap-3.5 text-amber-900">
            <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center font-black text-lg flex-shrink-0">
                ℹ️
            </div>
            <div class="text-xs font-medium leading-relaxed space-y-1">
                <h4 class="font-extrabold text-amber-950 uppercase tracking-wider text-[11px]">PETUNJUK KETENTUAN ARSITEKTUR KODE STATUS:</h4>
                <p>
                    Kunci primary key dan kode status (<span class="font-mono font-bold">ST01–ST06</span> &amp; <span class="font-mono font-bold">SP01–SP04</span>) merupakan acuan logika bertingkat (*skip-level approval*, *final-lock*, &amp; *state-machine*) pada service backend.
                    Demi menjaga integritas sistem, **kode status bersifat Read-Only**. Pengeditan hanya diizinkan untuk mengubah deskripsi/label tampilan visual.
                </p>
            </div>
        </div>

        <!-- Section 1: Tabel Status Dokumen Detail (ST01 - ST06) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden space-y-4 p-6">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-base font-extrabold text-[#061D38]">1. Status Dokumen Detail (ST01 – ST06)</h3>
                <span class="text-xs font-bold text-gray-400">Total: {{ $statusDokumenList->count() }} Status</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3 px-4">KEY</th>
                            <th class="py-3 px-4">KODE STATUS</th>
                            <th class="py-3 px-6">LABEL / DESKRIPSI TAMPILAN VISUAL</th>
                            <th class="py-3 px-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @foreach($statusDokumenList as $sd)
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-3.5 px-4 font-mono text-xs text-gray-400 font-bold">#{{ $sd->status_key }}</td>
                                <td class="py-3.5 px-4 font-mono text-xs font-extrabold text-[#061D38]">
                                    <span class="px-2.5 py-1 bg-blue-50 text-blue-900 rounded-md border border-blue-100">{{ $sd->status_kode }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-extrabold text-[#061D38]">
                                    {{ $sd->status }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <button type="button"
                                            @click="updateUrl = '{{ route('master.status.updateDokumen', ['id' => $sd->status_key]) }}'; modalTitle = 'Edit Label Status: {{ $sd->status_kode }}'; form = { status_kode: '{{ $sd->status_kode }}', status: '{{ addslashes($sd->status) }}' }; showModal = true"
                                            class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-lg text-xs transition-all">
                                        Edit Label
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: Tabel Status Pengajuan Ringkas (SP01 - SP04) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden space-y-4 p-6">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                <h3 class="text-base font-extrabold text-[#061D38]">2. Status Pengajuan Ringkas (SP01 – SP04)</h3>
                <span class="text-xs font-bold text-gray-400">Total: {{ $statusPengajuanList->count() }} Status</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3 px-4">KEY</th>
                            <th class="py-3 px-4">KODE STATUS</th>
                            <th class="py-3 px-6">LABEL / DESKRIPSI TAMPILAN VISUAL</th>
                            <th class="py-3 px-4 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @foreach($statusPengajuanList as $sp)
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-3.5 px-4 font-mono text-xs text-gray-400 font-bold">#{{ $sp->status_key }}</td>
                                <td class="py-3.5 px-4 font-mono text-xs font-extrabold text-[#061D38]">
                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-900 rounded-md border border-amber-100">{{ $sp->status_kode }}</span>
                                </td>
                                <td class="py-3.5 px-6 font-extrabold text-[#061D38]">
                                    {{ $sp->status }}
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    <button type="button"
                                            @click="updateUrl = '{{ route('master.status.updatePengajuan', ['id' => $sp->status_key]) }}'; modalTitle = 'Edit Label Status: {{ $sp->status_kode }}'; form = { status_kode: '{{ $sp->status_kode }}', status: '{{ addslashes($sp->status) }}' }; showModal = true"
                                            class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-lg text-xs transition-all">
                                        Edit Label
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Form Edit Label Status -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-5 border border-gray-100">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="text-base font-extrabold text-[#061D38]" x-text="modalTitle"></h3>
                    <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-lg">✕</button>
                </div>

                <form :action="updateUrl" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Kode Status (Read-Only)</label>
                        <input type="text" x-model="form.status_kode" disabled class="w-full px-3.5 py-2.5 bg-gray-100 border border-gray-200 rounded-xl text-sm font-mono font-bold text-gray-500 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Label / Deskripsi Status</label>
                        <input type="text" name="status" x-model="form.status" required placeholder="Contoh: File Terkirim" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md">Simpan Perubahan Label</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
