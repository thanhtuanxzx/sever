<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;
use App\Http\Controllers\TacGiaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\AuthController;

Route::prefix('auth')->group(function () {
    // Route đăng ký
    Route::post('register', [AuthController::class, 'register']);

    // Route đăng nhập
    Route::post('login', [AuthController::class, 'login']);

    // Route xác nhận email
    Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('auth.verifyEmail');

    // Route quên mật khẩu
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);

    // Route hiển thị form đặt lại mật khẩu (trả về token)
    Route::get('reset-password', [AuthController::class, 'showResetPasswordForm']);

    // Route đặt lại mật khẩu
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});
Route::middleware('auth:sanctum')->get('/user/tokens', [AuthController::class, 'getUserTokens']);
