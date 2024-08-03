<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Reponses;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AdminControllers\Admin;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ProfileController; 


// basic routing
Route::get('/', function () {
    return view('index');
});

// Defining Middleware // Registering Middleware //Middleware Parameters
Route::get('/admin', function () {
    return view('welcome');
   })->middleware(CheckLogin::class);
   //->middleware(CheckRole::admin);

//Route Parameters
Route::get('/user', function (Request $request) {
    $id = $request->query('id');
    return 'User ID: ' . $id;
}); 


Route::get('about', [ProductController::class, 'about'])->name('about1');



// Group 
Route::group(['prefix' => 'product'], function () {
    Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::post('edit', [ProductController::class, 'add'])->name('product.add');
    Route::delete('update/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Form Method Spoofing
    Route::get('{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('{product}', [ProductController::class, 'update'])->name('products.update');

    // Request file
    Route::get('/upload', [ProductController::class, 'showForm'])->name('products.showForm');
    Route::post('/upload', [ProductController::class, 'uploadFile'])->name('products.uploadFile');
    
});
// Route Model Binding
Route::get('detail/{product}', [ProductController::class, 'detail'])->name('product.detail');

// Fallback Route
Route::fallback(function () {
    return response()->view('error.404', [], 404);
});

// Accessing The Current Route
$currentRouteName = Route::currentRouteName();

// Route::get('/login', function () {
//     return view('login');
//  });

 // Route::get('/profile/{id}', [UserController::class, 'show']);

 Route::get('profile', [UserController::class, 'index']);



 // Creating Responses
 Route::get('/json-response', [Reponses::class, 'createJsonResponse']);

// Redirects
Route::get('/redirect-home', [Reponses::class, 'redirectToRoute']);

// Other Response Types
Route::get('/custom-response', [Reponses::class, 'customResponse']);

Route::get('/use-macro', function () {
    return response()->caps('hello world');
});
Route::get('/research', [ResearchController::class, 'showForm']);
Route::post('/research', [ResearchController::class, 'validateResearch']);

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Register
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Activation email
Route::get('/activate/{token}', [AuthController::class, 'activate']);
Route::get('activation/notice', function () {
    return view('Auth.activation_notice');
})->name('activation.notice');


Route::group(['middleware' => 'auth.web'], function() { 
   Route::get('class', [ClassesController::class, 'getAllClass']);
   Route::get('/countries', [Admin::class, 'getAllCountries']);
   Route::get('courses', [CoursesController::class, 'getAllCourses']);
   Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
   Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


   Route::post('courses/register', [CoursesController::class, 'register']);
   Route::get('courses/my-courses', [CoursesController::class, 'myCourses']);

   Route::post('class/register', [ClassesController::class, 'register']);
   Route::get('class/my-classes', [ClassesController::class, 'myclasses']);

   Route::get('/summary', function () {
    return view('sumary');
});
});
