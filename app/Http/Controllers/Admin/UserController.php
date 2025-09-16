<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
     protected $userService;

    // Khởi tạo và inject service
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
   public function list()
{
    $users = \App\Models\User::select('id', 'email', 'first_name',  'status','permissions')
        ->leftJoin('role_users', 'users.id', '=', 'role_users.user_id')
        ->whereNull('role_users.user_id') // Lọc user không có trong bảng role_users
        ->paginate(10);

    return view('admin.auth.listUser', compact('users'));
}
    public function createUser(){

        return view('admin.auth.addUser'); 
    }
    // Gọi đến service đăng ký
    public function postRegister(Request $req)
    {
        return $this->userService->postRegister($req);
    }

    // Gọi đến service hiển thị chi tiết tài khoản
    public function userDetail($id)
{
    return $this->userService->userDetail($id);
}

    // Gọi đến service cập nhật thông tin tài khoản

    public function updateAccountDetail(Request $req, $id)
    {
        return $this->userService->updateAccountDetail($req, $id);
    }
    public function deleteUser($id)
{
    return $this->userService->deleteUser($id);
}


    
}
