<?php

namespace App\Services;

use App\Models\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminService
{
    public function getAdmins($perPage = 10)
    {
        return User::whereHas('roles', function ($query) {
            $query->whereIn('slug', ['super-admin', 'admin']);
        })->paginate($perPage);
    }
     public function getAdminById($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    public function updateAdmin($id, array $data)
    {
        $user = User::findOrFail($id);

        $user->update([
            'email' => $data['email'] ?? $user->email,
            'first_name' => $data['first_name'] ?? $user->first_name,
            'last_name' => $data['last_name'] ?? $user->last_name,
        ]);

        // cập nhật roles
        if (isset($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        return $user;
    }

    public function getAllRoles()
    {
        return Role::all();
    }
    //add

    public function createAdmin(array $data)
    {
        // Tạo user
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'status'     => 1, // active
        ]);

        // Kiểm tra role tồn tại trước khi attach
        if (!empty($data['role'])) {
            $role = Role::where('slug', $data['role'])->first();
            if ($role) {
                $user->roles()->attach($role->id);
            } else {
                Log::error('Role không tồn tại: '.$data['role']);
            }
        }

        return $user;
    }
}