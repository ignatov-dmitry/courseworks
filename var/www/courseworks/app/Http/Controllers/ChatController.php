<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function createThread(Request $request)
    {
        $receiverId = $request->get('receiver_id');
        $thread = Thread::select(['uuid'])
            ->where(function (Builder $builder) use ($receiverId) {
                $builder
                    ->where('sender_id', '=', Auth::user()->id)
                    ->where('receiver_id', '=', $receiverId);
            })
            ->orWhere(function (Builder $builder) use ($receiverId) {
                $builder
                    ->where('sender_id', '=', $receiverId)
                    ->where('receiver_id', '=', Auth::user()->id);
            })->first();

        if (is_null($thread))
            $threadUuid =  response()->json([
                Thread::create([
                    'sender_id'     => Auth::user()->id,
                    'receiver_id'   => $receiverId,
                    'created_at'    => Carbon::now()
                ])->uuid
            ]);

        else
            $threadUuid = $thread->uuid;

        return redirect()->route('chat.getThread', ['threadId' => $threadUuid]);
    }

    public function getThread(string $threadId): JsonResponse
    {
        $thread = Thread::whereUuid($threadId)->first();
        return response()->json([$thread]);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $message = Message::create([
            'thread_id'     => $request->get('thread_id'),
            'sender_id'     => Auth::user()->id,
            'content'       => $request->get('content'),
            'created_at'    => Carbon::now()
        ]);

        return response()->json([$message]);
    }
    public function messages()
    {
        return view('chat.messages');
    }

    public function store(Request $request): JsonResponse
    {

        return response()->json([
            'status' => 'success',
            'message' => ''
        ]);
    }

    public function fetchMessages()
    {

    }
}
