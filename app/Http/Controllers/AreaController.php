<?php

namespace App\Http\Controllers;

use App\Models\SetArea;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(){
        return view('backend.admin.geofenceing');
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
