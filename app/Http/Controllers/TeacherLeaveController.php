<?php

namespace App\Http\Controllers;

use App\Models\LeaveSetup;
use App\Models\LeaveType;
use Illuminate\Support\Facades\File;
use App\Models\TeacherLeave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $currentYear = date('Y');

        $leaveSetup = LeaveSetup::all();
        $sickle = $leaveSetup->where('type','sick')->where('years',$currentYear)->first();
        $totalsickLeave = 0;
        if ($sickle) {
            $totalsickLeave = ($sickle->paid_leave ?? 0) + ($sickle->unpaid_leave ?? 0);
        }
        $casuale = $leaveSetup->where('type','casual')->where('years',$currentYear)->first();
        $totalcasualLeave = 0;
        if ($casuale) {
            $totalcasualLeave = ($casuale->paid_leave ?? 0) + ($casuale->unpaid_leave ?? 0);
        }
        // dd($totalcasualLeave , $totalsickLeave);
        $totalleaves =  TeacherLeave::join('leave_types', 'teacher_leaves.leave_type', '=', 'leave_types.id')
        ->select('leave_types.name as leave_type', DB::raw('count(teacher_leaves.id) as leave_count'))
        ->groupBy('leave_types.name')
        ->get();

        $allleaves = array();
        foreach($totalleaves as $tl){
            $allleaves[] = $tl;  
        }
        // dd($allleaves);
       return view('backend.staff.teacherleaves', compact('teacherleaves','leave','totalsickLeave','totalcasualLeave','allleaves'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (request()->ajax()) {
            $userId =  auth()->user()->id;
            $teacherleaves = TeacherLeave::where('user_id',$userId)->get();
            
            return DataTables::of($teacherleaves)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                if ($row->status == 0) {
                    return '<p class="text-dark bg-warning rounded-pill text-center">Pending</p>';
                } elseif ($row->status == 1) {
                    return '<p class="text-white bg-success rounded-pill text-center">Approved</p>';
                } elseif ($row->status == 2) {
                    return '<p class="text-dark bg-danger rounded-pill text-center">Declined</p>';
                }
            })
                ->addColumn('name', function ($q){
                    return optional($q->UserName)->name;
                    })
                    ->addColumn('leave_type', function($q){
                        return $q->LeaveTypes->name??'N/A';
                    })
                ->addColumn('file', function ($q) {
                   
                    return asset('storage/'.$q->file);
                })
                ->addColumn('action', function ($row) {
                    if($row->status == 0){
                        $id = $row->id;
                        $editLink = route("staff.teacher-leaves.edit", $id);
                        $editButton = '<a href="' . $editLink . '" target="_blank" class="btn btn-link p-0 " style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                        $editButton .= '<form action="' . route('staff.teacher-leaves.destroy', $id) . '"  method="POST" onsubmit="return confirm(\'Are you sure you want to delete this record?\')">';
                        $editButton .= csrf_field();
                        $editButton .= method_field('DELETE');
                        $editButton .= '<button type="submit" class="btn btn-danger"><i class="fa fa-trash " aria-hidden="true"></i></button>';
                        $editButton .= '</form>';
                        return $editButton;
                    }
                    return '';
                })
                ->rawColumns(['status', 'image', 'action'])
                ->make(true);
        }
        $userId =  auth()->user()->id;
        $currentYear = date('Y');
        $leaveSetup = LeaveSetup::all();
        // if(isset($leaveSetup) && $leaveSetup->type['sick']){
        $sickle = $leaveSetup->where('type','sick')->where('years',$currentYear)->first();
        $totalsickLeave = 0;
        if ($sickle) {
            $totalsickLeave = ($sickle->paid_leave ?? 0) + ($sickle->unpaid_leave ?? 0);
        }
        // }
        // if(isset($leaveSetup) && $leaveSetup->type == 'casual'){
        $casuale = $leaveSetup->where('type','casual')->where('years',$currentYear)->first();
        $totalcasualLeave = 0;
        if ($casuale) {
            $totalcasualLeave = ($casuale->paid_leave ?? 0) + ($casuale->unpaid_leave ?? 0);
        }
        // }
        $allleaves =  TeacherLeave::join('leave_types', 'teacher_leaves.leave_type', '=', 'leave_types.id')
        ->select('leave_types.name as leave_type', DB::raw('count(teacher_leaves.id) as leave_count'))
        ->groupBy('leave_types.name')
        ->get();
        dd($allleaves);
        return view('backend.staff.teacherleaveview', compact('allleaves','sickle','casuale','totalsickLeave','totalcasualLeave'));


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
            $userId = auth()->user()->id;
        $data = [
            //Database column_name => Form field name
            'leave_type' => $request->leave_type,
            'subject' => $request->subject,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' =>$userId,
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
