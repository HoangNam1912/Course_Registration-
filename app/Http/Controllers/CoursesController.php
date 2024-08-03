<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth; 

class CoursesController extends Controller
{
/**
     * Display all courses.
     *
     * @return \Illuminate\View\View
     */
    public function getAllCourses()
    {
        return view('admin.courses');
    }
 /**
     * @OA\Get(
     *     path="/api/courses",
     *     summary="Lấy tất cả các khóa học",
     *     @OA\Response(
     *         response=200,
     *         description="Lấy danh sách khóa học thành công",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Course"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Khóa học không tồn tại",
     *         @OA\JsonContent(type="object", @OA\Property(property="code", type="integer", example=404), @OA\Property(property="error", type="string", example="Duong dan khong hop le"), @OA\Property(property="data", type="null"))
     *     )
     * )
     */
public function GEtapi()
{
    try {
        $course = Course::all();

        return response()->json([
            'code' => 200,
            'error' => null,
            'data' => $course,
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        return response()->json([
            'code' => 404,
            'error' => 'Duong dan khong hop le ',
            'data' => null,
        ], 404);
    }
}
   
    public function register(Request $request )
    {
        $user = $request->user();

        $course = Course::findOrFail($request->course_id);

        // Thêm khóa học cho người dùng
        $user->courses()->attach($course);

   
        return response()->json(['message' => 'Đăng ký khóa học thành công.']);
    }

    /**
     * Display the list of courses registered by the user.
     *
     * @return \Illuminate\View\View
     *
     * @OA\Get(
     *     path="/api/my-courses",
     *     summary="Get the list of courses registered by the user",
     *     @OA\Response(
     *         response=200,
     *         description="List of registered courses retrieved successfully"
     *     )
     * )
     */
    public function myCourses()
    {
        $user = Auth::user();
        $courses = $user->courses;
        return view('my-courses', compact('courses'));
    }
    



}


