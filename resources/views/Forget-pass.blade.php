<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Đăng Nhập</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div id="banner"></div>
    <div class="layout-login">
        <div class="login-container">
            <h2>Quên mật khẩu</h2>
            <form action="{{ route('password.forgot') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="email">Email</label>
                  
                    <input type="email" id="email" name="email" required>
                </div>
                
                <button type="submit" class="login-btn">Gửi mã </button>
                <span></span>
                <a href="/register"><button type="button" class="forget-pass-btn">Đăng ký</button></a>
                </form>

            <!-- Thông báo cho người dùng -->
            <div class="notification">
                <p>Vui lòng kiểm tra email của bạn để nhận mã .</p>
            </div>

        </div>
    </div>
    
    <div id="footer"></div>
    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>
</html>