<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\UserTyping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Http\Response;


class ChatsController extends Controller
{
    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('chat');
    }


    public function fetchMessages()
    {
        return response(Message::with('user')->get(), 200);
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = auth()->user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        broadcast(new MessageSent($user, $message))->toOthers();

        return response(['status' => 'Message Sent!'], 200);
    }
    public function userTyping(Request $request)
    {
        broadcast(new UserTyping(User::find($request->input('user')['id'])))->toOthers();

        return response(200);
    }


}