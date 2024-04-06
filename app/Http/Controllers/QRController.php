<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\QR;
use App\Models\SetArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class QRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        
        if (request()->ajax()) {
            $qrDatas = QR::get();
            
            return DataTables::of($qrDatas)
                ->addIndexColumn()
            ->addColumn('valid_from', function($q) {
                return $q->valid_from->format('Y M d');
            })
            ->addColumn('valid_to', function($q) {
                return $q->valid_to->format('Y M d');
            })
                ->addColumn('action', function ($row) {
                    // $id = Crypt::encrypt($row->id); 
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("admin.qr.edit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    
                        $ht .= ' <form action="' . route("admin.qr.destroy", $id) . '" method="post" style="display:inline">
                        ' . csrf_field() . '
                        '.method_field("DELETE").'
                        <button type="submit" class="btn btn-link p-0" onclick="return confirm(\'Are you sure you want to delete this QR?\')">
                        <i class="fa fa-trash-o" style="color: red; font-size: 20px;"></i>
                        </button>';
                        $ht .= '<a href="' . route("staff.generate_qr", $id) . '" id="printButton"
                                                target="_blank" class="btn btn-link p-0">
                                                <i class="fa fa-print" aria-hidden="true" style="color: rgb(255, 174, 0); font-size: 20px;"></i>
                                            </a>';
                        return $ht; 
                })
                
                ->addColumn('is_active', function ($row) {
                    // $id = Crypt::encrypt($row->id);
                    $id = $row->id;
                    $ht = '
                    <label class="custom-control-label" for="switch-dark-mode-a'.$id.'">
                    <input type="checkbox" class="form-check-input active" data-id="' . $id . '"';
                    $ht .= ($row->is_active == 1) ? 'checked' : '';
                    $ht .= '>
                    <span class="switch-toggle-slider">
                      <span class="switch-on">
                        <i class="ti ti-check"></i>
                      </span>
                      <span class="switch-off">
                        <i class="ti ti-x"></i>
                      </span>
                    </span>
                  </label>';
                    return $ht;
                })
                ->rawColumns(['is_active','action'])
            ->make(true);
            }
        return view('backend.admin.qr_generate');
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
            return redirect()->route('admin.qr.index')->with('success','QR Created Successfully');
        }
        else{
            return redirect()->back()->with('error','Ops...! QR Not Created');
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
        $edit = QR::find($id);
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
            return redirect()->route('admin.qr.index')->with('success','QR Updated Successfully');
        }
        else{
            return redirect()->back()->with('error','Ops...! QR Not Update');
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

        $qr = QR::findOrFail($id);
        $qrId = $qr->qr_code;
        if ($qr->is_active !== '1') {
            return redirect()->route('admin.qr.index')->with('status', 'This QR status is not active');
        }
            return view('backend.admin.print_qr',compact('qrId'));
    }

    public function capture(Request $request , $qr_code)
    {
        $userLocation = auth()->user()->location;
        $userCoordinates = explode(',', $userLocation);
        $userLatitude = (float) $userCoordinates[0]; 
        $userLongitude = (float) $userCoordinates[1]; 

        $coordi = SetArea::first();
        $pointsString = $coordi->Coordinates;
        $pointsArray = explode(',', $pointsString);
        $allcoordinate = array_chunk($pointsArray, 2);
        $radius = 3; // assuming the radius is 3 units

        foreach ($allcoordinate as $coordinate) {
            $distance = $this->calculateDistance($userLatitude, $userLongitude, $coordinate[0], $coordinate[1]);
        //   dd($distance);
            if ($distance <= $radius) {
                
                $reqData = QR::active()->where('qr_code',$qr_code)->first();
                $user = auth()->user();
                if(auth()->user()->attendances == true){
                    $punchout =  Attendance::where('teacher_id',$user->id)->whereDate('punching_time',Carbon::today())->update([
                          'punchout_time'=>\Carbon\Carbon::now('Asia/Kolkata'),
                          'punchout_location'=>$user->location,
                      ]);
                      if($punchout){
                          return redirect()->route('admin.backendAdminPage')->with('success','Punchout Successfully');
                      }
                }
              
                if($reqData){
                 $valid = \Carbon\Carbon::now('Asia/Kolkata')->between($reqData->valid_from, $reqData->valid_to);
                  if($valid == false)
                 {
                  return redirect()->back()->with('error','Ops... This QR Code is Expired');
                 }
                 elseif($valid == true){
                  $attendance = Attendance::create([
                   'qr_id'=>$reqData->id,
                   'teacher_id'=>$user->id,
                   'punching_time'=>\Carbon\Carbon::now('Asia/Kolkata'),
                   'punching_location'=>$user->location,
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
            else{
                return redirect()->route('admin.backendAdminPage')->with('warning','You are in Restricted Area');
            }
        } 
    }
    
    private function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371; // in kilometers
        
        $lat1 = deg2rad((float) $latitude1);
        $lon1 = deg2rad((float) $longitude1);
        $lat2 = deg2rad((float) $latitude2);
        $lon2 = deg2rad((float) $longitude2);
        
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        $distance = $earthRadius * $c;
        
        return $distance;
    }

    

}
