<?php

namespace App\Http\Controllers;

use App\Events\Action;
use App\Events\DashboardNotificationEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    public function teacherRegister()
    {
        return view('backend.staff.teacherRegister');
    }
    public function storeTeacherRegister(Request $request)
    {
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
        $name = $request->f_name .' '. $request->l_name;
        $currentYear = now()->year;
        $count=User::whereYear('created_at',Carbon::now()->format('Y'))->count()+1;
        $teacher_id= Carbon::now()->format('Ym') .'000'.$count;
        $res = User::create([
        'name'=>$name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
         'teacher_id'=>'staff'.$teacher_id,
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
        // dd( User::get());
        if (request()->ajax()) {
            $users = User::get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('image', function($q) {
                    return asset('storage/'.$q->teacher_image);
                })
                ->addColumn('action', function ($row) {
                    // $id = Crypt::encrypt($row->id); 
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("staff.teacherEditData", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    
                        $ht .= ' <form action="' . route("staff.teacherDeleteData", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        '.method_field("POST").'
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this Staff?\')">
                        <i class="fa fa-trash-o" style="color: red; font-size: 20px;"></i>
                        </button>';
                    
                        return $ht; 
                })
                ->make(true); 
    }   
        return view('backend.staff.teachers');
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
            $path = $file->store('teacher','public');
            User::find($id)->update(['file' => $path]);
        }
        
        $name = $request->f_name .' '. $request->l_name;
        $data = [
            'name'=>$name,
            'email'=>$request->email,
            'first_name'=>$request->f_name,
            'last_name'=>$request->l_name,
            'father_name'=>$request->father_name,
            'dob'=>$request->dob,
            'mobile_number'=>$request->number,
            'anniversary_date'=>$request->anniversary_date,
            'joining_date'=>$request->joining_date,
            'teacher_image' => $path ??'',


        ];
        $student=User::find($id)->update($data);
        if($student){
            return redirect()->route('staff.teacherRegisterData')->with('success','Staff Update Success');
        }
        else{
            return redirect()->back()->with('error','Ops... Data Not Update');
        }

        
    }
    public function teacherDeleteData($id)
    {
        $Staff=User::find($id)->delete();
        if($Staff){
            return redirect()->back()->with('success','Staff Deleted Successfully'); 
        }
        else{
            return redirect()->back()->with('error','Ops... Staff Not Delete');
        }
    }

}
