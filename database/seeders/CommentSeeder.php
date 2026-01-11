<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy các admin đã được seed sẵn từ UserSeeder
        $admins = User::whereJsonContains('permissions', ['admin' => true])->get();

        // Nếu chưa có user thường, tạo thêm 2 người dùng
        $users = User::where(function ($query) {
            $query->whereNull('permissions')
                  ->orWhereJsonContains('permissions', ['admin' => false]);
        })->get();

        if ($users->isEmpty()) {
            $users = collect([
                User::create([
                    'email' => 'user1@example.com',
                    'password' => bcrypt('password'),
                    'first_name' => 'User',
                    'last_name' => 'One',
                ]),
                User::create([
                    'email' => 'user2@example.com',
                    'password' => bcrypt('password'),
                    'first_name' => 'User',
                    'last_name' => 'Two',
                ]),
            ]);
        }

        // Lấy sản phẩm đã có (bắt buộc phải có trước đó)
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->error(' Chưa có sản phẩm! Hãy chạy ProductsSeeder trước.');
            return;
        }

        // Tạo 10 bình luận giả
        foreach (range(1, 10) as $i) {
            $comment = Comment::create([
                'user_id' => $users->random()->id,
                'product_id' => $products->random()->id,
                'content' => fake()->sentence(),
            ]);

            // 50% cơ hội có phản hồi từ admin
            if (rand(0, 1)) {
                CommentReply::create([
                    'comment_id' => $comment->id,
                    'admin_id' => $admins->random()->id,
                    'content' => fake()->sentence(),
                ]);
            }
        }
    }
}
