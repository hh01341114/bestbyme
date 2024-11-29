<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class UserProfileController extends Controller
{
    public function showProfile($id)
    {
        $user = User::with(['blogs.items', 'followers', 'followings'])
        ->findOrFail($id);

        return view('blogs.profile', compact('user'));
    }

}
