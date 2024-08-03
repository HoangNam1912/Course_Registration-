<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <h1>Lớp học của tôi</h1>
    @if($classes->isEmpty())
        <p>Bạn chưa đăng ký khóa học nào.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Tên Lớp học</th>
                    <th>Mã lớp học</th>                     
                    <th>Mô tả</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $class)
                    <tr>
                        <td>{{ $class->class_name }}</td>
                        <td>{{ $class->class_code }}</td>      
                        <td>{{ $class->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="container">
        <h1>Khóa học của tôi</h1>

        @if($courses->isEmpty())
            <p>Bạn chưa đăng ký khóa học nào.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên Khóa học</th>
                        <th>Mã môn học</th>
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

    </div>

  
  
</body>
</html>