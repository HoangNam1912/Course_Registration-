<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthorizeWebAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem session 'api_token' có tồn tại không
        if (!Session::has('api_token5')) {
            Session::put('url.intended', $request->fullUrl());
            return redirect()->route('login')->with('error', 'Bạn chưa đăng nhập.');
        }

        // Lấy token từ session
        $token = Session::get('api_token5');

        try {
            // Xác thực token
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                return redirect()->route('login')->with('error', 'Phiên đăng nhập của bạn đã hết hạn hoặc không hợp lệ. Vui lòng đăng nhập lại.');
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ khi xác thực token không thành công
            return redirect()->route('login')->with('error', 'Đăng nhập không thành công. Vui lòng thử lại.');
        }

        // Cho phép request tiếp tục
        return $next($request);
    }
}
