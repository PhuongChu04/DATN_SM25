<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('colors')->insert([
            ['id' => 1, 'name' => 'Đen', 'code' => '#000000'],
            ['id' => 2, 'name' => 'Trắng', 'code' => '#000000'],
            ['id' => 3, 'name' => 'Xanh dương', 'code' => '#000000'],
            ['id' => 4, 'name' => 'Đỏ', 'code' => '#000000'],
            ['id' => 5, 'name' => 'Vàng', 'code' => '#000000'],
        ]);
    }
}
