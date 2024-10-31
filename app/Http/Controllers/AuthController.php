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
use Tymon\JWTAuth\Facades\JWTAuth;

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
            return response()->json(['status' => 422,'errors' => $validator->errors()], 422);
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

        return response()->json(['status' => 201,'message' => 'User registered successfully. Please verify your email.'], 201);
    }

    // API Đăng nhập người dùng
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()], 422);
        }

        $login = $request->input('login');
        $password = $request->input('password');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$fieldType => $login, 'password' => $password];

        $user = User::where($fieldType, $login)->first();
         // Kiểm tra nếu người dùng tồn tại và đã được kích hoạt
         if (!$user || $user->status !== 'active') {
            return response()->json(['status' => 403, 'message' => 'Your account is not activated.'], 403);
        }

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['status' => 401, 'message' => 'Invalid credentials'], 401);
        }

        return response()->json(['status' => 200, 'message' => 'Login successful', 'token' => $token], 200);
    }


    public function getUserTokens()
    {
      
        $userId = Auth::id(); 

        // Kiểm tra nếu không có người dùng đã đăng nhập
        if (!$userId) {
            return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
        }

      
        $user = User::find($userId); 

        if ($user) {
            $tokens = $user->tokens; 
            return response()->json($tokens); 
        }

        return response()->json(['status' => 404,'error' => 'User not found'], 404);
    }

    // Xác thực email
    public function verifyEmail(Request $request)
    {
        $request->validate(['token' => 'required|string']);
        $user = User::where('token', $request->token)->first();

        if ($user) {
            $user->status = 'active';
            $user->token = null;
            $user->save();

            return response()->json(['status' => 200,'message' => 'Email verified successfully.'], 200);
        }

        return response()->json(['status' => 400,'message' => 'Invalid verification link.'], 400);
    }

    // Quên mật khẩu
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 422,'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        $token = \Str::random(60);
        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(new ResetPasswordEmail($token));

        return response()->json(['status' => 200,'message' => 'Password reset link sent to your email.'], 200);
    }

    // Hiển thị form đặt lại mật khẩu (API không cần form)
    public function showResetPasswordForm(Request $request)
    {
        return response()->json(['status' => 200,'token' => $request->token], 200);
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
            return response()->json(['status' => 422,'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->where('token', $request->token)->first();

        if (!$user) {
            return response()->json(['status' => 400,'message' => 'Invalid token or email.'], 400);
        }

        $user->password = Hash::make($request->password);
        $user->token = null;
        $user->save();

        return response()->json(['status' => 200,'message' => 'Password reset successfully.'], 200);
    }
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['status' => 200, 'message' => 'Logout successful'], 200);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['status' => 500, 'message' => 'Failed to logout, please try again'], 500);
        }
    }
    
}
