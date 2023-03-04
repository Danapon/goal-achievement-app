<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\SubGoalController;
use App\Http\Controllers\UserController;// マイページ作成で追加
use Illuminate\Foundation\Auth\EmailVerificationRequest;// メール認証で追加
use App\Http\Controllers\LoginWithGoogleController;// Google認証で追加

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

// 最初の画面に遷移
Route::get('/', function () {
    return view('index');
});

// Google認証
Route::get("auth/google", [
    LoginWithGoogleController::class,
    "redirectToGoogle",
  ]);
  
Route::get("auth/google/callback", [
LoginWithGoogleController::class,
"handleGoogleCallback",
]);

// メール認証
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// ホーム画面
Route::get('/home', [GoalController::class, 'index'])->name('goals.index')->middleware(['auth', 'verified']);

// CRUD目標ルーティング
Route::resource('goals', GoalController::class)->only(['create', 'store', 'update'])->middleware(['auth', 'verified']);

// CRUDサブ目標ルーティング
Route::controller(SubGoalController::class)->group(function () {
    Route::post('/subgoals/{id}', 'update')->name('subgoals.update');
    Route::get('/subgoals/create', 'create')->name('subgoals.create');
    Route::post('/subgoals', 'store')->name('subgoals.store');
})->middleware(['auth', 'verified']);

// マイページルーティング
Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    // Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    // Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
});