<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\User;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 10 khách hàng
         User::all()->each(function ($user) {
            Order::factory(rand(2, 5))->create([
                'user_id' => $user->id,
            ]);
        });
    }
}