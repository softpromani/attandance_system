<?php

namespace App\Http\Controllers;

use App\Models\AddClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $classes = Section::get();
            
            return DataTables::of($classes)
                ->addIndexColumn()
                ->addColumn('clname', function($q) {
                    return $q->className->class??'N/A';
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("admin.section.edit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    
                        $ht .= ' <form action="' . route("admin.section.destroy", $id) . '" method="post" style="display:inline">
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
        return view('backend.admin.systemSetting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validate = $request->validate([
        //     'class'=>'required',
        //     'section'=>'required',
        // ]);
        $sectionData = Section::create([
            'class_id'=>$request->ClassId,
            'section'=>$request->section,
        ]);
        if($sectionData){
                return redirect()->back()->with('success','Section Added Successfully');
            }
            else{
                return redirect()->back()->with('error','Ops... Section Not Added ');
            }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Section::find($id);
        $classes = AddClass::get();
        return view('backend.admin.systemSetting',compact('edit','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Section::find($id);
        $sectionData = $data->update([
            'class_id'=>$request->ClassId,
            'section'=>$request->section,
        ]);
        if($sectionData){
            return redirect()->route('admin.systemSetting')->with('success','Section Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Ops...! Section Not Update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Section::find($id)->delete();
        if($delete){
            return back()->with('success', 'Section Deleted successfully');
        }
        else {
            return back()->with('error', 'Oh! Section did not Delete');
        }
    }
}
