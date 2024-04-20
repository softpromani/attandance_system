<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

 function sendPushNotification($title,$body)
{
    // Log::info('push notification',[
    //     'title' => $title,
    //     'body' => $body
    // ]);
   
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fcmTokens = User::whereNotNull('fcm_key')->pluck('fcm_key')->all();
    // dd($fcmTokens);
    $serverKey = 'AAAAYAXMyt0:APA91bETArIf0HeAsXN8pHqtclKhhCK0kq4g16nssyaWOAouHYbcYz8PkqwrjhpjclnbWqsk1iCSz_BC-EGN2MaXOnJJaPmUwLpe5WulIYxPGN2aOWnCgUeYMGo0ilrmldk1TitD0P-k';
    $data = [
        "registration_ids" => $fcmTokens,
        "notification" => [
            "title" => $title,
            "body" => $body,
        ]
    ];
    $response = Http::withHeaders([
        'Authorization' => 'key=' . $serverKey,
        'Content-Type' => 'application/json',
    ])->post($url, $data);
    dd($response);
    if ($response->successful()) {
        
        $responseData = $response->json(); 
        // Log::info('Response Data',[$responseData]);
        return redirect()->back();  
    } else {
        // Request failed, handle the error
        $errorCode = $response->status(); // Get HTTP status code
        $errorMessage = $response->body(); // Get error message
        // Log or handle the error accordingly
        return response()->json([
            'error' => 'Push notification failed',
            'code' => $errorCode,
            'message' => $errorMessage,
        ], $errorCode);
    }

}