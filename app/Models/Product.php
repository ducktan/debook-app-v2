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
    protected $casts = [
    'publication_date' => 'date',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function buyers()
    {
        return $this->belongsToMany(User::class, 'user_products');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    

    
}

