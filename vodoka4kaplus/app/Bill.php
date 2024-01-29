<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'resident_id',
        'period_id',
        'amount_rub'
    ];
}
