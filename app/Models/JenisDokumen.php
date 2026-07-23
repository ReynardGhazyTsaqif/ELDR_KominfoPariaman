<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    protected $table = 'd_jenis_dokumen';
    protected $primaryKey = 'jenis_dokumen_key';

    protected $fillable = [
        'kode_jenis_dokumen',
        'jenis_dokumen',
    ];
}
