<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. D_DESA
        Schema::create('d_desa', function (Blueprint $table) {
            $table->id('desa_key');
            $table->string('desa_kode', 10)->nullable();
            $table->string('desa_nama', 150);
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->char('f_status', 1)->default('1');
            $table->timestamps();
        });

        // 2. D_MASYARAKAT
        Schema::create('d_masyarakat', function (Blueprint $table) {
            $table->id('masyarakat_key');
            $table->string('nik', 30)->unique();
            $table->string('nama_masyarakat', 255);
            $table->timestamps();
        });

        // 3. FT_MASYARAKAT
        Schema::create('ft_masyarakat', function (Blueprint $table) {
            $table->id('id_fact');
            $table->foreignId('desa_key')->constrained('d_desa', 'desa_key')->cascadeOnDelete();
            $table->foreignId('masyarakat_key')->constrained('d_masyarakat', 'masyarakat_key')->cascadeOnDelete();
            $table->timestamps();
        });

        // 4. D_PEGAWAI
        Schema::create('d_pegawai', function (Blueprint $table) {
            $table->id('pegawai_key');
            $table->string('pns_id', 100)->nullable();
            $table->string('nip', 30)->unique();
            $table->string('nama_pegawai', 255);
            $table->string('gelar_depan', 150)->nullable();
            $table->string('gelar_belakang', 255)->nullable();
            $table->string('tempat_lahir', 150)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('no_ktp', 30)->nullable();
            $table->string('agama', 150)->nullable();
            $table->string('tingkat_pendidikan', 150)->nullable();
            $table->string('jurusan_pendidikan', 150)->nullable();
            $table->string('status_pegawai', 150)->nullable();
            $table->string('jenis_pegawai', 150)->nullable();
            $table->string('foto', 150)->nullable();
            $table->date('tmt_golongan')->nullable();
            $table->date('tmt_jabatan')->nullable();
            $table->string('kode_unit_kerja_siasn', 100)->nullable();
            $table->timestamps();
        });

        // 5. D_UNIT_KERJA
        Schema::create('d_unit_kerja', function (Blueprint $table) {
            $table->id('unit_kerja_key');
            $table->string('unit_kerja_kode', 150)->nullable();
            $table->string('unit_kerja_nama', 255)->nullable();
            $table->char('unit_kerja_status', 1)->nullable();
            $table->string('satker_kode', 150)->nullable();
            $table->string('satker_nama', 255)->nullable();
            $table->char('satker_status', 1)->nullable();
            $table->date('satker_created_date')->nullable();
            $table->string('bidang_kode', 150)->nullable();
            $table->string('bidang_nama', 255)->nullable();
            $table->date('bidang_created_date')->nullable();
            $table->string('sub_bidang_kode', 150)->nullable();
            $table->string('sub_bidang_nama', 255)->nullable();
            $table->char('sub_bidang_status', 1)->nullable();
            $table->date('sub_bidang_created_date')->nullable();
            $table->timestamps();
        });

        // 6. FT_PEGAWAI
        Schema::create('ft_pegawai', function (Blueprint $table) {
            $table->id('fact_id');
            $table->foreignId('unit_kerja_key')->nullable()->constrained('d_unit_kerja', 'unit_kerja_key')->nullOnDelete();
            $table->foreignId('pegawai_key')->constrained('d_pegawai', 'pegawai_key')->cascadeOnDelete();
            $table->timestamps();
        });

        // 7. D_SUBJEK
        Schema::create('d_subjek', function (Blueprint $table) {
            $table->id('subjek_key');
            $table->string('nomor_identitas', 50)->index();
            $table->string('nama_subjek', 150);
            $table->string('tipe_subjek', 35); // 'Pegawai' atau 'Masyarakat'
            $table->string('unit_kerja', 255)->nullable();
            $table->timestamps();
        });

        // 8. D_JENIS_DOKUMEN
        Schema::create('d_jenis_dokumen', function (Blueprint $table) {
            $table->id('jenis_dokumen_key');
            $table->string('kode_jenis_dokumen', 10)->nullable();
            $table->string('jenis_dokumen', 150);
            $table->timestamps();
        });

        // 9. D_STATUS_DOKUMEN
        Schema::create('d_status_dokumen', function (Blueprint $table) {
            $table->id('status_key');
            $table->string('status_kode', 10)->nullable();
            $table->string('status', 150);
            $table->timestamps();
        });

        // 10. D_STATUS_PENGAJUAN
        Schema::create('d_status_pengajuan', function (Blueprint $table) {
            $table->id('status_key');
            $table->string('status_kode', 10)->nullable();
            $table->string('status', 150);
            $table->timestamps();
        });

        // 11. D_DATE
        Schema::create('d_date', function (Blueprint $table) {
            $table->integer('date_key')->primary();
            $table->date('date')->unique();
            $table->integer('year');
            $table->integer('month');
            $table->string('month_name', 15);
            $table->integer('day_of_month');
            $table->integer('day_of_week');
            $table->string('day_name', 10);
            $table->smallInteger('is_weekend')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_date');
        Schema::dropIfExists('d_status_pengajuan');
        Schema::dropIfExists('d_status_dokumen');
        Schema::dropIfExists('d_jenis_dokumen');
        Schema::dropIfExists('d_subjek');
        Schema::dropIfExists('ft_pegawai');
        Schema::dropIfExists('d_unit_kerja');
        Schema::dropIfExists('d_pegawai');
        Schema::dropIfExists('ft_masyarakat');
        Schema::dropIfExists('d_masyarakat');
        Schema::dropIfExists('d_desa');
    }
};
