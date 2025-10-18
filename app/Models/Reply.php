<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'content',
        'likes_count',
    ];

    // Reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Reply belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Parent reply (for nested replies)
    public function parent()
    {
        return $this->belongsTo(Reply::class, 'parent_id');
    }

    // Child replies (nested replies)
    public function replies()
    {
        return $this->hasMany(Reply::class, 'parent_id')->with('user', 'replies')->latest();
    }
}
