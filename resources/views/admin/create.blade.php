<!DOCTYPE html>
<html>
<head>
    <title>Tạo Quốc gia Mới</title>
</head>
<body>
    <h1>Tạo Quốc gia Mới</h1>

 
    <form method="POST" action="{{ url('/api/admin/countries') }}">
        @csrf
        <div>
            <label for="country_code">Mã Quốc gia:</label>
            <input type="text" id="country_code" name="country_code" value="{{ old('country_code') }}" required maxlength="3">
        </div>
        <div>
            <label for="country_name">Tên Quốc gia:</label>
            <input type="text" id="country_name" name="country_name" value="{{ old('country_name') }}" required>
        </div>
        <div>
            <button type="submit">Tạo Quốc gia</button>
        </div>
    </form>
</body>
</html>







