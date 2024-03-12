<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Support\Str;
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
        $count=User::whereYear('created_at',Carbon::now()->format('Y'))->count()+1;
        $teacher_id= Carbon::now()->format('Ym') .'000'.$count;
        $res = User::create([
            'name'=>$name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'teacher_id'=>'Emp'.$teacher_id,
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
        if($res)
        {
            return redirect()->route('staff.teacherRegisterData');
        }

    }

    public function teacherRegisterData()
    {
        $data=User::paginate(10);
        return view('backend.staff.teachers',compact('data'));
    }

    public function teacherEditData($id)
    {
        $data=User::find($id);
        // dd($data);
        return view('backend.staff.teacherRegister',compact('data'));
    }

    public function teacherUpdateData(Request $request, $id)
    {

        // dd($request->all());
        if($request->hasFile('file')){
            $file = $request->file('file');
            $path = $file->store('file');
            User::find($id)->update(['file' => $path]);
        }

        $data = [
            'email'=>$request->email,
            'first_name'=>$request->f_name,
            'last_name'=>$request->l_name,
            'fathers_name'=>$request->father_name,
            'dob'=>$request->dob,
            'mobile_number'=>$request->number,
            'anniversary_date'=>$request->anniversary_date,
            'joining_date'=>$request->joining_date,
           'teacher_image' => $path ??'',


        ];
        $student=User::find($id)->update($data);
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
