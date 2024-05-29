<?php

namespace App\Http\Controllers;

use App\Notifications\FirebasePushNotification;

class AttendanceController extends Controller
{
    public function index()
    {
        $notification = new FirebasePushNotification(
            "dS3qAoY8SfiuzwhS24_81Z:APA91bFKzGZueTWRzD43HczZEHbdx65MMzdZdwtW89lo7nDLeMVowdbOfC-_jg8brwgaTepfdCqG3w9YKfpMa_K9y6a6GVyKxSKVwqHoRA7x_TBwW81dlCyOSmb4y3dhtSMNSPysGrp7",
            "Halo Sayang!",
            "Ini notif dari aku tercinta! :p"
        );

        $notification->toFirebase();

        return response()->json(['message' => 'This is an example API response'], 200);
    }
}
