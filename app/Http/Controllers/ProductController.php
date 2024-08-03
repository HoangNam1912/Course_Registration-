<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Middleware\CheckLogin;
use Illuminate\Routing\Controllers\Middleware;


class ProductController extends Controller 
{

    // Request file

    public function showForm()
    {
        return view('upload');
    }

    public function uploadFile(Request $request)
    {
        // Kiểm tra nếu có file được upload
        if ($request->hasFile('file')) {
            // Kiểm tra file hợp lệ
            $request->validate([
                'file' => 'required|file|mimes:jpg,png,pdf|max:2048', // Chỉ chấp nhận file jpg, png, pdf và kích thước tối đa 2MB
            ]);

            // Lấy file từ request
            $file = $request->file('file');

            // Lưu file vào thư mục 'uploads'
            $path = $file->store('uploads');

            return 'File uploaded successfully. Path: ' . $path;
        } else {
            return 'No file selected.';
        }
    }
    public function detail()
    {      
        return ;
    }

    public function edit()
    {
        return ;
    }

    public function update(Request $request)
    {
    
        return;
    }

    public function delete(Request $request)
    {
    
        return;
    }

    public function about()  {
        // Generating URLs and Accessing The Current URL
        $url = url('/path');
   //     $currentUrl = url()->current();
        // URLs For Named Routes
        $urlname = route('about1');
        // URLs For Controller Actions
        $urlcontroller = action([ProductController::class, 'about']);
        return view('about', ['url' => $urlname] ,['url1' => $urlcontroller]);      
    }
    
}
