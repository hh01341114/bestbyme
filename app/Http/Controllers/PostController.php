<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
 * Post一覧を表示する
 * 
 * @param Blog $blog 
 * @return array
 */
// PostController.php
    public function index(Blog $blog)
    {
        $featuredArticles = $blog->getFeaturedArticles();
        $paginatedArticles = $blog->getPaginatedArticles();

        return view('users.user', [
            'featuredArticles' => $featuredArticles,
            'paginatedArticles' => $paginatedArticles
        ]);
    }
}
