<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppsCountryController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AdminControllers\Admin;
use Faker\Guesser\Name;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopifyController\ShopifyController;

/**
 * @OA\Info(
 *     title="API Documentation",
 *     version="1.0",
 *     description="API Documentation for Courses and Classes"
 * )
 */


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/countries', [AppsCountryController::class, 'getAllCountries'])->name('all');
Route::get('/countries/paginated', [AppsCountryController::class, 'getAllCountriesPaginated']);
Route::get('/countries/{id}', [AppsCountryController::class, 'getCountryById']);
Route::get('/countries/code/{code}', [AppsCountryController::class, 'getCountryByCode']);
Route::post('/countries/create', [AppsCountryController::class, 'store']);
Route::put('/countries/update/{id}', [AppsCountryController::class, 'update']);
Route::delete('/countries/{id}', [AppsCountryController::class, 'destroy']);



Route::prefix('admin')->group(function () {
Route::get('/', [Admin::class, 'index']);
Route::get('/country', [Admin::class, 'getAllCountries']);
// Create
Route::post('/countries' ,  [Admin::class, 'createCountry']);
Route::get('/create', [Admin::class, 'createCountryView']);
// Edit
Route::get('/countries/edit/{id}', [Admin::class, 'editCountryView'])->name('admin.countries.edit');
Route::put('/countries/{id}', [Admin::class, 'updateCountry'])->name('admin.countries.update');
// Delete
Route::delete('/countries/{id}', [Admin::class, 'deleteCountry'])->name('admin.countries.delete');
});


Route::group(['middleware' => 'auth.api'], function($router) { 
    Route::get('/courses', [CoursesController::class, 'getAllCourses']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    
});

Route::get('/courses', [CoursesController::class, 'GEtapi']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/activate/{token}', [AuthController::class, 'activate']);

