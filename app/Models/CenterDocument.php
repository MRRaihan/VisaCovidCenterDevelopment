<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CenterDocument extends Model
{
    protected $fillable = [
        'user_id',
        'document',
        'status'
    ];
}