<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassMail;
use App\Models\LeaveSetup;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherLeave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.backendAdminPage')->with('Success','Welcome back');
        }
        return view('backend.auth.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $userData = Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember);

        if ($userData) {
            auth()->user()->update(['fcm_key'=>$request->fcm_token]);

            return redirect()->route('admin.backendAdminPage')->with('Success','Login Successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid Username or Password !');
        }
    }

    public function backendLoginPage()
    {
        $teacher=User::whereHas('roles', function ($query) {
          return $query->where('name','!=', 'admin');
        })->get();
        $student=Student::get();
        $leave=TeacherLeave::get();
        $stdnt=$student->count();
        $teach=$teacher->count();
        $lv=$leave->count();
        return view('backend.admin.adminLayout',compact('teach','stdnt','lv'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('Getlogin')->with('success','You are Logout Successfully');
    }

    public function showStaff($id)
    {
        $staff=User::find($id);
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

try {
    $user = User::find($id);
    if ($request->hasFile('file')) {
        $oldImagePath = $user->teacher_image;
        if ($oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }
        $file = $request->file('file');
        $path = $file->store('teacher', 'public');
        $user->update(['teacher_image' => $path]);
    }

    // if ($user)
    // {
    //     $oldImagePath = $user->teacher_image;
    //     if ($oldImagePath) {
    //         Storage::disk('public')->delete($oldImagePath);
    //     }
    //     $file = $request->file('file');
    //     $path = $file->store('teacher', 'public');
    //     $user->update(['teacher_image' => $path]);
    //  }
    $fullName = $request->f_name . ' ' . $request->l_name;
    $data = [
        'name'=>$fullName,
        'first_name'=>$request->f_name,
        'last_name'=>$request->l_name,
        'email'=>$request->email,
        'father_name'=>$request->father_name,
        'dob'=>$request->dob,
        'mobile_number'=>$request->number,
        'anniversary_date'=>$request->anniversary_date,
        'joining_date'=>$request->joining_date,

    ];
    $users=$user->update($data);
    if($users){
        return redirect()->route('admin.backendAdminPage')->with('success','Profile Update Successfully');
    }else{
        return redirect()->back()->with('error','Ops...! Profile not Update');
    }
    } catch (\Throwable $th) {
        return $th;
    }
      
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
       $data = $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        if($data){
            Auth::logout();
            return redirect()->route('Getlogin')->with('success', 'Password changed successfully');
            // Auth::logout()->with('success', 'Password changed successfully');
        }
    } else {
        return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
    }
}
    public function verifyEmail(){
        return view('backend.forgotPassword.verifyEmail');

    }

    public function forgotLink(Request $request)
{
    try {
        
      $validate = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ],
         [
            'email.exists' => 'This Email Address Does Not exist.',
        ]
        );
        if($validate){
            $url = url()->current();
            $baseUrl = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST) . ':' . parse_url($url, PHP_URL_PORT) . '/';
            $newUrl = $baseUrl.'forgot-password-view'.'/'.$request->email;
            // dd($newUrl);
            $mailData = [
                'email' => $request->email,
                'Forgot_Link' =>$newUrl,
            ];
            // Log::info('controller data'.json_encode($mailData));
            Mail::to($request->email)->send(new ForgotPassMail($mailData));
          
            return redirect('/')->with('success','Password reset Link sent to your email');
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (\Throwable $th) {
        return back()->with('error', $th);
    }
}
    public function forgotView($email){

        return view('backend.forgotPassword.forgotPass',compact('email'));
    }
        public function forgotPassword(Request $request)
        {
            $request->validate([
                'email' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);
            try {
                $updatePass = User::where('email', $request->email)
                ->update([
                    'password' => Hash::make($request->new_password),
                ]);
                if ($updatePass) {
                    return response()->json([
                        'message' => 'Password updated successfully.'
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Failed to update password. User not found or invalid email.'
                    ], 400);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'An error occurred while updating the password.',
                    'error' => $th->getMessage()
                ], 500);
            }
        }

    
}
