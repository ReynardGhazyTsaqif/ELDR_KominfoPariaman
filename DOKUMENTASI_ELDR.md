# Dokumentasi & Panduan Pengembangan Aplikasi ELDR
**Diskominfo Kota Pariaman (Laravel 13 + Spatie)**

Dokumen ini memuat rangkuman teknis, arsitektur database Star Schema, alur bisnis, serta realisasi kode aplikasi ELDR berdasarkan 5 berkas panduan di folder `PENJELASAN`.

---

## 1. Peran & Pengaturan Hak Akses (Spatie Permission)

| Role | Username / Login | Sumber Data | Kewenangan / Tugas Utama |
| :--- | :--- | :--- | :--- |
| **`super_admin`** | Custom Admin | `users` | Mengelola seluruh data master aplikasi ELDR. |
| **`admin_opd`** | NIP Pegawai | `d_pegawai` | Mengajukan dokumen hukum milik OPD (wajib `.doc` / `.docx`). |
| **`admin_desa`** | NIK Staf Desa | `d_masyarakat` | Mengajukan dokumen hukum milik Desa (staf/petugas desa, bukan warga umum). |
| **`admin_hukum`** | NIP Pegawai | `d_pegawai` | Menindaklanjuti pengajuan (Setuju / Minta Revisi / Minta Revisi + Upload File). |
| **`kabag_hukum`** | NIP Pegawai | `d_pegawai` | Memberikan persetujuan (*ACC*) final atau meminta revisi. |

---

## 2. Arsitektur Data Modeling (Star Schema & Conformed Dimension)

### A. Dimensi Terkonformasi `D_SUBJEK`
- **Tujuan**: Menyatukan *identitas pengaju* baik dari Pegawai OPD (`d_pegawai`) maupun Staf Desa (`d_masyarakat`).
- **Pengisian**: Otomatis (*auto-generate/upsert*) melalui `App\Services\SubjekService`.
- **Struktur**:
  - `nomor_identitas`: NIP / NIK
  - `nama_subjek`: Nama Pegawai / Nama Staf Desa
  - `tipe_subjek`: `"Pegawai"` / `"Masyarakat"`
  - `unit_kerja`: Nama OPD / Nama Desa

### B. Grain Tabel Fakta `FF_PENGAJUAN_DOKUMEN`
- **Prinsip Grain**: **1 Baris per Aksi/Kejadian** dalam alur pengajuan (bukan 1 baris per dokumen).
- **ID Thread (`dokumen_id`)**: Tetap sama untuk seluruh riwayat revisi dan persetujuan pada satu pengajuan dokumen.
- **Histori Otomatis**: Riwayat lengkap dokumen didapatkan dari `SELECT * FROM ff_pengajuan_dokumen WHERE dokumen_id = ? ORDER BY id_fact`.

### C. Pemetaan Status Dokumen (Detail) & Status Pengajuan (Ringkas)

| Kode Detail (`d_status_dokumen`) | Status Dokumen | Dipicu Oleh | Mapped Status Ringkas (`d_status_pengajuan`) |
| :---: | :--- | :--- | :---: |
| **1** | `File Terkirim` | Pengaju kirim dokumen pertama kali | **Pengajuan** |
| **2** | `File Terkirim (Diperbaiki)` | Pengaju kirim ulang setelah revisi | **Pengajuan** |
| **3** | `File Minta Diperbarui` | Admin/Kabag minta revisi tanpa lampiran file | **Ditolak** |
| **4** | `File Revisi` | Admin/Kabag minta revisi dengan lampiran file hasil edit | **Ditolak** |
| **5** | `File Disetujui Admin Hukum` | Admin Hukum ACC -> diteruskan ke Kabag | **Diproses** |
| **6** | `File Disetujui Kabag Hukum` | Kabag Hukum ACC final | **Disetujui** |

---

## 3. Realisasi Kode & Komponen Aplikasi

### A. Service Layer
- **[SubjekService.php](file:///d:/8.%20MAGANG%20RS%20SADIKIN/ELDR/ELDR_KominfoPariaman/app/Services/SubjekService.php)**: Mengelola conformed dimension `d_subjek` dan menghubungkan user login dengan record `d_subjek`.
- **[DocumentSubmissionService.php](file:///d:/8.%20MAGANG%20RS%20SADIKIN/ELDR/ELDR_KominfoPariaman/app/Services/DocumentSubmissionService.php)**: Menangani alur transaksional pengajuan dokumen, revisi (dengan/tanpa lampiran), kirim ulang, serta persetujuan berjenjang Admin Hukum & Kabag Hukum.

### B. Agregasi Dashboard Star Schema
- **[PengajuanDokumenObserver.php](file:///d:/8.%20MAGANG%20RS%20SADIKIN/ELDR/ELDR_KominfoPariaman/app/Observers/PengajuanDokumenObserver.php)**: Secara otomatis mengagregasi data dari `ff_pengajuan_dokumen` ke tabel fakta agregat `fa_dashboard` setiap kali terjadi transaksi pengajuan/perubahan status.

---

## 4. Urutan Migration & Seeder Database

1. `2026_07_23_000001_create_eldr_dimension_tables.php` (Skema tabel dimensi)
2. `0001_01_01_000000_create_users_table.php` (Penyesuaian tabel users)
3. `2026_07_23_000002_create_eldr_transaction_tables.php` (Tabel transaksi & fakta)
4. `2026_07_23_000003_create_fa_dashboard_table.php` (Tabel fakta agregat dashboard)
5. `DatabaseSeeder.php` (Menjalankan `RoleAndPermissionSeeder`, `MasterDataSeeder`, dan `DateDimensionSeeder`)
