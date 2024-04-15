<?php

namespace App\Http\Controllers;

use App\Models\SetArea;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(){
      
        if (auth()->check() && auth()->user()->roles[0]['name'] == 'admin') {
            return view('backend.admin.geofenceing');
        }
        else{
            return redirect()->route('admin.backendAdminPage')->with('error','You Are Not Admin');
        }
       
        
        // dd($request->location);
    }

    public function setArea(Request $request){
       $user = auth()->user()->id;
       $data = SetArea::updateOrCreate(['user_id'   => $user],
             [
            'Coordinates'=>json_encode($request->info),
            ]
    );
        if($data){
            return redirect()->back()->with('success','Area set successfully');
        }
        else{
            return redirect()->back()->with('error','Area not set');

        }
    }
}
