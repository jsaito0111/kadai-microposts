<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Auth;

class MessageController extends Controller
{
    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $messages = Message::where(function($query) use ($userId){
                               $query->where('sender_id', auth()->id())
                                     ->where('receiver_id', $userId);
                           })->orWhere(function($query) use ($userId){
                               $query->where('sender_id', $userId)
                                     ->where('receiver_id', auth()->id());
                           })->get();

        return view('messages.index', compact('user', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = new Message;
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        return redirect()->route('messages.index');
    }
    
    public function send(Request $request, $userId)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $receiver = User::findOrFail($userId);

        $message = new Message;
        $message->sender_id = auth()->id();
        $message->receiver_id = $receiver->id;
        $message->message = $request->message;
        $message->save();

        return redirect()->route('messages.index', ['userId' => $userId])
                         ->with('success', 'Message sent successfully.');
    }
}
