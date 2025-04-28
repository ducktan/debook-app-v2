<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




//


use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'productId');
    }

public function process(Request $request)
{
    // Lấy thông tin gói đăng ký từ ID (bạn có thể kiểm tra và xử lý nếu không tìm thấy gói)
    $subscription = Subscription::find($request->subscription_id);

    // Kiểm tra nếu gói đăng ký không tồn tại
    if (!$subscription) {
        return redirect()->route('home')->with('error', 'Gói đăng ký không tồn tại');
    }

    // Lấy người dùng hiện tại
    $user = Auth::user();

    // Tính toán ngày bắt đầu và ngày kết thúc
    $startDate = Carbon::now();
    $endDate = $startDate->copy()->add($subscription->duration, $subscription->durationUnit);

    // Lưu thông tin vào bảng user_subscriptions
    UserSubscription::create([
        'user_id' => $user->id,  // ID của người dùng đăng nhập
        'subscription_id' => $subscription->id,  // ID của gói đăng ký
        'start_date' => $startDate->toDateString(),
        'end_date' => $endDate->toDateString(),
        'status' => 'active',  // Gán status là 'active' khi người dùng mới đăng ký
    ]);

    // Sau khi thanh toán thành công, sử dụng session flash để hiển thị thông báo
    session()->flash('success', 'Đã đăng ký gói hội viên thành công!');

    // Chuyển hướng về trang chủ
    return redirect()->route('home');
}
}



