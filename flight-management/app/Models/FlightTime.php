<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightTime extends Model
{
    protected $table = 'flight_time';

    protected $fillable = [
        'y_pos',
        'x_pos',
        'flight_time',
        'flight_id',
        'duration',
    ];
//    protected $casts = [
//        'flight_time' => 'time:HH',
//    ];
    public function flight() {
        return $this->belongsTo(Flight::class);
    }
    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($flightTime) {
            $flightTime->flight_code = 'TK' . str_pad($flightTime->id, 5, '0', STR_PAD_LEFT);
            $flightTime->save(); 
        });
    }
}
