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
            ['id' => 1, 'name' => 'Đen'],
            ['id' => 2, 'name' => 'Trắng'],
            ['id' => 3, 'name' => 'Xanh dương'],
            ['id' => 4, 'name' => 'Đỏ'],
            ['id' => 5, 'name' => 'Vàng'],
        ]);
    }
}
