<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Classes;

class ClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            Classes::create([
                'course_id' => $course->id,
                'class_name' => 'Học Hè',
                'class_code' => $course->course_code . '-HE',
                'start_date' => now(),
                'end_date' => now()->addMonths(3),
                'schedule' => 'Mon-Wed-Fri',
                'description' => 'Lớp học hè cho khóa ' . $course->course_name,
            ]);

            Classes::create([
                'course_id' => $course->id,
                'class_name' => 'Học Chính Thức',
                'class_code' => $course->course_code . '-CT',
                'start_date' => now(),
                'end_date' => now()->addMonths(6),
                'schedule' => 'Tue-Thu-Sat',
                'description' => 'Lớp học chính thức cho khóa ' . $course->course_name,
            ]);
        }
    }
}
