<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\FeeDetail;
use App\Models\Month;
use App\Models\Student;
use App\Models\StudentBill;
use App\Models\Year;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class StudentBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        if ($req->ajax() && $req->has('term')) {
            $term = $req->input('term');

            // Perform a search based on the student name
            $students = Student::where('student_name', 'like', '%' . $term . '%')->get();

            // Return the result as JSON
            return response()->json(['studentData' => $students]);
        }

        $studentData=Student::get();
        return view('backend.studentBill', compact('studentData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()) {
            $bills=FeeDetail::get();
            
            return DataTables::of($bills)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $id = Crypt::encrypt($row->id); 
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("staff.student-bill.show", $id) . '" target="_blank" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';
                    
                        return $ht; 
                })
          
            ->make(true);
    }
        $bills=FeeDetail::all();
        return view('backend.studentsBill',['bills' => $bills]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'amount.*' => 'required|numeric',
            'month.*' => 'required',
            'late_fee.*' => 'required|numeric',
            'desc.*' => 'required',
            'year.*' => 'required',
            'totalsum' => 'required',
        ]);
        // dd($request);
        $fee = Fee::create(['total_fee'=>$request->totalsum,
        'payment_status'=>'0',
        'submitted_fee'=>'0.00',
        'student_id'=>$request->studentid,
        ]);
        // dd($fee->id);
        // foreach ($data['amount'] as $key => $fee) {
        //     FeeDetail::create([
        //         'amount' => $fee,
        //         'desc' => $data['desc'][$key],
        //         'year' => $data['year'][$key],
        //         'late_fee' => $data['late_fee'][$key],
        //         'month' => $data['month'][$key],
        //         'fee_id'=> $fee->id
        //     ]);
        foreach ($data['amount'] as $key => $amount) {
            $feeDetail = FeeDetail::create([
                'amount' => $amount,
                'desc' => $data['desc'][$key],
                'year' => $data['year'][$key],
                'late_fee' => $data['late_fee'][$key],
                'month' => $data['month'][$key],
                'fee_id' => $fee->id // Use the ID of the newly created fee
            ]);

        }

        return redirect()->back()->with('success', 'Data stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // dd($id);
            // Retrieve the student along with their fee details and sum of fees paid
            // $student = Student::with(['fees' => function ($query) {
            //     $query->select('student_id', DB::raw('SUM(total_fee) as total_paid'))
            //           ->groupBy('student_id');
            // }])->findOrFail($id);
            // $bill = FeeDetail::findOrFail($id);

            $fee=Fee::with(['student','feeDetails'])->find($id);
            // dd($fee);

        return  view('backend.studentBillPDF', compact('fee'));

    // Generate HTML content for the bill
    // DD($bill);
    // $htmlContent = view('backend.studentBillPDF', compact('student'))->render();



    // Generate HTML content for the bill
    // $bill = View::make('backend.studentBillPDF', compact('bill'))->render();

    // return view('backend.studentBillPDF', ['bill' => $bill]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);

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
        dd($request,$id);
        //     $fee=Fee::find($id)->update(['total_fee'=>$request->totalsum,
        // 'payment_status'=>'0',
        // 'submitted_fee'=>'0.00',
        // 'student_id'=>$request->studentid,
        // ]);
        // dd($fee);


        // foreach ($data['amount'] as $key => $amount) {
        //     $feeDetail = FeeDetail::create([
        //         'amount' => $amount,
        //         'desc' => $data['desc'][$key],
        //         'year' => $data['year'][$key],
        //         'late_fee' => $data['late_fee'][$key],
        //         'month' => $data['month'][$key],
        //         'fee_id' => $fee->id // Use the ID of the newly created fee
        //     ]);

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
    public function editBill($id)
    {

        $months=Month::get();
        $year=Year::get();
        $students = Student::find($id);
        if (!$students) {
            return response()->json(['error' => 'Student not found'], 404);
        }
                return  view('backend.studentBill',compact('students','months','year'));
    }

    public function editStudentFee($id)
    {
          $fee=Fee::with(['student','feeDetails'])->find($id);
        //   dd($fee);
          return view('backend.studentBillEdit',compact('fee'));
    }
    public function updateStudentFee(Request $request,$id)
    {
        // dd($request->all());

        $fee = Fee::find($id);
        $studentid=$fee->student_id;
        if ($fee) {
            $fee->feeDetails()->delete();
        }
        // Create a new fee record
        $fee->update([
            'total_fee' => $request->totalsum,
            'payment_status' => 'unpaid',
            'submitted_fee' => '0.00',
            'student_id' => $studentid,
        ]);
        // dd($fee);
        $data=$request->all();
        foreach ($data['amount'] as $key => $amount) {
            $feeDetail = FeeDetail::create([
                'amount' => $amount,
                'desc' => $data['desc'][$key],
                'year' => $data['year'][$key],
                'late_fee' => $data['late_fee'][$key],
                'month' => $data['month'][$key],
                'fee_id' => $fee->id // Use the ID of the newly created fee
            ]);
        }

        if($feeDetail){
            return redirect()->back()->with('succes' ,'Data Updated Successfully');

        }

else{
    return redirect()->back()->with('error','something went wrong');
}
    }
}
