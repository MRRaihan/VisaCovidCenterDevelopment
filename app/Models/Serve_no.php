<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serve_no extends Model
{
    protected $fillable = [
        'pcr',
        'vaccine',
        'booster_normal',
        'booster',
        'date',
        'center_id',
    ];
}
