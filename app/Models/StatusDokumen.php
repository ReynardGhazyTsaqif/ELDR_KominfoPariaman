<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusDokumen extends Model
{
    protected $table = 'd_status_dokumen';
    protected $primaryKey = 'status_key';

    protected $fillable = [
        'status_kode',
        'status',
    ];
}
