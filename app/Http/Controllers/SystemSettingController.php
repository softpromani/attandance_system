<?php

namespace App\Http\Controllers;

use App\Models\AddClass;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SystemSettingController extends Controller
{
    public function systemSetting(){
        if (request()->ajax()) {
            $classes = AddClass::get();
            
            return DataTables::of($classes)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("admin.jsfclass.edit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    
                        $ht .= ' <form action="' . route("admin.jsfclass.destroy", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        '.method_field("DELETE").'
                        <button type="submit" class="btn btn-link p-0" >
                        <i class="fa fa-trash-o" style="color: red; font-size: 20px;"></i>
                        </button>'
                        ;
                      
                        return $ht; 
                })

            ->make(true);
        }
        $classes = AddClass::get();
    return view('backend.admin.systemSetting',compact('classes'));
    }
   
    
}
