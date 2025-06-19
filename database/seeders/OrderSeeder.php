<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 10 khách hàng
        Customer::factory(10)->create()->each(function ($customer) {
            // Mỗi khách hàng có 2–5 đơn hàng
            Order::factory(rand(2, 5))->create([
                'customer_id' => $customer->id,
            ]);
        });
    }
}