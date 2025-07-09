<?php

namespace App\Http\Controllers\Admin;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class AuthController extends Controller
{
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
}
