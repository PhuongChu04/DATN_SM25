<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        try {
            // Lấy vai trò super-admin
            $role = Role::where('slug', 'super-admin')->firstOrFail();
            Log::info('Sử dụng vai trò super-admin: ', ['id' => $role->id, 'slug' => $role->slug]);

            // Tạo người dùng giả
            $userData = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => 'password123',
            ];

            // Đăng ký và kích hoạt người dùng qua Sentinel
            $user = Sentinel::registerAndActivate([
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);

            // Cập nhật trạng thái
            $user->status = 1;
            $user->save();

            // Gán vai trò super-admin
            $user->roles()->attach($role->id);
            Log::info('Gán vai trò super-admin cho người dùng: ', ['email' => $user->email, 'role_id' => $role->id]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo dữ liệu giả: ', ['message' => $e->getMessage()]);
            throw $e;
        }
    }
}