<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function qrScanner(){
        return view('backend.staff.scanner');
    }

    // public function updateLocation(Request $request)
    // {
    //     // dd($request->all());
    //     $latitude = $request->input('latitude');
    // $longitude = $request->input('longitude');

    // Log::info("Received latitude: $latitude, longitude: $longitude");
    //     return view('backend.location');
    //     // Add your logic here to handle the latitude and longitude data
    //     // For example, you can store it in the database or perform any other operations

    //     // Log the received data

    //     // return response()->json(['message' => 'Location data received successfully']);
    // }


    public function markAttendance(){
        
        $today_attendance=Attendance::where('teacher_id',Auth::user()->id)->whereDate('punching_time',Carbon::today())->first();
        $punching=$today_attendance?$today_attendance->punching_time:''; 
        $punchout=$today_attendance?$today_attendance->punchout_time:''; 
        $userAttendance = auth()->user()->attendances->all();
        return view('backend.staff.attendance_mark',compact('punching','punchout','userAttendance'));
    }

}
