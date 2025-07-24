<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                  User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'permissions' => json_encode(['admin' => true]),
            'last_login' => now(),
        ]);


                User::create([
            'email' => 'hoangvkph52610@gmail.com',
            'password' => Hash::make('password'),
            'first_name' => 'hoangcass',
            'last_name' => 'vuong',
            'permissions' => json_encode(['admin' => true]),
            'last_login' => now(),
        ]);

    }
}
