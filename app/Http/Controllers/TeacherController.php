<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacherRegister()
    {
        return view('backend.teacherRegister');
    }
}
