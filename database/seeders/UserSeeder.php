<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        //admin
        User::create([
            'email' => 'tesadmin@tokohebat.bom',
            'password' => Hash::make('admintes1'),
            'role' => 'admin'
        ]);
        //user
        User::create([
            'email' => 'user@example.com',
            'password' => Hash::make('user12345'),
            'role' => 'customer'
        ]);
    }
}