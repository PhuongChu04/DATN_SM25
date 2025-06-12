<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('sizes')->insert([
            ['id' => 42, 'name' => '42'],
            ['id' => 43, 'name' => '43'],
        ]);
    }
}
