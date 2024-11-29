<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id',
        'followed_id',
        'following_id',
    ];

    //特集ページのページネイション
    public function getPaginatedWithCategory(int $limit_count = 3)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }    

    // itemに対するリレーション
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    //いいねの関連付け
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes', 'blog_id', 'user_id');
    }

    //フォローとフォロワーの関連付け
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'followed_id', 'following_id');
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
