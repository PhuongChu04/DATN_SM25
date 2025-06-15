<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('brands')->insert([
    ['id' => 1, 'name' => 'Nike', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ['id' => 2, 'name' => 'Adidas', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ['id' => 3, 'name' => 'Puma', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ['id' => 4, 'name' => 'Reebok', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
    ['id' => 5, 'name' => 'Under Armour', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
]);
    }
}
