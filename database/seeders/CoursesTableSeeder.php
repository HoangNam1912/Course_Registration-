<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Facades\DB;


class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $courses = [
            ['course_name' => 'PHP Development', 'course_code' => 'PHP101'],
            ['course_name' => 'JavaScript Programming', 'course_code' => 'JS102'],
            ['course_name' => 'Python for Data Science', 'course_code' => 'PY103'],
            ['course_name' => 'Java Programming', 'course_code' => 'JV104'],
            ['course_name' => 'C++ Development', 'course_code' => 'CPP105'],
            ['course_name' => 'Ruby on Rails', 'course_code' => 'RB106'],
            ['course_name' => 'Swift for iOS', 'course_code' => 'SW107'],
            ['course_name' => 'Kotlin for Android', 'course_code' => 'KT108'],
            ['course_name' => 'Go Programming', 'course_code' => 'GO109'],
            ['course_name' => 'Rust Programming', 'course_code' => 'RS110'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
