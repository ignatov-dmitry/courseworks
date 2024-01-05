<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
}
