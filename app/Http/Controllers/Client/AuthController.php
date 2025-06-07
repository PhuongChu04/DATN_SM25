<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Exception;

use function Laravel\Prompts\alert;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.auth.login');
    }
    public function register()
    {
        return view('client.auth.register');
    }

    public function postLogin(Request $req) {
        try {
         $credentials = $req->validate([
                
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
            // $user = Sentinel::authenticate($credentials);

            // if ($user) {
            //     return redirect()->route('client.dashboard')->with([
            //         'message' => 'Đăng nhập thành công!'
            //     ]);
            // }

            // return redirect()->back()->withErrors([
            //     'error' => 'Email hoặc mật khẩu không đúng.'
            // ])->withInput();
            Sentinel::authenticate($credentials);
             return redirect('/client/dashboard')->with([
                // alert('Đăng Nhập thành công!')
            ]);
        }catch (Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Email hoặc password sai: ' . $e->getMessage()
            ])->withInput();
        }
    }
    public function postRegister(Request $req)
    {
        try {
            $credentials = $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            Sentinel::registerAndActivate($credentials);

            return redirect('/auth/dashboard')->with([
                'message' => 'Đăng ký thành công! Vui lòng đăng nhập.'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'Đăng ký thất bại: ' . $e->getMessage()
            ])->withInput();
        }
    }
    public function logoutClient(){
        Sentinel::logout();
        return redirect()->route('client.homeClient');
    }
    public function updateAccountDetail(Request $req){
        $validated = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'newPassword' => 'required|string|min:6|confirmed',
        ]);
        $user = Sentinel::getUser();
        if(!Sentinel::checkPassWord($user,$req->input('pass'))){
            return redirect()->back()->withErrors(['pass' => 'Mật khẩu không khớp với mật khẩu cũ']);
        }
         // Cập nhật thông tin người dùng
        $user->first_name = $req->input('firstname');
        $user->last_name = $req->input('lastname');
        $user->email = $req->input('email');

        // Cập nhật mật khẩu mới
        $user->password = bcrypt($req->input('newpass'));
         return redirect()->route('client.accountDetail')->with('success', 'Thông tin tài khoản đã được cập nhật thành công!');
   
    }
}
