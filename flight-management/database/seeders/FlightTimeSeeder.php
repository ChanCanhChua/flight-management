<?php

namespace Database\Seeders;

use App\Models\Flight;
use Igaster\LaravelCities\Geo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\FlightTime;
class FlightTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FlightTime::factory()->count(50)->create();

    }
}
