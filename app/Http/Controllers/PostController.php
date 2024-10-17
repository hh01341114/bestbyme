<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
 * Post一覧を表示する
 * 
 * @param User $user 
 * @return array
 */
    public function index(User $user)
    {
        $users = $user->get();
        return view('users', ['users' => $users]);
    }
}
