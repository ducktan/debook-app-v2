<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration', 'duration_unit'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_subscriptions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_subscriptions')
                    ->withPivot(['start_date', 'end_date', 'status'])
                    ->withTimestamps();
    }
}