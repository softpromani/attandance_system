<?php

namespace App\Http\Controllers;

use App\Models\LeaveSetup;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('backend.auth.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {


            return redirect()->route('admin.backendAdminPage')->with('Success','Login Successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid Username or Password !');
        }
    }

    public function backendLoginPage()
    {
        $teacher=Teacher::all();
        $student=Student::get();
        $leave=LeaveSetup::get();
        $stdnt=$student->count();
        $teach=$teacher->count();
        $lv=$leave->count();
        return view('backend.admin.adminLayout',compact('teach','stdnt','lv'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('Getlogin');
    }

    public function showStaff($id)
    {
        $staff=User::find($id);
        // dd($staff);
        return view('backend.admin.staffDetail',compact('staff'));
    }
    public function editStaff($id)
    {
        $staff=User::find($id);
        // dd($staff);
        return view('backend.admin.staffedit',compact('staff'));
    }

    public function staffUpdateData(Request $request, $id)
    {

        // dd($request->all());
        if($request->hasFile('file')){
            $path=$request->file->store('admin','public');
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

        return redirect()->back();
    }

    public function editPassword($id)
    {
        return view('backend.admin.changePassword');
    }
    public function changePassword(Request $request)
{
    $request->validate([
        'password' => 'required',
        'new_password' => 'required|min:8|different:current_password',
        'cnf_new_password' => 'required|same:new_password',
    ]);

    $user = auth()->user();

    if (Hash::check($request->password, $user->password)) {
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        Auth::logout();
        return redirect()->route('Getlogin')->with('success', 'Password changed successfully');
    } else {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
    }
}
}
