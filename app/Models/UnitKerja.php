<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'd_unit_kerja';
    protected $primaryKey = 'unit_kerja_key';

    protected $fillable = [
        'unit_kerja_kode',
        'unit_kerja_nama',
        'unit_kerja_status',
        'satker_kode',
        'satker_nama',
        'satker_status',
        'satker_created_date',
        'bidang_kode',
        'bidang_nama',
        'bidang_created_date',
        'sub_bidang_kode',
        'sub_bidang_nama',
        'sub_bidang_status',
        'sub_bidang_created_date',
    ];

    public function pegawai()
    {
        return $this->belongsToMany(Pegawai::class, 'ft_pegawai', 'unit_kerja_key', 'pegawai_key');
    }
}
