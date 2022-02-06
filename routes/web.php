<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceListController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\RestConroller;
use Illuminate\Support\Facades\Route;

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

/*会員登録*/
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

/*ログイン*/
Route::get('/login',[AuthenticatedSessionController::class, 'create']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

/*ログアウト*/
Route::post('/logout',[AuthenticatedSessionController::class, 'destroy']);

/*ユーザーページ*/
Route::get('/', [AttendanceController::class, 'index'])->middleware('auth');
Route::post('/',[AttendanceController::class, 'index'])->middleware('auth');;

/*勤怠管理処理*/
Route::post('/start',[AttendanceController::class, 'start']);
Route::post('/end',[AttendanceController::class, 'end']);
Route::post('/reststart',[RestConroller::class, 'restStart']);
Route::post('/restend',[RestConroller::class, 'restEnd']);

/*勤怠一覧*/
Route::get('/attendance/{attendance}', [AttendanceListController::class, 'index'])->middleware('auth');;
Route::post('/attendance/{attendance}', [AttendanceListController::class, 'attendanceDate']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
