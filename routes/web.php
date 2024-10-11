<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\KtraController;


use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\WizardController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes/web.php

Route::get('/banner', [NavController::class, 'showBanner']);


Route::get('/footer', function () {
    return view('includes.footer');
});

Route::view('/purpose-scope', 'purpose-scope');
Route::view('/pub-freq', 'pub-freq');
Route::view('/edit-ethics', 'edit-ethics');
Route::view('/policies-principles', 'policies-principles');
Route::view('/sponsorship', 'sponsorship');
Route::view('/auth-guidelines', 'auth-guidelines');
Route::view('/rev-guidelines', 'rev-guidelines');
Route::view('/edit', 'edit');
Route::view('/archiving', 'view.archiving');
Route::view('/submission', 'submission');
Route::view('/login', 'login');
Route::view('/index', 'index');
Route::view('/Layout-index', 'view.Layout-index');
Route::view('/Layout-view', 'view.Layout-view');
Route::view('/auth-guidelines', 'auth-guidelines');
Route::view('/rev-guidelines', 'rev-guidelines');
Route::view('/Forget-pass','Forget-pass');


Route::put('/user1', [UserController::class, 'update1'])->name('user.update1');
Route::put('/user2', [UserController::class, 'update2'])->name('user.update2');
Route::put('/user3', [UserController::class, 'update3'])->name('user.update3');
Route::put('/user4', [UserController::class, 'update4'])->name('user.update4');
Route::put('/user5', [UserController::class, 'update5'])->name('user.update5');





Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::post('/forgot-password', [AuthController::class, 'forgetPassword'])->name('password.forgot');
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.form');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password');


Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route cho trang đăng nhập
Route::get('/login', function () {
    return view('login'); 
})->name('login');

// Route xử lý đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => 'checkQuyen:1'], function () {
        Route::view('/bot-info', 'Board_of_Trustees.BoT-pbv-info')->name('bot.info');
        Route::view('/bot', 'Board_of_Trustees.BoT')->name('bot');
        Route::view('/counter-argument-detail', 'Counter_Argument.Counter-Argument-Detail')->name('counter.argument.detail');
        Route::view('/counter-argument-view', 'Counter_Argument.Counter-Argument-view')->name('counter.argument.view');
    });
});



Route::middleware('auth')->group(function () {
    Route::post('/wizard',[WizardController::class,'storeStep'])->name('wizard');
    Route::view('/profile','Layout_index.profile');
    Route::get('/Submissions', [KtraController::class, 'showSubmissions'])->name('Submissions');

    Route::get('/wizard/step1', [WizardController::class, 'step1'])
        ->name('wizard.step1');

    Route::post('/wizard/step1', [WizardController::class, 'storeStep1']);
    // Step 2
    Route::get('/wizard/step2', [WizardController::class, 'step2'])
        //->middleware('check_wizard_progress:2')
        ->name('wizard.step2');
    Route::post('/wizard/step2', [WizardController::class, 'storeStep2']);

    // Step 3
    Route::get('/wizard/step3', [WizardController::class, 'step3'])
        //->middleware('check_wizard_progress:3')
        ->name('wizard.step3');
    Route::post('/wizard/step3', [WizardController::class, 'storeStep3']);

    // Add Co-Author
    Route::post('/add-co-author', [WizardController::class, 'addCoAuthor'])
        ->name('add.coAuthor');

    // Step 4
    Route::get('/wizard/step4', [WizardController::class, 'step4'])
        //->middleware('check_wizard_progress:4')
        ->name('wizard.step4');
    Route::post('/wizard/step4', [WizardController::class, 'storeStep4']);

    // Step 5
    Route::get('/wizard/step5', [WizardController::class, 'step5'])
        //->middleware('check_wizard_progress:5')
        ->name('wizard.step5');
    Route::post('/wizard/step5', [WizardController::class, 'storeStep5']);
});



Route::get('/admin/art-done', [AdminPageController::class, 'adminArtDone'])->name('admin.art.done');

// Route for Admin Art Rejected
Route::get('/admin/art-rejected', [AdminPageController::class, 'adminArtRejected'])->name('admin.art.rejected');

// Route for Admin Article Details
Route::get('/admin/article-details', [AdminPageController::class, 'adminArticleDetails'])->name('admin.article.details');

// Route for Admin Magazine
Route::get('/admin/magazine', [AdminPageController::class, 'adminMagazine'])->name('admin.magazine');

// Route for Admin Dashboard
Route::get('/admin', [AdminPageController::class, 'adminDashboard'])->name('admin.dashboard');

// Route for Magazine Details
Route::get('/magazine/details', [AdminPageController::class, 'magazineDetails'])->name('magazine.details');

// Route for Magazine List
Route::get('/magazine/list', [AdminPageController::class, 'magazineList'])->name('magazine.list');