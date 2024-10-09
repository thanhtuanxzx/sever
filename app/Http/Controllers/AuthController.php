<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail; // Đảm bảo rằng bạn đã tạo lớp email này

class AuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('register'); // Thay 'register' bằng tên view của bạn
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'nationality' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'agree_terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Tạo một token ngẫu nhiên
        $token = \Str::random(60);

        // Tạo người dùng mới và lưu token vào cơ sở dữ liệu
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'organization' => $request->organization,
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'agree_terms' => $request->has('agree_terms'),
            'subscribe' => $request->has('subscribe'),
            'reviewer' => $request->has('reviewer'),
            'token' => $token
        ]);

        // Gửi email xác nhận với token
        Mail::to($user->email)->send(new VerificationEmail($user));

        return redirect()->route('register.form')->with('success', 'User registered successfully. Please check your email to verify your account.');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            //hoặc username
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lấy thông tin đăng nhập từ request
        $login = $request->input('login');
        $password = $request->input('password');

        // Xác định nếu đăng nhập bằng email hay username
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Chuẩn bị credentials để đăng nhập
        $credentials = [
            $fieldType => $login,
            'password' => $password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended('index'); // Redirect đến trang home sau khi đăng nhập thành công
        }

        return redirect()->back()->with('error', 'Unauthorized');
    }

    // Xử lý xác nhận email
    public function verifyEmail(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if ($user) {
            $user->status = 'active'; // Cập nhật trạng thái người dùng
            $user->token = null; // Xóa token sau khi xác nhận
            $user->save();

            return redirect()->route('login')->with('success', 'Your email has been verified. You can now log in.');
        }

        return redirect()->route('register.form')->with('error', 'Invalid verification link.');
    }
}
