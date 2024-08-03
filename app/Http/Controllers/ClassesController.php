<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ProcessPodcast;

class ClassesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/classes",
     *     summary="Lấy tất cả các lớp học",
     *     @OA\Response(
     *         response=200,
     *         description="Lấy danh sách lớp học thành công"
     *     )
     * )
     */
    public function getAllClass()
    {
        $class = Classes::paginate(10); 

    return view('class', compact('class'));
    }

     /**
     * @OA\Post(
     *     path="/api/classes/register",
     *     summary="Đăng ký khóa học cho người dùng đã xác thực",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="class_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Đăng ký khóa học thành công"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Lớp học không tồn tại"
     *     )
     * )
     */

     /**
     * Đăng ký khóa học cho người dùng đã xác thực.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request )
    {
        $user = $request->user();

        $class = Classes::findOrFail($request->class_id);

        // Thêm khóa học cho người dùng
        $user->classes()->attach($class);

   
        return response()->json(['message' => 'Đăng ký khóa học thành công.']);
    }
    /**
     * @OA\Get(
     *     path="/api/my-classes",
     *     summary="Lấy danh sách lớp học của người dùng đã xác thực",
     *     @OA\Response(
     *         response=200,
     *         description="Lấy danh sách lớp học thành công"
     *     )
     * )
     */
    public function myclasses()
    {
        $user = Auth::user();
        $classes = $user->classes;
        return view('my-classes', compact('classes'));
    }
}
