<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Post;
use Session;

class MessagesController extends Controller
{
    public function messages() {
        $messages = message::where('user_id', "=", Auth::user()->id)
                           ->orderBy('id', 'desc')
                           ->paginate(10);
        $posts = post::where('user_id', '=', Auth::user()->id)->get();
        $userUnreadNotifications = auth()->user()->unreadNotifications;
        foreach($userUnreadNotifications as $userUnreadNotification) {
            $userUnreadNotification->markAsRead();
        }
        return view('user.messages')->with('messages', $messages);
    }
}
