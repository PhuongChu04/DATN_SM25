<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSentinelMiddleware
{
    /**
     * Handle an incoming request.
     */
   public function handle(Request $request, Closure $next): Response
    {
        $user = Sentinel::check();

        if (!$user) {
            return redirect()->route('admin.auth.loginAdmin')->with('error', 'Bạn cần đăng nhập.');
        }

        if ($user->inRole('super-admin') || $user->inRole('admin')) {
            return $next($request);
        }

        return redirect()->route('admin.auth.loginAdmin')->with('error', 'Bạn không có quyền truy cập.');
    }
}
