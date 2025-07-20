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
        $orders = DB::table('orders')->pluck('id'); // Lấy danh sách id đơn hàng

        $variantOptions = [
            ['id_variant' => 1, 'size' => '42', 'color' => 'Trắng', 'price' => 220.57],
            ['id_variant' => 2, 'size' => '43', 'color' => 'Đen', 'price' => 220.57],
            ['id_variant' => 3, 'size' => '41', 'color' => 'Đỏ', 'price' => 300.00],
            ['id_variant' => 4, 'size' => '40', 'color' => 'Xám', 'price' => 724.79],
        ];

        $now = Carbon::now();

        foreach ($orders as $orderId) {
            $items = [];

            // Random số lượng sản phẩm trong mỗi đơn (1–3 sản phẩm)
            $numItems = rand(1, 3);

            for ($i = 0; $i < $numItems; $i++) {
               $variant = collect($variantOptions)->random();
                $quantity = rand(1, 2);
                $unitPrice = $variant->price ?? 100;

                $total = $unitPrice * $quantity;

                $items[] = [
                    'id_order'      => $orderId,

                    'id_variant'    => $variant->id,
                    'variant_data'  => json_encode([
                        'size'  => $variant->size->name ?? 'Không rõ',
                        'color' => $variant->color->name ?? 'Không rõ'

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

