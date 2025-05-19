<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeSubscriberMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SubscribeRequest;
use App\Models\Comment;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\ProductSubscription;
use App\Models\UserSubscription;
use App\Models\Order;
use App\Models\OrderItem;


class SubscriptionController extends Controller
{
    //
    public function confirm($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('pages.user.subConfirm', compact('subscription'));
    }

    public function pay(Request $request)
    {
        $subscription = Subscription::findOrFail($request->subscription_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'codeVNPAY' => 'DEB' . strtoupper(uniqid()),
            'status' => 'pending',
            'total' => $subscription->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $subscription->id,
            'price' => $subscription->price,
            'quantity' => 1,
        ]);

        // B2: Tạo link thanh toán VNPay
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('subscription.vnpay_return');
        $vnp_TmnCode = "6ZG2SBOC";
        $vnp_HashSecret = "00QVD3MCW74MU0EPKX3YBZ3UR3EX7L2W";

        $vnp_TxnRef = $order->codeVNPAY;
        $vnp_OrderInfo = "Thanh toan goi hoi vien: " . $subscription->name;
        $vnp_Amount = $subscription->price * 100; // nhân 100 theo đơn vị VND
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_BankCode = 'NCB';

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => now()->format('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = [];
        $hashdata = '';
        foreach ($inputData as $key => $value) {
            $query[] = urlencode($key) . "=" . urlencode($value);
            $hashdata .= ($hashdata ? '&' : '') . urlencode($key) . "=" . urlencode($value);
        }

        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= '?' . implode('&', $query) . '&vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url);


    }

    public function vnpayReturn(Request $request)
    {
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TransactionStatus = $request->input('vnp_TransactionStatus');

        $order = Order::with('items')->where('codeVNPAY', $vnp_TxnRef)->first();

        if (!$order) {
            return redirect()->route('index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        if ($vnp_ResponseCode === '00' && $vnp_TransactionStatus === '00') {
            $order->status = 'completed';
            $order->save();

            $item = $order->items->first(); // Mỗi order chỉ có 1 subscription
            if ($item && $order->user_id) {
                $subscriptionId = $item->product_id;
                $subscription = \App\Models\Subscription::find($subscriptionId);

                if ($subscription) {
                    $startDate = Carbon::now();
                    $endDate = match ($subscription->duration_unit) {
                        'days' => $startDate->copy()->addDays($subscription->duration),
                        'months' => $startDate->copy()->addMonths($subscription->duration),
                        'years' => $startDate->copy()->addYears($subscription->duration),
                    };

                    UserSubscription::create([
                        'user_id' => $order->user_id,
                        'subscription_id' => $subscription->id,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'status' => 'active',
                    ]);
                    \App\Models\User::where('id', $order->user_id)->update(['utype' => 'VIP']);

                }
            }

            return redirect()->route('index')->with('message', 'Thanh toán thành công! Bạn đã trở thành hội viên.');
        } else {
            $order->status = 'failed';
            $order->save();

            return redirect()->route('index')->with('error', 'Thanh toán thất bại.');
        }
    }
}
