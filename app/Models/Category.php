<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getByCategory(int $limit_count = 5)
    {
        return $this->blogs()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    public function getFeaturedArticles(int $limit_count = 3)
    {
        return $this->blogs()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function getPaginatedArticles(int $limit_count = 4)
    {
        return $this->blogs()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    

}
