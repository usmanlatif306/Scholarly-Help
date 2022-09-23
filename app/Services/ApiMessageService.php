<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Http;


class ApiMessageService
{
    // sending message to api
    public function sendMessage($message, $last_message)
    {
        $url = env('API_URL') . 'message/create';
        $response = Http::post($url, [
            'user_id' => $message->user_id,
            'receiver_id' => $last_message->api_user_id,
            'type' => $message->type,
            'message' => $message->message,
            'file_name' => $message->file_name,
            'status' => false,
        ]);

        $response = $response->json();
        if ($response['error']) {
            return false;
        }
        return true;
    }
}
