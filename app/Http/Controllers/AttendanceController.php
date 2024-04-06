<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class AttendanceController extends Controller
{
    public function qrScanner(){
        return view('backend.staff.scanner');
    }
    public function markAttendance(){


        if (request()->ajax()) {

            if (auth()->user()->hasRole('admin')) {
                $userAttendance = \App\Models\Attendance::all();
            } else {
                $userAttendance = auth()->user()->attendances;
            }

            return DataTables::of($userAttendance)
                ->addIndexColumn()
            ->addColumn('staff', function($q) {
                return $q->user->name;
            })
            ->addColumn('punching_time', function($q) {
                return \Carbon\Carbon::parse($q->punching_time)->format('d F , Y h:i A');
            })
            ->addColumn('punchout_time', function($q) { if ($q->punchout_time) {
                return \Carbon\Carbon::parse($q->punchout_time)->format('d F , Y h:i A');
            } else {
                return ''; 
            }
            })
            ->addColumn('status',function($q){
                $status = $q->status == 1 ? 'Present' : 'Absent';
                return '<button class=" btn btn-xs bg-success text-white">'.$status.'</button>';
            })
            ->rawColumns(['status'])
            ->make(true);
            }
        $today_attendance=Attendance::where('teacher_id',Auth::user()->id)->whereDate('punching_time',Carbon::today())->first();
        $punching=$today_attendance?$today_attendance->punching_time:''; 
        $punchout=$today_attendance?$today_attendance->punchout_time:''; 
        
        return view('backend.staff.attendance_mark',compact('punching','punchout'));
    }
    public function updateLocation(Request $request){
      $updateData = User::where('id',auth()->user()->id)->update(['location' => json_encode($request->location)]);
        if($updateData){
            return redirect()->back();
        }
        else{
            return redirect()->route('admin.backendAdminPage')->with('warning','Please Allow The Location...!');
        }
    }

}
