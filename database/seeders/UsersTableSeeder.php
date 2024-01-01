<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Default Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create an customer user
        User::create([
            'name' => 'Default Customer',
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'customer',
            'status' => 'active',
        ]);
    }
}
