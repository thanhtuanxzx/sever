<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail; 
use App\Mail\ResetPasswordEmail;

class AuthController extends Controller
{
    // API Đăng ký người dùng
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
         
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $token = \Str::random(60);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'organization' => $request->organization,
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
           
            'token' => $token
        ]);

        Mail::to($user->email)->send(new VerificationEmail($user));

        return response()->json(['message' => 'User registered successfully. Please verify your email.'], 201);
    }

    // API Đăng nhập người dùng
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $login = $request->input('login');
        $password = $request->input('password');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [$fieldType => $login, 'password' => $password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Lấy thông tin người dùng đã đăng nhập
            $token = $user->createToken('YourAppName')->plainTextToken; // Tạo token cá nhân

            return response()->json(['message' => 'Login successful', 'token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function getUserTokens()
    {
        // Lấy ID người dùng hiện tại
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Kiểm tra nếu không có người dùng đã đăng nhập
        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Tìm người dùng và lấy tất cả các token cá nhân
        $user = User::find($userId); // Tìm người dùng theo ID

        if ($user) {
            $tokens = $user->tokens; // Lấy tất cả token cá nhân của người dùng
            return response()->json($tokens); // Trả về danh sách token
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    // Xác thực email
    public function verifyEmail(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if ($user) {
            $user->status = 'active';
            $user->token = null;
            $user->save();

            return response()->json(['message' => 'Email verified successfully.'], 200);
        }

        return response()->json(['message' => 'Invalid verification link.'], 400);
    }

    // Quên mật khẩu
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        $token = \Str::random(60);
        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordEmail($token));

        return response()->json(['message' => 'Password reset link sent to your email.'], 200);
    }

    // Hiển thị form đặt lại mật khẩu (API không cần form)
    public function showResetPasswordForm(Request $request)
    {
        return response()->json(['token' => $request->token], 200);
    }

    // Đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->where('token', $request->token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid token or email.'], 400);
        }

        $user->password = Hash::make($request->password);
        $user->token = null;
        $user->save();

        return response()->json(['message' => 'Password reset successfully.'], 200);
    }
}
