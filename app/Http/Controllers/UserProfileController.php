<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show($id)
    {
        $user = User::with(['blogs' => function ($query) {
            $query->latest()->limit(3);
        }, 'followers', 'followings'])->findOrFail($id);

        return view('blogs.profile', compact('user'));
    }
}
