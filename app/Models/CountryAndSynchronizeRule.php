<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryAndSynchronizeRule extends Model
{
    protected $fillable = [
        'country_id',
        'synchronize_id'
    ];

    public function rule()
    {
        return $this->belongsTo(Synchronize::class, 'synchronize_id');
    }
}
