<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacherRegister()
    {
        return view('backend.teacherRegister');
    }
    public function storeTeacherRegister(Request $request)
    {
        // dd($request);
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'father_name' => 'required',
            'number' => 'required',
            'dob' => 'required',
            'anniversary_date' => 'required',
            'joining_date' => 'required',
        ]);
        // dd($request->all());

        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $file->move(public_path('upload/teacher'), $file);
        // }

        if($request->hasFile('file'))
        {
           $pathToStore=$request->file->store('teacher','public');
        }


        $currentYear = now()->year;
        $res = Teacher::create([
            'teacher_id'=>'emp'.$currentYear.'-'.$request->f_name,
         'first_name'=>$request->f_name,
         'last_name'=>$request->l_name,
         'fathers_name'=>$request->father_name,
         'dob'=>$request->dob,
         'mobile_number'=>$request->number,
         'anniversary_date'=>$request->anniversary_date,
         'joining_date'=>$request->joining_date,
        'teacher_image' => $pathToStore,
    ]);

        if($res)
        {
            return redirect()->route('teacherRegisterData');
        }

    }

    public function teacherRegisterData()
    {
        $data=Teacher::paginate(5);
        return view('backend.teachers',compact('data'));
    }

    public function teacherEditData($id)
    {
        $data=Teacher::find($id);
        // dd($data);
        return view('backend.teacherRegister',compact('data'));
    }

    public function teacherUpdateData(Request $request, $id)
    {

        // dd($request->all());
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('file');
            Teacher::find($id)->update(['file' => $path]);
        }

        $data = [
            'first_name'=>$request->f_name,
            'last_name'=>$request->l_name,
            'fathers_name'=>$request->father_name,
            'dob'=>$request->dob,
            'mobile_number'=>$request->number,
            'anniversary_date'=>$request->anniversary_date,
            'joining_date'=>$request->joining_date,
           'teacher_image' => $path ??'',


        ];
        $student=Teacher::find($id)->update($data);
        // dd($student);

        return redirect()->route('teacherRegisterData');
    }
    public function teacherDeleteData($id)
    {
        // dd($id);
        $student=Teacher::find($id)->delete();
        // dd($student);

        return redirect()->back();
    }

}
