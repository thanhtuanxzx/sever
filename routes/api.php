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

// Route cho bước 1
Route::post('/wizard/step1', [WizardController::class, 'storeStep1']);

// Route cho bước 2
Route::post('/wizard/step2', [WizardController::class, 'storeStep2']);

// Route cho bước 3
Route::post('/wizard/step3', [WizardController::class, 'storeStep3']);

// Route cho bước 4
Route::post('/wizard/step4', [WizardController::class, 'storeStep4']);

// Route cho bước 5
Route::post('/wizard/step5', [WizardController::class, 'storeStep5']);

// Route cho trang hoàn thành wizard
Route::get('/wizard/completed', [WizardController::class, 'completed']);
