<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('backend-admin-page',[AuthController::class,'backendLoginPage'])->name('backendAdminPage');
Route::get('teacher-register',[TeacherController::class,'teacherRegister'])->name('TeacherRegester');
Route::post('store-teacher-register',[TeacherController::class,'storeTeacherRegister'])->name('storeTeacherRegister');
Route::get('teacher-register-data',[TeacherController::class,'teacherRegisterData'])->name('teacherRegisterData');
Route::get('teacher-edit-data/{id}',[TeacherController::class,'teacherEditData'])->name('teacherEditData');
Route::post('teacher-update-data/{id}',[TeacherController::class,'teacherUpdateData'])->name('teacherUpdateData');
Route::post('teacher-delete-data/{id}',[TeacherController::class,'teacherDeleteData'])->name('teacherDeleteData');
Route::get('teacher-count',[TeacherController::class,'teacherCount'])->name('teacherCount');
