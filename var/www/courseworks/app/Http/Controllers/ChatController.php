<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Thread;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function messages(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $threads = DB::table('threads')
            ->select(
                'threads.uuid as thread_uuid',
                'threads.sender_id',
                'threads.receiver_id',
                'last_message.content',
                'last_message.read_at',
                'last_message.created_at',
                'u.name as user_name'
            )
            ->leftJoin(DB::raw('LATERAL (SELECT
            m.content,
            m.read_at,
            m.created_at
        FROM
            messages m
        WHERE
            m.thread_id = threads.uuid
        ORDER BY
            m.id DESC
        LIMIT 1) AS last_message ON TRUE'), function (){})
            ->leftJoin('users as u', function (JoinClause $join) {
                $join
                    ->on(function (JoinClause $clause) {
                        $clause->whereRaw('u.id in (threads.sender_id, threads.receiver_id)');
                    })
                    ->where('u.id', '!=', 10);
            })
            ->where('threads.sender_id', 10)
            ->orWhere('threads.receiver_id', 10)
            ->orderByRaw('last_message.created_at desc NULLS LAST')
            ->get();

        return view('chat.messages', compact('threads'));
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
