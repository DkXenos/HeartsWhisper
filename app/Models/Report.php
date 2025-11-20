<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reportable_id',
        'reportable_type',
        'reason',
        'description',
        'status',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    // Polymorphic relationship - bisa report Post atau Reply
    public function reportable()
    {
        return $this->morphTo();
    }

    // User yang melaporkan
    public function reporter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Moderator/Admin yang review
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
