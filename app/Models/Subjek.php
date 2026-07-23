<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subjek extends Model
{
    protected $table = 'd_subjek';
    protected $primaryKey = 'subjek_key';

    protected $fillable = [
        'nomor_identitas',
        'nama_subjek',
        'tipe_subjek',
        'unit_kerja',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'subjek_key', 'subjek_key');
    }

    public function pengajuanDokumen()
    {
        return $this->hasMany(PengajuanDokumen::class, 'subjek_key', 'subjek_key');
    }
}
