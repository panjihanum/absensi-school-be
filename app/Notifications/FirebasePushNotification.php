<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class FirebasePushNotification extends Notification
{
    use Queueable;

    protected $title;
    protected $body;
    protected $fcmId;
    protected $data;
    protected $firebaseUrl;

    public function __construct()
    {
        $this->firebaseUrl = base_path() . env('FIREBASE_CREDENTIALS');
    }

    public function setMessage($fcmId, $title, $body, $data = [])
    {
        $this->title = $title;
        $this->body = $body;
        $this->fcmId = $fcmId;
        $this->data = $data;
    }

    public function via()
    {
        return ['firebase'];
    }

    public function sendMessage()
    {
        $firebase = (new Factory)
            ->withServiceAccount($this->firebaseUrl);

        $messaging = $firebase->createMessaging();

        $notification = FirebaseNotification::fromArray([
            'title' => $this->title,
            'body' => $this->body,
            // 'image' => $imageUrl,
        ]);

        $message = CloudMessage::fromArray([
            'token' => $this->fcmId,
            'notification' => $notification, // optional
            'data' => $this->data, // optional
        ]);

        try {
            $response = $messaging->send($message);

            Log::info('Notification sent successfully:', $response);

            return $response;
        } catch (\Throwable $e) {
            Log::error('Error sending notification:', ['error' => $e->getMessage()]);
        }
    }
}
