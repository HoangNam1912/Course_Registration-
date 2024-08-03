<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class Reponses extends Controller
{
    // Creating Responses
    // Passing Data To Views
    public function createJsonResponse()
    {
         $data = ['name' => 'Nam', 'age' => 21];

        return response()->json($data);
    }
    // Redirects
    public function redirectToRoute()
    {
        return redirect()->route('home');
    }
    // Other Response Types
    public function customResponse()
    {
        return response('Hello, World!', 200)
            ->header('Content-Type', 'text/plain');
    }
    //  Response Macros
    public function boot()
    {
         Response::macro('caps', function ($value) {
        return Response::make(strtoupper($value));
    });
    }


}
