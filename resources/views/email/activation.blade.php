<!-- resources/views/emails/activation.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Kích hoạt Tài khoản</title>
</head>
<body>
    <h1>Kích hoạt Tài khoản của bạn</h1>
    <p>Kính gửi {{ $user->first_name }},</p>
    <p>Cảm ơn bạn đã đăng ký. Vui lòng nhấp vào liên kết bên dưới để kích hoạt tài khoản của bạn:</p>
    <a href="{{ url('api/activate', $user->activation_token) }}">Kích hoạt Tài khoản</a>
    <p>Nếu bạn không đăng ký, vui lòng bỏ qua email này.</p>
</body>
</html>
