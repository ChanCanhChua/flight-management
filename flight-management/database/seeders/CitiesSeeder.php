<?php

namespace Database\Seeders;

use Igaster\LaravelCities\Geo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $geo = Geo::getCountry('VN')->children()->orderBy('name')->get()->toArray();
            foreach ($geo as $key => $value) {
                DB::table('cities')->insert([
                    'name' => $value['name'],
                    'country_name' => 'Việt Nam',
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
