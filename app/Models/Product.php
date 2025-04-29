<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'format',
        'rating',
        'category_id',
        'sales_count'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:1'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor để lấy URL ảnh
    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : asset('images/default-product.jpg');
    }

    // Phương thức scope để filter
    public function scopePriceRange($query, $range)
    {
        return match ($range) {
            'under_50k' => $query->where('price', '<', 50000),
            '50k_100k' => $query->whereBetween('price', [50000, 100000]),
            'over_100k' => $query->where('price', '>', 100000),
            default => $query,
        };
    }

    public function scopeWithFormat($query, $formats)
    {
        if (!empty($formats)) {
            return $query->whereIn('format', (array)$formats);
        }
        return $query;
    }

    public function scopeMinRating($query, $rating)
    {
        if ($rating) {
            return $query->where('rating', '>=', $rating);
        }
        return $query;
    }

    // Quan hệ với reviews (chỉ khai báo một lần)
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }
}