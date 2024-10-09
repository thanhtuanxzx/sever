<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
@if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
        </ul>
    <div id="banner"></div>
    <div class="layout-login">
        <div class="login-container">
            <h2>Đăng Nhập</h2>
            <form method="POST" action="{{ url('/login') }}">
            @csrf
                <div class="input-group">
                    <label for="login">Tên tài khoản / Địa chỉ email</label>
                    <input type="text" id="login" name="login" required>
                </div>
                <div class="input-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember-me" name="remember-me">
                        <label for="remember-me">Giữ đăng nhập</label>
                    </div>
                    <a href="#" class="forgot-password">Quên mật khẩu?</a>
                </div>
                <button type="submit" class="login-btn">Đăng Nhập</button>
            </form>
            
        </div>
    </div>
    
    <div id="footer"></div>
    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>
</html>
