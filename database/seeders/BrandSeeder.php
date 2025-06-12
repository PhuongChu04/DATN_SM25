<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['id' => 1, 'name' => 'Nike'],
            ['id' => 2, 'name' => 'Adidas'],
            ['id' => 3, 'name' => 'Puma'],
            ['id' => 4, 'name' => 'Reebok'],
            ['id' => 5, 'name' => 'Under Armour'],
        ]);
    }
}
