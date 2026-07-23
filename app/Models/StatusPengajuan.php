<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengajuan extends Model
{
    protected $table = 'd_status_pengajuan';
    protected $primaryKey = 'status_key';

    protected $fillable = [
        'status_kode',
        'status',
    ];
}
