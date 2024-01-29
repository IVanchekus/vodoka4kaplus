<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resident extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'fio',
        'area',
        'start_date'
    ];
}
