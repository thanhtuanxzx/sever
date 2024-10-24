<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;
use App\Http\Controllers\TacGiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
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
    Route::post('login', [AuthController::class, 'login'])->name('login');

    // Route xác nhận email
    Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('auth.verifyEmail');

    // Route quên mật khẩu
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);

    // Route hiển thị form đặt lại mật khẩu (trả về token)
    Route::get('reset-password', [AuthController::class, 'showResetPasswordForm']);

    // Route đặt lại mật khẩu
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});
Route::get('/user', [UserController::class, 'show'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/messages', [ChatController::class, 'getMessages']);
    Route::put('/message/{id}', [ChatController::class, 'updateMessage']);  
    Route::delete('/message/{id}', [ChatController::class, 'deleteMessage']);  

    Route::get('/bai-viet', [WizardController::class, 'show']);
    Route::get('/bai-viet1', [WizardController::class, 'show1']);
    Route::get('/user/tokens', [AuthController::class, 'getUserTokens']);
    // Các route khác cần xác thực  
    Route::post('/wizard/step1/{id_bai_viet?}', [WizardController::class, 'storeStep1']);
    Route::post('/wizard/step2/{id_bai_viet?}', [WizardController::class, 'storeStep2']);
    Route::post('/wizard/step3/{id_bai_viet?}', [WizardController::class, 'storeStep3']);
    Route::post('/wizard/step4/{id_bai_viet?}', [WizardController::class, 'storeStep4']);
    Route::post('/wizard/step5/{id_bai_viet?}', [WizardController::class, 'storeStep5']);
    Route::get('/wizard/completed', [WizardController::class, 'completed']);
    Route::put('/user/update1', [UserController::class, 'update1']);
    Route::put('/user/update2', [UserController::class, 'update2']);
    Route::put('/user/update3', [UserController::class, 'update3']);
    Route::post('/user/update4', [UserController::class, 'update4']);
    Route::put('/user/update5', [UserController::class, 'update5']);

    });

   
// Route cho trang hoàn thành wizard

