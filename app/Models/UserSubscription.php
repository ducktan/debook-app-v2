<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    // Định nghĩa bảng tương ứng
    protected $table = 'user_subscriptions';

    // Các cột có thể được mass-assignable
    protected $fillable = [
        'user_id',
        'subscription_id',
        'start_date',
        'end_date',
        'status',  // Thêm cột status vào $fillable
    ];

    // Nếu bạn muốn tự động chuyển giá trị `status` thành dạng enum (active, expired, cancelled)
    protected $casts = [
        'status' => 'string',  // Cột status sẽ được cast thành string
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class); // Mối quan hệ với Subscription
    }


    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

}
