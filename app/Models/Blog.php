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
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    //新着投稿のページネイション
    public function getPaginatedArticles(int $limit_count = 4)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
