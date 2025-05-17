<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    public function subscriptions()
    {
        return $this->belongsToMany(Subscription::class, 'user_subscriptions')
                    ->withPivot(['start_date', 'end_date', 'status'])
                    ->withTimestamps();
    }
}
