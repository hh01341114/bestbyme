<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, User $user)
    {
        $currentUser = auth()->user();

        if (!$currentUser->followings()->where('followed_id', $user->id)->exists()) {
            $currentUser->followings()->attach($user->id);
        }

        return back();
    }

    public function unfollow(Request $request, User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->followings()->where('followed_id', $user->id)->exists()) {
            $currentUser->followings()->detach($user->id);
        }

        return back();
    }
}
