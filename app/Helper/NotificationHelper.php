<?php

use App\Models\User;
use App\Notifications\UserNotification;
use GuzzleHttp\Client;

class NotificationHelper
{
    public static function sendNotification(array $data, User $userTarget)
    {
        $userTarget->notify(new UserNotification($data));

        $serverKey = env('FCM_SERVER_KEY');
        $headers = [
            'Authorization' => 'key=' . $serverKey,
            'Content-Type'  => 'application/json',
        ];
        $fields = [
            'to' => $userTarget->fcm_token_key,
            'content-available' => true,
            'priority' => 'high',
            'data' => [
                'title' => $data['title'] != null ? $data['title'] : "Title",
                'body' => $data['body'] != null ? $data['body'] : "Body",
                'id' => NotificationHelper::generateRandomString(),
                'status' => $data['status'] != null ? $data['status'] : "new",
                'image' => $data['image'] != null ? $data['image'] : "normal",
                'notifiable_id' => $userTarget->id,
                'formated_created_at' => date("Y-m-d H:i:s"),
                'formated_updated_at' => date("Y-m-d H:i:s"),
            ],
        ];
        $fields = json_encode($fields);
        $client = new Client();

        $guzzleResponse = $client->post("https://fcm.googleapis.com/fcm/send", [
            'headers' => $headers,
            "body" => $fields,
        ]);

        if ($guzzleResponse->getStatusCode() == 200) {
            return $guzzleResponse->getBody();
        } else {
            return null;
        }
    }

    public static function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}