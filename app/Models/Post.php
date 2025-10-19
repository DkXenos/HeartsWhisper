<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
