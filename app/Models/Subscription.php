<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    // Định nghĩa bảng tương ứng
    protected $table = 'subscriptions';

    // Định nghĩa các cột có thể được mass assignable
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'durationUnit',
    ];

    // Nếu muốn thêm tính năng tự động cập nhật thời gian tạo và cập nhật
    public $timestamps = true;

    // Định nghĩa các cột cần kiểu dữ liệu đặc biệt
    protected $casts = [
        'price' => 'decimal:2', // đảm bảo rằng giá là kiểu số thập phân với 2 chữ số sau dấu phẩy
    ];

    public function subscriptions()
{
    return $this->hasMany(UserSubscription::class);  // Quan hệ 1-n với bảng user_subscriptions
}
}

