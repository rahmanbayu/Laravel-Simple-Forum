<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function notifications()
    {
        // memberi tanda readed pada unreaded notification
        Auth::user()->unreadNotifications->markAsRead();
        // Display nitif all
        return view('users.notification', ['notifications' => Auth::user()->notifications()->paginate(5)]);
    }
}
