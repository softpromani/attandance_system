<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $students = Student::get();
       return view('backend.staff.studentsshow', compact('students'));
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
                'student_image'=>'required',



            ]
        );
       // dd($request);
        //dd($request->all());

        if($request->hasFile('student_image')){
            $file = $request->file('student_image');
            $path = $file->store('student','public');
        }
            $currentYear = now()->year;
        $data = [
            //Database column_name => Form field name
            'registration_number' =>'emp'.$currentYear.rand('0','9').'_'. $request->student_name,
            'student_name' => $request->student_name,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'class' => $request->class,
            'section' => $request->section,
            'mobile_number' => $request->mobile_number,
            'student_image' => $path ?? null,

        ];
       // dd($data);


        $student = Student::create($data);
        toast('User created sucessfully','success');

        return redirect()->route('student.student.index', compact('student'));
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
        // dd($edituser);
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

        // dd($request->all());
        if($request->hasFile('student_image')){
            $file = $request->file('student_image');
            $path = $file->store('student','public');
            Student::find($id)->update(['student_image' => $path]);
        }

        $data = [
            //Database column_name => Form field name
            'student_name' => $request->student_name,
            'date_of_birth' => $request->date_of_birth,
            'father_name' => $request->father_name,
            'class' => $request->class,
            'section' => $request->section,
            'mobile_number' => $request->mobile_number,
            'student_image' => $path ?? null,


        ];
        $student=Student::find($id)->update($data);
        // dd($student);

        return redirect()->route('student.student.index');
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
        $student=Student::find($id)->delete();
        // dd($student);

        toast('Student Deleted Sucessfully','success');
        return redirect()->back();
    }
}
