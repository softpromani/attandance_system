<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\TeacherLeave;
use Illuminate\Http\Request;

class TeacherApproveController extends Controller
{
    public function allLeave()
    {
        $leave = LeaveType::get();
        $teacherleaves = TeacherLeave::get();
       return view('backend.staff.approveTeacherLeave', compact('teacherleaves','leave'));
    }

    public function approveLeave(Request $request)
    {

        $leaveId = $request->input('leave_id');
        $action = $request->input('action');

        $leave = TeacherLeave::findOrFail($leaveId);

        if ($action == 'approve') {
            $leave->status = 1;
        } elseif ($action == 'decline') {
            $leave->status = 2;
        }

        $leave->update();
    return redirect()->back();
    }
}
