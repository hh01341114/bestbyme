<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ユーザーがフォローしているユーザー
    // public function following()
    // {
    //     return $this->belongsToMany(User::class, 'followers', 'following_id', 'followed_id');
    // }

    // // ユーザーがフォローされているユーザー
    // public function followers()
    // {
    //     return $this->belongsToMany(User::class, 'followers', 'followed_id', 'following_id');
    // }
    
    //いいね機能
    public function likedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'likes', 'user_id', 'blog_id');
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

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
