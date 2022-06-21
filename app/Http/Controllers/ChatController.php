<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // dd($users[2]->user->first_name);
        // dd($user->id);
        return view('writer.chat');
    }

    public function getMessages()
    {
        $user = Auth::user();
        $messages = Message::with('user:id,first_name,last_name,photo')->where('user_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        // $messages = Message::distinct()->where('user_id', $user->id)
        //     ->get();
        $users = [];
        foreach ($messages->unique('user_id') as $item) {
            if ($item->user_id !== $user->id) {
                $users[] = $item->user;
            }
        }

        return response()->json([
            'users' => $users,
            'messages' => MessageResource::collection($messages)
        ]);
    }

    // fetching user unread messages for notifications
    public function UserReadMessages()
    {
        $messages = Message::query()->where('receiver_id', auth()->id())->where('status', false)->count();
        // dd($messages);
        return response([
            'error' => false,
            'message' => $messages
        ]);
    }
}
