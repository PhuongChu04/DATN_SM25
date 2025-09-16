<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        if ($users->count() == 0 || $products->count() == 0) {
            $this->command->warn('⚠️ Không có user hoặc product để tạo review.');
            return;
        }

        foreach ($products as $product) {
            Review::create([
                'user_id' => $users->random()->id,
                'product_id' => $product->id,
                'rating' => rand(1, 5),
                'comment' => fake()->paragraph(),
                'admin_reply' => rand(0, 1) ? fake()->sentence() : null,
            ]);
        }

        $this->command->info('✅ ReviewSeeder đã chạy thành công.');
    }
}

