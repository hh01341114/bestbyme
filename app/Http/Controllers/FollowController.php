<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, Blog $blog)
    {
        $currentUser = auth()->user();

        if (!$currentUser->followings()->where('followed_id', $blog->id)->exists()) {
            $currentUser->followings()->attach($blog->id);
        }

        return back()->with('success', 'フォローしました！');
    }

    public function unfollow(Request $request, Blog $blog)
    {
        $currentUser = auth()->user();

        if ($currentUser->followings()->where('followed_id', $blog->id)->exists()) {
            $currentUser->followings()->detach($blog->id);
        }

        return back()->with('success', 'フォローを解除しました！');
    }
}
