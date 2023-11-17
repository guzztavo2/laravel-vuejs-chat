<?php

namespace App\Http\Controllers;

use App\Events\UserOnline;
use App\Models\User;
use Illuminate\Http\Request;

class UserOnlineController extends Controller
{
    public function index(User $user)
    {
        $user->status = 'online';
        $user->save();

        broadcast(new UserOnline($user));
    }
}