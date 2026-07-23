<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'd_desa';
    protected $primaryKey = 'desa_key';

    protected $fillable = [
        'desa_kode',
        'desa_nama',
        'tanggal_mulai',
        'tanggal_selesai',
        'f_status',
    ];

    public function masyarakat()
    {
        return $this->belongsToMany(Masyarakat::class, 'ft_masyarakat', 'desa_key', 'masyarakat_key');
    }
}
