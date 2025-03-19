<?php

namespace Database\Seeders;

use App\Models\City;
use Igaster\LaravelCities\Geo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $geo = Geo::getCountry('VN')->children()->orderBy('name')->get()->toArray();
            $cities = City::all();

            foreach ($geo as $key => $value) {
                DB::table('airports')->insert([
                    'name' => $value['name'].' Airport',
                    'lat'   => $value['lat'],
                    'city_id' => $cities[$key]->id,
                    'time_zone' => '1',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }
}
