<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
    {
        $user = \Auth::user();

        $user->load('tasks');

        return view('users.mypage', compact('user'));
    }
}
