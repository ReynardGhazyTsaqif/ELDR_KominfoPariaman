<x-app-layout>
    <div class="max-w-4xl mx-auto py-2">
        <!-- Main Form Card Container -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100/80">
            <!-- Dark Navy Header Strip -->
            <div class="bg-[#062447] text-white px-8 py-5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="text-lg font-extrabold tracking-tight text-white">Pengajuan Dokumen Hukum</h2>
                </div>
                <span class="text-xs font-mono font-semibold text-blue-200 bg-white/10 px-3 py-1 rounded-lg">
                    ID: REG-2026-0042
                </span>
            </div>

            <!-- Form Content Body -->
            <form action="#" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <!-- Row 1: NAMA FILE & JENIS DOKUMEN -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama File -->
                    <div>
                        <label for="nama_file" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            NAMA FILE <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="nama_file" name="nama_file" required
                               placeholder="Masukkan nama file resmi..."
                               class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                    </div>

                    <!-- Jenis Dokumen -->
                    <div>
                        <label for="jenis_dokumen" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                            JENIS DOKUMEN <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="jenis_dokumen" name="jenis_dokumen" required
                                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 appearance-none cursor-pointer transition-all">
                                <option value="" disabled selected>Pilih jenis dokumen...</option>
                                <option value="1">Peraturan Walikota (Perwako)</option>
                                <option value="2">Keputusan Walikota (SK)</option>
                                <option value="3">Peraturan Daerah (Perda)</option>
                                <option value="4">Peraturan Desa (Perdes)</option>
                                <option value="5">Instruksi Dinas / Kadis</option>
                                <option value="6">Standar Operasional (SOP)</option>
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-3.5 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Row 2: UPLOAD FILE Drag & Drop Box -->
                <div>
                    <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                        UPLOAD FILE <span class="text-rose-500">*</span>
                    </label>
                    <div x-data="{ isDragging: false, fileName: '' }"
                         @dragover.prevent="isDragging = true"
                         @dragleave.prevent="isDragging = false"
                         @drop.prevent="isDragging = false; if ($event.dataTransfer.files.length) { fileName = $event.dataTransfer.files[0].name }"
                         class="relative border-2 border-dashed rounded-2xl p-8 text-center cursor-pointer transition-all"
                         :class="isDragging ? 'border-[#062447] bg-blue-50/50' : 'border-gray-300 bg-gray-50/50 hover:bg-gray-50 hover:border-gray-400'">
                        
                        <input type="file" name="file_dokumen" id="file_dokumen" accept=".doc,.docx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                               @change="if ($event.target.files.length) fileName = $event.target.files[0].name">

                        <div class="flex flex-col items-center justify-center gap-2">
                            <div class="w-12 h-12 rounded-full bg-blue-50 text-[#062447] flex items-center justify-center mb-1">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h4 class="text-sm font-bold text-gray-800" x-text="fileName ? fileName : 'Klik untuk unggah atau seret file ke sini'">
                                Klik untuk unggah atau seret file ke sini
                            </h4>
                            <p class="text-xs text-gray-400 font-medium">
                                Wajib format Word (.doc/.docx)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Row 3: PERIHAL -->
                <div>
                    <label for="perihal" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                        PERIHAL <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="perihal" name="perihal" required
                           placeholder="Subjek atau inti ringkasan dokumen..."
                           class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all">
                </div>

                <!-- Row 4: CATATAN -->
                <div>
                    <label for="catatan" class="block text-xs font-extrabold text-gray-700 uppercase tracking-wider mb-2">
                        CATATAN
                    </label>
                    <textarea id="catatan" name="catatan" rows="4"
                              placeholder="Tambahkan instruksi khusus atau catatan untuk verifikator..."
                              class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#062447] focus:ring-2 focus:ring-[#062447]/20 transition-all resize-none"></textarea>
                </div>

                <!-- Warning Alert Box -->
                <div class="bg-amber-50/70 border-l-4 border-amber-500 p-4 rounded-r-xl text-xs text-amber-900 flex items-start gap-3 mt-6 shadow-xs">
                    <div class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <p class="leading-relaxed font-medium">
                        Dokumen yang diajukan akan melalui proses verifikasi oleh bagian hukum sebelum dipublikasikan. Pastikan isi dokumen telah sesuai dengan standar legal formal Pemerintah Kota Pariaman.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-gray-100">
                    <a href="{{ route('dashboard') }}" class="px-6 py-2.5 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold text-sm rounded-xl transition-all shadow-xs">
                        Kembali
                    </a>
                    <button type="submit" class="px-6 py-2.5 bg-[#062447] hover:bg-[#0A3363] text-white font-bold text-sm rounded-xl flex items-center gap-2 shadow-md transition-all cursor-pointer">
                        <svg class="w-4 h-4 text-[#F5BF38]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
