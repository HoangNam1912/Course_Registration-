<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\AppsCountry;
use App\Models\Course;
use App\Models\Classes;
use GuzzleHttp\Psr7\Request;
use app\Models\User;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer(['admin.index', 'admin.country', 'admin.create', 'admin.edit'], function ($view) {
            $totalCountries = AppsCountry::count();
            $view->with('countries', AppsCountry::paginate(10));     
        });
        View::composer(['admin.courses'], function ($view) {
            $totalCourses = Course::count();
            $view->with('courses', Course::paginate(10));     
        });
        View::composer(['/class'], function ($view) {
            $totalClass = Classes::count();
            $view->with('class', Classes::paginate(10));     
        });

        View::composer('sumary', function ($view) {
            $user = User::findOrFail(auth()->id()); // Lấy thông tin người dùng hiện tại
            $courses = $user->courses; // Lấy danh sách các khóa học của người dùng
            $classes = $user->classes; // Lấy danh sách các lớp học của người dùng
        
            $view->with(compact('courses', 'classes'));
        });
    }
    
}



