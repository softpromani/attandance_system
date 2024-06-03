<?php

namespace App\Http\Controllers;

use App\Models\AddClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            $data = AddClass::create([
                'class'=>$request->addclass,
            ]);
            if($data){
                return redirect()->back()->with('success','Class Added Successfully');
            }
            else{
                return redirect()->back()->with('error','Ops... Class Not Added ');
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
        $edit = AddClass::find($id);
        return view('backend.admin.systemSetting',compact('edit'));
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
        $data = AddClass::find($id);
        $classData = $data->update([
            'class'=>$request->addclass,
        ]);
        if($classData){
            return redirect()->route('admin.systemSetting')->with('success','Class Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Ops...! Class Not Update');
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
        $delete = AddClass::find($id)->delete();
        if($delete){
            return back()->with('success', 'Class Deleted successfully');
        }
        else {
            return back()->with('error', 'Oh! Class did not Delete');
        }
    }
}
