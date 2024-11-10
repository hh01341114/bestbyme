<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //テスト用
    protected $fillable = ['user_id', 'category_id', 'title', 'body'];
    //

    //特集ページのページネイション
    public function getFeaturedArticles(int $limit_count = 3)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    //新着投稿のページネイション
    public function getPaginatedArticles(int $limit_count = 4)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
