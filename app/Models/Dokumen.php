<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'd_dokumen';
    protected $primaryKey = 'dokumen_key';

    protected $fillable = [
        'dokumen_judul',
        'nama_file',
    ];
}
