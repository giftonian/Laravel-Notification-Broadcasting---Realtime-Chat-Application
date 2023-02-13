<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use GuzzleHttp\Psr7\Request;
use App\Http\Controllers\ChannelController;
//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ChatController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::get('/chatroom', [ChatController::class, 'chat'])->name('chatroom');
    Route::get('/chatroom/{channel_id}', [ChatController::class, 'chatRoom'])->name('chatroom');   
    Route::post('/chat-message', [ChatController::class, 'storeMessage'])->name('chat-message');
    
    Route::resource('channels', ChannelController::class);
});



// Route::post('/chat-message' , function (\Illuminate\Http\Request $request) {    
//     event(new \App\Events\ChatMessageEvent($request->channel_id, $request->message, auth()->user())); // passing , auth()->user() to get user name in Private Channel communication
//     //broadcast(new \App\Events\ChatMessageEvent($request->message, auth()->user()));
//     return null;
//  })->middleware(['auth', 'verified']); // attaching auth middlware in case of Private channel communication, otherwise non-logged in user can send msgs



require __DIR__.'/auth.php';
