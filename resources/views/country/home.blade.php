<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách quốc gia</title>
</head>
<body>

    <h1>Danh sách quốc gia</h1>
    <ul>
    @foreach ($countries as $country)
            <li>{{ $country->id }} - {{ $country->country_code }}: {{ $country->country_name }}</li>
        @endforeach
    </ul>
    

</body>
</html>
