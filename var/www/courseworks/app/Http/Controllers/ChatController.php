<?php

namespace App\Http\Controllers;

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
    private function createThread(int $receiverId): Model|Thread
    {
        return Thread::create([
            'sender_id'     => Auth::user()->id,
            'receiver_id'   => $receiverId,
            'created_at'    => Carbon::now()
        ]);
    }

    public function getThread($user_id)
    {
        $threadUuid = Thread::select(['uuid'])
            ->where(function (Builder $builder) use ($user_id) {
                $builder
                    ->where('sender_id', '=', Auth::user()->id)
                    ->where('receiver_id', '=', $user_id);
        })
            ->orWhere(function (Builder $builder) use ($user_id) {
                $builder
                    ->where('sender_id', '=', $user_id)
                    ->where('receiver_id', '=', Auth::user()->id);
            })->first();

        if (is_null($threadUuid))
            $this->createThread($user_id);

        return view('chat.messages');
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
