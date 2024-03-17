<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
public function index(){
    return view('backend.notifications.dashNotification');
}


public function markRead(Request $request){
        auth()->user()->unreadNotifications->when($request->input('id'), function ($query) use ($request) {
            return $query->where('id', $request->input('id'));
        })->markAsRead();
    return response()->noContent();
    }

}
