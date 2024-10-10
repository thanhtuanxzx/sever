<!DOCTYPE html>
<html>
<head>
    <title>Đặt lại mật khẩu</title>
</head>
<body>
    <h1>Đặt lại mật khẩu</h1>
    <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn.</p>
    <p>Để đặt lại mật khẩu, vui lòng nhấp vào liên kết dưới đây:</p>
    <p><a href="{{ url('reset-password?token=' . $token) }}">Đặt lại mật khẩu</a></p>
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
</body>
</html>
