<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

</head>
<body>
    <div class="container">
        <h2>Đặt lại mật khẩu</h2>
        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

      
        <form action="{{ route('reset.password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email -->
            <div class="input-group">
                <label for="email">Email</label>
    
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- New Password -->
            <div class="input-group">
                <label for="password">Mật khẩu mới</label>
                <input type="password" id="password" name="password" required>
            </div>

            <!-- Confirm New Password -->
            <div class="input-group">
                <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn">Đặt lại mật khẩu</button>
        </form>
    </div>
</body>
</html>
