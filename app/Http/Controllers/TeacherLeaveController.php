<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Support\Facades\File;
use App\Models\TeacherLeave;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TeacherLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $leave = LeaveType::get();
        $teacherleaves = TeacherLeave::get();
       return view('backend.staff.teacherleaves', compact('teacherleaves','leave'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (request()->ajax()) {
            $teacherleaves = TeacherLeave::get();

            return DataTables::of($teacherleaves)
                ->addIndexColumn() // Add DT_RowIndex field
                ->addColumn('status_column', function ($row) {
                    if ($row->status == 0) {
                        return '<p class="text-dark bg-warning rounded-pill">Pending</p>';
                    } elseif ($row->status == 1) {
                        return '<p class="text-white bg-success rounded-pill">Approved</p>';
                    } elseif ($row->status == 2) {
                        return '<p class="text-dark bg-danger rounded-pill">Declined</p>';
                    }
                })
                ->addColumn('file', function ($row) {
                    return [
                        'display' => '<img src="' . asset('storage/' . $row->file) . '" width="100">',
                        'sort' => $row->file, // You might need to adjust this if you want to allow sorting
                    ];
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $editLink = route("staff.teacher-leaves.edit", $id);
                    $editButton = '<a href="' . $editLink . '" target="_blank" class="btn btn-link p-0" style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    return $editButton;
                })
                ->addColumn('delete', function ($row) {
                    $id = $row->id;
                    $form = '<form action="' . route('staff.teacher-leaves.destroy', $id) . '" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this record?\')">';
                    $form .= csrf_field();
                    $form .= method_field('DELETE');
                    $form .= '<button type="submit" class="btn btn-danger">Delete</button>';
                    $form .= '</form>';
                    return $form;
                })
                ->rawColumns(['status_column', 'image', 'action', 'delete'])
                ->make(true);
        }


        $teacherleaves = TeacherLeave::get();
        // dd($teacherleaves);
        return view('backend.staff.teacherleaveview', compact('teacherleaves'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'leave_type'=>'required',
                'subject'=>'required',
                'description'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',

            ]
        );
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('teacherleaves','public');
        }
            $currentYear = now()->year;
        $data = [
            //Database column_name => Form field name
            'leave_type' => $request->leave_type,
            'subject' => $request->subject,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'file' => $path ?? null,

        ];
        $teacherleave = TeacherLeave::create($data);


        return redirect()->route('staff.teacher-leaves.create', compact('teacherleave'))->with('Teacher leave created sucessfully','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave = LeaveType::get();
        $editteacherleave = TeacherLeave::find($id);
        // dd($editteacherleave);
        $teacherleaves = TeacherLeave::get();
        return view('backend.staff.teacherleaves', compact('editteacherleave','teacherleaves','leave'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->hasFile('file')){

       $img = TeacherLeave::find($id)->file;
        if (File::exists( public_path('storage/'.$img))) {
            File::delete( public_path('storage/'.$img));
      }
            $file = $request->file('file');
            $path = $file->store('teacherleaves','public');
            TeacherLeave::find($id)->update(['file' => $path]);
        }

        $data = [
            //Database column_name => Form field name

            'leave_type' => $request->leave_type,
            'subject' => $request->subject,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,


        ];
        $teacherleave=TeacherLeave::find($id)->update($data);
        // dd($student);

        return redirect()->route('staff.teacher-leaves.create', compact('teacherleave'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // dd($id);
           $img = TeacherLeave::find($id)->file;
        if (File::exists( public_path('storage/'.$img))) {
            File::delete( public_path('storage/'.$img));
      }
         $teacherleave=TeacherLeave::find($id)->delete();
         // dd($student);

         return redirect()->back()->with('success', 'Teacher Leaves Deleted Sucessfully');
}
}
