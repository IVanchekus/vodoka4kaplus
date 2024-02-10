<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PumpMeterRecord extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'period_id',
        'amount_volume'
    ];
}
