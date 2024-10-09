<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\KtraController;
use App\Http\Controllers\ArticleSubmissionController;
use App\Http\Controllers\CitationController;
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
Route::view('/home', 'home');
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
Route::view('/profile', 'Layout_index.profile');
Route::view('/wizard', 'wizard.wizard');
Route::put('/user1', [UserController::class, 'update1'])->name('user.update1');
Route::put('/user2', [UserController::class, 'update2'])->name('user.update2');
Route::put('/user3', [UserController::class, 'update3'])->name('user.update3');
Route::put('/user4', [UserController::class, 'update4'])->name('user.update4');
Route::put('/user5', [UserController::class, 'update5'])->name('user.update5');

// Route::get('/wizard', [TestController::class, 'showWizard']);

// Xử lý đăng ký

// routes/web.php
Route::middleware('auth')->group(function () {
    Route::get('/Submissions', [KtraController::class, 'showSubmissions'])->name('Submissions');
});
// Route::middleware('auth')->group(function () {
//     Route::get('/wizard/step1', [KtraController::class, 'showwizardstep1'])->name('wizard.step1');
// });

Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/submit-article', [ArticleSubmissionController::class, 'create'])->name('submit-article.create');
Route::post('/submit-article', [ArticleSubmissionController::class, 'store'])->name('submit-article.store');


Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
// Route cho trang đăng nhập
Route::get('/login', function () {
    return view('login'); // Hiển thị trang đăng nhập
})->name('login');

// Route xử lý đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('login.post');



Route::resource('citations', CitationController::class);
Route::post('/citations/store-multiple', [CitationController::class, 'storeMultiple'])->name('citations.storeMultiple');

Route::post('/citations', [CitationController::class, 'store'])->name('citations.store');





// Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
// Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
Route::post('/citations/store', [CitationController::class, 'store'])->name('citations.store');
Route::get('/citations', [CitationController::class, 'index'])->name('citations.index');
Route::post('/citations/store-multiple', [CitationController::class, 'storeMultiple'])->name('citations.store_multiple');


Route::get('/bai-viets', [BaiVietController::class, 'index'])->name('bai_viets.index');
Route::get('/bai-viets/create', [BaiVietController::class, 'create'])->name('bai_viets.create');
Route::post('/bai-viets', [BaiVietController::class, 'store'])->name('bai_viets.store');
Route::get('/bai-viets/{id_bai_viet}', [BaiVietController::class, 'show'])->name('bai_viets.show');
Route::get('/bai-viets/{id_bai_viet}/edit', [BaiVietController::class, 'edit'])->name('bai_viets.edit');
Route::put('/bai-viets/{id_bai_viet}', [BaiVietController::class, 'update'])->name('bai_viets.update');
Route::delete('/bai-viets/{id_bai_viet}', [BaiVietController::class, 'destroy'])->name('bai_viets.destroy');
Route::post('/bai-viet', [BaiVietController::class, 'store'])->name('bai_viet.store');
// Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');




Route::get('/wizard/step1', [WizardController::class, 'step1'])
   // ->middleware('check_wizard_progress:1')
    ->name('wizard.step1');
Route::post('/wizard/step1', [WizardController::class, 'storeStep1']);

Route::get('/wizard/step2', [WizardController::class, 'step2'])
    //->middleware('check_wizard_progress:2')
    ->name('wizard.step2');
Route::post('/wizard/step2', [WizardController::class, 'storeStep2']);

Route::get('/wizard/step3', [WizardController::class, 'step3'])
    // ->middleware('check_wizard_progress:3')
    ->name('wizard.step3');
Route::post('/wizard/step3', [WizardController::class, 'storeStep3']);
Route::post('/add-co-author', [WizardController::class, 'addCoAuthor'])->name('add.coAuthor');
Route::get('/wizard/step4', [WizardController::class, 'step4'])
    //>middleware('check_wizard_progress:4')
    ->name('wizard.step4');
Route::post('/wizard/step4', [WizardController::class, 'storeStep4']);

Route::get('/wizard/step5', [WizardController::class, 'step5'])
    // ->middleware('check_wizard_progress:5')
    ->name('wizard.step5');
Route::post('/wizard/step5', [WizardController::class, 'storeStep5']);

Route::get('/wizard/completed', [WizardController::class, 'completed'])->name('wizard.completed');

Route::get('/wizard/completed', [WizardController::class, 'completed'])->name('wizard.completed');

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