<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class LikeController extends Controller
{
    // いいねをする関数
    public function like(Request $request, Blog $blog)
    {
        $blog_id = $blog->id;
        $user = auth()->user();

        if (!$user->likedBlogs()->where('blog_id', $blog_id)->exists()) {
            $user->likedBlogs()->attach($blog_id);
        }

        return redirect()->route('blogs.show', ['blog' => $blog_id]);
    }

    // いいねを解除する関数
    public function unlike(Request $request, Blog $blog)
    {
        $blog_id = $blog->id;
        $user = auth()->user();

        if ($user->likedBlogs()->where('blog_id', $blog_id)->exists()) {
            $user->likedBlogs()->detach($blog_id);
        }

        return redirect()->route('blogs.show', ['blog' => $blog_id]);
    }
}
