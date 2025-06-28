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
                
                'name' => 'Giày thể thao nam',
                'descrition' => 'Giày thể thao nam, chất liệu da cao cấp, thiết kế hiện đại.',
                'id_brand' => 1,
                'id_category' => 1,
                'image_primary' => 'images/products/shoe1.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
               
                'name' => 'Giày chạy bộ nữ',
                'descrition' => 'Giày chạy bộ nhẹ, thoáng khí, thiết kế chuyên nghiệp.',
                'id_brand' => 1,
                'id_category' => 1,
                'image_primary' => 'images/products/shoe2.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
          
                'name' => 'Giày sneaker unisex',
                'descrition' => 'Giày sneaker phong cách, phù hợp cho mọi giới tính.',
                'id_brand' => 2,
                'id_category' => 1,
                'image_primary' => 'images/products/shoe3.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
             
                'name' => 'Giày da công sở',
                'descrition' => 'Giày da nam công sở, sang trọng và bền bỉ.',
                'id_brand' => 3,
                'id_category' => 2,
                'image_primary' => 'images/products/shoe4.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            
                'name' => 'Giày sandal nữ',
                'descrition' => 'Sandal nữ nhẹ nhàng, phù hợp đi dạo và đi làm.',
                'id_brand' => 2,
                'id_category' => 3,
                'image_primary' => 'images/products/shoe5.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
              
                'name' => 'Giày leo núi chuyên dụng',
                'descrition' => 'Giày leo núi bền chắc, chống trơn trượt tốt.',
                'id_brand' => 4,
                'id_category' => 4,
                'image_primary' => 'images/products/shoe6.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'name' => 'Giày tập gym',
                'descrition' => 'Giày tập gym hỗ trợ tốt cho việc tập luyện.',
                'id_brand' => 1,
                'id_category' => 1,
                'image_primary' => 'images/products/shoe7.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
              
                'name' => 'Giày lười nam',
                'descrition' => 'Giày lười nam tiện lợi, phù hợp đi làm và đi chơi.',
                'id_brand' => 3,
                'id_category' => 2,
                'image_primary' => 'images/products/shoe8.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
            
                'name' => 'Giày cao gót nữ',
                'descrition' => 'Giày cao gót nữ thanh lịch, dành cho các dịp đặc biệt.',
                'id_brand' => 2,
                'id_category' => 3,
                'image_primary' => 'images/products/shoe9.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                
                'name' => 'Giày bảo hộ lao động',
                'descrition' => 'Giày bảo hộ an toàn, chắc chắn, phù hợp công trường.',
                'id_brand' => 4,
                'id_category' => 5,
                'image_primary' => 'images/products/shoe10.jpg',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
