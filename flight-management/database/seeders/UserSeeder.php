<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            
            'email' => 'thaile1202@gmail.com',
            'name'  => 'thaile',
            'password' => Hash::make('password'),
         
        ]);
    }
}
