<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    //
    protected $table = 'cities';
    public $timestamps = true;

    public function aiports(): HasMany
    {
        return $this->hasMany(Airport::class);
    }
}
