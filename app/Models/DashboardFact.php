<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardFact extends Model
{
    protected $table = 'fa_dashboard';
    protected $primaryKey = 'id_fact';

    protected $fillable = [
        'status_pengajuan_key',
        'jenis_dokumen_key',
        'tanggal_pengajuan_key',
        'total_dokumen_pengajuan',
    ];

    public function statusPengajuan()
    {
        return $this->belongsTo(StatusPengajuan::class, 'status_pengajuan_key', 'status_key');
    }

    public function jenisDokumen()
    {
        return $this->belongsTo(JenisDokumen::class, 'jenis_dokumen_key', 'jenis_dokumen_key');
    }

    public function dateDimension()
    {
        return $this->belongsTo(DateDimension::class, 'tanggal_pengajuan_key', 'date_key');
    }
}
