<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    

    protected $userModel;
    /**
     * Display a listing of the resource.
     */

     public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function show(string $id): View
    {
        $user = $this->userModel->findOrFail($id);

        return view('profile', ['profile' => $user]);
    }
 

     // Request input
    public function index(Request $request)
    {
        $id = $request->input('id');
        return view('profile', ['id' => $id]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // Tạo validator để xác thực dữ liệu từ request
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
    ]);

    // Kiểm tra xem dữ liệu có hợp lệ không
    if ($validator->fails()) {
        // Xử lý khi validation fails
        return redirect('form')
                    ->withErrors($validator)
                    ->withInput();
    }

    // Nếu validation thành công, bạn có thể tiếp tục xử lý dữ liệu
    // Ví dụ: lưu vào cơ sở dữ liệu, gửi email xác nhận, vv.
    // User::create($request->all());
    // Mail::to($request->input('email'))->send(new WelcomeEmail());

    return redirect('dashboard')->with('success', 'Dữ liệu đã được lưu thành công!');
    }

    // Working With Validated Input
    // Lấy dữ liệu sau khi đã được xác thực
    // public function store(StoreUserRequest $request)
    // {
    //     $validatedData = $request->validated();

    //     $name = $validatedData['name'];
    //     $email = $validatedData['email'];

    //     
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request) {
        // Validation Quickstart & Available Validation Rules & Conditionally Adding Rules & Validating Passwords
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function CustomValidationRules() {
        Validator::extend('uppercase', function ($attribute, $value, $parameters, $validator) {
            return strtoupper($value) === $value;
        });
        
        $rules = [
            'name' => 'required|uppercase',
        ];
        
    }
}
