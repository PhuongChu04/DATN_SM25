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
    {DB::table('product_variants')->insert([
            [
                'id_product' => 1,
                'id_color' => 1,
                'id_size' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_product' => 1,
                'id_color' => 2,
                'id_size' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_product' => 2,
                'id_color' => 3,
                'id_size' => '43',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_product' => 2,
                'id_color' => 4,
                'id_size' => '42',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
            
        ]);
    }
}
