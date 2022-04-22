<?php

namespace App\Services;

use App\Models\User;

class WebNotify
{
    public static function notify($title)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $data = [
            'registration_ids' => $firebaseToken,
            'notification' => [
                'title' => $title,
            ],
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . env('SERVER_API_KEY'),
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    }
}
