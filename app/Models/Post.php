<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'audio_url',
    ];

    // Quan hệ: Một bài viết thuộc về một người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
