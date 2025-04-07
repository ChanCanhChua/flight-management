<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Quản trị viên',
            'email' => 'admin@example.com',
            'password' => bcrypt('111111'), // Mật khẩu mặc định
        ]);

     
    }
}