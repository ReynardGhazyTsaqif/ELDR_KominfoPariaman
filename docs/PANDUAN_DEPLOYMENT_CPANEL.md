# PANDUAN DEPLOYMENT APLIKASI ELDR DI CPANEL HOSTING

Panduan langkah demi langkah aman dan teruji untuk melakukan hosting aplikasi **Laravel ELDR Kota Pariaman** pada server cPanel (Hostinger, Niagahoster, IDCloudHost, dll.).

---

## 📍 BAGIAN A: PERSIAPAN DI KOMPUTER LOKAL (LOCALHOST)

### Langkah 1: Bersihkan Cache & Build Assets Frontend
Buka Terminal / PowerShell di folder project ELDR (`d:\Unand\Sems 7\Magang\Project ELDR\ELDR`), lalu jalankan:

```bash
# 1. Bersihkan seluruh cache internal lokal
php artisan optimize:clear

# 2. Compile & minifikasi aset Vite/Tailwind untuk produksi (SANGAT WAJIB)
npm run build

# 3. Install composer dependensi produksi tanpa package dev
composer install --no-dev --optimize-autoloader
```

> **⚠️ PENTING**: JANGAN jalankan `php artisan config:cache` di lokal pada tahap ini agar setelan database lokal tidak terkunci ke dalam file zip.

---

### Langkah 2: Kompresi Project Menjadi File ZIP
1. Masuk ke folder project ELDR Anda.
2. Blok seluruh isi folder project (termasuk folder `app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `storage`, `vendor`, `.env`, `artisan`).
3. Klik kanan -> **Compress to ZIP file** / **Add to archive...**.
4. Beri nama file: `eldr_project.zip`.

---

## 📍 BAGIAN B: UPLOAD & STRUKTUR FOLDER DI CPANEL

### Langkah 3: Upload File ZIP ke cPanel
1. Login ke akun **cPanel** hosting Anda.
2. Buka menu **File Manager**.
3. Masuk ke direktori utama user, yaitu folder `/home/USERNAME/` (posisi di luar folder `public_html`).
4. Klik **Upload** di bagian atas, lalu upload file `eldr_project.zip`.

---

### Langkah 4: Extract Project di Luar `public_html`
1. Setelah upload 100% selesai, kembali ke File Manager.
2. Buat folder baru di tingkat utama (di luar `public_html`), beri nama misal: `eldr_app`.
3. Pindahkan file `eldr_project.zip` ke dalam folder `eldr_app`.
4. Klik kanan file `eldr_project.zip` -> **Extract** (Extract ke `/home/USERNAME/eldr_app`).

Hasil akhirnya struktur direktori Anda akan seperti ini:
```text
/home/USERNAME/
├── eldr_app/
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   ├── .env
│   └── artisan
└── public_html/
```

---

### Langkah 5: Pindahkan Isi Folder Public ke `public_html`
1. Masuk ke folder `/home/USERNAME/eldr_app/public/`.
2. Pilih/blok **seluruh isi folder `public`** (seperti `index.php`, `.htaccess`, `build/`, `favicon.ico`, `robots.txt`, dll.).
3. Klik tombol **Move** (Pindahkan) ke direktori tujuan: `/public_html/`.

---

### Langkah 6: Edit File `public_html/index.php`
1. Masuk ke folder `/public_html/`.
2. Klik kanan file `index.php` -> **Edit**.
3. Cari 2 baris penyambung path berikut:

```php
// Semula (Default):
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

4. Ubah menjadi path absolut mengarah ke folder `eldr_app` Anda:

```php
// Sesuaikan dengan USERNAME cPanel Anda:
require '/home/USERNAME/eldr_app/vendor/autoload.php';
$app = require_once '/home/USERNAME/eldr_app/bootstrap/app.php';
```

5. Klik **Save Changes**.

---

## 📍 BAGIAN C: DATABASE & ENVIRONMENT

### Langkah 7: Buat Database MySQL di cPanel
1. Di halaman utama cPanel, buka menu **MySQL Database Wizard**.
2. **Step 1**: Masukkan nama database (misal: `eldr_db`) -> Klik *Next Step*.
3. **Step 2**: Buat username & password database -> Klik *Create User*.
   - *Catatan: Simpan Nama Database, Username, dan Password ini di Catatan/Notepad.*
4. **Step 3**: Centang opsi **ALL PRIVILEGES** -> Klik *Make Changes*.

### Langkah 8: Konfigurasi File `.env` di cPanel
1. Buka File Manager cPanel, masuk ke `/home/USERNAME/eldr_app/`.
2. Pastikan opsi **Show Hidden Files (dotfiles)** pada Settings cPanel sudah dicentang.
3. Klik kanan file `.env` -> **Edit**.
4. Ubah variabel berikut sesuai data cPanel & domain Anda:

```env
APP_NAME="ELDR Kota Pariaman"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainanda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=usernamecpanel_eldr_db
DB_USERNAME=usernamecpanel_eldr_user
DB_PASSWORD=PasswordDatabaseAnda
```

5. Klik **Save Changes**.

---

## 📍 BAGIAN D: EKSEKUSI PERINTAH SERBER (CPANEL TERMINAL / SSH)

### Langkah 9: Eksekusi Migrasi, Storage Link, & Cache
1. Di cPanel, buka menu **Terminal** (atau sambungkan via SSH).
2. Masuk ke direktori project Anda:
   ```bash
   cd /home/USERNAME/eldr_app
   ```
3. **Jalankan Migrasi & Seeder Master Data**:
   ```bash
   php artisan migrate:fresh --seed --force
   ```
4. **Jalankan Storage Link** (Wajib agar dokumen .docx dapat di-download):
   ```bash
   php artisan storage:link
   ```
   *Catatan: Ini akan membuat symlink dari `storage/app/public` ke `public_html/storage`.*

5. **Jalankan Cache Optimasi Produksi**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

---

## 📍 BAGIAN E: HAK AKSES PERMISSION (KEAMANAN)

### Langkah 10: Atur Izin Folder Storage & Cache
Di File Manager cPanel, pastikan folder berikut memiliki izin (permission) **755** atau **775**:
- `/home/USERNAME/eldr_app/storage/` (dan seluruh sub-folder di dalamnya)
- `/home/USERNAME/eldr_app/bootstrap/cache/`

---

## 📍 BAGIAN F: UJI COBA & VERIFIKASI

1. Buka domain Anda di browser: `https://domainanda.com`
2. Coba login menggunakan akun bawaan seeder:
   - **Super Admin**: `superadmin` / `password`
   - **Admin OPD**: `198501012010011001` / `password`
   - **Admin Hukum**: `198001012005011001` / `password`
   - **Kabag Hukum**: `197501012000011001` / `password`
3. Coba lakukan pengajuan 1 dokumen `.docx` baru untuk memastikan fitur simpan dan download file fisik berjalan sempurna.

---

## 🛠️ TROUBLESHOOTING DIBANTU JIKA TERJADI ERROR

| Gejala Error | Penyebab Utama | Solusi |
|:---|:---|:---|
| **500 Internal Server Error** | `.env` salah, DB gagal terkoneksi, atau cache lama tersimpan. | Set sementara `APP_DEBUG=true` di `.env` cPanel untuk melihat detail error, atau jalankan `php artisan config:clear`. |
| **Vite Manifest Not Found** | Folder `public/build` tidak ada / lupa `npm run build`. | Jalankan `npm run build` di komputer lokal, lalu upload folder `public/build` ke `/public_html/build`. |
| **File Dokumen Tidak Bisa Di-download** | Storage link belum dibuat / salah direktori. | Jalankan `php artisan storage:link` di Terminal cPanel. |
| **Class "Role" / "Spatie" Not Found** | Folder `vendor` tidak terupload lengkap. | Pastikan folder `vendor` di-ZIP dan di-upload secara utuh. |
