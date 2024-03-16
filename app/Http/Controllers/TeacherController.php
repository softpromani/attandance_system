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
        // dd($request->all());
        $request->validate([
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'number' => 'required|string|regex:/^[0-9]+$/|max:12', // Assuming a maximum length of 12 digits and only numeric
            'dob' => 'required|date|before_or_equal:today',
            'anniversary_date' => 'required|date|before_or_equal:today',
            'joining_date' => 'required|date|before_or_equal:today',
            'file' => 'nullable|file|mimes:jpeg,png|max:2048', // Assuming a maximum file size of 2 MB
            'password' => 'required|string|min:8', // Adjust the minimum length as needed
            'email' => 'required|email|unique:users,email|max:255',
        ]);

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
        'teacher_image' =>$pathToStore??'',
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
