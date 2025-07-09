<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Giày thể thao nam', 'id_parent' => null],
            ['id' => 2, 'name' => 'Giày thể thao nữ', 'id_parent' => null],
            ['id' => 3, 'name' => 'Giày công sở nam', 'id_parent' => null],
            ['id' => 4, 'name' => 'Giày công sở nữ', 'id_parent' => null],
            ['id' => 5, 'name' => 'Giày sandal nam', 'id_parent' => null],
            ['id' => 6, 'name' => 'Giày sandal nữ', 'id_parent' => null],
        ]);
    }
}
