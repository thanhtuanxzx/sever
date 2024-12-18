<?php
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WizardController;
use App\Http\Controllers\TacGiaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ReviewerController;
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
   
  
    Route::post('register', [AuthController::class, 'register']);


    Route::post('login', [AuthController::class, 'login'])->name('login');

  
    Route::get('verify-email', [AuthController::class, 'verifyEmail']);


    Route::post('forget-password', [AuthController::class, 'forgetPassword']);

   
    Route::get('reset-password', [AuthController::class, 'showResetPasswordForm']);

   
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('/user', [UserController::class, 'show'])->middleware('auth:api');

Route::post('/users/email', [WizardController::class, 'getUserByEmail'])->name('users.email.get');

Route::get('/tac-gia/{id_bai_viet}', [WizardController::class, 'getAuthorIdByBaiVietId']);

Route::get('/chuyen-de', [WizardController::class, 'getCategory']);

Route::middleware('auth:api')->group(function () {
    
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/messages', [ChatController::class, 'getMessages']);
    Route::put('/message/{id}', [ChatController::class, 'updateMessage']);  
    Route::delete('/message/{id}', [ChatController::class, 'deleteMessage']);  

    Route::get('/user/article/files', [WizardController::class, 'getUserArticleFiles']);
    Route::get('/bai-viet', [WizardController::class, 'show']);
    Route::get('/bai-viet1', [WizardController::class, 'show1']);
    Route::get('/user/tokens', [AuthController::class, 'getUserTokens']);
    Route::get('/submissions', [WizardController::class, 'getSubmissions']);
    Route::get('/tukhoa/{id_bai_viet}', [WizardController::class, 'getTukhoa']);

    // Các route khác cần xác thực  
    Route::post('/wizard/step1/{id_bai_viet?}', [WizardController::class, 'storeStep1']);
    Route::post('/wizard/step2/{id_bai_viet?}', [WizardController::class, 'storeStep2']);
    Route::post('/wizard/step3/{id_bai_viet?}', [WizardController::class, 'storeOrUpdateStep3']);    
    Route::post('/wizard/step4/{id_bai_viet?}', [WizardController::class, 'storeStep4']);

    Route::put('/wizard/step3/{id_bai_viet?}', [WizardController::class, 'storeStep3_']);
    Route::put('/articles/{article_id}/updated', [WizardController::class, 'update_a']);
    Route::put('/articles/{article_id}/update', [WizardController::class, 'update_w']);

    Route::get('/auth/avatar', [UserController::class, 'getAvatar']);
    Route::put('/user/update1', [UserController::class, 'update1']);
    Route::put('/user/update2', [UserController::class, 'update2']);
    Route::put('/user/update3', [UserController::class, 'update3']);
    Route::put('/user/update4', [UserController::class, 'update4']);
    Route::put('/user/update5', [UserController::class, 'update5']);

    Route::post('/uploadfile',[ChatController::class,'getfile']);
  

  
    });

     Route::get('avatar/{filename}', function ($filename) {
        return Storage::disk('public')->response('avatars/' . $filename);
    });
    
    Route::get('public/{filename}', function ($filename) {
        // Trả về file từ thư mục public trong storage
        return Storage::disk('public')->response('public/' . $filename);
    });
    Route::get('uploads/{filename}', function ($filename) {
        // Kiểm tra sự tồn tại của file
        if (!Storage::disk('public')->exists('uploads/' . $filename)) {
            return response()->json(['error' => 'File not found'], 404);
        }
    
        // Trả về file
        return Storage::disk('public')->response('uploads/' . $filename);
    });
 
    Route::middleware('auth:api')->group(function () {
        Route::get('/notifications', [NotificationController::class, 'getNotifications']);
        Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
        Route::post('/notifications/{notificationId}/mark-read', [NotificationController::class, 'markAsRead']);
    });

    
    Route::get('download-pdf/{article_id}', function ($article_id) {
        // Tìm file theo article_id
        $file = File::where('article_id', $article_id)->first();
    
        // Kiểm tra nếu file tồn tại
        if ($file) {
            // Trả về thông tin file dưới dạng JSON
            return response()->json([
                'file_name' => $file->file_name,
                'file_path' => asset('storage/' . $file->file_path),
                'mime_type' => $file->file_mime_type,
                'created_at' => $file->created_at,
            ]);
        }
    
        // Nếu không tìm thấy file, trả về lỗi
        return response()->json(['error' => 'File not found'], 404);
    });


    Route::middleware(['auth:api', 'role:1'])->group(function () {
        Route::get('/pending-articles', [EditorialController::class, 'getPendingArticles']);

        // Route để lấy danh sách người dùng có vai trò reviewer (role = 3)
        Route::get('/reviewers', [EditorialController::class, 'getReviewer']);
        Route::post('/editorial/assign-reviewer', [EditorialController::class, 'assignReviewer']);

        });

    Route::middleware(['auth:api', 'role:2'])->group(function () {
        Route::get('/committee/review-articles', [CommitteeController::class, 'getPendingArticles']);
        Route::post('/committee/review/{article_id}', [CommitteeController::class, 'reviewArticle']);
    });
    
    Route::middleware(['auth:api', 'role:3'])->group(function () {
        Route::get('/getfull-article', [ReviewerController::class, 'getByStatus']);
       
    });
    
    
    