<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variants')->insert([
            'id'         => 3,
            'id_product' => 1,
            'id_color'   => 1, // Đen
            'id_size'    => 42,
            'status'     => 'available',
            'price'      => 1200000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
