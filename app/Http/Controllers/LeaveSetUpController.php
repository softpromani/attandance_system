<?php

namespace App\Http\Controllers;

use App\Models\LeaveSetup;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveSetUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $leave=LeaveSetup::paginate(5);
        return view('backend.admin.leaveSetUp',compact('leave'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('backend.admin.createLeave');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'type'=>'required',
                'year'=>'required',
                'paid_leave'=>'required',
                'unpaid_leave'=>'required',
               ]
        );
        $data =LeaveSetup::create( [
            'type'=>$request->type,
            'years' => $request->year,
            'unpaid_leave' => $request->unpaid_leave,
            'paid_leave' => $request->paid_leave,

        ]);

        if($data)
        {
            return redirect()->route('admin.leave-set-up.index')->with('success','Leave Setup Created Successfully');
        }
        else{

            return redirect()->back()->with('error','Something Went Wrong');

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
        $lvdata=LeaveSetup::find($id);
        // dd($lvdata);
        $leave=LeaveSetup::paginate(5);
        return view('backend.admin.createLeave',compact('lvdata','leave'));
        dd($lvdata);
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
        $data = [
            'type'=>$request->type,
            'years' => $request->year,
            'unpaid_leave' => $request->unpaid_leave,
            'paid_leave' => $request->paid_leave,


        ];
        $student=LeaveSetup::find($id)->update($data);
        if($student){
            return redirect()->route('admin.leave-set-up.index')->with('success','Leave Setup Update Successfully');
        }
        else{
            return redirect()->back()->with('success','Leave Setup Update Successfully');
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
        //
    }
}
