<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {   
        User::create([
            'name' => 'andrei',
            'email' => 'andreigeorgemira@gmail.com',
            'password' => Hash::make('andrei123'),
        ]);
    }
}
