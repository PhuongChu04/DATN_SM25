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

        // Kiểm tra trạng thái người dùng
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->status == 0) {
            Log::warning('Đăng nhập không thành công: Tài khoản buộc dừng hoạt động', ['email' => $credentials['email']]);
            return redirect()->back()->withErrors([
                'error' => 'Tài khoản của bạn đã bị khóa. Vui lòng liên hệ quản trị viên.'
            ])->withInput();
        }

        if (Sentinel::authenticate($credentials)) {
            return redirect('/admin/dashboard')->with('success', 'Đăng nhập thành công!');
        } else {
            Log::error('Đăng nhập không thành công: Thông tin đăng nhập email không hợp lệ ' . $credentials['email']);
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
        'role'       => 'required|in:super-admin,admin', 
    ]);

    $this->adminService->createAdmin($request->only(['first_name', 'last_name', 'email', 'password', 'role']));

    return redirect()->route('admin.auth.listAdmin')->with('success', 'Đăng ký admin thành công!');
}
public function deleteUser($id)
{
    return $this->adminService->deleteUser($id);
}
// public function toggleStatus(Request $request, $id)
// {
//     try {
//         $request->validate([
//             'status' => 'boolean',
//         ]);

//         $this->adminService->toggleStatus($id, $request->input('status', false));

//         return redirect()->route('admin.auth.listAdmin')->with('success', 'Cập nhật trạng thái người dùng thành công!');
//     } catch (Exception $e) {
//         Log::error('Lỗi khi cập nhật trạng thái người dùng: ' . $e->getMessage());
//         return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái.']);
//     }
// }
public function toggleStatus(Request $request, $id)
{
    try {
        $request->validate([
            'status' => 'boolean',
        ]);

        $this->adminService->toggleStatus($id, $request->input('status', false));

        // Kiểm tra xem user có role admin hay không để chuyển hướng
        // $user = User::findOrFail($id);
        // $redirectRoute = $user->hasAnyRole(['admin', 'super-admin']) ? 'auth.listAdmin' : 'auth.list';

        return redirect()->back()->with('success', 'Cập nhật trạng thái người dùng thành công!');
    } catch (Exception $e) {
        Log::error('Lỗi khi cập nhật trạng thái người dùng: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái.']);
    }
}
// public function toggleStatusUser(Request $request, $id)
// {
//     try {
//         $request->validate([
//             'status' => 'boolean',
//         ]);

//         $this->adminService->toggleStatusUser($id, $request->input('status', false));

//         return redirect()->route('admin.auth.list')->with('success', 'Cập nhật trạng thái người dùng thành công!');
//     } catch (Exception $e) {
//         Log::error('Lỗi khi cập nhật trạng thái người dùng: ' . $e->getMessage());
//         return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật trạng thái.']);
//     }
// }
}
