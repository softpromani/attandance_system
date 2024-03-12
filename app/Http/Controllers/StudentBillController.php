<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentBill;
use Illuminate\Http\Request;

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
        return view('backend.studentBill',compact('studentData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'fee.*' => 'required|numeric',
            'month.*' => 'required|string',
            'late_fee.*' => 'required|numeric',
            'sum_fee.*' => 'required|numeric',
        ]);

        foreach ($data['fee'] as $key => $fee) {
            StudentBill::create([
                'student_id'=>$request->studentid,
                'fee' => $fee,
                'desc' => $request->desc,
                'late_fee' => $data['late_fee'][$key],
                'sum_fee' => $data['sum_fee'][$key],
                'total_fee' => $request->total_sum,
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
    public function show()
    {

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


        $students = Student::find($id);
        if (!$students) {
            return response()->json(['error' => 'Student not found'], 404);
        }
                return  view('backend.studentBill',compact('students'));
    }



}
