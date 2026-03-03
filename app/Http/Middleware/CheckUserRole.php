<?php

namespace App\Http\Middleware;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Sentinel::getUser();

        if (!$user) {
            return redirect()->route('admin.auth.loginAdmin')->with('error', 'Bạn cần đăng nhập.');
        }
         if ($user->status == 0) {
            Sentinel::logout();
            return redirect()->route('admin.auth.loginAdmin')->with('error', 'Tài khoản của bạn đã bị khóa.');
        }

        // Kiểm tra xem user có vai trò admin hoặc superadmin
        if ($user->inRole('admin') || $user->inRole('super-admin')) {
            return $next($request); // Cho phép truy cập
        }
        if($user->inRole('super-admin')){
            return redirect()->route('admin.auth.listAdmin')->with('error','Bạn không có quyền truy cập.');
        }

        // Ngược lại, chuyển hướng
        return redirect()->route('admin.auth.loginAdmin')->with('error', 'Bạn không có quyền truy cập trang này.');
    
    }
}
