<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerihalDokumen extends Model
{
    protected $table = 'd_perihal_dokumen';
    protected $primaryKey = 'perihal_dokumen_key';

    protected $fillable = [
        'perihal_dokumen',
    ];
}
