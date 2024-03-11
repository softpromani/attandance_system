<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveSetUpController;
use App\Http\Controllers\StudentBillController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('index', function () {
//     return view('index');
// });
Route::get('sign-in', function () {
    return view('sign   in');
});
Route::get('/', [AuthController::class, 'showLoginForm'])->name('Getlogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group([ 'prefix'=>'admin','as'=>'admin.', 'middleware' => 'auth'],function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('backend-admin-page',[AuthController::class,'backendLoginPage'])->name('backendAdminPage');
    Route::resource('leave-set-up',LeaveSetUpController::class);
});

Route::group([ 'prefix'=>'staff','as'=>'staff.', 'middleware' => 'auth'],function(){
    Route::get('attendance-mark',[AttendanceController::class,'attendanceMark'])->name('attendanceMark');
    Route::get('teacher-register',[TeacherController::class,'teacherRegister'])->name('TeacherRegester');
    Route::post('store-teacher-register',[TeacherController::class,'storeTeacherRegister'])->name('storeTeacherRegister');
    Route::get('teacher-register-data',[TeacherController::class,'teacherRegisterData'])->name('teacherRegisterData');
    Route::get('teacher-edit-data/{id}',[TeacherController::class,'teacherEditData'])->name('teacherEditData');
    Route::post('teacher-update-data/{id}',[TeacherController::class,'teacherUpdateData'])->name('teacherUpdateData');
    Route::post('teacher-delete-data/{id}',[TeacherController::class,'teacherDeleteData'])->name('teacherDeleteData');
    Route::get('teacher-count',[TeacherController::class,'teacherCount'])->name('teacherCount');
    Route::get('/update-location', [AttendanceController::class, 'updateLocation']);
});
Route::group([ 'prefix'=>'student','as'=>'student.', 'middleware' => 'auth'],function(){
    Route::resource('student',StudentController::class);
});



