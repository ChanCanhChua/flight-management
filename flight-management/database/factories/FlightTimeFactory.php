<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\FlightTime;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlightTimeFactory extends Factory
{
    protected $model = FlightTime::class;
    protected static function newFactory()
    {
        return FlightTime::new();
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $flight = $this->getFlightRandom();
        $x_pos = $flight->total_seat/2;
        $y_pos = $flight->total_seat-$x_pos;
        $hour = floor(rand(0, 1440) / 60);
        $minute = rand(0, 1440) % 60;
        return [
            'y_pos' =>$x_pos,
            'x_pos' => $y_pos,
            'flight_time' => $hour.':'.$minute,
            'flight_id' =>$flight->id,
        ];
    }
    private function getFlightRandom()
    {
        return Flight::inRandomOrder()->first();
    }
}
