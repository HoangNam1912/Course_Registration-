<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    // Lưu trữ dữ liệu vào session
    public function storeSessionData(Request $request)
    {
        $request->session()->put('key', 'value');
        return ;
    }

    // Lấy dữ liệu từ session
    public function getSessionData(Request $request)
    {
        $value = $request->session()->get('key', 'default');
        return;
    }

    // Kiểm tra sự tồn tại của một giá trị trong session
    public function checkSessionData(Request $request)
    {
        if ($request->session()->has('key')) {
            return;
        } else {
            return ;
        }
    }

    // Xóa một giá trị khỏi session
    public function deleteSessionData(Request $request)
    {
        $request->session()->forget('key');
        return ;
    }

    // Lấy và xóa một giá trị khỏi session
    public function pullSessionData(Request $request)
    {
        $value = $request->session()->pull('key', 'default');
        return ;
    }

    // Lấy tất cả dữ liệu trong session
    public function getAllSessionData(Request $request)
    {
        $data = $request->session()->all();
        return $data;
    }

    // Xóa tất cả dữ liệu trong session
    public function flushSessionData(Request $request)
    {
        $request->session()->flush();
        return ;
    }
}
