<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

                // Ngày bắt đầu là ngày hiện tại
            $startDate = Carbon::now();
            
           // Lấy thông tin người dùng (người đang đăng nhập)
           $user = Auth::user();

        

            // Ngày bắt đầu và kết thúc của gói
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->add($subscription->duration, $subscription->duration_unit);

            return view('pages.payment', compact('subscription', 'user', 'startDate', 'endDate'));

    }
    public function process(Request $request)
{
    // Lấy thông tin thanh toán từ form
    $subscription = Subscription::find($request->subscription_id);

    if (!$subscription) {
        return redirect()->route('home')->with('error', 'Gói đăng ký không tồn tại');
    }

    session()->flash('success', 'Đã đăng ký gói hội viên thành công!');
    // Xử lý thanh toán ở đây (ví dụ: tích hợp với cổng thanh toán)
    // Nếu thanh toán thành công, bạn có thể chuyển hướng người dùng tới trang cảm ơn
    return redirect()->route('index')->with('success', 'Thanh toán thành công!');



  
}

}






