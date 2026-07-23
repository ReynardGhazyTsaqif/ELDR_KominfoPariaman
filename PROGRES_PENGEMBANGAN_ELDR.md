# Laporan Progres Pengembangan Aplikasi ELDR
**Electronic Legal Document Repository - Diskominfo Kota Pariaman**  
*Dari Kerangka Awal Laravel hingga Versi Terkini*

---

## 📌 Ringkasan Eksekutif

Dokumen ini mencatat seluruh rekam jejak dan histori progres pengembangan aplikasi **ELDR (Electronic Legal Document Repository)** Kota Pariaman. Proyek ini dimulai dari kerangka dasar (*skeleton*) framework **Laravel 13** dan kini telah berkembang menjadi aplikasi repositori serta alur kerja (*workflow*) pengajuan dokumen hukum berfitur lengkap yang didukung oleh arsitektur **Star Schema Data Warehouse**, **Conformed Dimension**, **Spatie RBAC**, **Multi-role Dashboard**, **Approval & Revisi Berjenjang**, **Daftar Dokumen Dinamis**, **Halaman Riwayat OPD**, serta **Modul Master Data Management**.

---

## 🚀 Tahapan & Chronological Progress (Fase demi Fase)

```
[ Kerangka Laravel 13 ] 
       │
       ├──► 1. Arsitektur Data Warehouse & Database Schema (Star Schema)
       ├──► 2. Seeder Data Master, Date Dimension & Multi-Role User
       ├──► 3. Service Layer (SubjekService & DocumentSubmissionService) + Observer Agregasi
       ├──► 4. Custom Autentikasi NIP/NIK & Spatie RBAC Security
       ├──► 5. Antarmuka Dashboard Dynamic Per-Role (Super Admin, OPD/Desa, Admin Hukum, Kabag Hukum)
       ├──► 6. Workflow Pengajuan Dokumen Hukum (.doc/.docx), Verification & Antrian Approval
       ├──► 7. Audit Trail Detail Dokumen & Alur Revisi (Dengan/Tanpa Lampiran File)
       ├──► 8. Manajemen Master Data (Master Desa & Master Status Referensi)
       ├──► 9. Refactoring Komponen, Optimasi UI/UX & Bug Fixing (Alpine.js / Dynamic Routing)
       └──► 10. Daftar Dokumen Dinamis, Riwayat OPD/Desa, Fix Format Word & Sidebar Scoping Role
```

---

### 🟢 Fase 1: Setup Framework & Fondasi Arsitektur Database

- **Framework & Dependencies**:
  - Inisialisasi framework **Laravel 13**, Vite, Livewire, Alpine.js, dan TailwindCSS.
  - Pemasangan package `spatie/laravel-permission` untuk pengelolaan Hak Akses & Peran.
- **Arsitektur Data Warehouse (Star Schema & Conformed Dimension)**:
  - **`d_subjek` (Conformed Dimension)**: Menyatukan identitas pengaju baik dari Pegawai OPD (`d_pegawai` - NIP) maupun Staf Desa (`d_masyarakat` - NIK).
  - **Tabel Dimensi**: `d_unit_kerja` (OPD), `d_desa`, `d_jenis_dokumen`, `d_perihal_dokumen`, `d_status_dokumen`, `d_status_pengajuan`, `d_date`.
  - **Tabel Fakta Transaksional (`ff_pengajuan_dokumen`)**: Menggunakan grain *1 baris per kejadian/aksi* dengan thread `dokumen_id` untuk riwayat lengkap audit trail.
  - **Tabel Fakta Agregat (`fa_dashboard`)**: Untuk kebutuhan performa statistik dashboard secara real-time.
- **Database Migrations & Seeders**:
  - Pembuatan file migrasi dimensi, transaksi, dan fakta (`2026_07_23_000001_create_eldr_dimension_tables.php`, `2026_07_23_000002_create_eldr_transaction_tables.php`, dll).
  - Penyiapan seeder: `RoleAndPermissionSeeder.php`, `MasterDataSeeder.php`, `DateDimensionSeeder.php`, dan `UserSeeder.php`.

---

### 🔵 Fase 2: Service Layer & Event Observer Automations

- **`SubjekService.php`**:
  - Mengelola *upsert* dan pencatatan otomatis record dimensi `d_subjek` saat user (Pegawai NIP / Staf Desa NIK) melakukan pengajuan dokumen.
- **`DocumentSubmissionService.php`**:
  - Menangani alur bisnis transaksional pengajuan dokumen baru, pengiriman ulang revisi, hingga proses approval berjenjang.
- **`PengajuanDokumenObserver.php`**:
  - Mengagregasi data transaksi dari `ff_pengajuan_dokumen` ke tabel fakta agregat `fa_dashboard` setiap kali ada perubahan data/status pengajuan.

---

### 🟡 Fase 3: Autentikasi Custom & Peran Hak Akses (RBAC)

- **Custom Login Form (`LoginForm.php`)**:
  - Mengubah logika autentikasi bawaan email menjadi **Username / NIP / NIK**.
- **Desain UI Halaman Login**:
  - Menyesuaikan antarmuka login dengan identitas visual resmi ELDR Diskominfo Kota Pariaman.
- **Spatie RBAC & Security**:
  - Penerapan middleware role Spatie pada rute-rute aplikasi untuk 5 peran utama:
    1. `super_admin` (Akses penuh master data & sistem)
    2. `admin_opd` (Mengajukan dokumen OPD - NIP)
    3. `admin_desa` (Mengajukan dokumen Desa - NIK)
    4. `admin_hukum` (Verifikasi & rekomendasi revisi/ACC)
    5. `kabag_hukum` (Persetujuan final/ACC & revisi)

---

### 🟠 Fase 4: Antarmuka Dashboard Dynamic Per-Role

- **Pemisahan Dashboard Modular**:
  - Pemisahan Blade View dashboard terpisah untuk tiap role di directory `resources/views/dashboards/`:
    - `super-admin.blade.php`: Overview data master, status sistem, dan manajemen user.
    - `admin-opd.blade.php`: Stat pengajuan dokumen OPD/Desa, ringkasan status, dan tombol pengajuan cepat.
    - `admin-hukum.blade.php`: Dashboard antrian verifikasi Admin Hukum.
    - `kabag-hukum.blade.php`: Dashboard persetujuan final Kepala Bagian Hukum.
- **Visual Design Standard**:
  - Desain modern menggunakan TailwindCSS, kartu statistik dengan indikator trend, badge status dinamis, serta navigasi sidebar interaktif.

---

### 🟣 Fase 5: Alur Pengajuan, Approval Queue, & Detail Audit Trail

- **Form Pengajuan Dokumen (`documents/create.blade.php`)**:
  - Form pengajuan dokumen khusus `admin_opd` & `admin_desa` dengan validasi ekstensi wajib **`.doc` / `.docx`**.
- **Daftar Dokumen (`documents/index.blade.php`)**:
  - Halaman repositori & tabel daftar dokumen dengan pencarian, filter status, filter perihal dokumen, dan paginasi.
- **Antrian Persetujuan (`documents/approvals.blade.php`)**:
  - Halaman antrian kerja khusus `admin_hukum` dan `kabag_hukum` untuk mempercepat pemrosesan dokumen masuk.
- **Detail Dokumen & Audit Trail (`documents/show.blade.php`)**:
  - Menampilkan riwayat transaksi lengkap (*audit trail timeline*) berdasarkan `dokumen_id`.
  - Tombol aksi terintegrasi **Setuju** dan **Revisi** (dengan opsional lampiran berkas coretan perbaikan).
- **Fitur Permintaan Revisi (`documents/revision.blade.php`)**:
  - Halaman/modal khusus verifikator untuk memberikan catatan perbaikan dan mengunggah berkas koreksi.

---

### 🟤 Fase 8: Penambahan Master Staf Desa, Jenis Dokumen, Direktori Pegawai, User Management & Custom Error Pages (Git Pull Update)

- **Manajemen Staf Desa (`master/staf.blade.php`)**:
  - Pengelolaan data master staf/petugas desa (`d_masyarakat`) dilengkapi relasi ke data desa (`d_desa` -> `ft_masyarakat`) dengan opsi modal pencarian & registrasi staf.
- **Manajemen Jenis Dokumen (`master/jenis.blade.php`)**:
  - Pengelolaan data master jenis dokumen hukum (`d_jenis_dokumen`) seperti Perda, Perwako, SK/Keputusan, dan Perdes.
- **Direktori Data Pegawai (`pegawai/index.blade.php`)**:
  - Tampilan repositori dan direktori data pegawai OPD Kota Pariaman (`d_pegawai`) beserta unit kerja (`d_unit_kerja`).
- **Manajemen Pengguna (`users/index.blade.php`)**:
  - Pengelolaan akun pengguna (`users`) beserta pengalokasian peran (*role assignment*) Spatie RBAC.
- **Custom Error Pages (`errors/403.blade.php` & `errors/404.blade.php`)**:
  - Penanganan halaman error kustom berdesain modern bertema ELDR untuk status 403 (Akses Ditolak/Forbidden) dan 404 (Halaman Tidak Ditemukan/Not Found).
- **Integrasi Navigasi Sidebar (`resources/views/layouts/app.blade.php`)**:
  - Penyesuaian dan pengaktifan seluruh link menu sidebar master data, pengguna, dan direktori pegawai.

---

### ⚪ Fase 9: Penanganan Download File Storage, DocumentController, Seeder Pegawai & OPD, serta Verifikasi 100% System

- **`DocumentController.php` & Handler Storage Download**:
  - Implementasi controller transaksional untuk pengajuan berkas, pengiriman revisi, approval berjenjang, serta handler download berkas fisik `.doc`/`.docx` dari storage `documents/`.
- **Integrasi Data Dynamic pada Detail Dokumen (`documents/show.blade.php`)**:
  - Pengikatan data dinamis linimasa audit trail, status dokumen, metadata pengaju, serta tombol download berkas fisik yang terhubung secara riil ke backend.
- **Seeder Data Pegawai & Unit Kerja (`PegawaiUnitKerjaSeeder.php`)**:
  - Penambahan seeder data pegawai (`d_pegawai`) dan unit kerja OPD (`d_unit_kerja`) Kota Pariaman untuk pengujian data riil.
- **Verifikasi 100% Migration, Seeder & 35 Rute Aplikasi**:
  - Menjalankan verifikasi `php artisan migrate:fresh --seed` (7 migration & 5 seeder berjalan tanpa error) dan `php artisan route:list` (35 rute terdaftar dengan bersih).

---

### 🔴 Fase 10: Integrasi Dinamis Daftar Dokumen, Riwayat OPD, Ekstensi Download Berkas Word & Scoping Sidebar Role

- **Dinamisasi Halaman Daftar Dokumen (`documents/index.blade.php`)**:
  - Menghubungkan tabel repositori dokumen dengan query fakta transaksional terbaru (*latest state per thread `dokumen_id`*) melalui `DocumentController@index`.
  - Mengintegrasikan 4 kartu KPI dinamis (`totalCount`, `disetujuiCount`, `diprosesCount`, `ditolakCount`), filter pencarian kata kunci, dropdown jenis dokumen, status pengajuan, dan paginasi *withQueryString*.
  - Menambahkan pembatasan data (*role-based scoping*): Admin OPD/Desa hanya dapat melihat dokumen pengajuan milik instansinya sendiri.
- **Modul Halaman Riwayat OPD & Desa (`documents/history.blade.php`)**:
  - Pembuatan rute `dokumen/riwayat` (`documents.history`) dan view khusus audit trail riwayat transaksi pengajuan, revisi, dan persetujuan secara kronologis untuk instansi pengaju.
- **Perbaikan Ekstensi Unduh Berkas Word (`DocumentController@download`)**:
  - Menambahkan otomatisasi penambahan ekstensi berkas `.doc` / `.docx` berdasarkan berkas fisik di disk storage, sehingga berkas terunduh secara konsisten dalam format Microsoft Word.
- **Penyembunyian Menu Sidebar yang Tidak Digunakan**:
  - Menyembunyikan menu *Penyusunan* dan *Pengaturan* dari sidebar `Admin OPD` dan `Admin Desa`.
  - Mengkhususkan menu Master Data (Desa, Staf Desa, Jenis Dokumen, Status Referensi, Pengaturan User) hanya untuk `Super Admin`.

---

### 🟣 Fase 11: Penyempurnaan Alur Revisi Berjenjang (OPD -> Admin Hukum -> Kabag Hukum -> Admin Hukum -> OPD), Timezone WIB, Fix KPI Cards, & Pagination Arah Panah

- **Penyelarasan Alur Revisi Berjenjang**:
  - Menyempurnakan alur pengembalian revisi dari Kabag Hukum: ketika Kabag Hukum meminta revisi, permintaan tersebut diteruskan lebih dahulu ke Admin Hukum, lalu Admin Hukum meneruskan pesan/koreksi Kabag Hukum ke OPD/Desa melalui tombol `📩 Teruskan Catatan Revisi Kabag ke OPD` dan Modal Pop-up Interaktif.
  - Memperbarui `DocumentSubmissionService::forwardRevisionToOpd` untuk memperbarui status thread menjadi `File Minta Diperbarui` (`status_dokumen_key = 3`) dan `status_pengajuan_key = 3` (Perlu Revisi).
- **Audit Trail Chronological Role Resolution**:
  - Menyempurnakan pembacaan peran aktor pada linimasa audit trail (`show.blade.php`): secara otomatis mendeteksi secara kronologis apakah revisi dilakukan oleh OPD, Admin Hukum, atau Kabag Hukum.
- **Konfigurasi Zona Waktu Lokal Kota Pariaman (WIB / Asia/Jakarta)**:
  - Mengubah timezone bawaan aplikasi di `config/app.php` dan `.env` dari `UTC` menjadi `'Asia/Jakarta'` (WIB, UTC+7), serta locale ke `id`.
- **Penyelarasan Kartu Statistik KPI & Status Thread OPD**:
  - Menyelaraskan logika hitung KPI card dan status badge pada `admin-opd.blade.php`, `admin-hukum.blade.php`, `kabag-hukum.blade.php`, `documents/index.blade.php`, dan `approvals.blade.php`.
  - Dokumen yang memerlukan revisi (`status_dokumen_key == 3` atau `status_pengajuan_key == 3`) secara akurat terhitung di kartu `PERLU REVISI` / `SEDANG DIREVISI` dan tidak lagi keliru terhitung sebagai *Disetujui*.
  - Mengubah scoping query `DocumentController` untuk OPD menjadi berbasis ID Thread (`opdDokumenIds`) agar dokumen yang ditindaklanjuti verifikator tetap selalu muncul pada repositori milik OPD.
- **Penyempurnaan Komponen Pagination Tailwind (`vendor/pagination/tailwind.blade.php`)**:
  - Membuat komponen pagination kustom Tailwind dengan tombol navigasi arah panah yang jelas (`‹ Sebelumnya` di sebelah kiri dan `Berikutnya ›` di sebelah kanan).
- **Pengaturan Akses Sidebar**:
  - Menyembunyikan menu *Direktori Pegawai* dari role Kabag Hukum dan membatasi aksesnya untuk Super Admin.

---

## 📑 Mapping File & Komponen Penting Proyek

| Kategori | Nama File | Deskripsi & Peran |
| :--- | :--- | :--- |
| **Migrations** | `2026_07_23_000001_create_eldr_dimension_tables.php` | Skema tabel-tabel dimensi (`d_subjek`, `d_unit_kerja`, `d_desa`, dll.) |
| | `2026_07_23_000002_create_eldr_transaction_tables.php` | Skema tabel fakta transaksional (`ff_pengajuan_dokumen`) |
| | `2026_07_23_000003_create_fa_dashboard_table.php` | Skema tabel fakta agregat dashboard (`fa_dashboard`) |
| **Controllers & Services** | `app/Http/Controllers/DocumentController.php` | Controller pengajuan, download storage, revisi, approval, & riwayat |
| | `app/Services/SubjekService.php` | Auto-generate & upsert Conformed Dimension `d_subjek` |
| | `app/Services/DocumentSubmissionService.php` | Logika transaksional pengajuan, revisi, & approval berjenjang |
| **Observer & Seeders** | `app/Observers/PengajuanDokumenObserver.php` | Real-time auto sync statistik agregat ke `fa_dashboard` |
| | `database/seeders/PegawaiUnitKerjaSeeder.php` | Seeder data pegawai NIP dan unit kerja OPD |
| | `database/seeders/MasterDataSeeder.php` | Seeder data referensi 6 jenis dokumen, status detail & ringkas |
| **Models** | `app/Models/PengajuanDokumen.php`, `Subjek.php`, dll | Model Eloquent tabel dimensi & fakta |
| **Views** | `resources/views/dashboards/*.blade.php` | Tampilan dashboard spesifik untuk masing-masing role |
| | `resources/views/documents/*.blade.php` | Tampilan Form Pengajuan, Daftar, Antrian, Detail Audit Trail, Revisi, & Riwayat |
| | `resources/views/master/*.blade.php` | Tampilan Master Desa, Staf Desa, Jenis Dokumen, & Status Referensi |
| | `resources/views/pegawai/index.blade.php` | Tampilan Direktori Data Pegawai |
| | `resources/views/users/index.blade.php` | Tampilan Manajemen Pengguna & Spatie RBAC |
| | `resources/views/errors/*.blade.php` | Halaman Custom Error 403 & 404 |
| | `resources/views/vendor/pagination/*.blade.php` | Custom Pagination Component Tailwind (Arah Panah Kiri/Kanan) |
| **Routes** | `routes/web.php` | Konfigurasi 36 rute aplikasi & proteksi RBAC Spatie |

---

## 📊 Summary Status Progres Terkini (100% SELESAI)

- [x] Kerangka Dasar Framework Laravel 13
- [x] Perancangan Data Warehouse & Star Schema Database
- [x] Autentikasi NIP/NIK & Spatie Role-Based Access Control (RBAC)
- [x] Service Layer & Automated Dashboard Aggregation Observer
- [x] Multi-Role Dashboards (Super Admin, OPD/Desa, Admin Hukum, Kabag Hukum)
- [x] Form Pengajuan Dokumen Hukum (`.doc` / `.docx`)
- [x] Repositori & Filter Dinamis Daftar Dokumen Hukum
- [x] Modul Audit Trail Halaman Riwayat OPD & Desa (`/dokumen/riwayat`)
- [x] Antrian Persetujuan & Workflow Approval Berjenjang
- [x] Audit Trail Timeline & Fitur Revisi Berkas Berjenjang (Forward Kabag -> Admin -> OPD)
- [x] Konfigurasi Timezone Local Waktu Indonesia Barat (WIB / Asia/Jakarta)
- [x] Synced KPI Cards & Thread-Based Scoping untuk OPD & Verifikator
- [x] Custom Tailwind Pagination Component (Arah Panah Kiri/Kanan Presisi)
- [x] Penanganan Unduh Berkas Word Format `.doc` / `.docx`
- [x] Manajemen Master Data (Desa, Staf Desa, Jenis Dokumen, Status Referensi)
- [x] Direktori Data Pegawai & Manajemen Akun Pengguna (Users)
- [x] Custom Error Pages (403 Forbidden & 404 Not Found)
- [x] Scoping Menu Sidebar Dynamic Berdasarkan Peran
- [x] Verifikasi 100% Database Migrations, Seeders, & Route List (36 Routes Clean)

---

*Laporan progres ini mencatat kondisi 100% selesai untuk aplikasi ELDR Diskominfo Kota Pariaman.*
