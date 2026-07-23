<x-app-layout>
    <!-- Background Document Context -->
    <div class="relative min-h-[550px] p-6 bg-slate-200/60 rounded-2xl opacity-40 pointer-events-none select-none">
        <div class="flex items-center justify-between border-b border-gray-300 pb-4 mb-6">
            <h2 class="text-xl font-bold text-gray-700">Draf Peraturan Walikota Pariaman No. 42 Tahun 2024</h2>
            <div class="w-8 h-8 rounded-full bg-slate-400"></div>
        </div>
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2 h-96 bg-white rounded-xl shadow-xs"></div>
            <div class="h-96 bg-white rounded-xl shadow-xs"></div>
        </div>
    </div>

    <!-- Kirim Permintaan Revisi Modal Overlay -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 z-50">
        <div class="w-full max-w-xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100/80">
            <!-- Modal Header -->
            <div class="bg-[#062447] text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <h3 class="text-base font-extrabold text-white tracking-tight">Kirim Permintaan Revisi</h3>
                </div>
                <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition-all cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Sub-header Document Info Strip -->
            <div class="bg-[#F6F4EF] px-6 py-3 flex items-center justify-between text-xs border-b border-gray-200/60">
                <div class="flex items-center gap-1.5">
                    <span class="font-extrabold text-gray-500 uppercase tracking-wider">DOKUMEN:</span>
                    <span class="font-bold text-[#062447]">Draf Perwal_Tata_Kelola_Diskominfo_v2.pdf</span>
                </div>
                <span class="inline-flex items-center gap-1.5 bg-amber-100/80 text-amber-800 font-extrabold px-2.5 py-0.5 rounded-full text-[10px] tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                    Menunggu Review
                </span>
            </div>

            <!-- Form Content -->
            <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                @csrf

                <!-- Catatan Revisi -->
                <div>
                    <label for="catatan_revisi" class="block text-xs font-extrabold text-[#062447] uppercase tracking-wider mb-2">
                        CATATAN REVISI
                    </label>
                    <textarea id="catatan_revisi" name="catatan_revisi" rows="4" required
                              placeholder="Berikan detail poin-poin yang perlu diperbaiki oleh Staff pengunggah..."
                              class="w-full px-4 py-3 bg-[#F9FAFB] border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all resize-none"></textarea>
                    <p class="text-[11px] text-gray-400 italic mt-1.5">
                        Mohon sebutkan nomor pasal atau ayat jika revisi bersifat spesifik.
                    </p>
                </div>

                <!-- Upload File Pendukung (Opsional) -->
                <div>
                    <label class="block text-xs font-extrabold text-[#062447] uppercase tracking-wider mb-2">
                        UPLOAD FILE PENDUKUNG (OPSIONAL)
                    </label>
                    <div x-data="{ isDragging: false, fileName: '' }"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; if ($event.dataTransfer.files.length) { fileName = $event.dataTransfer.files[0].name }"
                         class="relative border-2 border-dashed rounded-xl p-6 text-center cursor-pointer transition-all"
                         :class="isDragging ? 'border-[#062447] bg-blue-50/50' : 'border-gray-300 bg-gray-50/50 hover:bg-gray-50 hover:border-gray-400'">
                        
                        <input type="file" name="file_pendukung" id="file_pendukung" accept=".doc,.docx,.pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               @change="if ($event.target.files.length) fileName = $event.target.files[0].name">

                        <div class="flex flex-col items-center justify-center gap-1.5">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-[#062447] flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h4 class="text-xs font-bold text-gray-800" x-text="fileName ? fileName : 'Klik untuk unggah atau seret berkas ke sini'">
                                Klik untuk unggah atau seret berkas ke sini
                            </h4>
                            <p class="text-[10px] text-gray-400 font-medium">
                                Format Word/PDF max 10MB (Draft coretan/markup)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Action Buttons -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-xs uppercase tracking-wider rounded-xl transition-all shadow-xs flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                        </svg>
                        <span>KEMBALI</span>
                    </a>
                    <button type="submit" class="px-5 py-2 bg-[#755900] hover:bg-[#5E4700] text-white font-bold text-xs uppercase tracking-wider rounded-xl flex items-center gap-1.5 shadow-md transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 210.3H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span>KIRIM REVISI</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
