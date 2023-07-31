<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function followers(User $user)
    {
        $data = $user->profile->followers;
        // dd($data);
        return view('profiles.followers', compact('data' , 'user'));
    }

    public function following(User $user)
    {
        $data = $user->following;
        // dd($data);
        return view('profiles.following', compact('data' , 'user'));
    }
}
