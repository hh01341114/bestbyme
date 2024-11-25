<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function getBlogsWithPagination(int $limit_count = 5)
    {
        return $this->blogs()->with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
