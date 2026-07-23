<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanDokumen extends Model
{
    protected $table = 'ff_pengajuan_dokumen';
    protected $primaryKey = 'id_fact';

    protected $fillable = [
        'dokumen_id',
        'subjek_key',
        'dokumen_key',
        'jenis_dokumen_key',
        'perihal_dokumen_key',
        'catatan_dokumen',
        'keterangan',
        'status_pengajuan_key',
        'status_dokumen_key',
        'tanggal_pengajuan_key',
    ];

    public function subjek()
    {
        return $this->belongsTo(Subjek::class, 'subjek_key', 'subjek_key');
    }

    public function dokumen()
    {
        return $this->belongsTo(Dokumen::class, 'dokumen_key', 'dokumen_key');
    }

    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_dokumen_key', 'jenis_dokumen_key');
    }

    public function perihalDokumen()
    {
        return $this->belongsTo(PerihalDokumen::class, 'perihal_dokumen_key', 'perihal_dokumen_key');
    }

    public function statusDokumen()
    {
        return $this->belongsTo(StatusDokumen::class, 'status_dokumen_key', 'status_key');
    }

    public function statusPengajuan()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_pengajuan_key', 'status_key');
    }

    public function dateDimension()
    {
        return $this->belongsTo(DateDimension::class, 'tanggal_pengajuan_key', 'date_key');
    }
}
