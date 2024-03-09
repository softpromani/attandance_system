<?php

namespace App\Http\Controllers;

use App\Models\LeaveSetup;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {


            return redirect()->route('backendAdminPage')->with('Success','Login Successfully');
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
        return view('backend.adminLayout',compact('teach','stdnt','lv'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
