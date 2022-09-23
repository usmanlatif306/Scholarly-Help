<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function storeMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => $request->user_id,
            'receiver_id' => $request->receiver_id,
            'type' => $request->type,
            'message' => $request->message,
            'file_name' => $request->file_name,
            'status' => false,
            'message_type' => 'api',
            'api_user_id' => $request->api_user_id
        ]);

        return response()->json([
            'error' => false,
            'message' => 'message created'
        ]);
    }
}
