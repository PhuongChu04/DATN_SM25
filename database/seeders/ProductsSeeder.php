<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Giày thể thao',
                'descrition' => 'Giày thể thao nam, chất liệu da cao cấp, thiết kế hiện đại.',
                'id_brand' => 1,
                'id_category' => 1,
                'image_primary' => 'images/products/shoe1.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
