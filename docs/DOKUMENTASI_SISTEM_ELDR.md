# DOKUMENTASI SISTEM ELDR (Elektronik Legal Document Repository)
**Kota Pariaman**

---

## 1. RINGKASAN SISTEM

**ELDR (Elektronik Legal Document Repository)** adalah aplikasi berbasis web yang dirancang khusus untuk mengelola, memverifikasi, dan menyimpankan dokumen produk hukum (seperti Ranperda, Perwako, Surat Keputusan, dll.) di lingkungan Pemerintah Kota Pariaman. 

Sistem ini menghubungkan Organisasi Perangkat Daerah (OPD) dan Pemerintah Desa dengan Bagian Hukum Sekretariat Daerah Kota Pariaman secara digital, terstruktur, aman, dan dapat diaudit secara real-time (*audit trail*).

### Tujuan Utama
1. **Digitalisasi Alur Pengajuan Produk Hukum**: Menggantikan proses pengajuan fisik manual menjadi serba digital dan terpantau.
2. **Skema Data Audit Trail Per-Kejadian**: Menggunakan arsitektur *Star Schema Data Warehouse* di mana setiap aksi (pengajuan, revisi, penterusan, persetujuan) dicatat sebagai baris fakta baru (append-only), tanpa menimpa data lama.
3. **Mekanisme Relay Revisi Wajib**: Memastikan Kabag Hukum dan OPD/Desa tidak berkomunikasi langsung. Admin Hukum bertindak sebagai *verifikator awal & relay wajib* untuk menyaring catatan revisi Kabag sebelum diteruskan ke OPD.
4. **Keamanan & Scoping Data Ketat**: Mencegah *Insecure Direct Object Reference* (IDOR) dan membatasi akses sesuai peran pengguna (*Role-Based Access Control*).

---

## 2. ARSITEKTUR & TEKNOLOGI

### Tech Stack
- **Framework Utama**: Laravel 11.x (PHP 8.2+)
- **Basis Data**: MySQL / SQLite (Menggunakan Star Schema DW Pattern)
- **Frontend / UI**: Laravel Blade Templates, Vanilla CSS Design System, Tailwind CSS, Alpine.js, Livewire Volt
- **Otorisasi & Autentikasi**: Laravel Breeze, Spatie Laravel-Permission
- **Visualisasi & Ikon**: ApexCharts (KPI Aggregates), Lucide Icons
- **Pengujian Otomatis**: Pest PHP / PHPUnit

---

## 3. MODEL DATA & ARSITEKTUR TABEL (STAR SCHEMA)

Aplikasi ELDR menerapkan arsitektur *Star Schema* untuk efisiensi pelaporan, analisis KPI dashboard, dan keutuhan riwayat audit (*audit trail*).

```
                      +-------------------+
                      |   d_jenis_dokumen |
                      +---------+---------+
                                |
+------------------+  +---------+---------+  +-------------------+
|     d_subjek     |--|ff_pengajuan_dokumen|--| d_perihal_dokumen |
+------------------+  +---------+---------+  +-------------------+
                                |
                      +---------+---------+
                      |     d_dokumen     |
                      +-------------------+
```

### 3.1. Tabel Fakta Transaksional: `ff_pengajuan_dokumen`
- **Primary Key**: `id_fact` (Auto Increment)
- **Grain**: **1 Baris = 1 Kejadian / Aksi Transaksi** (Append-Only, tidak ada perintah `UPDATE` baris lama).
- **Struktur Kolom**:
  - `id_fact` (BIGINT PK)
  - `dokumen_id` (INT) - Thread ID unik yang mengelompokkan 1 berkas pengajuan dari awal hingga final.
  - `subjek_key` (FK -> `d_subjek`) - Actor/Entitas yang melakukan aksi.
  - `dokumen_key` (FK -> `d_dokumen`) - Referensi ke versi fisik berkas dokumen.
  - `jenis_dokumen_key` (FK -> `d_jenis_dokumen`) - Kategori jenis produk hukum.
  - `perihal_dokumen_key` (FK -> `d_perihal_dokumen`) - Uraian perihal dokumen.
  - `status_dokumen_key` (FK -> `d_status_dokumen`) - Kode status teknis dokumen (1-6).
  - `status_pengajuan_key` (FK -> `d_status_pengajuan`) - Kode status tahapan pengajuan (1-4).
  - `catatan_dokumen` (TEXT) - Catatan revisi atau pesan pengaju/verifikator.
  - `keterangan` (VARCHAR) - Label naratif singkat kejadian (misal: "File Terkirim", "Acc Admin Hukum").
  - `tanggal_pengajuan_key` (INT FK -> `d_date`) - Tanggal dimensi (Format: YYYYMMDD).
  - `created_at`, `updated_at` (TIMESTAMP).

### 3.2. Tabel Fakta Agregat: `fa_dashboard`
- **Tujuan**: Menyimpan statistik agregat pra-hitung untuk KPI dashboard cepat tanpa *cost* query agregasi berat.
- **Diperbarui Otomatis**: Melalui Eloquent Observer `PengajuanDokumenObserver`.

### 3.3. Tabel Dimensi Master
1. `d_subjek`: Menyimpan profil pengaju/aktor (Nama, Tipe: Pegawai/Masyarakat, NIP/NIK, Unit Kerja/Desa).
2. `d_dokumen`: Menyimpan metadata berkas fisik (Judul Dokumen, Nama File di Storage).
3. `d_jenis_dokumen`: Master jenis produk hukum (Perda, Perwako, SK, Perdes, dll.).
4. `d_perihal_dokumen`: Master teks perihal dokumen.
5. `d_status_dokumen`: Master status berkas teknis:
   - `1`: ST01 - File Terkirim
   - `2`: ST02 - File Terkirim (Diperbaiki)
   - `3`: ST03 - File Minta Diperbarui
   - `4`: ST04 - File Revisi Dikirim ke OPD (Dengan Lampiran)
   - `5`: ST05 - File Disetujui Admin Hukum
   - `6`: ST06 - File Disetujui Kabag Hukum (Final)
6. `d_status_pengajuan`: Master status alur pengajuan:
   - `1`: SP01 - Pengajuan (Antrian Admin Hukum)
   - `2`: SP02 - Diproses (Antrian Verifikator / Internal Hukum)
   - `3`: SP03 - Ditolak / Perlu Revisi OPD (Antrian OPD/Desa)
   - `4`: SP04 - Disetujui (Selesai/Final)
7. `d_date`: Dimensi tanggal (*Date Dimension*).

---

## 4. PERAN PENGGUNA & HAK AKSES (RBAC)

Sistem menggunakan 5 role utama yang dikelola via Spatie Laravel-Permission:

| Role | Cakupan & Hak Akses |
|:---|:---|
| `super_admin` | **Akses Penuh**. Mengelola User, Master Desa, Master Staf, Master Jenis Dokumen, Master Status Labels, dan melihat seluruh pengajuan. |
| `admin_opd` | **Pengaju OPD**. Mengajukan dokumen baru untuk instansi OPD, melihat antrian revisi OPD, mengirim ulang revisi, dan mengunduh berkas OPD milik sendiri. |
| `admin_desa` | **Pengaju Desa**. Mengajukan dokumen baru untuk Desa, melihat antrian revisi Desa, mengirim ulang revisi, dan mengunduh berkas Desa milik sendiri. |
| `admin_hukum` | **Verifikator Tingkat 1 & Relay Wajib**. Mengulas dokumen masuk awal/revisi, menyetujui (meneruskan ke Kabag), meminta revisi langsung ke OPD, atau meneruskan revisi dari Kabag ke OPD. |
| `kabag_hukum` | **Verifikator Tingkat 2 & Approval Final**. Mengulas dokumen yang disetujui Admin Hukum (ST05), meminta revisi (dikembalikan ke Admin Hukum dulu), atau memberikan Persetujuan Final (ST06). |

---

## 5. STATE MACHINE & ALUR BISNIS (WORKFLOW ENGINE)

Alur persetujuan dokumen tunduk pada aturan state transition berikut:

```
[OPD / Desa] --- Submit / Resubmit ---> (ST01 / ST02) ---> [Admin Hukum Queue]
                                                                |
                                      +-------------------------+-------------------------+
                                      |                                                   |
                            Meminta Revisi Direct                                     Setuju (ST05)
                                      |                                                   |
                                      v                                                   v
                             [OPD / Desa Queue]                                  [Kabag Hukum Queue]
                                                                                          |
                                      +---------------------------------------------------+
                                      |                                                   |
                            Meminta Revisi (ST03)                                     Setuju (ST06)
                                      |                                                   |
                                      v                                                   v
                            [Admin Hukum Relay]                                      [FINAL & LOCKED]
                                      |
                           Admin Klik "Teruskan"
                                      |
                                      v
                             [OPD / Desa Queue]
```

### Aturan Utama State Machine:
1. **Prinsip Relay Wajib Kabag**: Catatan revisi yang dibuat oleh Kabag Hukum (`ST03`/`SP02`) **TIDAK BISA DILIHAT** oleh OPD/Desa pada endpoint mana pun (`show`, `history`, API) sebelum Admin Hukum menekan tombol **"Teruskan ke OPD/Desa"**.
2. **Prinsip Tidak Ada Kontak Langsung**: OPD/Desa yang mengirim ulang dokumen hasil revisi Kabag akan masuk **KEMBALI ke antrian Admin Hukum** (`ST02`/`SP01`), bukan langsung melompat ke Kabag.
3. **Penguncian Dokumen Final (`ST06`)**: Dokumen yang sudah mencapai status `ST06` (Disetujui Kabag Hukum) berstatus **FINAL & IMMUTABLE**. Dokumen ini dikunci dari seluruh aksi revisi, resubmit, maupun approval ulang.

---

## 6. PETA ROUTE & ENDPOINT

Seluruh rute terdefinisi di `routes/web.php` dan `routes/auth.php`:

### Rute Utama Dokumen (`DocumentController`)
- `GET  /dokumen` -> `documents.index` (`auth`) - Repositori & Tab Antrian Persetujuan.
- `GET  /dokumen/detail/{id}` -> `documents.show` (`auth`) - Detail Dokumen & Audit Trail.
- `GET  /dokumen/download/{dokumenKey}` -> `documents.download` (`auth`) - Unduh Berkas Fisik.
- `GET  /dokumen/riwayat` -> `documents.history` (`auth`) - Halaman Audit Trail.
- `GET  /dokumen/create` -> `documents.create` (`auth`, `role:admin_opd|admin_desa|super_admin`) - Form Pengajuan Baru.
- `POST /dokumen/store` -> `documents.store` (`auth`, `role:admin_opd|admin_desa|super_admin`) - Proses Simpan Dokumen Baru.
- `GET  /dokumen/revisi/{id}` -> `documents.revision` (`auth`, `role:admin_hukum|kabag_hukum|super_admin`) - Form Modal Minta Revisi.
- `POST /dokumen/revisi/{dokumenId}` -> `documents.submitRevision` (`auth`, `role:admin_hukum|kabag_hukum|super_admin`) - Kirim Permintaan Revisi.
- `POST /dokumen/teruskan-revisi/{dokumenId}` -> `documents.forwardRevision` (`auth`, `role:admin_hukum|super_admin`) - Teruskan Revisi Kabag ke OPD.
- `POST /dokumen/kirim-ulang/{dokumenId}` -> `documents.resubmit` (`auth`, `role:admin_opd|admin_desa|super_admin`) - Kirim Ulang Berkas Perbaikan OPD.
- `POST /dokumen/approve/{dokumenId}` -> `documents.approve` (`auth`, `role:admin_hukum|kabag_hukum|super_admin`) - Process Approval.

### Rute Manajemen Super Admin Group (`role:super_admin`)
- `GET/POST/PUT/DELETE /users` -> Manajemen Pengguna & Soft Deactivation.
- `GET/POST/PUT/DELETE /master/desa` -> Manajemen Master Data Desa.
- `GET/POST/PUT/DELETE /master/staf` -> Manajemen Master Staf & Masyarakat.
- `GET/POST/PUT/DELETE /master/jenis` -> Manajemen Jenis Dokumen.
- `GET/PUT             /master/status` -> Manajemen Label Status Dokumen & Pengajuan.

### Rute Publik & Utilitas
- `GET  /direktori-pegawai` -> Direktori Pencarian ASN (Read-Only).
- `GET  /login` & `POST /login` -> Autentikasi Pengguna (Dengan Rate Limiter 5x).
- `POST /logout` -> Destruksi Sesi Aman.
- `GET  /register` -> **Di-redirect ke `/login`** (Self-registration dinonaktifkan).

---

## 7. IMPLEMENTASI KEAMANAN (SECURITY HARDENING)

1. **Proteksi IDOR**: Method `isAuthorizedForDocument()` memverifikasi kepemilikan `subjek_key` dokumen sebelum memberi izin `show`, `download`, atau `resubmit`.
2. **Pencegahan Race Condition**: Method `submit()` menggunakan `PengajuanDokumen::lockForUpdate()->max('dokumen_id')` dalam transaksi DB untuk mencegah duplikasi `dokumen_id` saat request bersamaan.
3. **Validasi File Upload**: 
   - Hanya ekstensi `.doc` dan `.docx` yang diizinkan untuk dokumen pengajuan.
   - Ukuran maksimum file 20 MB.
   - Nama file fisik disanitasi dengan regex `preg_replace('/[^a-zA-Z0-9._-]/', '_', $name)` untuk mencegah Path Traversal.
4. **Proteksi Brute-Force**: LoginRequest menerapkan `RateLimiter` 5 kali percobaan berturut-turut per username/IP.
5. **Escape Output XSS**: Semua output Blade menggunakan `{{ $variable }}` untuk meng-escape script HTML/JS secara otomatis.

---

## 8. PANDUAN PENGUJIANKODING (TESTING GUIDE)

Proyek ini dilengkapi dengan suite pengujian otomatis komprehensif menggunakan Pest PHP:

```bash
# Jalankan seluruh test suite
php artisan test

# Jalankan pengujian alur bisnis end-to-end khusus
php artisan test --filter=ComprehensiveFlowAuditTest

# Jalankan pengujian keamanan & fix bug
php artisan test --filter=BugFixesTest

# Jalankan pengujian manajemen super admin
php artisan test --filter=SuperAdminManagementTest

# Jalankan pengujian N+1 query performance
php artisan test --filter=PerformanceQueryCountTest
```

---

## 9. PANDUAN DEPLOYMENT & PRODUCTION CHECKLIST

### Langkah Pemasangan Pertama Kali (Fresh Deployment):
1. **Clone Repository & Install Dependencies**:
   ```bash
   composer install --no-dev --optimize-autoloader
   npm install && npm run build
   ```
2. **Salin `.env` & Generate App Key**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. **Atur Database di `.env`**:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eldr_pariaman
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```
4. **Jalankan Migrasi & Seeder Master Data**:
   ```bash
   php artisan migrate:fresh --seed --force
   ```
5. **Buat Symlink Storage**:
   ```bash
   php artisan storage:link
   ```
6. **Jalankan Cache Produksi**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---
*Dokumentasi ini disusun secara otomatis berdasarkan inspeksi kode sumber dan pengujian terverifikasi pada aplikasi ELDR Kota Pariaman.*
