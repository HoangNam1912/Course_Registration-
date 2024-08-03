<!DOCTYPE html>
<html>
<head>
    <title>Edit Country</title>
</head>
<body>
    <div class="page-content">
    <div class="page-header">
        <h1>Chỉnh Sửa Quốc Gia</h1>
    </div>
    <form method="POST" action="{{ url('/api/admin/countries/' . $country->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="country_code">Mã Quốc Gia:</label>
            <input type="text" id="country_code" name="country_code" value="{{ $country->country_code }}" class="form-control" required maxlength="3">
        </div>
        <div class="form-group">
            <label for="country_name">Tên Quốc Gia:</label>
            <input type="text" id="country_name" name="country_name" value="{{ $country->country_name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cập Nhật Quốc Gia</button>
        </div>
    </form>
</div>
</body>
</html>
