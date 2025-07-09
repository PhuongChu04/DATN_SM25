<?php

namespace App\Http\Controllers\Admin;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RoleController extends Controller
{
    public function createRole()
    {
        return view('admin.auth.register');
    }
    public function postCreateRole(Request $request)
    {
        // Tạo mới role
        // create role user
        // $role = Sentinel::getRoleRepository()->createModel()->create([
        //     'name' => 'User',
        //     'slug' => 'user',
        // ]);
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:roles,slug',
        ]);

        // Create role using Sentinel
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->back()->with('success', 'Tạo Role thành công!');
    }
    public function showAttachForm()
    {
        $roles = Sentinel::getRoleRepository()->get(); // Lấy tất cả vai trò
        return view('admin.auth.rolePermission', compact('roles'));
    }


    
    public function attachUserRole(Request $request)
    {
        // $user = Sentinel::findById($request->email);
        // $role = Sentinel::findRoleByName($request->role_name);
        $user = Sentinel::findByCredentials(['login' => $request->email]); // Đúng cách tìm theo email
        $role = Sentinel::findRoleBySlug($request->role_name);

        if (!$user || !$role) {
            return back()->with('error', 'Người dùng hoặc vai trò không tồn tại.');
        }

        $role->users()->attach($user);

        return back()->with('success', 'Gán vai trò thành công!');
    }





    public function list(){
        
    }
}
