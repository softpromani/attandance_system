<?php

namespace App\Http\Controllers;

use App\Models\AddClass;
use App\Models\Fee;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function getReport()
    {
        $students = Student::all();
        $studentMale = $students->where('gender','male')->count();
        $studentFemale = $students->where('gender','female')->count();
        $allstudent = $students->count();

        $monthlyFees = Fee::select(
            DB::raw('SUM(total_fee) as total'),
            DB::raw('MONTH(created_at) as month')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();
        $monthlyFees = array_replace(array_fill(1, 12, 0), $monthlyFees);

        return view('backend.admin.report',compact('studentMale','studentFemale','allstudent','monthlyFees'));
    }

    public function getEvent()
    {
        $users = User::all();
        $anniversaries = [];
        $anniFullDate = [];
        $dob = [];
        $dobFullDate = [];
        $joining = [];
        $joiningFullDate = [];
        $usernames = [];
        foreach ($users as $user) {
            // Anniversary processing
            $anniversaryDate = $user->anniversary_date;
            if ($anniversaryDate) {
                $anniversaries[] = Carbon::parse($anniversaryDate)->format('m/d');
                $anniFullDate[] = Carbon::parse($anniversaryDate)->format('j F, Y');
            }
            // Birthday processing
            $birthday = $user->dob;
            if ($birthday) {
                $dob[] = Carbon::parse($birthday)->format('m/d');
                $dobFullDate[] = Carbon::parse($birthday)->format('j F, Y');
            }
            // Joining processing
            $joiningdate = $user->joining_date;
            if ($joiningdate) {
                $joining[] = Carbon::parse($joiningdate)->format('m/d');
                $joiningFullDate[] = Carbon::parse($joiningdate)->format('j F, Y');
            }
            $usernames[] = $user->name;
        }
        $calendarEvents = [];
        for ($i = 0; $i < count($anniversaries); $i++) {
            if ($anniversaries[$i]) {
                $calendarEvents[] = [
                    'id' => 'anniversary' . $i,
                    'name' => $usernames[$i],
                    'date' => $anniversaries[$i],
                    'type' => 'holiday',
                    'description' => 'Marriage Anniversary ' . $anniFullDate[$i],
                    'everyYear' => true,
                    'color' => '#0000FF'
                ];
            }
        }
        // Loop through dob and usernames to add birthday events
        for ($i = 0; $i < count($dob); $i++) {
            if ($dob[$i]) {
                $calendarEvents[] = [
                    'id' => 'birthday' . $i,
                    'name' => $usernames[$i],
                    'date' => $dob[$i],
                    'type' => 'birthday',
                    'description' => 'Happy Birthday ' . $dobFullDate[$i],
                    'everyYear' => true,
                    'color' => '#FF0000' // Red color for this event
                ];
            }
        }
        // Loop through dob and usernames to add Joining events
        for ($i = 0; $i < count($joining); $i++) {
            if ($joining[$i]) {
                $calendarEvents[] = [
                    'id' => 'joining' . $i,
                    'name' => $usernames[$i],
                    'date' => $joining[$i],
                    'type' => 'joining',
                    'description' => 'Joining Anniversary ' . $joiningFullDate[$i],
                    'everyYear' => true,
                    'color' => '#008000' // Red color for this event
                ];
            }
        }
        // Pass processed data to the view
        return view('backend.admin.event', compact('calendarEvents'));
    }

    public function viewStudentReport(){
        if (request()->ajax()) {
            $sections = Section::with(['className','students'])->get();
            return DataTables::of($sections)
                ->addIndexColumn()
            ->addColumn('class', function($q) {
                return $q->className->class??'N/A';
            })
            ->addColumn('section', function($q) {
                return $q->section??'N/A'; 
            })
            ->addColumn('girls', function($q) {
                return $q->students()->where('gender', 'female')->count();
            })
            ->addColumn('boys', function($q) {
                return $q->students()->where('gender', 'male')->count();
            })
            ->addColumn('total', function($q) {
                return $q->students()->count();
            })
            ->make(true);
        }
        return view('backend.admin.viewStdReport');
    }
    public function viewStudentFeeReport(Request $request)
        {
            if ($request->ajax()) {
                $fees = Fee::with(['student.className', 'student.sectionName', 'feeDetails'])
                ->get()
                ->groupBy(function ($fee) {
                    if (!$fee->student) {
                        return 'unknown';
                    }
                    
                    $createdAt = Carbon::parse($fee->created_at);
                    $classId = $fee->student->class_id ?? '';
                    $sectionId = $fee->student->section_id ?? '';
                    $month = $createdAt->month ?? '';
                    $year = $createdAt->year ?? '';
                    
                    return "{$classId}-{$sectionId}-{$month}-{$year}";
                });
        
                $data = [];
        
                foreach ($fees as $groupKey => $groupFees) {
                    $parts = explode('-', $groupKey);

                    $classId = $parts[0] ?? 'unknown';
                    $sectionId = $parts[1] ?? 'unknown';
                    $month = $parts[2] ?? '0';
                    $year = $parts[3] ?? '0';
                
                    $total = $groupFees->sum(function ($fee) {
                        return $fee->total_fee;
                        // feeDetails->sum('amount');
                    });
                    $formattedTotal = '₹' . number_format($total, 2);
                    $data[] = [
                        'class' => $groupFees->first()->student->className->class?? '',
                        'section' => $groupFees->first()->student->sectionName->section?? '',
                        'month' => Carbon::createFromDate(null, $month)->format('F'), // Get month name
                        'year' => $year,
                        'total' => $formattedTotal,
                    ];
                }
        
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        return view('backend.admin.viewStdFeeReport');
    }
}
