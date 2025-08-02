<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\ProductVariant;


class OrderDetailSeeder extends Seeder
{
    public function run(): void
    {
       $orders = DB::table('orders')->pluck('id');

        if ($orders->isEmpty()) {
            $this->command->warn("⚠ Không có đơn hàng nào để thêm chi tiết.");
            return;
        }

        $variantOptions = [
            ['id_variant' => 1, 'size' => '42', 'color' => 'Trắng', 'price' => 220.57],
            ['id_variant' => 2, 'size' => '43', 'color' => 'Đen',   'price' => 220.57],
            ['id_variant' => 3, 'size' => '41', 'color' => 'Đỏ',    'price' => 300.00],
            ['id_variant' => 4, 'size' => '40', 'color' => 'Xám',   'price' => 724.79],
        ];

        $now = Carbon::now();

        foreach ($orders as $orderId) {
            $items = [];

            $numItems = rand(1, 3);

            for ($i = 0; $i < $numItems; $i++) {
                $variant = collect($variantOptions)->random();
                $quantity = rand(1, 2);
                $unitPrice = $variant['price'];
                $total = $unitPrice * $quantity;

                $items[] = [
                    'id_order'     => $orderId,
                    'id_variant'   => $variant['id_variant'],
                    'variant_data' => json_encode([
                        'size'  => $variant['size'],
                        'color' => $variant['color'],
                    ]),
                    'quantity'     => $quantity,
                    'unit_price'   => $unitPrice,
                    'total'        => $total,
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ];
            }

            DB::table('order_details')->insert($items);
        }
    }

}
