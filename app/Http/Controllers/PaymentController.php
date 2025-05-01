<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\UserSubscription;  // Thêm model UserSubscription
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class PaymentController extends Controller
{
    

    public function show($id)
    {
       // Lấy gói đăng ký từ id
       $subscription = Subscription::find($id);

       // Kiểm tra nếu gói đăng ký tồn tại
       if (!$subscription) {
           return redirect()->route('home')->with('error', 'Gói đăng ký không tồn tại');
       }

       // Lấy thông tin người dùng (người đang đăng nhập)
       $user = Auth::user();

       // Kiểm tra xem người dùng đã đăng ký gói này trước đó hay chưa
       $existingSubscription = UserSubscription::where('user_id', $user->id)
           ->where('subscription_id', $subscription->id)
           ->where('status', 'active') // Kiểm tra chỉ gói đang hoạt động
           ->first();

       if ($existingSubscription) {
           // Nếu người dùng đã có gói đăng ký, lấy ngày kết thúc gói cũ
           $startDate = Carbon::parse($existingSubscription->end_date)->addDay(); // Ngày bắt đầu mới là ngày kết thúc + 1
       } else {
           // Nếu người dùng chưa có gói đăng ký, ngày bắt đầu là ngày hiện tại
           $startDate = Carbon::now();
       }

       // Ngày kết thúc của gói (theo độ dài gói đăng ký)
       $endDate = $startDate->copy()->add($subscription->duration, $subscription->duration_unit);

       return view('pages.payment', compact('subscription', 'user', 'startDate', 'endDate'));
    }
    

    public function process(Request $request)
    {
        // Lấy thông tin gói đăng ký từ form
        $subscription = Subscription::find($request->subscription_id);

        // Kiểm tra nếu gói đăng ký tồn tại
        if (!$subscription) {
            return redirect()->route('home')->with('error', 'Gói đăng ký không tồn tại');
        }

        // Lấy thông tin người dùng
        $user = Auth::user();

        // Kiểm tra xem người dùng đã có gói đăng ký chưa
        $existingSubscription = UserSubscription::where('user_id', $user->id)
            ->where('subscription_id', $subscription->id)
            ->where('status', 'active') // Kiểm tra chỉ gói đang hoạt động
            ->first();

        if ($existingSubscription) {
            // Nếu người dùng đã có gói đăng ký, lấy ngày kết thúc gói cũ
            $startDate = Carbon::parse($existingSubscription->end_date)->addDay(); // Ngày bắt đầu mới là ngày kết thúc + 1
        } else {
            // Nếu người dùng chưa có gói đăng ký, ngày bắt đầu là ngày hiện tại
            $startDate = Carbon::now();
        }

        // Ngày kết thúc gói mới
        $endDate = $startDate->copy()->add($subscription->duration, $subscription->duration_unit);

        // Lưu thông tin thanh toán vào bảng user_subscriptions
        $userSubscription = UserSubscription::create([
            'user_id' => $user->id,               // ID người dùng
            'subscription_id' => $subscription->id, // ID gói đăng ký
            'start_date' => $startDate,            // Ngày bắt đầu
            'end_date' => $endDate,                // Ngày hết hạn
            'status' => 'active',                  // Trạng thái gói (active khi thanh toán thành công)
        ]);

        // Thêm thông báo thành công
        session()->flash('success', 'Đã đăng ký gói hội viên thành công!');

        // Xử lý thanh toán ở đây (ví dụ: tích hợp với cổng thanh toán)

        // Nếu thanh toán thành công, chuyển hướng người dùng tới trang cảm ơn
        return redirect()->route('index')->with('success', 'Thanh toán thành công!');
    }


}



