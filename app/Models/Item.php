<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',     // 購入品の名前
        'image',    // 購入品の画像パス
        'blog_id',  // Blogモデルとのリレーションの外部キー
        'price',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

}
