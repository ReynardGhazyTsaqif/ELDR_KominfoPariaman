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
        // 1. D_DOKUMEN
        Schema::create('d_dokumen', function (Blueprint $table) {
            $table->id('dokumen_key');
            $table->text('dokumen_judul');
            $table->text('nama_file');
            $table->timestamps();
        });

        // 2. D_PERIHAL_DOKUMEN
        Schema::create('d_perihal_dokumen', function (Blueprint $table) {
            $table->id('perihal_dokumen_key');
            $table->text('perihal_dokumen');
            $table->timestamps();
        });

        // 3. FF_PENGAJUAN_DOKUMEN
        Schema::create('ff_pengajuan_dokumen', function (Blueprint $table) {
            $table->id('id_fact');
            $table->unsignedBigInteger('dokumen_id')->index(); // Thread ID
            $table->foreignId('subjek_key')->constrained('d_subjek', 'subjek_key')->cascadeOnDelete();
            $table->foreignId('dokumen_key')->constrained('d_dokumen', 'dokumen_key')->cascadeOnDelete();
            $table->foreignId('jenis_dokumen_key')->constrained('d_jenis_dokumen', 'jenis_dokumen_key')->cascadeOnDelete();
            $table->foreignId('perihal_dokumen_key')->constrained('d_perihal_dokumen', 'perihal_dokumen_key')->cascadeOnDelete();
            $table->longText('catatan_dokumen')->nullable();
            $table->longText('keterangan')->nullable();
            $table->foreignId('status_pengajuan_key')->constrained('d_status_pengajuan', 'status_key')->cascadeOnDelete();
            $table->foreignId('status_dokumen_key')->constrained('d_status_dokumen', 'status_key')->cascadeOnDelete();
            $table->integer('tanggal_pengajuan_key')->nullable();
            $table->timestamps();

            $table->foreign('tanggal_pengajuan_key')->references('date_key')->on('d_date')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ff_pengajuan_dokumen');
        Schema::dropIfExists('d_perihal_dokumen');
        Schema::dropIfExists('d_dokumen');
    }
};
