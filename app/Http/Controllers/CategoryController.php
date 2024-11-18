<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(Category $category)
    {
        // 必要なデータを取得
        $featuredArticles = $category->getFeaturedArticles();
        $paginatedArticles = $category->getPaginatedArticles();
    
        // ビューにデータを渡す
        return view('categories.index', [
            'featuredArticles' => $featuredArticles,
            'paginatedArticles' => $paginatedArticles,
        ]);
    }

}
