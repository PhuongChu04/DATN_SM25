<?php

namespace App\Http\Controllers\Admin;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Services\AdminService;

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

    public function postLogin(Request $req) {
        try {
         $credentials = $req->validate([
                
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
            Sentinel::authenticate($credentials);
             return redirect('/admin/dashboard')->with([
                
            ]);
        }catch (Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Email hoặc password sai: ' . $e->getMessage()
            ])->withInput();
        }
    }

     public function logout(){
        Sentinel::logout();
        return redirect()->route('admin.auth.loginAdmin');
    }
    
     public function list()
    {
        // Lấy user có role super_admin hoặc admin
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
            'role'       => 'required|in:super_admin,admin',
        ]);

        $this->adminService->createAdmin($request->only(['first_name','last_name','email','password','role']));


     return redirect()->route('admin.auth.listAdmin')->with('success', 'Đăng ký admin thành công!');
    }
}
