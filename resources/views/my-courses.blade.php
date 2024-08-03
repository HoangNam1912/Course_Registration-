<!-- resources/views/my-courses.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học của tôi</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Khóa học của tôi</h1>

        @if($courses->isEmpty())
            <p>Bạn chưa đăng ký khóa học nào.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên Khóa học</th>
                        <th>Mô tả</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->course_code }}</td>                
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
</body>
</html>
