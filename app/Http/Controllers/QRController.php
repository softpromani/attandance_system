<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\QR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class QRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
         $qrDatas = QR::paginate(10);
        return view('backend.admin.qr_generate',compact('qrDatas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.qr_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'from'=>'required',
            'to'=>'required',
        ]);
        $uniqueCode = Str::random(10);
        $qrData = QR::create([
            'valid_from'=>$request->from,
            'valid_to'=>$request->to,
            'qr_code'=>$uniqueCode,
            'is_active'=>'1'
        ]);
        if($qrData){
            return redirect()->route('admin.qr.index')->with('toast_success','QR Created Successfully');
        }
        else{
            return redirect()->back()->with('toast_error','Ops...! QR Not Created');
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
        // $qrDatas = QR::all();
        $edit = QR::find(Crypt::decrypt($id));
        return view('backend.admin.qr_create',compact('edit'));
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
        $data = QR::find(Crypt::decrypt($id));
        $qrData = $data->update([
            'valid_from'=>$request->from,
            'valid_to'=>$request->to,
        ]);

        if($qrData){
            return redirect()->route('admin.qr.index')->with('success','QR Created Successfully');
        }
        else{
            return redirect()->back()->with('error','Ops...! QR Not Created');
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
        $delete = QR::find($id)->delete();
        if($delete){
            return back()->with('success', 'QR Deleted successfully');
        }
        else {
            return back()->with('error', 'Oh! QR did not Delete');
        }
    }
    public function is_active(Request $request, $id)
    {
        $data = QR::find($id)->is_active;
        if ($data == 1) {
            $update = QR::find($id)->update([
                'is_active' => 0
            ]);
        } else {
            $update = QR::find($id)->update([
                'is_active' => 1
            ]);
        }
        return redirect()->back()->with('success', 'Status Updated Successfully');
    }


    public function generateQR($id){
        $qr = QR::findOrFail(decrypt($id));
        $qrId = $qr->qr_code;
        if ($qr->is_active !== '1') {
            return redirect()->route('admin.qr.index')->with('status', 'This QR status is not active');
        }
            return view('backend.admin.print_qr',compact('qrId'));
    }

    public function capture(Request $request , $qr_code)
    {
      $reqData = QR::active()->where('qr_code',$qr_code)->first();
      $user = auth()->user();
       if(auth()->user()->attendances == true){
       
          $punchout =  Attendance::where('teacher_id',$user->id)->update([
                'punchout_time'=>now(),
                'punchout_location'=>'location',
            ]);
            if($punchout){
                return redirect()->route('admin.backendAdminPage')->with('success','Punchout Successfully');
            }
      }
    if($reqData){
       $valid = now()->between($reqData->valid_from, $reqData->valid_to);
        if($valid == false)
       {
        return redirect()->back()->with('error','Ops... This QR Code is Expired');
       }
       elseif($valid == true){
        $attendance = Attendance::create([
         'qr_id'=>$reqData->id,
         'teacher_id'=>$user->id,
         'punching_time'=>now(),
         'punching_location'=>'location',
         'status'=>'1',
         'device_info'=>json_encode(['ip'=>$request->ip()]),
        ]);
        if($attendance){
         return redirect()->route('admin.backendAdminPage')->with('success','Attendance Mark Successfully');
        }
     }
    }
    else{
        return redirect()->back()->with('error','Invalid QR Code');
       }
    }
    

}
