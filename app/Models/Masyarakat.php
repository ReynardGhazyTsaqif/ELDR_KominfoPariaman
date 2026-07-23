<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table = 'd_masyarakat';
    protected $primaryKey = 'masyarakat_key';

    protected $fillable = [
        'nik',
        'nama_masyarakat',
    ];

    public function desa()
    {
        return $this->belongsToMany(Desa::class, 'ft_masyarakat', 'masyarakat_key', 'desa_key');
    }
}
