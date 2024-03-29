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
        dd($request->all());
        $coordinates = $request->input('coordinates');
       $data = SetArea::create([
            'Coordinates'=>$coordinates
        ]);
        if($data){
            return redirect()->back()->with('success','Area set successfully');
        }
        else{
            return redirect()->back()->with('error','Area not set');

        }
    }
}
