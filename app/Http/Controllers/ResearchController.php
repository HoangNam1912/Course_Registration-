<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Validation\Rules\Password;

class ResearchController extends Controller
{

    // Validation Quickstart
    public function showForm()
    {
        return view('Valation.research');
    }

    public function validateResearch(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'abstract' => 'required|string|max:1000',
            'file' => 'required|file|mimes:pdf|max:3072', // Kích thước tối đa 3mb
        ]);

        if ($validator->fails()) {
            return redirect('/research')
                ->withErrors($validator)
                ->withInput();
        }
    }
    //  Form Request Validation

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
    }

    //  Working With Error Messages
    public function ErrorMessages(Request $request)
    {
        $messages = [
            'name.required' => 'Chúng tôi cần biết tên của bạn!',
            'email.required' => 'Chúng tôi cần biết địa chỉ email của bạn!',
        ];

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ], $messages);
    }

    public function  AvailableValidationRules(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email',
            'url' => 'required|url',
            'ip' => 'required|ip',
            'age' => 'required|integer|min:18|max:65',
            'password' => 'required|string|min:8|confirmed',
            'accepted' => 'accepted',
            'file' => 'file|mimes:jpeg,png,pdf|max:2048',
        ]);
    }

    public function ValidatingArrays(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
    }


    public function ValidatingPasswords(Request $request)
    {
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        // Proceed with the validated data
    }
}
