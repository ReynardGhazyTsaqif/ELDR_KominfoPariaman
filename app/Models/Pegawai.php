<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'd_pegawai';
    protected $primaryKey = 'pegawai_key';

    protected $fillable = [
        'pns_id',
        'nip',
        'nama_pegawai',
        'gelar_depan',
        'gelar_belakang',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_ktp',
        'agama',
        'tingkat_pendidikan',
        'jurusan_pendidikan',
        'status_pegawai',
        'jenis_pegawai',
        'foto',
        'tmt_golongan',
        'tmt_jabatan',
        'kode_unit_kerja_siasn',
    ];

    public function unitKerja()
    {
        return $this->belongsToMany(UnitKerja::class, 'ft_pegawai', 'pegawai_key', 'unit_kerja_key');
    }
}
