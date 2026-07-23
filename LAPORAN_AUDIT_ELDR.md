# LAPORAN AUDIT KODE & ARSITEKTUR PROJECT ELDR
**Aplikasi Pengajuan & Approval Dokumen Hukum — Diskominfo Kota Pariaman**

---

## 1. RINGKASAN UMUM

- **Versi Laravel**: `11.x` (`laravel/framework: ^11.0` pada `composer.json`)
- **Versi PHP**: `^8.2` (Config platform target: `8.2.12`)
- **Stack Breeze & UI**: 
  - **Auth**: Livewire Volt Class / Volt Functional components (`resources/views/livewire/pages/auth/`)
  - **Aplikasi Utama**: Blade Views + TailwindCSS v3 + Alpine.js + Livewire v3
- **Database**: 
  - Konfigurasi default di `.env`: **MySQL** (`DB_CONNECTION=mysql`, `DB_HOST=127.0.0.1`, `DB_PORT=3306`, `DB_DATABASE=eldr_pariaman`)
  - Konfigurasi `.env.example`: SQLite (`DB_CONNECTION=sqlite`)
- **Package Tambahan di `composer.json`**:
  - `livewire/livewire`: `^3.0` (Framework UI reaktif)
  - `livewire/volt`: `^1.0` (Komponen reaktif tunggal Blade/PHP)
  - `spatie/laravel-permission`: `^6.0` (Manajemen Role & Permission RBAC)
  - *Dev Packages*: `laravel/breeze: ^2.0`, `pestphp/pest: ^2.0`, `pestphp/pest-plugin-laravel: ^2.0`, `fakerphp/faker: ^1.23`, `laravel/pint: ^1.13`, `mockery/mockery: ^1.6`, `nunomaduro/collision: ^8.1`
- **Package Tambahan di `package.json`**:
  - `@tailwindcss/forms`: `^0.5.7`
  - `autoprefixer`: `^10.4.16`
  - `concurrently`: `^8.2.2`
  - `laravel-vite-plugin`: `^1.0.0`
  - `postcss`: `^8.4.31`
  - `tailwindcss`: `^3.4.0`
  - `vite`: `^5.0.0`

---

## 2. DATABASE — MIGRATION

Berikut adalah rincian lengkap seluruh 7 file migration di `database/migrations/` disusun secara kronologis:

### 1. File: `0001_01_01_000000_create_users_table.php`

#### Tabel: `users`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `name` | `varchar(255)` | No | - | Nama lengkap user |
| `username` | `varchar(255)` | Yes | `NULL` | Unique index |
| `email` | `varchar(255)` | No | - | Unique index |
| `email_verified_at` | `timestamp` | Yes | `NULL` | Timestamp verifikasi email |
| `password` | `varchar(255)` | No | - | Password ter-hash |
| `subjek_key` | `bigint unsigned` | Yes | `NULL` | Foreign key acuan ke `d_subjek` |
| `tipe_login` | `enum('pegawai','masyarakat')` | No | `'pegawai'` | Tipe entitas login |
| `is_active` | `tinyint(1)` | No | `1` | Status keaktifan akun |
| `remember_token` | `varchar(100)` | Yes | `NULL` | Token ingat saya |
| `created_at` | `timestamp` | Yes | `NULL` | Timestamp pembuat |
| `updated_at` | `timestamp` | Yes | `NULL` | Timestamp perubah |

- **Primary Key**: `id`
- **Foreign Keys**: `subjek_key` dihubungkan secara logikal ke `d_subjek(subjek_key)` via Eloquent relationship.
- **Index Tambahan**: Unique Index pada `username`, Unique Index pada `email`.

#### Tabel: `password_reset_tokens`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `email` | `varchar(255)` | No | - | **Primary Key** |
| `token` | `varchar(255)` | No | - | Token reset password |
| `created_at` | `timestamp` | Yes | `NULL` | Waktu pembuatan token |

- **Primary Key**: `email`

#### Tabel: `sessions`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `varchar(255)` | No | - | **Primary Key** |
| `user_id` | `bigint unsigned` | Yes | `NULL` | Index |
| `ip_address` | `varchar(45)` | Yes | `NULL` | IP address pengguna |
| `user_agent` | `text` | Yes | `NULL` | User agent browser |
| `payload` | `longtext` | No | - | Data sesi terserialisasi |
| `last_activity` | `int` | No | - | Index (timestamp epoch) |

- **Primary Key**: `id`
- **Index Tambahan**: Index pada `user_id`, Index pada `last_activity`.

---

### 2. File: `0001_01_01_000001_create_cache_table.php`

#### Tabel: `cache`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `key` | `varchar(255)` | No | - | **Primary Key** |
| `value` | `mediumtext` | No | - | Nilai cache tersimpan |
| `expiration` | `bigint` | No | - | Index (timestamp kedaluwarsa) |

- **Primary Key**: `key`
- **Index Tambahan**: Index pada `expiration`.

#### Tabel: `cache_locks`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `key` | `varchar(255)` | No | - | **Primary Key** |
| `owner` | `varchar(255)` | No | - | Pemilik kunci lock |
| `expiration` | `bigint` | No | - | Index (timestamp kedaluwarsa) |

- **Primary Key**: `key`
- **Index Tambahan**: Index pada `expiration`.

---

### 3. File: `0001_01_01_000002_create_jobs_table.php`

#### Tabel: `jobs`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `queue` | `varchar(255)` | No | - | Index (nama antrian) |
| `payload` | `longtext` | No | - | Data job |
| `attempts` | `smallint unsigned` | No | - | Jumlah percobaan |
| `reserved_at` | `int unsigned` | Yes | `NULL` | Timestamp diproses |
| `available_at` | `int unsigned` | No | - | Timestamp tersedia |
| `created_at` | `int unsigned` | No | - | Timestamp dibuat |

- **Primary Key**: `id`
- **Index Tambahan**: Index pada `queue`.

#### Tabel: `job_batches`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `varchar(255)` | No | - | **Primary Key** |
| `name` | `varchar(255)` | No | - | Nama batch |
| `total_jobs` | `int` | No | - | Total job |
| `pending_jobs` | `int` | No | - | Job tertunda |
| `failed_jobs` | `int` | No | - | Job gagal |
| `failed_job_ids` | `longtext` | No | - | ID job gagal |
| `options` | `mediumtext` | Yes | `NULL` | Opsi batch |
| `cancelled_at` | `int` | Yes | `NULL` | Timestamp dibatalkan |
| `created_at` | `int` | No | - | Timestamp dibuat |
| `finished_at` | `int` | Yes | `NULL` | Timestamp selesai |

- **Primary Key**: `id`

#### Tabel: `failed_jobs`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `uuid` | `varchar(255)` | No | - | Unique Index |
| `connection` | `text` | No | - | Nama koneksi |
| `queue` | `text` | No | - | Nama queue |
| `payload` | `longtext` | No | - | Payload job |
| `exception` | `longtext` | No | - | Pesan exception |
| `failed_at` | `timestamp` | No | `CURRENT_TIMESTAMP` | Timestamp kegagalan |

- **Primary Key**: `id`
- **Index Tambahan**: Unique Index pada `uuid`, Composite Index pada `(connection, queue, failed_at)`.

---

### 4. File: `2026_07_21_081509_create_permission_tables.php`

#### Tabel: `permissions`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `name` | `varchar(255)` | No | - | Nama permission |
| `guard_name` | `varchar(255)` | No | - | Nama guard (e.g. `web`) |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `id`
- **Index Tambahan**: Unique Composite Index pada `(name, guard_name)`.

#### Tabel: `roles`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `name` | `varchar(255)` | No | - | Nama role |
| `guard_name` | `varchar(255)` | No | - | Guard |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `id`
- **Index Tambahan**: Unique Composite Index pada `(name, guard_name)`.

#### Tabel: `model_has_permissions`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `permission_id` | `bigint unsigned` | No | - | Foreign Key ke `permissions(id)` |
| `model_type` | `varchar(255)` | No | - | Class namespace model |
| `model_id` | `bigint unsigned` | No | - | Primary Key ID model |

- **Primary Key (Composite)**: `(permission_id, model_id, model_type)`
- **Foreign Keys**: `permission_id` -> `permissions(id)` ON DELETE CASCADE
- **Index Tambahan**: Composite Index `model_has_permissions_model_id_model_type_index` pada `(model_id, model_type)`.

#### Tabel: `model_has_roles`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `role_id` | `bigint unsigned` | No | - | Foreign Key ke `roles(id)` |
| `model_type` | `varchar(255)` | No | - | Class namespace model |
| `model_id` | `bigint unsigned` | No | - | Primary Key ID model |

- **Primary Key (Composite)**: `(role_id, model_id, model_type)`
- **Foreign Keys**: `role_id` -> `roles(id)` ON DELETE CASCADE
- **Index Tambahan**: Composite Index `model_has_roles_model_id_model_type_index` pada `(model_id, model_type)`.

#### Tabel: `role_has_permissions`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `permission_id` | `bigint unsigned` | No | - | Foreign Key ke `permissions(id)` |
| `role_id` | `bigint unsigned` | No | - | Foreign Key ke `roles(id)` |

- **Primary Key (Composite)**: `(permission_id, role_id)`
- **Foreign Keys**: 
  - `permission_id` -> `permissions(id)` ON DELETE CASCADE
  - `role_id` -> `roles(id)` ON DELETE CASCADE

---

### 5. File: `2026_07_23_000001_create_eldr_dimension_tables.php`

#### Tabel: `d_desa`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `desa_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `desa_kode` | `varchar(10)` | Yes | `NULL` | Kode unik desa |
| `desa_nama` | `varchar(150)` | No | - | Nama desa/kelurahan |
| `tanggal_mulai` | `date` | Yes | `NULL` | Tmt |
| `tanggal_selesai` | `date` | Yes | `NULL` | Tst |
| `f_status` | `char(1)` | No | `'1'` | Flag status aktif |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `desa_key`

#### Tabel: `d_masyarakat`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `masyarakat_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `nik` | `varchar(30)` | No | - | Unique Index |
| `nama_masyarakat` | `varchar(255)` | No | - | Nama warga |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `masyarakat_key`
- **Index Tambahan**: Unique Index pada `nik`.

#### Tabel: `ft_masyarakat` (Fakta / Pivot Desa & Masyarakat)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id_fact` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `desa_key` | `bigint unsigned` | No | - | Foreign Key ke `d_desa(desa_key)` |
| `masyarakat_key` | `bigint unsigned` | No | - | Foreign Key ke `d_masyarakat(masyarakat_key)` |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `id_fact`
- **Foreign Keys**:
  - `desa_key` -> `d_desa(desa_key)` ON DELETE CASCADE
  - `masyarakat_key` -> `d_masyarakat(masyarakat_key)` ON DELETE CASCADE

#### Tabel: `d_pegawai`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `pegawai_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `pns_id` | `varchar(100)` | Yes | `NULL` | ID SIASN/BKN |
| `nip` | `varchar(30)` | No | - | Unique Index (NIP) |
| `nama_pegawai` | `varchar(255)` | No | - | Nama lengkap |
| `gelar_depan` | `varchar(150)` | Yes | `NULL` | Gelar akademis depan |
| `gelar_belakang` | `varchar(255)` | Yes | `NULL` | Gelar akademis belakang |
| `tempat_lahir` | `varchar(150)` | Yes | `NULL` | Kota lahir |
| `tanggal_lahir` | `date` | Yes | `NULL` | Tanggal lahir |
| `alamat` | `varchar(255)` | Yes | `NULL` | Alamat domisili |
| `no_ktp` | `varchar(30)` | Yes | `NULL` | NIK KTP |
| `agama` | `varchar(150)` | Yes | `NULL` | Agama |
| `tingkat_pendidikan` | `varchar(150)` | Yes | `NULL` | Jenjang (S1/S2/dll) |
| `jurusan_pendidikan` | `varchar(150)` | Yes | `NULL` | Program studi |
| `status_pegawai` | `varchar(150)` | Yes | `NULL` | PNS / PPPK / Honorer |
| `jenis_pegawai` | `varchar(150)` | Yes | `NULL` | Jabatan/Tipe pegawai |
| `foto` | `varchar(150)` | Yes | `NULL` | Path/filename foto |
| `tmt_golongan` | `date` | Yes | `NULL` | TMT Golongan |
| `tmt_jabatan` | `date` | Yes | `NULL` | TMT Jabatan |
| `kode_unit_kerja_siasn` | `varchar(100)` | Yes | `NULL` | Kode unit kerja SIASN |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `pegawai_key`
- **Index Tambahan**: Unique Index pada `nip`.

#### Tabel: `d_unit_kerja`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `unit_kerja_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `unit_kerja_kode` | `varchar(150)` | Yes | `NULL` | Kode unit kerja |
| `unit_kerja_nama` | `varchar(255)` | Yes | `NULL` | Nama unit kerja (OPD) |
| `unit_kerja_status` | `char(1)` | Yes | `NULL` | Status unit kerja |
| `satker_kode` | `varchar(150)` | Yes | `NULL` | Kode satuan kerja |
| `satker_nama` | `varchar(255)` | Yes | `NULL` | Nama satuan kerja |
| `satker_status` | `char(1)` | Yes | `NULL` | Status satker |
| `satker_created_date` | `date` | Yes | `NULL` | Tgl buat satker |
| `bidang_kode` | `varchar(150)` | Yes | `NULL` | Kode bidang |
| `bidang_nama` | `varchar(255)` | Yes | `NULL` | Nama bidang |
| `bidang_created_date` | `date` | Yes | `NULL` | Tgl buat bidang |
| `sub_bidang_kode` | `varchar(150)` | Yes | `NULL` | Kode sub-bidang |
| `sub_bidang_nama` | `varchar(255)` | Yes | `NULL` | Nama sub-bidang |
| `sub_bidang_status` | `char(1)` | Yes | `NULL` | Status sub-bidang |
| `sub_bidang_created_date` | `date` | Yes | `NULL` | Tgl buat sub-bidang |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `unit_kerja_key`

#### Tabel: `ft_pegawai` (Fakta / Pivot Unit Kerja & Pegawai)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `fact_id` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `unit_kerja_key` | `bigint unsigned` | Yes | `NULL` | Foreign Key ke `d_unit_kerja(unit_kerja_key)` |
| `pegawai_key` | `bigint unsigned` | No | - | Foreign Key ke `d_pegawai(pegawai_key)` |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `fact_id`
- **Foreign Keys**:
  - `unit_kerja_key` -> `d_unit_kerja(unit_kerja_key)` ON DELETE SET NULL
  - `pegawai_key` -> `d_pegawai(pegawai_key)` ON DELETE CASCADE

#### Tabel: `d_subjek`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `subjek_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `nomor_identitas` | `varchar(50)` | No | - | Index (NIP/NIK) |
| `nama_subjek` | `varchar(150)` | No | - | Nama pengaju/aktor |
| `tipe_subjek` | `varchar(35)` | No | - | `'Pegawai'` atau `'Masyarakat'` |
| `unit_kerja` | `varchar(255)` | Yes | `NULL` | Nama OPD / Desa asal |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `subjek_key`
- **Index Tambahan**: Index pada `nomor_identitas`.

#### Tabel: `d_jenis_dokumen`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `jenis_dokumen_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `kode_jenis_dokumen` | `varchar(10)` | Yes | `NULL` | Kode jenis (K01, dst) |
| `jenis_dokumen` | `varchar(150)` | No | - | Perwako/Perdes/SK/dll |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `jenis_dokumen_key`

#### Tabel: `d_status_dokumen`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `status_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `status_kode` | `varchar(10)` | Yes | `NULL` | ST01, ST02, dst |
| `status` | `varchar(150)` | No | - | Nama status dokumen |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `status_key`

#### Tabel: `d_status_pengajuan`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `status_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `status_kode` | `varchar(10)` | Yes | `NULL` | SP01, SP02, dst |
| `status` | `varchar(150)` | No | - | Status ringkas (Pengajuan/Diproses/dll) |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `status_key`

#### Tabel: `d_date` (Dimensi Waktu)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `date_key` | `int` | No | - | **Primary Key** (Format `YYYYMMDD`) |
| `date` | `date` | No | - | Unique Index |
| `year` | `int` | No | - | Tahun |
| `month` | `int` | No | - | Bulan (1-12) |
| `month_name` | `varchar(15)` | No | - | Nama bulan |
| `day_of_month` | `int` | No | - | Tanggal bulan (1-31) |
| `day_of_week` | `int` | No | - | Hari minggu (1-7) |
| `day_name` | `varchar(10)` | No | - | Nama hari |
| `is_weekend` | `smallint` | No | `0` | Flag akhir pekan |

- **Primary Key**: `date_key` (bukan auto-increment)
- **Index Tambahan**: Unique Index pada `date`.

---

### 6. File: `2026_07_23_000002_create_eldr_transaction_tables.php`

#### Tabel: `d_dokumen`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `dokumen_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `dokumen_judul` | `text` | No | - | Judul dokumen |
| `nama_file` | `text` | No | - | Filename fisik di storage |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `dokumen_key`

#### Tabel: `d_perihal_dokumen`
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `perihal_dokumen_key` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `perihal_dokumen` | `text` | No | - | Isi ringkasan/perihal |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `perihal_dokumen_key`

#### Tabel: `ff_pengajuan_dokumen` (Tabel Fakta Pengajuan Utama & Audit Trail)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id_fact` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `dokumen_id` | `bigint unsigned` | No | - | Index (Thread ID Pengajuan) |
| `subjek_key` | `bigint unsigned` | No | - | Foreign Key ke `d_subjek(subjek_key)` |
| `dokumen_key` | `bigint unsigned` | No | - | Foreign Key ke `d_dokumen(dokumen_key)` |
| `jenis_dokumen_key` | `bigint unsigned` | No | - | Foreign Key ke `d_jenis_dokumen(jenis_dokumen_key)` |
| `perihal_dokumen_key` | `bigint unsigned` | No | - | Foreign Key ke `d_perihal_dokumen(perihal_dokumen_key)` |
| `catatan_dokumen` | `longtext` | Yes | `NULL` | Catatan revisi/disetujui |
| `keterangan` | `longtext` | Yes | `NULL` | Status deskriptif event |
| `status_pengajuan_key` | `bigint unsigned` | No | - | Foreign Key ke `d_status_pengajuan(status_key)` |
| `status_dokumen_key` | `bigint unsigned` | No | - | Foreign Key ke `d_status_dokumen(status_key)` |
| `tanggal_pengajuan_key` | `int` | Yes | `NULL` | Foreign Key ke `d_date(date_key)` |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `id_fact`
- **Foreign Keys**:
  - `subjek_key` -> `d_subjek(subjek_key)` ON DELETE CASCADE
  - `dokumen_key` -> `d_dokumen(dokumen_key)` ON DELETE CASCADE
  - `jenis_dokumen_key` -> `d_jenis_dokumen(jenis_dokumen_key)` ON DELETE CASCADE
  - `perihal_dokumen_key` -> `d_perihal_dokumen(perihal_dokumen_key)` ON DELETE CASCADE
  - `status_pengajuan_key` -> `d_status_pengajuan(status_key)` ON DELETE CASCADE
  - `status_dokumen_key` -> `d_status_dokumen(status_key)` ON DELETE CASCADE
  - `tanggal_pengajuan_key` -> `d_date(date_key)` ON DELETE SET NULL
- **Index Tambahan**: Index pada `dokumen_id`.

---

### 7. File: `2026_07_23_000003_create_fa_dashboard_table.php`

#### Tabel: `fa_dashboard` (Agregat Dashboard Fact)
| Nama Kolom | Tipe Data | Nullable | Default | Keterangan |
|---|---|---|---|---|
| `id_fact` | `bigint unsigned` | No | Auto-increment | **Primary Key** |
| `status_pengajuan_key` | `bigint unsigned` | No | - | Foreign Key ke `d_status_pengajuan(status_key)` |
| `jenis_dokumen_key` | `bigint unsigned` | No | - | Foreign Key ke `d_jenis_dokumen(jenis_dokumen_key)` |
| `tanggal_pengajuan_key` | `int` | No | - | Foreign Key ke `d_date(date_key)` |
| `total_dokumen_pengajuan` | `int` | No | `0` | Jumlah dokumen terakumulasi |
| `created_at` | `timestamp` | Yes | `NULL` | - |
| `updated_at` | `timestamp` | Yes | `NULL` | - |

- **Primary Key**: `id_fact`
- **Foreign Keys**:
  - `status_pengajuan_key` -> `d_status_pengajuan(status_key)` ON DELETE CASCADE
  - `jenis_dokumen_key` -> `d_jenis_dokumen(jenis_dokumen_key)` ON DELETE CASCADE
  - `tanggal_pengajuan_key` -> `d_date(date_key)` ON DELETE CASCADE

---

### RINGKASAN REKAPITULASI TABEL MIGRATION

1. **Daftar Tabel yang ADA di Migration tapi TIDAK Dipakai di Model Standar Manapun**:
   - `cache`, `cache_locks` (Diakses internal Laravel Cache Engine)
   - `jobs`, `job_batches`, `failed_jobs` (Diakses internal Laravel Queue Worker)
   - `sessions`, `password_reset_tokens` (Diakses internal Session/Auth Handler)
   - `permissions`, `roles`, `model_has_permissions`, `model_has_roles`, `role_has_permissions` (Diakses via package Spatie Permission models, bukan file model tersendiri di `app/Models/`)
   - `ft_masyarakat`, `ft_pegawai` (Merupakan tabel pivot relasi n-to-n antara `d_desa`<->`d_masyarakat` dan `d_unit_kerja`<->`d_pegawai`, diakses via method `belongsToMany()` tanpa model standalone).

2. **Daftar Tabel yang Seharusnya Ada tapi Migration-nya BELUM Dibuat**:
   - **TIDAK ADA**. Semua tabel domain bisnis (`d_desa`, `d_masyarakat`, `d_pegawai`, `d_unit_kerja`, `d_subjek`, `d_jenis_dokumen`, `d_status_dokumen`, `d_status_pengajuan`, `d_date`, `d_dokumen`, `d_perihal_dokumen`, `ff_pengajuan_dokumen`, `fa_dashboard`) telah memiliki file migration yang lengkap dan valid.

---

## 3. MODEL (Eloquent)

Berikut adalah audit lengkap seluruh 14 file model di `app/Models/`:

### 1. Model: `User.php`
- **Tabel**: `users`
- **Primary Key**: `id` (default)
- **Fillable**: `['name', 'username', 'email', 'password', 'subjek_key', 'tipe_login', 'is_active']`
- **Traits**: `HasFactory`, `Notifiable`, `HasRoles` (Spatie Permission)
- **Relasi**:
  - `subjek()`: `belongsTo(Subjek::class, 'subjek_key', 'subjek_key')`
- **Method Custom / Casts**:
  - `casts()`: `email_verified_at` => datetime, `password` => hashed, `is_active` => boolean.

### 2. Model: `Subjek.php`
- **Tabel**: `d_subjek`
- **Primary Key**: `subjek_key`
- **Fillable**: `['nomor_identitas', 'nama_subjek', 'tipe_subjek', 'unit_kerja']`
- **Traits**: Tidak ada
- **Relasi**:
  - `users()`: `hasMany(User::class, 'subjek_key', 'subjek_key')`
  - `pengajuanDokumen()`: `hasMany(PengajuanDokumen::class, 'subjek_key', 'subjek_key')`

### 3. Model: `Pegawai.php`
- **Tabel**: `d_pegawai`
- **Primary Key**: `pegawai_key`
- **Fillable**: `['pns_id', 'nip', 'nama_pegawai', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_ktp', 'agama', 'tingkat_pendidikan', 'jurusan_pendidikan', 'status_pegawai', 'jenis_pegawai', 'foto', 'tmt_golongan', 'tmt_jabatan', 'kode_unit_kerja_siasn']`
- **Traits**: Tidak ada
- **Relasi**:
  - `unitKerja()`: `belongsToMany(UnitKerja::class, 'ft_pegawai', 'pegawai_key', 'unit_kerja_key')`

### 4. Model: `UnitKerja.php`
- **Tabel**: `d_unit_kerja`
- **Primary Key**: `unit_kerja_key`
- **Fillable**: `['unit_kerja_kode', 'unit_kerja_nama', 'unit_kerja_status', 'satker_kode', 'satker_nama', 'satker_status', 'satker_created_date', 'bidang_kode', 'bidang_nama', 'bidang_created_date', 'sub_bidang_kode', 'sub_bidang_nama', 'sub_bidang_status', 'sub_bidang_created_date']`
- **Traits**: Tidak ada
- **Relasi**:
  - `pegawai()`: `belongsToMany(Pegawai::class, 'ft_pegawai', 'unit_kerja_key', 'pegawai_key')`

### 5. Model: `Masyarakat.php`
- **Tabel**: `d_masyarakat`
- **Primary Key**: `masyarakat_key`
- **Fillable**: `['nik', 'nama_masyarakat']`
- **Traits**: Tidak ada
- **Relasi**:
  - `desa()`: `belongsToMany(Desa::class, 'ft_masyarakat', 'masyarakat_key', 'desa_key')`

### 6. Model: `Desa.php`
- **Tabel**: `d_desa`
- **Primary Key**: `desa_key`
- **Fillable**: `['desa_kode', 'desa_nama', 'tanggal_mulai', 'tanggal_selesai', 'f_status']`
- **Traits**: Tidak ada
- **Relasi**:
  - `masyarakat()`: `belongsToMany(Masyarakat::class, 'ft_masyarakat', 'desa_key', 'masyarakat_key')`

### 7. Model: `Dokumen.php`
- **Tabel**: `d_dokumen`
- **Primary Key**: `dokumen_key`
- **Fillable**: `['dokumen_judul', 'nama_file']`
- **Traits**: Tidak ada
- **Relasi**: Tidak ada method relasi langsung di file ini (dihubungkan dari `PengajuanDokumen`).

### 8. Model: `JenisDokumen.php`
- **Tabel**: `d_jenis_dokumen`
- **Primary Key**: `jenis_dokumen_key`
- **Fillable**: `['kode_jenis_dokumen', 'jenis_dokumen']`
- **Traits**: Tidak ada
- **Relasi**: Tidak ada

### 9. Model: `PerihalDokumen.php`
- **Tabel**: `d_perihal_dokumen`
- **Primary Key**: `perihal_dokumen_key`
- **Fillable**: `['perihal_dokumen']`
- **Traits**: Tidak ada
- **Relasi**: Tidak ada

### 10. Model: `StatusDokumen.php`
- **Tabel**: `d_status_dokumen`
- **Primary Key**: `status_key`
- **Fillable**: `['status_kode', 'status']`
- **Traits**: Tidak ada
- **Relasi**: Tidak ada

### 11. Model: `StatusPengajuan.php`
- **Tabel**: `d_status_pengajuan`
- **Primary Key**: `status_key`
- **Fillable**: `['status_kode', 'status']`
- **Traits**: Tidak ada
- **Relasi**: Tidak ada

### 12. Model: `DateDimension.php`
- **Tabel**: `d_date`
- **Primary Key**: `date_key`
- **Property Khusus**: `$incrementing = false`, `$timestamps = false`
- **Fillable**: `['date_key', 'date', 'year', 'month', 'month_name', 'day_of_month', 'day_of_week', 'day_name', 'is_weekend']`
- **Traits**: Tidak ada
- **Relasi**: Tidak ada

### 13. Model: `PengajuanDokumen.php`
- **Tabel**: `ff_pengajuan_dokumen`
- **Primary Key**: `id_fact`
- **Fillable**: `['dokumen_id', 'subjek_key', 'dokumen_key', 'jenis_dokumen_key', 'perihal_dokumen_key', 'catatan_dokumen', 'keterangan', 'status_pengajuan_key', 'status_dokumen_key', 'tanggal_pengajuan_key']`
- **Traits**: Tidak ada
- **Relasi**:
  - `subjek()`: `belongsTo(Subjek::class, 'subjek_key', 'subjek_key')`
  - `dokumen()`: `belongsTo(Dokumen::class, 'dokumen_key', 'dokumen_key')`
  - `jenisDokumen()`: `belongsTo(JenisDokumen::class, 'jenis_dokumen_key', 'jenis_dokumen_key')`
  - `perihalDokumen()`: `belongsTo(PerihalDokumen::class, 'perihal_dokumen_key', 'perihal_dokumen_key')`
  - `statusDokumen()`: `belongsTo(StatusDokumen::class, 'status_dokumen_key', 'status_key')`
  - `statusPengajuan()`: `belongsTo(StatusPengajuan::class, 'status_pengajuan_key', 'status_key')`
  - `dateDimension()`: `belongsTo(DateDimension::class, 'tanggal_pengajuan_key', 'date_key')`

### 14. Model: `DashboardFact.php`
- **Tabel**: `fa_dashboard`
- **Primary Key**: `id_fact`
- **Fillable**: `['status_pengajuan_key', 'jenis_dokumen_key', 'tanggal_pengajuan_key', 'total_dokumen_pengajuan']`
- **Traits**: Tidak ada
- **Relasi**:
  - `statusPengajuan()`: `belongsTo(StatusPengajuan::class, 'status_pengajuan_key', 'status_key')`
  - `jenisDokumen()`: `belongsTo(JenisDokumen::class, 'jenis_dokumen_key', 'jenis_dokumen_key')`
  - `dateDimension()`: `belongsTo(DateDimension::class, 'tanggal_pengajuan_key', 'date_key')`

---

## 4. ROUTES

Berikut adalah isi lengkap seluruh pendaftaran route aplikasi pada `routes/web.php` dan `routes/auth.php` (Catatan: `routes/api.php` **tidak ada** di project ini):

### A. Routes Utama (`routes/web.php`)

```php
// Redirect root ke login
Route::redirect('/', 'login');

// Dashboard Utama
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Dokumen Workflow Routes
Route::get('dokumen', [DocumentController::class, 'index'])
    ->middleware(['auth'])
    ->name('documents.index');

Route::get('dokumen/detail/{id?}', [DocumentController::class, 'show'])
    ->middleware(['auth'])
    ->name('documents.show');

Route::get('dokumen/download/{dokumenKey}', [DocumentController::class, 'download'])
    ->middleware(['auth'])
    ->name('documents.download');

Route::get('dokumen/riwayat', [DocumentController::class, 'history'])
    ->middleware(['auth'])
    ->name('documents.history');

Route::view('dokumen/create', 'documents.create')
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.create');

Route::post('dokumen/store', [DocumentController::class, 'store'])
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.store');

Route::get('dokumen/revisi/{id?}', [DocumentController::class, 'revisionForm'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.revision');

Route::post('dokumen/revisi/{dokumenId}', [DocumentController::class, 'submitRevision'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.submitRevision');

Route::post('dokumen/teruskan-revisi/{dokumenId}', [DocumentController::class, 'forwardRevision'])
    ->middleware(['auth', 'role:admin_hukum|super_admin'])
    ->name('documents.forwardRevision');

Route::post('dokumen/kirim-ulang/{dokumenId}', [DocumentController::class, 'resubmit'])
    ->middleware(['auth', 'role:admin_opd|admin_desa|super_admin'])
    ->name('documents.resubmit');

Route::post('dokumen/approve/{dokumenId}', [DocumentController::class, 'approve'])
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.approve');

Route::view('dokumen/persetujuan', 'documents.approvals')
    ->middleware(['auth', 'role:admin_hukum|kabag_hukum|super_admin'])
    ->name('documents.approvals');

// Master Data Management Routes
Route::view('master/desa', 'master.desa')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.desa');

Route::view('master/staf', 'master.staf')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.staf');

Route::view('master/jenis', 'master.jenis')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.jenis');

Route::view('master/status', 'master.status')
    ->middleware(['auth', 'role:super_admin'])
    ->name('master.status');

// Direktori & Users Routes
Route::view('direktori-pegawai', 'pegawai.index')
    ->middleware(['auth'])
    ->name('pegawai.index');

Route::view('users', 'users.index')
    ->middleware(['auth', 'role:super_admin'])
    ->name('users.index');

// Error & Profile Routes
Route::view('error-404', 'errors.404')
    ->middleware(['auth'])
    ->name('errors.404');

Route::view('error-403', 'errors.403')
    ->middleware(['auth'])
    ->name('errors.403');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
```

### B. Routes Otentikasi (`routes/auth.php`)

```php
Route::middleware('guest')->group(function () {
    Volt::route('register', 'pages.auth.register')->name('register');
    Volt::route('login', 'pages.auth.login')->name('login');
    Volt::route('forgot-password', 'pages.auth.forgot-password')->name('password.request');
    Volt::route('reset-password/{token}', 'pages.auth.reset-password')->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'pages.auth.verify-email')->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Volt::route('confirm-password', 'pages.auth.confirm-password')->name('password.confirm');
    Route::post('logout', [LogoutAction::class, '__invoke'])->name('logout');
});
```

---

## 5. CONTROLLER

Seluruh controller terletak pada folder `app/Http/Controllers/`. Berikut detail setiap method public:

### 1. Class: `App\Http\Controllers\DocumentController`

- **Method: `index(Request $request)`**
  - **Route**: `GET /dokumen` (`documents.index`)
  - **Middleware**: `['auth']`
  - **Validasi**: Tidak ada FormRequest khusus (hanya membaca query params `search`, `jenis`, `status`).
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`), `JenisDokumen` (`d_jenis_dokumen`), `StatusPengajuan` (`d_status_pengajuan`), `SubjekService`.
  - **Ringkasan Logic**:
    1. Mengambil query parameter `search`, `jenis`, `status`.
    2. Jika user ber-role `admin_opd` / `admin_desa`, ambil `subjek_key` pengguna via `SubjekService`, lalu filter hanya `dokumen_id` yang pernah diajukan oleh OPD/Desa tersebut (`whereIn('dokumen_id', $opdDokumenIds)`). Jika verifikator/super admin, ambil seluruh `dokumen_id`.
    3. Ambil `MAX(id_fact)` per `dokumen_id` untuk mengambil status fakta paling mutakhir (latest thread state).
    4. Terapkan filter pencarian pada judul dokumen atau perihal, serta filter jenis dokumen dan status pengajuan.
    5. Urutkan berdasarkan `id_fact` descending dan paginasi 10 baris.
    6. Hitung 4 statistik KPI (`totalCount`, `disetujuiCount`, `diprosesCount`, `ditolakCount`) langsung dari kumpulan fakta terbaru.
  - **Response**: `view('documents.index', [...])`

- **Method: `download($dokumenKey)`**
  - **Route**: `GET /dokumen/download/{dokumenKey}` (`documents.download`)
  - **Middleware**: `['auth']`
  - **Validasi**: Implicit `findOrFail($dokumenKey)`.
  - **Model/Tabel disentuh**: `Dokumen` (`d_dokumen`).
  - **Ringkasan Logic**:
    1. Cari data `Dokumen` berdasarkan `$dokumenKey` (`findOrFail`).
    2. Susun nama berkas yang akan diunduh pengguna beserta ekstensi aslinya.
    3. Cek keberadaan berkas fisik di `storage/app/public/documents/` atau `storage/app/documents/`.
    4. Jika ada, kembalikan HTTP file download response; jika tidak ada, kembalikan pesan error di session.
  - **Response**: `Storage::download()` atau `back()->with('error', ...)`

- **Method: `show($id)`**
  - **Route**: `GET /dokumen/detail/{id?}` (`documents.show`)
  - **Middleware**: `['auth']`
  - **Validasi**: Parameter ID integer optional.
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`) dengan relasi `subjek`, `dokumen`, `jenisDokumen`, `perihalDokumen`, `statusDokumen`, `statusPengajuan`.
  - **Ringkasan Logic**:
    1. Query seluruh baris riwayat `ff_pengajuan_dokumen` yang memiliki `dokumen_id = $id`, diurutkan `id_fact` ascending.
    2. Ambil baris ter-akhir (`$history->last()`) sebagai status fakta terkini.
    3. Tampilkan halaman detail bersama seluruh kronologi audit trail.
  - **Response**: `view('documents.show', [...])`

- **Method: `store(Request $request)`**
  - **Route**: `POST /dokumen/store` (`documents.store`)
  - **Middleware**: `['auth', 'role:admin_opd|admin_desa|super_admin']`
  - **Validasi Input**:
    - `judul_file`: `required|string|max:255`
    - `jenis_dokumen_key`: `required|integer`
    - `perihal`: `required|string`
    - `file_dokumen`: `required|file|mimes:doc,docx|max:20480` (Maks 20MB, format .doc/.docx)
    - `catatan`: `nullable|string`
  - **Model/Tabel disentuh**: `Dokumen` (`d_dokumen`), `PerihalDokumen` (`d_perihal_dokumen`), `PengajuanDokumen` (`ff_pengajuan_dokumen`), `Subjek` (`d_subjek`).
  - **Ringkasan Logic**:
    1. Lakukan validasi input request.
    2. Simpan berkas fisik ke `storage/app/public/documents/` dengan penamaan `time()_sanitized_original_filename`.
    3. Panggil `DocumentSubmissionService::submit(...)` untuk secara otomatis membuat thread `dokumen_id` baru, insert `d_dokumen`, `d_perihal_dokumen`, dan fakta `ff_pengajuan_dokumen` dengan `status_dokumen_key = 1` (File Terkirim) dan `status_pengajuan_key = 1` (Pengajuan).
  - **Response**: `redirect()->route('documents.show', ['id' => $dokumen_id])->with('success', ...)`

- **Method: `revisionForm($id = null)`**
  - **Route**: `GET /dokumen/revisi/{id?}` (`documents.revision`)
  - **Middleware**: `['auth', 'role:admin_hukum|kabag_hukum|super_admin']`
  - **Validasi**: Parameter ID optional.
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`), `Dokumen` (`d_dokumen`).
  - **Ringkasan Logic**:
    1. Tentukan `dokumen_id` acuan.
    2. Ambil data dokumen terkait dan tampilkan form modal permintaan revisi.
  - **Response**: `view('documents.revision', [...])`

- **Method: `submitRevision(Request $request, $dokumenId)`**
  - **Route**: `POST /dokumen/revisi/{dokumenId}` (`documents.submitRevision`)
  - **Middleware**: `['auth', 'role:admin_hukum|kabag_hukum|super_admin']`
  - **Validasi Input**:
    - `catatan_revisi` / `catatan`: `nullable|string`
    - `file_revisi` / `file_pendukung`: `nullable|file|mimes:doc,docx,pdf|max:20480`
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`), `Dokumen` (`d_dokumen`).
  - **Ringkasan Logic**:
    1. Validasi opsi lampiran berkas revisi dan catatan.
    2. Jika ada berkas revisi yang diunggah verifikator, simpan berkas fisik ke disk public dan buat record `d_dokumen` baru.
    3. Panggil `DocumentSubmissionService::requestRevision(...)`.
       - Jika dipanggil **Kabag Hukum**: Buat fakta baru di `ff_pengajuan_dokumen` dengan `status_dokumen_key = 3` (File Minta Diperbarui) dan `status_pengajuan_key = 2` (Diproses — kembali ke antrian Admin Hukum).
       - Jika dipanggil **Admin Hukum**: Buat fakta baru di `ff_pengajuan_dokumen` dengan `status_dokumen_key = 3/4` dan `status_pengajuan_key = 3` (Ditolak / Perlu Revisi OPD).
  - **Response**: `redirect()->route('documents.show', ['id' => $dokumenId])->with('success', ...)`

- **Method: `forwardRevision(Request $request, $dokumenId)`**
  - **Route**: `POST /dokumen/teruskan-revisi/{dokumenId}` (`documents.forwardRevision`)
  - **Middleware**: `['auth', 'role:admin_hukum|super_admin']`
  - **Validasi Input**: `catatan_tambahan`: `nullable|string`
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`).
  - **Ringkasan Logic**:
    1. Ambil fakta mutakhir dari `dokumen_id`.
    2. Gabungkan catatan dari Kabag Hukum dengan catatan tambahan Admin Hukum jika ada.
    3. Panggil `DocumentSubmissionService::forwardRevisionToOpd(...)` untuk mencatat fakta baru dengan `status_dokumen_key = 3` (File Minta Diperbarui) dan `status_pengajuan_key = 3` (Ditolak / Perlu Revisi OPD).
  - **Response**: `redirect()->route('documents.show', ['id' => $dokumenId])->with('success', ...)`

- **Method: `approve(Request $request, $dokumenId)`**
  - **Route**: `POST /dokumen/approve/{dokumenId}` (`documents.approve`)
  - **Middleware**: `['auth', 'role:admin_hukum|kabag_hukum|super_admin']`
  - **Validasi Input**: `catatan`: `nullable|string`
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`).
  - **Ringkasan Logic**:
    1. Cek role user yang sedang login.
    2. Jika user ber-role `kabag_hukum`: Panggil `submissionService->approveKabagHukum(...)` -> Insert fakta `status_dokumen_key = 6` (File Disetujui Kabag Hukum) & `status_pengajuan_key = 4` (Disetujui — Final).
    3. Jika user ber-role `admin_hukum`: Panggil `submissionService->approveAdminHukum(...)` -> Insert fakta `status_dokumen_key = 5` (File Disetujui Admin Hukum) & `status_pengajuan_key = 2` (Diproses — lanjut ke Kabag Hukum).
  - **Response**: `redirect()->route('documents.show', ['id' => $dokumenId])->with('success', ...)`

- **Method: `history(Request $request)`**
  - **Route**: `GET /dokumen/riwayat` (`documents.history`)
  - **Middleware**: `['auth']`
  - **Validasi**: Tidak ada.
  - **Model/Tabel disentuh**: `PengajuanDokumen` (`ff_pengajuan_dokumen`).
  - **Ringkasan Logic**:
    1. Ambil data subjek user login.
    2. Jika role OPD/Desa, filter riwayat berdasarkan `dokumen_id` milik OPD tersebut.
    3. Paginasi riwayat audit trail (15 baris per halaman) diurutkan `id_fact` descending.
  - **Response**: `view('documents.history', [...])`

- **Method: `resubmit(Request $request, $dokumenId)`**
  - **Route**: `POST /dokumen/kirim-ulang/{dokumenId}` (`documents.resubmit`)
  - **Middleware**: `['auth', 'role:admin_opd|admin_desa|super_admin']`
  - **Validasi Input**:
    - `judul_file`: `required|string|max:255`
    - `file_dokumen`: `required|file|mimes:doc,docx|max:20480`
    - `catatan`: `nullable|string`
  - **Model/Tabel disentuh**: `Dokumen` (`d_dokumen`), `PengajuanDokumen` (`ff_pengajuan_dokumen`).
  - **Ringkasan Logic**:
    1. Validasi berkas perbaikan (.doc/.docx max 20MB).
    2. Simpan berkas ke storage public.
    3. Panggil `submissionService->resubmit(...)` untuk membuat record `d_dokumen` baru dan membuat fakta baru di `ff_pengajuan_dokumen` dengan `status_dokumen_key = 2` (File Terkirim (Diperbaiki)) & `status_pengajuan_key = 1` (Pengajuan — kembali ke antrian Admin Hukum).
  - **Response**: `redirect()->route('documents.show', ['id' => $dokumenId])->with('success', ...)`

### 2. Class: `App\Http\Controllers\Auth\VerifyEmailController`
- **Method: `__invoke(EmailVerificationRequest $request)`**
  - **Route**: `GET /verify-email/{id}/{hash}` (`verification.verify`)
  - **Middleware**: `['auth', 'signed', 'throttle:6,1']`
  - **Ringkasan Logic**: Memverifikasi alamat email user dan me-redirect ke dashboard.

---

## 6. LIVEWIRE / VOLT COMPONENT

Aplikasi ini menggunakan perpaduan **Livewire v3 Component** (Class-based) dan **Livewire Volt Component**:

### A. Class-Based Livewire Components

1. **`App\Livewire\Forms\LoginForm`**
   - **File**: `app/Livewire/Forms/LoginForm.php`
   - **Public Properties**: `$email` (string), `$password` (string), `$remember` (bool).
   - **Method `authenticate()`**:
     - Cek apakah login mengalami rate limit (`ensureIsNotRateLimited()`).
     - Menentukan field login (`email` atau `username` berdasar format input).
     - Mencoba otentikasi via `Auth::attempt()`. Jika gagal, panggil `RateLimiter::hit()` dan lempar `ValidationException`. Jika berhasil, bersihkan rate limiter.
   - **Method `ensureIsNotRateLimited()`**: Memastikan percobaan login tidak melebihi 5x dalam window rate limit.
   - **Method `throttleKey()`**: Mengembalikan key throttle unik berdasar email/username + IP.

2. **`App\Livewire\Actions\Logout`**
   - **File**: `app/Livewire/Actions/Logout.php`
   - **Method `__invoke()`**: Melakukan `Auth::guard('web')->logout()`, memvalidasi ulang session via `Session::invalidate()` dan me-regenerate token CSRF.

### B. Livewire Volt Components (Auth Pages)

Terdapat 6 komponen Volt yang digunakan untuk alur otentikasi Breeze:
1. `resources/views/livewire/pages/auth/login.blade.php` (Komponen Login pengguna)
2. `resources/views/livewire/pages/auth/register.blade.php` (Komponen Registrasi)
3. `resources/views/livewire/pages/auth/forgot-password.blade.php` (Komponen Lupa Password)
4. `resources/views/livewire/pages/auth/reset-password.blade.php` (Komponen Reset Password)
5. `resources/views/livewire/pages/auth/verify-email.blade.php` (Komponen Notifikasi Verifikasi Email)
6. `resources/views/livewire/pages/auth/confirm-password.blade.php` (Komponen Konfirmasi Password)

### C. Livewire Volt Components (Profile Management)
1. `resources/views/livewire/profile/update-profile-information-form.blade.php`
2. `resources/views/livewire/profile/update-password-form.blade.php`
3. `resources/views/livewire/profile/delete-user-form.blade.php`

---

## 7. MIDDLEWARE & ROLE/PERMISSION

### 1. Middleware Custom (`app/Http/Middleware/`)
- **Hasil Audit**: **TIDAK DITEMUKAN** file middleware custom buatan tangan di `app/Http/Middleware/`.
- Middleware RBAC didaftarkan secara terpusat pada `bootstrap/app.php` menggunakan alias resmi dari package Spatie Permission:
  ```php
  $middleware->alias([
      'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
      'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
      'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
  ]);
  ```

### 2. Role & Permission yang Di-assign & Lokasinya
- **Role yang Terdaftar**:
  1. `super_admin`
  2. `admin_opd`
  3. `admin_desa`
  4. `admin_hukum`
  5. `kabag_hukum`
- **Lokasi Inisialisasi**: `database/seeders/RoleAndPermissionSeeder.php` dan `database/seeders/UserSeeder.php`.
- **Assignment User bawaan di Seeder**:
  - `admin` -> Role: `super_admin`
  - `199001012015011001` -> Role: `admin_opd` (Dinas Kominfo)
  - `1371010101900001` -> Role: `admin_desa` (Desa Pariaman Utara)
  - `198001012005011003` -> Role: `admin_hukum` (Bagian Hukum Setdako)
  - `197501012000011004` -> Role: `kabag_hukum` (Kepala Bagian Hukum)

### 3. Proteksi Route Berdasarkan Role
- `role:admin_opd|admin_desa|super_admin`: Protected pada route `documents.create`, `documents.store`, `documents.resubmit`.
- `role:admin_hukum|kabag_hukum|super_admin`: Protected pada route `documents.revision`, `documents.submitRevision`, `documents.approve`, `documents.approvals`.
- `role:admin_hukum|super_admin`: Protected pada route `documents.forwardRevision`.
- `role:super_admin`: Protected pada route master data (`master.desa`, `master.staf`, `master.jenis`, `master.status`, `users.index`).

---

## 8. HALAMAN / VIEW

### Daftar Seluruh Halaman Areal Aplikasi

| Nama Halaman | Path File View | Route / URL | Role yang Bisa Akses | Fungsi Halaman (1 Kalimat) | Classification |
|---|---|---|---|---|---|
| Dashboard Utama | `resources/views/dashboard.blade.php` | `GET /dashboard` | Semua Role | Menampilkan ringkasan statistik dan antrian kerja sesuai role pengguna. | **SHARED Controller / DUPLIKAT View Template** |
| Daftar Dokumen | `resources/views/documents/index.blade.php` | `GET /dokumen` | Semua Role | Menampilkan tabel daftar seluruh dokumen dengan filter pencarian dan status. | **SHARED** |
| Detail Dokumen | `resources/views/documents/show.blade.php` | `GET /dokumen/detail/{id?}` | Semua Role | Menampilkan riwayat kronologis audit trail dan status dokumen terkini. | **SHARED** |
| Form Buat Dokumen | `resources/views/documents/create.blade.php` | `GET /dokumen/create` | Admin OPD, Admin Desa, Super Admin | Form untuk mengunggah dan mengajukan dokumen hukum baru. | **SHARED** |
| Antrian Persetujuan | `resources/views/documents/approvals.blade.php` | `GET /dokumen/persetujuan` | Admin Hukum, Kabag Hukum, Super Admin | Halaman khusus antrian dokumen yang menunggu verifikasi atau approval. | **SHARED** |
| Modal Request Revisi | `resources/views/documents/revision.blade.php` | `GET /dokumen/revisi/{id?}` | Admin Hukum, Kabag Hukum, Super Admin | Form untuk menginput catatan dan berkas lampiran revisi dokumen. | **SHARED** |
| Riwayat Audit Trail | `resources/views/documents/history.blade.php` | `GET /dokumen/riwayat` | Semua Role | Menampilkan log lengkap seluruh aktivitas transaksi fakta pengajuan. | **SHARED** |
| Master Data Desa | `resources/views/master/desa.blade.php` | `GET /master/desa` | Super Admin | Pengelolaan data master desa dan kelurahan di Kota Pariaman. | Khusus Super Admin |
| Master Staf & Warga | `resources/views/master/staf.blade.php` | `GET /master/staf` | Super Admin | Pengelolaan data staf desa dan data masyarakat terdaftar. | Khusus Super Admin |
| Master Jenis Dokumen | `resources/views/master/jenis.blade.php` | `GET /master/jenis` | Super Admin | Pengelolaan kategori dan jenis dokumen hukum (Perwako, Perdes, dll). | Khusus Super Admin |
| Referensi Status | `resources/views/master/status.blade.php` | `GET /master/status` | Super Admin | Pengelolaan kamus referensi status dokumen dan status pengajuan. | Khusus Super Admin |
| Pengaturan User | `resources/views/users/index.blade.php` | `GET /users` | Super Admin | Pengelolaan akun pengguna, penetapan NIP/NIK, dan penetapan role. | Khusus Super Admin |
| Direktori Pegawai | `resources/views/pegawai/index.blade.php` | `GET /direktori-pegawai` | Semua Role (Auth) | Menampilkan daftar direktori pegawai ASN Pemko Pariaman. | **SHARED** |

### Analisis SHARED vs DUPLIKAT

1. **Dashboard View Template (`resources/views/dashboards/`)**: **DUPLIKAT (Struktural)**.
   - Route `/dashboard` menggunakan satu controller/view entry point `dashboard.blade.php`.
   - Namun di dalamnya terdapat pengecekan `@if(Auth::user()->hasRole(...))` yang meng-include 4 file template terpisah:
     - `dashboards/super-admin.blade.php` (20.0 KB)
     - `dashboards/admin-opd.blade.php` (17.0 KB)
     - `dashboards/admin-hukum.blade.php` (13.5 KB)
     - `dashboards/kabag-hukum.blade.php` (12.4 KB)
   - *Tingkat Kemiripan*: Kodenya memuat komponen UI (card statistik, tabel antrian, skema warna) yang 70-80% serupa secara visual.

2. **Daftar Dokumen vs Antrian Persetujuan (`index.blade.php` vs `approvals.blade.php`)**: **DUPLIKAT (Visual / UI)**.
   - `resources/views/documents/index.blade.php` (17.4 KB) dan `resources/views/documents/approvals.blade.php` (11.7 KB) memiliki struktur layout tabel, badge status, modal detail, dan script pencarian yang **85% identik**.

### Pengecekan Menu / Sidebar Navigasi

- **Bukti Konkret**: File `resources/views/layouts/app.blade.php` (Baris 20 - 133).
- **Hasil Audit**: Sidebar dirender dari **SATU FILE TUNGGAL** (`layouts/app.blade.php`). Menu navigasi diatur secara dinamis menggunakan direktif konvensional Blade (`@if(Auth::user() && Auth::user()->hasRole('...'))`). Tidak ditemukan file sidebar terpisah seperti `sidebar-admin.blade.php` atau `sidebar-kabag.blade.php`.

---

## 9. ALUR PENGAJUAN DOKUMEN — IMPLEMENTASI AKTUAL

Berikut adalah alur pengajuan dokumen **seperti yang sudah diimplementasi dalam kode**:

```
[OPD / Desa] --- (1. store / resubmit) ---> [Admin Hukum]
                                                  |
                                                  +--- (2a. approve) ---> [Kabag Hukum] ---> (3a. approve) ---> [SELESAI (Final)]
                                                  |                             |
                                                  |                             +--- (3b. requestRevision)
                                                  |                                        |
                                                  |                                        v
                                                  +<--- (4. forwardRevisionToOpd) <---+ [Antrian Admin Hukum]
                                                  |                                   (Teruskan ke OPD/Desa)
                                                  v
                                            [OPD / Desa]
```

### Langkah demi Langkah Implementasi Aktual Kode:

#### Step 1: Submit Dokumen Awal oleh OPD / Desa
- **Controller & Method**: `DocumentController@store` -> `DocumentSubmissionService@submit`
- **Perubahan Status**: 
  - `status_dokumen_key` = `1` (`ST01: File Terkirim`)
  - `status_pengajuan_key` = `1` (`SP01: Pengajuan`)
- **Upload File**: Wajib. Validasi `mimes:doc,docx|max:20480` (Maks 20MB, `.doc/.docx`).
- **Notifikasi/Email**: Tidak ada.

#### Step 2: Review & Aksi oleh Admin Hukum
- **Opsi A: Approve ke Kabag Hukum**
  - **Controller & Method**: `DocumentController@approve` -> `DocumentSubmissionService@approveAdminHukum`
  - **Perubahan Status**: `status_dokumen_key` = `5` (`ST05: File Disetujui Admin Hukum`), `status_pengajuan_key` = `2` (`SP02: Diproses`)
  - **Upload File**: Tidak ada.
- **Opsi B: Minta Revisi Langsung ke OPD/Desa**
  - **Controller & Method**: `DocumentController@submitRevision` -> `DocumentSubmissionService@requestRevision`
  - **Perubahan Status**: `status_dokumen_key` = `3` (`ST03: File Minta Diperbarui`) / `4` (`ST04: File Revisi`), `status_pengajuan_key` = `3` (`SP03: Ditolak / Perlu Revisi OPD`)

#### Step 3: Review & Aksi oleh Kabag Hukum
- **Opsi A: Persetujuan Final (ACC)**
  - **Controller & Method**: `DocumentController@approve` -> `DocumentSubmissionService@approveKabagHukum`
  - **Perubahan Status**: `status_dokumen_key` = `6` (`ST06: File Disetujui Kabag Hukum`), `status_pengajuan_key` = `4` (`SP04: Disetujui`)
  - **Upload File**: Tidak ada.
- **Opsi B: Minta Revisi (Dikembalikan ke Admin Hukum)**
  - **Controller & Method**: `DocumentController@submitRevision` -> `DocumentSubmissionService@requestRevision`
  - **Perubahan Status**: `status_dokumen_key` = `3` (`ST03: File Minta Diperbarui`), `status_pengajuan_key` = `2` (`SP02: Diproses`)
  - **Keterangan**: `"Permintaan Revisi oleh Kabag Hukum"` (Masuk antrian Admin Hukum).

#### Step 4: Meneruskan Revisi Kabag ke OPD/Desa oleh Admin Hukum
- **Controller & Method**: `DocumentController@forwardRevision` -> `DocumentSubmissionService@forwardRevisionToOpd`
- **Perubahan Status**: `status_dokumen_key` = `3` (`ST03: File Minta Diperbarui`), `status_pengajuan_key` = `3` (`SP03: Ditolak / Perlu Revisi OPD`)
- **Keterangan**: `"Revisi Diteruskan ke OPD oleh Admin Hukum"`

#### Step 5: Kirim Ulang Berkas Perbaikan oleh OPD/Desa
- **Controller & Method**: `DocumentController@resubmit` -> `DocumentSubmissionService@resubmit`
- **Perubahan Status**: `status_dokumen_key` = `2` (`ST02: File Terkirim (Diperbaiki)`), `status_pengajuan_key` = `1` (`SP01: Pengajuan`)
- **Upload File**: Wajib (`mimes:doc,docx|max:20480`).

---

## 10. PENGECEKAN BUG LINTAS ROLE & KEAMANAN ALUR

### A. Otorisasi Per-Role (Authorization)
- **STATUS**: **AMAN (Route Level)** / **BERMASALAH SEDANG (Granular Action Check)**
- **Bukti**: `routes/web.php` (Baris 30-58), `app/Http/Controllers/DocumentController.php` (Baris 268-272).
- **Penjelasan**: 
  - Proteksi middleware backend Spatie (`role:xxx`) sudah terpasang pada seluruh route sensitif (`documents.store`, `documents.submitRevision`, `documents.approve`, `documents.forwardRevision`).
  - Namun pada method `approve()`, pembedaan logic antara Admin Hukum vs Kabag Hukum hanya mengandalkan pengecekan `if ($user->hasRole('kabag_hukum'))`. Jika seorang `admin_hukum` memanggil `approve()`, ia akan mengeksekusi `approveAdminHukum()`, tetapi backend **tidak mengecek** apakah status dokumen saat itu memang layak di-approve oleh Admin Hukum (misal dokumen yang sudah di-ACC Kabag atau dokumen yang sedang perlu revisi OPD).
- **Saran Perbaikan**: Tambahkan pengecekan kondisi status fakta sebelum mengeksekusi method persetujuan.

---

### B. Kebocoran Data antar OPD/Desa (IDOR & Data Scoping)
- **STATUS**: **BERMASALAH (KERENTANAN KEAMANAN IDOR TINGGI)**
- **Bukti**: `app/Http/Controllers/DocumentController.php` method `show()` (Baris 131-156), method `download()` (Baris 108-126), dan method `resubmit()` (Baris 313-334).
- **Penjelasan**:
  - Pada method `index()`, filter dokumen milik OPD sudah ada (`whereIn('dokumen_id', $opdDokumenIds)`).
  - **AKAN TETAPI** pada method `show($id)`, `download($dokumenKey)`, dan `resubmit($dokumenId)`, backend **sama sekali tidak memeriksa** apakah `dokumen_id` tersebut milik OPD/Desa pengguna yang sedang login!
  - Seorang Admin OPD A cukup mengubah angka ID di URL browser (misal dari `/dokumen/detail/1` menjadi `/dokumen/detail/2`), maka ia dapat melihat detail, mengunduh berkas rahasia, maupun mengirim ulang dokumen milik OPD B!
- **Saran Perbaikan**: Tambahkan verifikasi kepemilikan dokumen pada method `show`, `download`, dan `resubmit` untuk role `admin_opd` dan `admin_desa`. Contoh: `abort_if($user->hasRole(['admin_opd', 'admin_desa']) && $pengajuan->subjek_key !== $userSubjekKey, 403);`.

---

### C. Validasi Status & Routing Antar Level (State Machine)
- **STATUS**: **BERMASALAH**
- **Bukti**: `app/Services/DocumentSubmissionService.php` (Baris 88-118, 191-238).
- **Penjelasan**:
  1. **Dokumen Final Masih Bisa Diubah**: Jika dokumen sudah berstatus `ST06` / `SP04` (Disetujui Kabag Hukum - Final), backend tidak mengunci dokumen tersebut. Pengaju masih bisa memanggil `resubmit()`, dan verifikator masih bisa memanggil `requestRevision()` atau `approve()`.
  2. **Skip Level Approval**: Method `approveKabagHukum()` tidak mengecek apakah dokumen tersebut sudah disetujui Admin Hukum (`status_dokumen_key == 5`). Kabag Hukum dapat menyetujui dokumen secara langsung dari status pengajuan awal (SP01).
  3. **Kebocoran Antrian Revisi Kabag ke OPD**: Ketika Kabag Hukum meminta revisi, `requestRevision()` mengatur `status_pengajuan_key = 2` (Diproses — Antrian Admin Hukum). Namun karena method `DocumentController@index` mengambil `dokumen_id` milik OPD tanpa mengecek `status_pengajuan_key`, OPD/Desa sudah bisa melihat catatan revisi Kabag Hukum sebelum Admin Hukum menekan tombol "Teruskan ke OPD/Desa".
  4. **Pengecekan Fitur Perantara "Teruskan ke OPD/Desa"**: Fitur ini **SUDAH DIIMPLEMENTASI** di kode (`DocumentController@forwardRevision` dan `DocumentSubmissionService@forwardRevisionToOpd`).
- **Saran Perbaikan**:
  - Kunci dokumen yang memiliki `status_dokumen_key == 6` (Final) agar tidak dapat diubah lagi.
  - Validasi bahwa `approveKabagHukum()` hanya bisa dipanggil jika `status_dokumen_key == 5`.
  - Filter query `index()` OPD agar hanya menampilkan dokumen berevisi jika `status_pengajuan_key == 3`.

---

### D. Konsistensi Grain `ff_pengajuan_dokumen`
- **STATUS**: **AMAN**
- **Bukti**: `app/Services/DocumentSubmissionService.php` (Seluruh method: `submit`, `requestRevision`, `forwardRevisionToOpd`, `resubmit`, `approveAdminHukum`, `approveKabagHukum`).
- **Penjelasan**: 
  - SETIAP aksi transaksi pengajuan dokumen konsisten membuat **BARIS BARU** (`PengajuanDokumen::create([...])`) pada tabel fakta `ff_pengajuan_dokumen` (Grain: 1 baris = 1 kejadian/event).
  - Kolom `dokumen_id` konsisten digunakan sebagai Thread ID pengajuan untuk mengelompokkan seluruh kronologi fakta dari pengajuan yang sama. Riwayat dokumen lama **tidak pernah tertimpa/di-update**.

---

### E. Validasi File Upload
- **STATUS**: **AMAN**
- **Bukti**: `app/Http/Controllers/DocumentController.php` (Baris 172-182, 223-235, 314-318).
- **Penjelasan**:
  - Validasi format berkas dilakukan ketat di backend menggunakan FormRequest rule `mimes:doc,docx` (atau `mimes:doc,docx,pdf` pada revisi) dan batas ukuran `max:20480` (Maksimal 20 MB).
  - Penamaan file yang disimpan disanitasi menggunakan `preg_replace('/[^a-zA-Z0-9._-]/', '_', ...)` dan diberi prefix `time()` unik untuk mencegah path traversal dan overwriting.

---

### F. Race Condition & Double Submit
- **STATUS**: **BERMASALAH SEDANG**
- **Bukti**: `app/Services/DocumentSubmissionService.php` (Baris 33).
- **Penjelasan**:
  - Penentuan `dokumen_id` baru di `submit()` dilakukan dengan `(PengajuanDokumen::max('dokumen_id') ?? 0) + 1` **tanpa DB Transaction** (`DB::transaction`) atau locking (`lockForUpdate`). Jika dua OPD menekan tombol submit pada milidetik yang sama, berpotensi terjadi bentrokan ID.
  - Tombol submit pada UI Blade belum dilengkapi penanganan disable otomatis (`x-data="{ submitting: false }"`).
- **Saran Perbaikan**: Bungkus proses mutasi data di `DocumentSubmissionService` ke dalam `DB::transaction()` dan tambahkan disabling pada tombol submit UI.

---

### G. Password & Login
- **STATUS**: **AMAN**
- **Bukti**: `database/seeders/UserSeeder.php`, `app/Models/User.php` (Casts `'password' => 'hashed'`), `app/Livewire/Forms/LoginForm.php` (Baris 31-70).
- **Penjelasan**:
  - Password di-hash menggunakan algoritma Bcrypt/Argon2id default Laravel (`Hash::make()`).
  - Fitur login sudah dilengkapi **Rate Limiting** via `RateLimiter::tooManyAttempts($this->throttleKey(), 5)` yang otomatis memblokir percobaan brute-force NIP/NIK setelah 5 kali kegagalan berturut-turut.

---

### H. Duplikasi Halaman/Komponen Per Role (Arsitektur)
- **STATUS**: **BERMASALAH SEDANG (Risiko Inkonsistensi UI)**
- **Bukti**: File `resources/views/documents/index.blade.php` vs `resources/views/documents/approvals.blade.php`.
- **Penjelasan**:
  - Halaman `index.blade.php` dan `approvals.blade.php` memiliki 85% struktur markup tabel dan modal yang sama. Jika kelak ada perubahan kolom/desain pada tabel dokumen, developer berisiko lupa memperbarui salah satu file.
  - Namun untuk Sidebar Navigasi sudah **SANGAT AMAN** karena terpusat pada 1 file tunggal (`resources/views/layouts/app.blade.php`).
- **Saran Rekomendasi**: Gabungkan `approvals.blade.php` ke dalam `index.blade.php` menggunakan parameter tab/filter filter query (`?tab=approvals`), sehingga hanya ada 1 file view daftar dokumen yang dipelihara.

---

## 11. FILE UPLOAD

- **Storage / Disk**: `public` disk (Konfigurasi: `config/filesystems.php`, mengarah ke `storage/app/public/documents/` yang ditautkan ke `public/storage/documents/`).
- **Validasi Format File**:
  - Form Pengajuan Baru (`DocumentController@store`): `mimes:doc,docx|max:20480` (Maks 20MB, Word Document).
  - Form Kirim Ulang Revisi (`DocumentController@resubmit`): `mimes:doc,docx|max:20480`.
  - Form Lampiran Revisi Verifikator (`DocumentController@submitRevision`): `mimes:doc,docx,pdf|max:20480`.
- **Konvensi Penamaan File**:
  - Pengajuan awal: `{timestamp}_{sanitized_original_filename}`
  - Revisi verifikator: `{timestamp}_rev_{sanitized_original_filename}`
  - Kirim ulang perbaikan: `{timestamp}_resub_{sanitized_original_filename}`
- **Folder Penyimpanan**: `storage/app/public/documents/`

---

## 12. SEEDER

Seluruh 6 seeder pada `database/seeders/` berfungsi membentuk master data awal:

1. **`DatabaseSeeder.php`**: Runner utama yang memanggil 5 seeder lainnya secara berurutan.
2. **`RoleAndPermissionSeeder.php`**: Membuat 5 role Spatie Permission (`super_admin`, `admin_opd`, `admin_desa`, `admin_hukum`, `kabag_hukum`).
3. **`MasterDataSeeder.php`**: 
   - Seed `d_jenis_dokumen`: 6 Jenis Dokumen (K01: Perwako, K02: SK Walikota, K03: Perda, K04: Perdes, K05: Instruksi Kadis, K06: SOP).
   - Seed `d_status_dokumen`: 6 Status Dokumen (ST01 s/d ST06).
   - Seed `d_status_pengajuan`: 4 Status Pengajuan (SP01 s/d SP04).
4. **`DateDimensionSeeder.php`**: Membaca file SQL `PENJELASAN/D_DATE.sql` untuk mengisi tabel dimensi tanggal `d_date`.
5. **`PegawaiUnitKerjaSeeder.php`**: Memasukkan sampel master data `d_unit_kerja` (Diskominfo, Setdako, DPMD, PUPR, Disdikpora) dan sampel data `d_pegawai`.
6. **`UserSeeder.php`**: Membuat 5 akun pengguna default beserta relasi `d_subjek` untuk masing-masing role (Password default: `password`).

---

## 13. YANG BELUM SELESAI / DIKETAHUI BERMASALAH

1. **Komentar TODO / FIXME dalam Kode**:
   - **TIDAK DITEMUKAN** komentar `TODO` atau `FIXME` di seluruh berkas sumber project.

2. **Kerentanan Keamanan IDOR (Critical Bug)**:
   - Method `show()`, `download()`, dan `resubmit()` pada `DocumentController.php` tidak memverifikasi kepemilikan `subjek_key` dokumen untuk role `admin_opd` & `admin_desa`.

3. **Status Validation & State Machine Guarding**:
   - Tidak ada validasi backend yang mengunci dokumen yang sudah berstatus Final (`ST06`).
   - Pengecekan prasyarat approval belum ada (Kabag bisa menyetujui dokumen yang belum di-ACC Admin Hukum).

4. **Fitur Notifikasi & Email**:
   - Belum ada sistem Notifikasi Email/WA (Laravel Notification / Mailable class) yang dikirim saat dokumen diajukan, direvisi, atau disetujui.

5. **Hasil Uji Eksekusi Command Artisan & Build**:
   - `php artisan route:list`: **BERHASIL** (Menampilkan 39 route terdaftar).
   - `npm run build`: **BERHASIL** (Build Vite bundler sukses dalam 3.05s).
   - `php artisan migrate:status`: **GAGAL KONEKSI DATABASE LOCAL** (`SQLSTATE[HY000] [2002] Connection refused`). Ini terjadi karena service MySQL server lokal (port 3306) belum diaktifkan/dijalankan pada mesin lokal.

---

## 14. CARA MENJALANKAN PROJECT INI

Berikut langkah-langkah lengkap untuk menjalankan project ini dari nol pada lingkungan lokal:

### 1. Prasyarat Sistem
- PHP `>= 8.2` (dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `xml`, `curl`)
- Composer `>= 2.0`
- Node.js `>= 18.0` & NPM
- Database Server MySQL / MariaDB (misal via XAMPP, Laragon, atau Docker)

### 2. Langkah Instalasi

```bash
# 1. Clone repository & masuk ke direktori project
cd ELDR

# 2. Install dependensi PHP via Composer
composer install

# 3. Install dependensi JavaScript via NPM
npm install

# 4. Salin file konfigurasi lingkungan (.env)
cp .env.example .env

# 5. Generate Application Encryption Key
php artisan key:generate

# 6. Konfigurasi Database pada file .env
# Buka file .env dan sesuaikan kredensial MySQL Anda:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=eldr_pariaman
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Pastikan MySQL Service sudah berjalan, lalu jalankan Migration & Seeder
php artisan migrate:fresh --seed

# 8. Buat Symlink Storage (Menghubungkan storage/app/public ke public/storage)
php artisan storage:link

# 9. Jalankan Development Server (Laravel Serve + Vite Hot Reload)
npm run dev
```

Secara alternatif, project ini menyediakan script composer otomatis:
```bash
composer run setup
```
Dan untuk menjalankan server pengembangan:
```bash
composer run dev
```

---
*Laporan ini disusun secara otomatis berdasarkan hasil audit statis dan analisis alur eksekusi kode sumber ELDR Kota Pariaman.*
