<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\PostRequest;
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

        return view('users.index', [
            'featuredArticles' => $featuredArticles,
            'paginatedArticles' => $paginatedArticles
        ]);
    }
//トップページ
    public function show(Blog $blog)
    {
        return view('users.show')->with(['blog' => $blog]);
    }
//投稿作成
    public function create()
    {
        return view('users.create');
    }
//投稿保存処理
    public function store(Blog $blog, PostRequest $request,)
    {
        $input = $request['blog'];
        $blog->fill($input)->save();

        return redirect('/blogs' . $blog->id);
    }
}