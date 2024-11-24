<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Prakash Chaudhary',
            'email'=>'admin@gmail.com',
            'phone'=>'9800000000',
            'address'=>'Kathmandu',
            'is_verified'=>1,
            'is_admin'=>1,
            'position'=>'employee',
            'password'=>1122334455
        ]);
    }
}
