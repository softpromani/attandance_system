<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendanceMark(){
        return view('backend.attendance_mark');
    }
    
}
