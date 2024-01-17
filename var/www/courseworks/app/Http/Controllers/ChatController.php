<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function messages()
    {
        Chat::with('user')->get();
        return view('chat.messages');
    }

    public function store(Request $request): JsonResponse
    {
        $message = Chat::create($request->merge(['sender_id' => Auth::user()->id])->all());

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }

    public function fetchMessages(): Collection|array
    {
        return Chat::with('user')->get();
    }
}
