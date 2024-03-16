<?php

namespace App\Http\Controllers;

use App\Events\Action;
use App\Events\DashboardNotificationEvent;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function teacherRegister()
    {
        return view('backend.staff.teacherRegister');
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

        $name = $request->f_name . $request->l_name;
        $currentYear = now()->year;
        $res = User::create([
            'name'=>$name,
            'email'=>'prakash@gmail.com',
            'password'=>Hash::make('123456'),
            'teacher_id'=>'emp'.$currentYear.'-'.$request->f_name,
         'first_name'=>$request->f_name,
         'last_name'=>$request->l_name,
         'father_name'=>$request->father_name,
         'dob'=>$request->dob,
         'mobile_number'=>$request->number,
         'anniversary_date'=>$request->anniversary_date,
         'joining_date'=>$request->joining_date,
        'teacher_image' => $pathToStore??'',
    ]);
    $res->assignRole('staff');
    if($res){
        event(new DashboardNotificationEvent($res));
        event(new Action($res)); 
      }
        if($res)
        {
            return redirect()->route('staff.teacherRegisterData');
        }

    }

    public function teacherRegisterData()
    {
        $data=Teacher::paginate(10);
        return view('backend.staff.teachers',compact('data'));
    }

    public function teacherEditData($id)
    {
        $data=Teacher::find($id);
        // dd($data);
        return view('backend.staff.teacherRegister',compact('data'));
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

        return redirect()->route('staff.teacherRegisterData');
    }
    public function teacherDeleteData($id)
    {
        // dd($id);
        $student=Teacher::find($id)->delete();
        // dd($student);

        return redirect()->back();
    }

}
