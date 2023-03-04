<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => 'Katha',
            'phone'=> '09456480770',
            'password' => Hash::make ('admin123'),
            'gender' => 'male',
            'role' => 'admin'
       ]);
    }
}
