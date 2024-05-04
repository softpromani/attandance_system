<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Fee;
use App\Models\Student;
use App\Models\TeacherLeave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TodayHistoryController extends Controller
{
    public function viewHistory(){
        $allStudents = Student::all()->count();
       $newStudents =  Student::whereDate('created_at', Carbon::today())->count();
        $newStaffs = User::whereHas('roles', function ($query) {
            $query->where('name', 'staff')->orWhere('name', 'driver');
        })
        ->whereDate('created_at', Carbon::today())
        ->count();
        $allStaff = User::whereHas('roles', function ($query) {
            $query->where('name', 'staff')->orWhere('name', 'driver');
        })->count();
        $newLeave = TeacherLeave::whereDate('created_at', Carbon::today())->count();
        $newAttendance = Attendance::whereDate('created_at', Carbon::today())->count();
        $allBills = Fee::count();
        $newBills = Fee::whereDate('created_at', Carbon::today())->count();
        return view('backend.admin.todayHistory',compact('allStudents','newStudents','newStaffs','allStaff','newLeave','newAttendance','allBills','newBills'));
    }
}
