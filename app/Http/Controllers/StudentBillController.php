<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\FeeDetail;
use App\Models\FeeType;
use App\Models\Month;
use App\Models\Student;
use App\Models\StudentBill;
use App\Models\Year;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Support\Carbon;
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
    public function create(Request $request)
    {
        if (request()->ajax()) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
           
            $query =Fee::query();
    
            if ($startDate && $endDate) {
               $data = $query->whereBetween('created_at', [$startDate, $endDate]);
                $data->get();
            }
            $bills=$query->with('student')->get();
            // dd($bills);
            return DataTables::of($bills)
                ->addIndexColumn()
                ->addColumn('student_name',function($q){
                    return $q->student->student_name;
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $ht = '';
                        $ht .= '<a href="' . route("staff.student-fee.edit", $id) . '" class="btn btn-link p-0 "style="display:inline"><i class="fa fa-edit me-1" style="color:blue; font-size:20px;"></i></a>';

                        return $ht;
                })
                ->addColumn('view',function($q){
                    $id = $q->id;
                    $ht = '';
                  $ht = '<a href="'. route('staff.student-bill.show' , $id).'" ><i class="fa fa-download" aria-hidden="true"></i></a>';
                 return $ht;
                })
                ->rawColumns(['action','view'])

            ->make(true);
    }
        $bills=Fee::with('student')->get();
        return view('backend.studentsBill',compact('bills'));
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
            'desc.*' => 'required',
            'year.*' => 'required',
            'totalsum' => 'required',
            'late_fee'=>'nullable',
        ]);

        // finance year
        $today=new DateTime(); // today's date
        $currentYear=(int)$today->format('Y');
        $currentMonth=(int)$today->format('m');
        if($currentMonth < 4){
            $financialYearStart=$currentYear-1;
            $financialYearEnd=$currentYear;
        }
        else{
            $financialYearStart=$currentYear;
            $financialYearEnd=$currentYear+1;
        }

        $financialYear=sprintf("%d-%d",$financialYearStart,substr($financialYearEnd,-2));
        $number=Fee::currentYearInvoices()->count() + 1;
        // Format the invoice number with leading zeros if needed
        $formattedNumber = str_pad($number, 4, '0', STR_PAD_LEFT);
        // Generate the year-based invoice number
        $invoiceNumber = $financialYear.'/'. $formattedNumber;
        // dd($invoiceNumber);
        $fee = Fee::create([
        'total_fee'=>$request->totalsum,
        'invoice_no'=>$invoiceNumber,
        'payment_status'=>'paid',
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
                'late_fee' => isset($data['late_fee'][$key]) ? $data['late_fee'][$key] : '0',
                'month' => $data['month'][$key],
                'fee_id' => $fee->id 
            ]);
        }
        if($feeDetail){
            return redirect()->route('staff.student-bill.create')->with('success', 'Data stored successfully');
        }
        else{
            return redirect()->back()->with('error','Ops.... Bill Not Created');
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
        $feeTypes = FeeType::get();
        $students = Student::find($id);
        if (!$students) {
            return response()->json(['error' => 'Student not found'], 404);
        }
                return  view('backend.studentBill',compact('students','months','year','feeTypes'));
    }

    public function editStudentFee($id)
    {
          $fee=Fee::with(['student','feeDetails'])->find($id);
        //   dd($fee);
        $feeTypes = FeeType::get();
          return view('backend.studentBillEdit',compact('fee','feeTypes'));
    }
    public function updateStudentFee(Request $request,$id)
    {
        // dd($request->all());

        $fee = Fee::find($id);;
        $studentid=$fee->student_id;
        if ($fee) {
            $fee->feeDetails()->delete();
        }
        // Create a new fee record
        $totalFee = $request->has('totalsum') ? $request->totalsum : $fee->total_fee;

        $fee->update([
            'total_fee' => $totalFee,
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
                'late_fee' => $data['late_fee'][$key] ?? '0.00',
                'month' => $data['month'][$key],
                'feetype_id' => $data['fee_type'][$key],
                'fee_id' => $fee->id // Use the ID of the newly created fee
            ]);
        }

        if($feeDetail){
            return redirect()->route('staff.student-bill.create')->with('succes' ,'Data Updated Successfully');

        }

else{
    return redirect()->back()->with('error','something went wrong');
}
    }
}
