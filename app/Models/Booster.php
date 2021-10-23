<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booster extends Model
{
    protected $fillable = [
        'name_of_vaccine',
        'registration_type',
        'date',
        'antibody_last_date',
        'users_id',
        'center_id',
        'staff_id',
        'status',
    ];
}
