<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Mail\AccountActivation;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // Lấy thông báo lỗi từ session nếu có
        $errorMessage = Session::get('error_message');
        Session::forget('error_message'); // Xóa thông báo lỗi sau khi đã lấy ra

        return view('Auth.login', compact('errorMessage'));
    }

    public function login(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        //  đăng nhập người dùng
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            // Nếu thông tin đăng nhập không hợp lệ, chuyển hướng trở lại trang đăng nhập với thông báo lỗi
            return redirect()->route('login')->with('error', 'Đăng nhập không thành công. Vui lòng thử lại.');
        }
        // Chuyển hướng đến URL đích hoặc route mặc định
        $intendedUrl = Session::get('url.intended');
        Session::put('api_token5', $token);
        return redirect()->intended($intendedUrl);
        // return $this->respondWithToken($token);      
}

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
         //  'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
      //  Auth::guard('api')->logout(); // Đăng xuất người dùng khỏi guard 'api'

        Session::remove('api_token'); // Xóa token khỏi session
    
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công.');
    }

    public function refresh()
    {
    //    return $this->respondWithToken(Auth::guard('api')->refresh());
    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }


    public function showRegistrationForm()
    {
        return view('Auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|  max:255|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'dob' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'dob' => $request->dob,
            'status' => 'inactive',
            'activation_token' => Str::random(60),
        ]);

        Mail::to($user->email)->send(new AccountActivation($user));

        return redirect()->route('activation.notice');
    }

    public function activate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Token kích hoạt không hợp lệ.'], 404);
        }

        $user->status = 'active';
        $user->activation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return response()->json(['message' => 'Tài khoản đã được kích hoạt thành công.'], 200);
    }

    public function forgotPassword(Request $request)
{
    // 1. Xác thực dữ liệu đầu vào
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }

    // 2. Tìm người dùng với email đã cung cấp
    $user = User::where('email', $request->email)->first();

    // 3. Tạo mật khẩu mới ngẫu nhiên
    $newPassword = Str::random(10);
    $user->password = Hash::make($newPassword);
    $user->save();

    // 4. Gửi mật khẩu mới đến email của người dùng
   // Mail::to($user->email)->send(new NewPasswordMail($newPassword));

    // 5. Phản hồi JSON với thông báo thành công
    return response()->json(['message' => 'Mật khẩu mới đã được gửi đến địa chỉ email của bạn.'], 200);
}



}


