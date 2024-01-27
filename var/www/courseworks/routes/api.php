<?php

use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('messages', function (Request $request) {

});

Route::middleware('auth:sanctum')->get('threads', [ChatController::class, 'getThread']);
Route::middleware('auth:sanctum')->post('send-message', [ChatController::class, 'sendMessage']);
