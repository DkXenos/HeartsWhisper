<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image',
        'likes_count'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    // Post has many replies
    public function replies()
    {
        return $this->hasMany(Reply::class)
        ->whereNull('parent_id')
        ->with('user', 'replies')->latest();
    }

    // Get total replies count (including nested)
    public function totalRepliesCount()
    {
        return $this->replies()->count() + $this->replies()->withCount('replies')->get()->sum('replies_count');
    }
}
