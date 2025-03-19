<?php

namespace Database\Factories;

use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    protected $model = Flight::class;

    protected static function newFactory()
    {
        return FlightFactory::new();
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $originAP = $this->getAirport();
        $destinationAP = $this->getAirport($originAP->id);
        return [
            'origin_ap_id' =>  $originAP->id,
            'destination_ap_id' => $destinationAP->id,
            'is_active' => true,
            'total_seat' => rand(30,100),
            'price' => rand(1000000,5000000)
        ];
    }

    private function getAirport($airportId=null)
    {
        if(!is_null($airportId)){
            return Airport::where('id','!=',$airportId)->inRandomOrder()->first();
        }
        return Airport::inRandomOrder()->first();
    }
}
