<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/save-account-type', [AdminController::class, 'saveAccountType'])->name('saveAccountType');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::delete('/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/account-update', [ProfileController::class, 'accountUpdate'])->name('profile.accountUpdate');
    Route::patch('/profile-update', [ProfileController::class, 'profileUpdate'])->name('profile.profileUpdate');
});

Route::group([
    'as' => 'chat.',
    'prefix' => 'chat'
], function () {
    Route::get('messages', [ChatController::class, 'messages'])->name('messages');
});

require __DIR__.'/auth.php';
