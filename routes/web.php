<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\LeaveSetUpController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\StudentBillController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherLeaveController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('sign-in', function () {
    return view('sign   in');
});
Route::get('/', [AuthController::class, 'showLoginForm'])->name('Getlogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
//role:admin
//role:staff
Route::group([ 'prefix'=>'admin','as'=>'admin.', 'middleware' => 'auth'],function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('show-staff/{id}', [AuthController::class, 'showStaff'])->name('showStaff');
    Route::get('edit-staff/{id}', [AuthController::class, 'editStaff'])->name('editStaff');
    Route::get('edit-password/{id}', [AuthController::class, 'editPassword'])->name('editPassword');
    Route::post('/change-password', [AuthController::class,'changePassword'])->name('change.password');
    Route::post('update-staff-data/{id}', [AuthController::class, 'staffUpdateData'])->name('updateStaff');
    Route::get('Dashboard',[AuthController::class,'backendLoginPage'])->name('backendAdminPage');
    Route::resource('leave-set-up',LeaveSetUpController::class);
    Route::resource('qr',QRController::class);
    Route::get('changeStatus/{id}',[QRController::class,'is_active']);
    Route::post('mark-as-read',[NotificationController::class,'markRead'])->name('markread');
    Route::get('Notifications',[NotificationController::class,'index'])->name('index');


});

Route::group([ 'prefix'=>'staff','as'=>'staff.', 'middleware' => 'auth'],function(){
    Route::get('scanner',[AttendanceController::class,'qrScanner'])->name('qrscanner');
    Route::get('teacher-register',[TeacherController::class,'teacherRegister'])->name('TeacherRegester');
    Route::post('store-teacher-register',[TeacherController::class,'storeTeacherRegister'])->name('storeTeacherRegister');
    Route::get('teacher-register-data',[TeacherController::class,'teacherRegisterData'])->name('teacherRegisterData');
    Route::get('teacher-edit-data/{id}',[TeacherController::class,'teacherEditData'])->name('teacherEditData');
    Route::post('teacher-update-data/{id}',[TeacherController::class,'teacherUpdateData'])->name('teacherUpdateData');
    Route::post('staff-delete/{id}',[TeacherController::class,'teacherDeleteData'])->name('teacherDeleteData');
    Route::get('teacher-count',[TeacherController::class,'teacherCount'])->name('teacherCount');
    // Route::get('/update-location', [AttendanceController::class, 'updateLocation']);
    Route::get('qr-generate/{id}',[QRController::class,'generateQR'])->name('generate_qr');
    Route::get('cpr/{id}',[QRController::class,'capture']);
    Route::resource('student-bill',StudentBillController::class);
    Route::get('student-bill/edit/{id}', [StudentBillController::class,'editBill'])->name('student-bill.edit');
    Route::get('student-fee/edit/{id}', [StudentBillController::class,'editStudentFee'])->name('student-fee.edit');
    Route::get('student-fee/update/{id}', [StudentBillController::class,'updateStudentFee'])->name('student-fee-update');
    Route::resource('teacher-leaves',TeacherLeaveController::class);
    Route::get('mark_attendance',[AttendanceController::class,'markAttendance'])->name('markattendance');
});
Route::group([ 'prefix'=>'student','as'=>'student.', 'middleware' => 'auth'],function(){
    Route::resource('student',StudentController::class);
    Route::get('bill',[BillController::class,'index'])->name('bills');
    Route::resource('leave-set-up',LeaveSetUpController::class);
});


