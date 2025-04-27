<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'author', 'type', 'category_id',
        'publication_date', 'price', 'file_url', 'image_url',
        'duration', 'language', 'rating'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

