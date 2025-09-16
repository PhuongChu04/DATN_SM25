<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Tạo vai trò super-admin
            $superAdmin = Role::firstOrCreate(
                ['slug' => 'super-admin'],
                [
                    'name' => 'Super Admin',
                    'permissions' => json_encode([]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
            Log::info('Tạo vai trò super-admin: ', ['id' => $superAdmin->id, 'slug' => $superAdmin->slug]);

            // Tạo vai trò admin
            $admin = Role::firstOrCreate(
                ['slug' => 'admin'],
                [
                    'name' => 'Admin',
                    'permissions' => json_encode([]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
            Log::info('Tạo vai trò admin: ', ['id' => $admin->id, 'slug' => $admin->slug]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo vai trò: ', ['message' => $e->getMessage()]);
            throw $e;
        }
    }
}