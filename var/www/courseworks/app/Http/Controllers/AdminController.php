<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.dashboard');
    }

    public function settings(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.settings');
    }

    public function saveAccountType(Request $request): JsonResponse
    {
        Auth::user()->update($request->all());

        return response()->json(['status' => 'OK']);
    }
}
