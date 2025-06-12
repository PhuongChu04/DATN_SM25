<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'id_user' => 1,
            'user_data' => json_encode(['name' => 'Khách hàng A']),
            'address_data' => json_encode(['address' => '123 Đường ABC, TP.HCM']),
            'voucher_data' => json_encode([]),
            'status' => 'pending',
            'note' => 'Giao hàng buổi sáng',
            'subtotal' => 2300000,
            'shipping' => 30000,
            'total' => 2330000,
            'payment_method' => 'cod',
        ]);
    }
}
