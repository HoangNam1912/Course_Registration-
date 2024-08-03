<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/research') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}">
    </div>
    <div>
        <label for="abstract">Abstract</label>
        <textarea id="abstract" name="abstract">{{ old('abstract') }}</textarea>
    </div>
    <div>
        <label for="file">File</label>
        <input type="file" id="file" name="file">
    </div>
    <button type="submit">Submit</button>
</form>

</body>
</html>