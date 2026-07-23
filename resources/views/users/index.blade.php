<x-app-layout>
    <div class="space-y-6" x-data="{
        showModal: false,
        modalTitle: 'Tambah User Baru',
        isEdit: false,
        editUrl: '',
        form: { name: '', username: '', email: '', password: '', role: 'admin_opd', tipe_login: 'pegawai' },
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
                <h2 class="text-2xl font-black text-[#061D38] tracking-tight">Manajemen Pengguna Sistem (Users)</h2>
                <p class="text-xs font-semibold text-gray-500 mt-1">Kelola data pengguna, hak akses role (Spatie), dan status akun internal ELDR Kota Pariaman.</p>
            </div>
            <button @click="isEdit = false; modalTitle = 'Tambah User Baru'; form = { name: '', username: '', email: '', password: '', role: 'admin_opd', tipe_login: 'pegawai' }; showModal = true"
                    type="button"
                    class="px-5 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-xs rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>+ Tambah User</span>
            </button>
        </div>

        <!-- 1. KPI Summary Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">TOTAL USER TERDAFTAR</h4>
                    <p class="text-3xl font-black text-[#061D38] mt-1 tracking-tight">{{ number_format($totalUsers) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#062447] flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">AKUN AKTIF</h4>
                    <p class="text-3xl font-black text-emerald-600 mt-1 tracking-tight">{{ number_format($activeUsers) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">AKUN NONAKTIF</h4>
                    <p class="text-3xl font-black text-rose-600 mt-1 tracking-tight">{{ number_format($inactiveUsers) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-xs border border-gray-100/80 flex items-center justify-between">
                <div>
                    <h4 class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">PERANAN (ROLES)</h4>
                    <p class="text-3xl font-black text-purple-600 mt-1 tracking-tight">{{ number_format($roles->count()) }}</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- 2. Search & Filter Bar -->
        <div class="bg-white rounded-2xl p-4 shadow-xs border border-gray-100/80">
            <form method="GET" action="{{ route('users.index') }}" class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="relative flex-1 w-full">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari NIP / Username / Nama / Email..."
                           class="w-full px-4 py-2.5 pl-10 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <select name="role" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none cursor-pointer">
                        <option value="">Semua Role</option>
                        @foreach($roles as $r)
                            <option value="{{ $r->name }}" {{ ($roleFilter ?? '') == $r->name ? 'selected' : '' }}>
                                {{ str_replace('_', ' ', strtoupper($r->name)) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="px-5 py-2.5 bg-[#062447] text-white font-bold text-xs rounded-xl hover:bg-[#0A3363] transition-all">Filter</button>
                    @if($search || $roleFilter)
                        <a href="{{ route('users.index') }}" class="px-4 py-2.5 bg-gray-100 text-gray-600 font-bold text-xs rounded-xl hover:bg-gray-200 transition-all">Reset</a>
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
                            <th class="py-3.5 px-6">USERNAME / NIP</th>
                            <th class="py-3.5 px-6">NAMA LENGKAP &amp; EMAIL</th>
                            <th class="py-3.5 px-6">ROLE (HAK AKSES)</th>
                            <th class="py-3.5 px-4 text-center">STATUS HAK AKSES</th>
                            <th class="py-3.5 px-6 text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-semibold text-gray-700">
                        @forelse($users as $u)
                            @php
                                $roleName = $u->roles->first()?->name ?? 'user';
                            @endphp
                            <tr class="hover:bg-gray-50/50 transition-all">
                                <td class="py-4 px-6 font-mono text-xs font-extrabold text-[#061D38]">
                                    {{ $u->username }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="block font-extrabold text-[#061D38]">{{ $u->name }}</span>
                                    <span class="text-xs text-gray-400 font-normal block">{{ $u->email }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-block bg-blue-50 text-[#062447] text-xs font-bold px-2.5 py-1 rounded-lg border border-blue-100">
                                        {{ str_replace('_', ' ', $roleName) }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($u->is_active)
                                        <span class="inline-block bg-emerald-50 text-emerald-600 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Aktif</span>
                                    @else
                                        <span class="inline-block bg-rose-50 text-rose-600 font-extrabold px-3 py-1 rounded-full text-[10px] uppercase tracking-wider">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                                @click="isEdit = true; editUrl = '{{ route('users.update', ['id' => $u->id]) }}'; modalTitle = 'Edit User: {{ addslashes($u->name) }}'; form = { name: '{{ addslashes($u->name) }}', username: '{{ addslashes($u->username) }}', email: '{{ addslashes($u->email) }}', password: '', role: '{{ $roleName }}', tipe_login: '{{ $u->tipe_login }}' }; showModal = true"
                                                class="px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-lg text-xs transition-all">
                                            Edit
                                        </button>

                                        <form action="{{ route('users.toggleStatus', ['id' => $u->id]) }}" method="POST">
                                            @csrf
                                            <button type="button"
                                                    @click="triggerConfirm('Konfirmasi Ubah Status', 'Apakah Anda yakin ingin mengubah status aktif user {{ addslashes($u->name) }}?', $el.closest('form'))"
                                                    class="px-3 py-1.5 {{ $u->is_active ? 'bg-amber-50 hover:bg-amber-100 text-amber-700' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700' }} font-bold rounded-lg text-xs transition-all cursor-pointer">
                                                {{ $u->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        <form action="{{ route('users.destroy', ['id' => $u->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    @click="triggerConfirm('Konfirmasi Hapus User', 'Apakah Anda yakin ingin menghapus data user {{ addslashes($u->name) }}? Tindakan ini tidak dapat dibatalkan.', $el.closest('form'))"
                                                    class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold rounded-lg text-xs transition-all cursor-pointer">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-400 font-medium">
                                    Tidak ada data user ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $users->links() }}
            </div>
        </div>

        <!-- Modal Form Create / Edit User -->
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl space-y-5 border border-gray-100">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                    <h3 class="text-base font-extrabold text-[#061D38]" x-text="modalTitle"></h3>
                    <button type="button" @click="showModal = false" class="text-gray-400 hover:text-gray-600 font-bold text-lg">✕</button>
                </div>

                <form :action="isEdit ? editUrl : '{{ route('users.store') }}'" method="POST" class="space-y-4">
                    @csrf
                    <template x-if="isEdit">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap User</label>
                        <input type="text" name="name" x-model="form.name" required placeholder="Masukkan nama lengkap" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Username (NIP / NIK)</label>
                        <input type="text" name="username" x-model="form.username" required placeholder="Contoh: 199001012015011001" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Email Resmi</label>
                        <input type="email" name="email" x-model="form.email" required placeholder="contoh@pariamankota.go.id" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">
                            Password <span x-show="isEdit" class="text-gray-400 font-normal lowercase">(kosongkan jika tidak diubah)</span>
                        </label>
                        <input type="password" name="password" x-model="form.password" :required="!isEdit" placeholder="••••••••" class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Role Hak Akses (Spatie)</label>
                        <select name="role" x-model="form.role" required class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                            @foreach($roles as $r)
                                <option value="{{ $r->name }}">{{ str_replace('_', ' ', strtoupper($r->name)) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-1">Tipe Login</label>
                        <select name="tipe_login" x-model="form.tipe_login" required class="w-full px-3.5 py-2.5 bg-white border border-gray-200 rounded-xl text-sm font-semibold focus:outline-none focus:border-[#062447]">
                            <option value="pegawai">Pegawai / ASN</option>
                            <option value="masyarakat">Staf Desa / Masyarakat</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-xs">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-[#062447] hover:bg-[#0A3363] text-white font-extrabold text-xs rounded-xl shadow-md">Simpan User</button>
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
