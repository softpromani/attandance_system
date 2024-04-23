<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\TeacherLeave;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeacherApproveController extends Controller
{
    public function allLeave()
    {

        if (request()->ajax()) {
            $teacherleaves = TeacherLeave::get();
            return DataTables::of($teacherleaves)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        return '<p class="text-dark bg-warning rounded-pill">Pending</p>';
                    } elseif ($row->status == 1) {
                        return '<p class="text-white bg-success rounded-pill">Approved</p>';
                    } elseif ($row->status == 2) {
                        return '<p class="text-dark bg-danger rounded-pill">Declined</p>';
                    }
                })
                ->addColumn('file', function ($row) {
                    return '<img src="' . asset('storage/' . $row->file) . '" width="100">';
                })
                ->addColumn('action', function ($row) {
                    // Check if the status is 0 (pending)
                    if ($row->status === 0) {
                        $approveRoute = route('staff.approveLeave', $row->id);
                        $declineRoute = route('staff.declineLeave', $row->id);

                        $buttons = '<form action="' . $approveRoute . '" method="POST">' . csrf_field() .
                            '<button type="submit" class="btn btn-success">Approve</button></form>';
                        $buttons .= '<form action="' . $declineRoute . '" method="POST">' . csrf_field() .
                            '<button type="submit" class="btn btn-danger">Decline</button></form>';

                        return $buttons;
                    } else {
                        // If status is not 0, return an empty string (hide the buttons)
                        return '';
                    }
                })
                ->rawColumns(['status', 'file', 'action']) // Declare rawColumns
                ->make(true);
        }

        $leave = LeaveType::get();
        $teacherleaves = TeacherLeave::get();
       return view('backend.staff.approveTeacherLeave', compact('teacherleaves','leave'));
    }

    // public function approveLeave(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'leave_id' => 'required|exists:teacher_leaves,id',
    //         'action' => 'required|in:approve,decline',
    //     ]);

    //     $leaveId = $request->input('leave_id');
    //     $action = $request->input('action');

    //     // Find the leave by ID
    //     $leave = TeacherLeave::findOrFail($leaveId);

    //     // Update the status based on the action
    //     if ($action == 'approve') {
    //         $leave->status = 1; // Approved
    //     } elseif ($action == 'decline') {
    //         $leave->status = 2; // Declined
    //     }

    //     // Save the updated leave status
    //     $leave->save();

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Leave request ' . ucfirst($action) . 'd successfully.');
    // }


    public function approveLeave(Request $request, $id)
{
    $leave = TeacherLeave::findOrFail($id);
    $leave->status = 1; // Set status to approved
    $leave->save();

    return redirect()->back()->with('success', 'Leave request approved successfully.');
}

public function declineLeave(Request $request, $id)
{
    $leave = TeacherLeave::findOrFail($id);
    $leave->status = 2; // Set status to declined
    $leave->save();

    return redirect()->back()->with('success', 'Leave request declined successfully.');
}
}
