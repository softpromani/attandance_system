<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function attendanceMark(){
        return view('backend.staff.attendance_mark');
    }
    public function updateLocation(Request $request)
    {
        // dd($request->all());
        $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');

    Log::info("Received latitude: $latitude, longitude: $longitude");
        return view('backend.location');
        // Add your logic here to handle the latitude and longitude data
        // For example, you can store it in the database or perform any other operations

        // Log the received data

        // return response()->json(['message' => 'Location data received successfully']);
    }
}
