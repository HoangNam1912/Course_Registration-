<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
</head>
<body>
    <div class="container">
        <form action="{{ url('/upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="file">Choose file:</label>
                <input type="file" id="file" name="file">
            </div>
            <div>
                <button type="submit">Upload</button>
            </div>
        </form>

      
    </div>
</body>
</html>
