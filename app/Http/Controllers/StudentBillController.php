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
use Illuminate\Support\Facades\View;

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
            'totalsum.*' => 'required',
        ]);
        // dd($request);
        $fee = Fee::create(['total_fee'=>$request->totalsum,
        'student_id'=>$request->studentid,
        ]);

        foreach ($data['amount'] as $key => $fee) {
            FeeDetail::create([
                'amount' => $fee,
                'desc' => $data['desc'][$key],
                'year' => $data['year'][$key],
                'late_fee' => $data['late_fee'][$key],
                'month' => $data['month'][$key],
                'fee_id'=> $fee->id
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
    //     $bill = StudentBill::findOrFail($id);

    // // Generate HTML content for the bill
    // DD($bill);
    // $htmlContent = view('backend.studentBillPDF', compact('bill'))->render();

    // $bill = StudentBill::findOrFail($id);

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
        //
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

    public function months()
    {
        $month=Month::get();
        dd($month);
    }

}
