<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DateDimension extends Model
{
    protected $table = 'd_date';
    protected $primaryKey = 'date_key';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'date_key',
        'date',
        'year',
        'month',
        'month_name',
        'day_of_month',
        'day_of_week',
        'day_name',
        'is_weekend',
    ];
}
