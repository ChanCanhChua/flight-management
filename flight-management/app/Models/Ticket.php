<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $fillable = [
        'user_id', 'class_id', 'flight_time_id', 'amount_booked', 'quantity', 'flight_date', 'created_at', 'updated_at','passenger_id'
    ];
//    protected $casts = [
//        'flight_time' => 'time:HH',
//    ];
    public function flight_time() {
        return $this->belongsTo(FlightTime::class);
    }

}
