<?php

namespace App\Http\Middleware;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SentinelAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    if (Sentinel::check()) {
        $user = Sentinel::getUser();

        // kiểm tra status
        if ($user->status == 0) {
            Sentinel::logout();
            return redirect()->route('auth.loginClient')
                ->with('error', 'Tài khoản của bạn đã bị khóa.');
        }

        return $next($request);
    }

    return redirect()->route('auth.loginClient')
        ->with('message', 'Vui lòng đăng nhập để tiếp tục.');
}


}
