<?php

namespace App\Http\Controllers;

use App\Events\DashboardNotificationEvent;
use App\Models\Student;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (request()->ajax()) {
            $students = Student::get();
            
            return DataTables::of($students)
                ->addIndexColumn()
                ->addColumn('student_image', function($q) {
                    // return optional($q)->student_image? asset('storage/'.$q->student_image) : '#';
                    return asset('storage/'.$q->student_image);
                })
                ->addColumn('action', function ($row) {
                    // $id = Crypt::encrypt($row->id); 
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("student.student.edit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    
                        $ht .= ' <form action="' . route("student.student.destroy", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        '.method_field("DELETE").'
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this Subject?\')">
                        <i class="fa fa-trash-o" style="color: red; font-size: 20px;"></i>
                        </button>';
                    
                        return $ht; 
                })
          
            ->make(true);
    }
      
       return view('backend.staff.studentsshow');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.staff.studentregister');
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
                'student_name'=>'required',
                'date_of_birth'=>'required',
                'father_name'=>'required',
                'class'=>'required',
                'section'=>'required',
                'mobile_number'=>'required',
                'student_image'=>'nullable',

            ]
        );
        $count=Student::latest()->first()->id??0;
        $count=$count+1;
        
        if($request->hasFile('student_image')){
            $file = $request->file('student_image');
            $path = $file->store('student','public');
        }
            $currentYear = now()->year;
        $data = [
            'registration_number' =>'STD'.$currentYear.rand('0','9').'00'.$count,
            'student_name' => $request->student_name,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'class' => $request->class,
            'section' => $request->section,
            'mobile_number' => $request->mobile_number,
            'student_image' => $path ?? null,

        ];
        $student = Student::create($data);
        if($student){
            event(new DashboardNotificationEvent($student));
        }

        return redirect()->route('student.student.index', compact('student'))->with('success','Student Created Successfully');
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
        $editstudent = Student::find($id);
        $students = Student::get();
        return view('backend.staff.studentregister', compact('editstudent','students'));
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
        if($request->hasFile('student_image')){
            $file = $request->file('student_image');
            $path = $file->store('student','public');
            Student::find($id)->update(['student_image' => $path]);
        }

        $data = [
            'student_name' => $request->student_name,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'class' => $request->class,
            'section' => $request->section,
            'mobile_number' => $request->mobile_number,
            'student_image' => $path ?? null,
        ];
        $student=Student::find($id)->update($data);
        if($student){
            return redirect()->route('student.student.index')->with('success','Student Update Sucessfully');
        }
        else{
            return redirect()->back()->with('error','Student Deleted Sucessfully');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::find($id)->delete();
        if($student){
            return redirect()->back()->with('success','Student Deleted Sucessfully');
        }
        else{
            return redirect()->back()->with('error','Ops... Student Not Delete');
        }
    }
    public function getfirebaseNoti(){
        return view('backend.notifications.notificationpush');
    }
    public function firebaseNoti(Request $request){

        $title = $request->title;
        $body = $request->body;
       $data = sendPushNotification($title , $body);
       if($data){
        return redirect()->route('admin.backendAdminPage')->with('success','Push Notification Send Successfully');
       }
       else{
        return redirect()->back()->with('error','Ops... Push Notification Not Send ');
       }
    }
}
