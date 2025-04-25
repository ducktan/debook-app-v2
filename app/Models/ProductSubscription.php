<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSubscription extends Model
{
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'product_subscriptions');
    }

}
