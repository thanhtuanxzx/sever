<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
   <div id="banner"></div>

    <div class="layout-login">
        <div class="registration-container">
        <h2>Đăng Ký</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <div class="form-group">
                <label for="first_name">Tên đệm và tên</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
            </div>
            <div class="form-group">
                <label for="last_name">Họ</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
            </div>
            <div class="form-group">
                <label for="organization">Cơ quan</label>
                <input type="text" id="organization" name="organization" class="form-control" value="{{ old('organization') }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Điện thoại</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="nationality">Quốc tịch</label>
                <input type="text" id="nationality" name="nationality" class="form-control" value="{{ old('nationality') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="username">Tên tài khoản</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Nhập lại mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <div class="form-check">
                <input type="checkbox" id="agree_terms" name="agree_terms" class="form-check-input" {{ old('agree_terms') ? 'checked' : '' }} required>
                <label for="agree_terms" class="form-check-label">Tôi đồng ý để dữ liệu của tôi được thu thập và lưu trữ theo cam kết bảo mật.</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="subscribe" name="subscribe" class="form-check-input" {{ old('subscribe') ? 'checked' : '' }}>
                <label for="subscribe" class="form-check-label">Có, tôi muốn được thông báo về các ấn phẩm và thông báo mới.</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="reviewer" name="reviewer" class="form-check-input" {{ old('reviewer') ? 'checked' : '' }}>
                <label for="reviewer" class="form-check-label">Ông/Bà có sẵn sàng để làm phản biện cho tạp chí này? Có, yêu cầu vai trò Người phản biện.</label>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Ký</button>
        </form>
        </div>
    </div>
    
    <div id="footer"></div>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>
</html>
