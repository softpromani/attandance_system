<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password], $request->remember_me)) {


            return redirect()->route('backendAdminPage');
        } else {
            return redirect()->back()->with('error', 'Invalid Username or Password !');
        }
    }

    public function backendLoginPage()
    {
        return view('backend.adminLayout');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
