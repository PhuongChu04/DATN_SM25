<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('order_details')->insert([
            [
                'id_order' => DB::table('orders')->inRandomOrder()->value('id'),
                'id_variant'    => 3,
                'variant_data'  => json_encode([
                    'color' => 'Đen',
                    'size' => '42'
                ]),
                'quantity'      => 2,
                'unit_price'    => 1200000,
                'total'         => 2400000,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            // Có thể thêm nhiều dòng khác ở đây nếu muốn
        ]);
    }
}
