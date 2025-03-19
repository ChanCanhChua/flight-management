<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $table = 'passenger';

    protected $fillable = [
        'passenger_name', 'passenger_tel', 'passenger_email'];
//    protected $casts = [
//        'flight_time' => 'time:HH',
//    ];
    public function flight_time() {
        return $this->belongsTo(FlightTime::class);
    }

}
