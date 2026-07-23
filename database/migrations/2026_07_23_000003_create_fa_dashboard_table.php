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
        Schema::create('fa_dashboard', function (Blueprint $table) {
            $table->id('id_fact');
            $table->foreignId('status_pengajuan_key')->constrained('d_status_pengajuan', 'status_key')->cascadeOnDelete();
            $table->foreignId('jenis_dokumen_key')->constrained('d_jenis_dokumen', 'jenis_dokumen_key')->cascadeOnDelete();
            $table->integer('tanggal_pengajuan_key');
            $table->integer('total_dokumen_pengajuan')->default(0);
            $table->timestamps();

            $table->foreign('tanggal_pengajuan_key')->references('date_key')->on('d_date')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fa_dashboard');
    }
};
