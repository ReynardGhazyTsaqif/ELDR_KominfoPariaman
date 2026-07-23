<x-app-layout>
    <div class="space-y-6" x-data="{
        showModal: false,
        modalTitle: 'Tambah Desa Baru',
        isEdit: false,
        editUrl: '',
        form: { desa_kode: '', desa_nama: '' },
        showConfirm: false,
        confirmTitle: '',
        confirmMessage: '',
        confirmForm: null,
        triggerConfirm(title, message, formElement) {
            this.confirmTitle = title;
            this.confirmMessage = message;
            this.confirmForm = formElement;
            this.showConfirm = true;
        },
        executeConfirm() {
            if (this.confirmForm) {
                if (this.confirmForm.submitted) return;
                this.confirmForm.submitted = true;
                this.confirmForm.submit();
            }
        }
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

        <!-- Page Header & CTA Row -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Master Data Desa (Tabel Dimensi d_desa)</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">Kelola data desa resmi Se-Kota Pariaman yang terhubung ke dalam struktur Star Schema ELDR.</p>
            </div>
            <button @click="isEdit = false; modalTitle = 'Tambah Desa Baru'; form = { desa_kode: '', desa_nama: '' }; showModal = true"
                    type="button"
                    class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>+ Tambah Desa</span>
            </button>
        </div>

        <!-- 1. KPI Summary Card -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL DESA TERDAFTAR</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($totalDesa) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#062447] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DESA AKTIF</h4>
                    <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">{{ number_format($activeDesa) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">DESA NONAKTIF</h4>
                    <p class="text-3xl font-black text-rose-600 mt-1 tracking-tight">{{ number_format($inactiveDesa) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Search Bar -->
        <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-100/80">
            <form method="GET" action="{{ route('master.desa') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="relative flex-1 w-full">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari kode desa atau nama desa..."
                           class="w-full px-4 py-2.5 pl-10 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="submit" class="px-5 py-2.5 bg-[#062447] text-white font-bold text-xs rounded-xl hover:bg-[#0A3363] transition-all">Filter</button>
                    @if($search)
                        <a href="{{ route('master.desa') }}" class="px-4 py-2.5 bg-gray-100 text-gray-600 font-bold text-xs rounded-xl hover:bg-gray-200 transition-all">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Card Container -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-extrabold text-gray-400 uppercase tracking-wider bg-gray-50/50">
                            <th class="py-3.5 px-6">KEY / KODE DESA</th>
                            <th class="py-3.5 px-6">NAMA DESA</th>
                            <th class="py-3.5 px-4 text-center">STATUS SISTEM</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @forelse($desas as $d)
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-mono text-xs font-extrabold text-[#061D38]">
                                    <span class="block">{{ $d->desa_kode ?? 'DESA-'.$d->desa_key }}</span>
                                    <span class="text-[10px] text-gray-400 font-normal">KEY: {{ $d->desa_key }}</span>
                                </td>
                                <td class="py-4 px-6 font-extrabold text-[#061D38]">
                                    {{ $d->desa_nama }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($d->f_status === '1')
                                        <span class="inline-block bg-emerald-50 text-emerald-600 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Aktif</span>
                                    @else
                                        <span class="inline-block bg-rose-50 text-rose-600 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                                @click="isEdit = true; editUrl = '{{ route('master.desa.update', ['id' => $d->desa_key]) }}'; modalTitle = 'Edit Desa: {{ addslashes($d->desa_nama) }}'; form = { desa_kode: '{{ addslashes($d->desa_kode) }}', desa_nama: '{{ addslashes($d->desa_nama) }}' }; showModal = true"
                                                class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-lg text-xs transition-all">
                                            Edit
                                        </button>

                                        <form action="{{ route('master.desa.toggleStatus', ['id' => $d->desa_key]) }}" method="POST">
                                            @csrf
                                            <button type="button"
                                                    @click="triggerConfirm('Konfirmasi Ubah Status Desa', 'Apakah Anda yakin ingin mengubah status aktif desa {{ addslashes($d->desa_nama) }}?', $el.closest('form'))"
                                                    class="px-3 py-1.5 {{ $d->f_status === '1' ? 'bg-amber-50 hover:bg-amber-100 text-amber-700' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700' }} font-bold rounded-lg text-xs transition-all cursor-pointer">
                                                {{ $d->f_status === '1' ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('master.desa.destroy', ['id' => $d->desa_key]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    @click="triggerConfirm('Konfirmasi Hapus Desa', 'Apakah Anda yakin ingin menghapus data desa {{ addslashes($d->desa_nama) }}? Tindakan ini tidak dapat dibatalkan.', $el.closest('form'))"
                                                    class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold rounded-lg text-xs transition-all cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-12 text-center text-gray-400 font-medium">
                                    Tidak ada data desa ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $desas->links() }}
            </div>
        </div>

        <!-- Modal Form Create / Edit Desa -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-5 border border-gray-100">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="text-base font-extrabold text-[#061D38]" x-text="modalTitle"></h3>
                    <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-lg">✕</button>
                </div>

                <form :action="isEdit ? editUrl : '{{ route('master.desa.store') }}'" method="POST" class="space-y-4">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Kode Desa / Kemendagri</label>
                        <input type="text" name="desa_kode" x-model="form.desa_kode" required placeholder="Contoh: 1377012001" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Nama Desa / Kelurahan</label>
                        <input type="text" name="desa_nama" x-model="form.desa_nama" required placeholder="Masukkan nama desa" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md">Simpan Desa</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Custom Confirmation Modal (Alpine.js) -->
        <div x-show="showConfirm" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-5 border border-gray-100 text-center">
                <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto border border-amber-200">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <div class="space-y-1">
                    <h3 class="text-base font-extrabold text-[#061D38]" x-text="confirmTitle"></h3>
                    <p class="text-xs font-semibold text-gray-500 leading-relaxed" x-text="confirmMessage"></p>
                </div>

                <div class="flex items-center justify-center gap-3 pt-2">
                    <button type="button" @click="showConfirm = false" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="button" @click="executeConfirm()" class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md transition-all cursor-pointer">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
