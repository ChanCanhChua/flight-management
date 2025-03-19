<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    //
    public $timestamps = true;

    use HasFactory;

    protected $fillable = [
        'origin_ap_id',
        'destination_ap_id',
        'is_active',
        'total_seat',
        'price',
        
    ];

    public function flightTimes() {
        return $this->hasMany(FlightTime::class, 'flight_id');
    }

    public function originAirport() {
        return $this->belongsTo(Airport::class, 'origin_ap_id');
    }
    public function destinationAirport() {
        return $this->belongsTo(Airport::class, 'destination_ap_id');
    }
}
