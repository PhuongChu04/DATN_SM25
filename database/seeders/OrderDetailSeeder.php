<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
        $orders = DB::table('orders')->pluck('id'); // Lấy danh sách id đơn hàng
        $variantOptions = [
            ['id_variant' => 11, 'size' => '42', 'color' => 'Trắng', 'price' => 220.57],
            ['id_variant' => 8, 'size' => '43', 'color' => 'Đen', 'price' => 220.57],
            ['id_variant' => 3, 'size' => '41', 'color' => 'Đỏ', 'price' => 300.00],
            ['id_variant' => 9, 'size' => '40', 'color' => 'Xám', 'price' => 724.79],
        ];

        $now = Carbon::now();

        foreach ($orders as $orderId) {
            $items = [];

            // Random số lượng sản phẩm trong mỗi đơn (1–3 sản phẩm)
            $numItems = rand(1, 3);

            for ($i = 0; $i < $numItems; $i++) {
                $option = $variantOptions[array_rand($variantOptions)];
                $quantity = rand(1, 2);
                $unitPrice = $option['price'];
                $total = $unitPrice * $quantity;

                $items[] = [
                    'id_order'      => $orderId,
                    'id_variant'    => $option['id_variant'],
                    'variant_data'  => json_encode([
                        'size'  => $option['size'],
                        'color' => $option['color']
                    ]),
                    'quantity'      => $quantity,
                    'unit_price'    => $unitPrice,
                    'total'         => $total,
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }

            DB::table('order_details')->insert($items);
        }
    }
}