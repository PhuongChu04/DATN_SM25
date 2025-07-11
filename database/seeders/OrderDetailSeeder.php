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

        $variants = ProductVariant::with(['size', 'color'])->get(); // Lấy variant có quan hệ size, color

        if ($variants->isEmpty()) {
            $this->command->warn('Không có product variants để tạo order details.');
            return;
        }


        $now = Carbon::now();

        foreach ($orders as $orderId) {
            $items = [];

            // Random số lượng sản phẩm trong mỗi đơn (1–3 sản phẩm)
            $numItems = rand(1, 3);

            for ($i = 0; $i < $numItems; $i++) {

                $variant = $variants->random();
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

