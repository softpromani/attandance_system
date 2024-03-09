<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', function () {
    return view('index');
});
Route::get('sign-in', function () {
    return view('signin');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::group([ 'middleware' => 'auth'],function(){

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('backend-admin-page',[AuthController::class,'backendLoginPage'])->name('backendAdminPage');
    Route::get('attendance-mark',[AttendanceController::class,'attendanceMark'])->name('attendanceMark');
});