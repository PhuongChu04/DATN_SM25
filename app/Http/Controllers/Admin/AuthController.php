<?php

namespace App\Http\Controllers\Admin;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
     protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function login(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $req)
{
    try {
        $credentials = $req->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);
        Log::info('Login attempt: ', $credentials);

        if (Sentinel::authenticate($credentials)) {
            return redirect('/admin/dashboard')->with('success', 'Đăng nhập thành công!');
        } else {
            Log::error('Login failed: Invalid credentials for email ' . $credentials['email']);
            return redirect()->back()->withErrors([
                'error' => 'Email hoặc mật khẩu không đúng.'
            ])->withInput();
        }
    } catch (Exception $e) {
        Log::error('Login error: ' . $e->getMessage());
        return redirect()->back()->withErrors([
            'error' => 'Đã có lỗi xảy ra: ' . $e->getMessage()
        ])->withInput();
    }
}

     public function logout(){
        Sentinel::logout();
        return redirect()->route('admin.auth.loginAdmin');
    }
    
     public function list()
    {
        // Lấy user có role super-admin hoặc admin
        $users = $this->adminService->getAdmins(10);

        return view('admin.auth.listAdmin', compact('users'));
    }
    public function detail($id)
    {
        $user = $this->adminService->getAdminById($id);
        $roles = $this->adminService->getAllRoles();
        return view('admin.auth.adminDetail', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'roles' => 'array'
        ]);

        $this->adminService->updateAdmin($id, $request->all());

        return redirect()->route('admin.auth.listAdmin')->with('success', 'Cập nhật người dùng thành công');
    }
     // Hiển thị form
    public function showRegisterForm()
    {
        return view('admin.auth.addUser');
    }

    // Xử lý đăng ký
   public function postRegister(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email',
        'password'   => 'required|string|min:6',
        'role'       => 'required|in:super-admin,admin', // Sửa từ super-admin thành super-admin
    ]);

    $this->adminService->createAdmin($request->only(['first_name', 'last_name', 'email', 'password', 'role']));

    return redirect()->route('admin.auth.listAdmin')->with('success', 'Đăng ký admin thành công!');
}
}
