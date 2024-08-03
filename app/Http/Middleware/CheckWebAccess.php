<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
class CheckWebAccess
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Kiểm tra xem token có hợp lệ hay không
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            // Nếu token không hợp lệ, lưu URL và chuyển hướng đến trang đăng nhập
          //  $request->session()->put('url.intended', $request->url());
            Session::put('url.intended', $request->url());
            return redirect()->route('login');
        }

        return $next($request);
    }
}
