<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
// Thiết lập múi giờ GMT+7
date_default_timezone_set('Asia/Ho_Chi_Minh');

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = (int) $request->input('quantity', 1);
        

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
                'image_url' => $product->image_url,
                'author' => $product->author,
                'description' => $product->description,
                'category' => $product->category_id,
            ];
        }

      

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }


    public function index()
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Tính tổng tiền giỏ hàng
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity']; // Giả sử mỗi sản phẩm có key 'price' và 'quantity'
        }

        // Trả về view và truyền cả giỏ hàng và tổng tiền
        return view('pages.cart', compact('cart', 'totalPrice'));
    }

  
    

    public function updateQuantity(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        
        // Kiểm tra nếu sản phẩm tồn tại trong giỏ hàng
        if (isset($cart[$productId])) {
            // Lấy số lượng mới từ request
            $newQuantity = (int) $request->input('quantity');

            // Kiểm tra nếu số lượng hợp lệ (lớn hơn 0)
            if ($newQuantity > 0) {
                $cart[$productId]['quantity'] = $newQuantity;  // Cập nhật số lượng
            } else {
                // Nếu số lượng không hợp lệ, xóa sản phẩm khỏi giỏ
                unset($cart[$productId]);
            }

            // Cập nhật lại giỏ hàng vào session
            session()->put('cart', $cart);
        }

        // Tính lại tổng tiền của giỏ hàng
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Trả về tổng tiền sau khi cập nhật
        return response()->json([
            'success' => true,
            'totalPrice' => $totalPrice,
            'message' => 'Giỏ hàng đã được cập nhật'
        ]);
    }



    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cart.index');
    }


    // --------------------------------------------
    public function payment(Request $request) {

        $data = $request->all();
        $code_cart = rand(00, 9999); 
        
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/payment/return";
        $vnp_TmnCode = "6ZG2SBOC";
        $vnp_HashSecret = "00QVD3MCW74MU0EPKX3YBZ3UR3EX7L2W";
        
        $startTime = date("YmdHis");
        $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

       
        $vnp_TxnRef = 'DEB' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $vnp_OrderInfo = "Thanh toan GD:" . $vnp_TxnRef;

        $vnp_Amount = $_POST['amount']; 
        $vnp_Locale = 'vn';        
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; 
        $vnp_BankCode = 'NCB'; // Ngân hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$expire, 
            "vnp_BankCode" => $vnp_BankCode
        );

        // Order Process
           
        $userId = Auth::check() ? Auth::id() : null;
        $cart = session()->get('cart', []);
        $order = Order::create([
            'user_id' => $userId,
            'codeVNPAY' => $vnp_TxnRef,
            'status' => 'pending',
            'total' => $vnp_Amount,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }



        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        header('Location: ' . $vnp_Url);
        die();

        
    }

    public function paymentReturn(Request $request)
    {
        // Lấy các thông tin trả về từ VNPay
        $vnp_Amount = $request->input('vnp_Amount');
        $vnp_BankCode = $request->input('vnp_BankCode');
        $vnp_OrderInfo = $request->input('vnp_OrderInfo');
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        $vnp_TxnRef = $request->input('vnp_TxnRef');
        $vnp_TransactionNo = $request->input('vnp_TransactionNo');
        $vnp_SecureHash = $request->input('vnp_SecureHash');
        $vnp_TransactionStatus = $request->input('vnp_TransactionStatus');

        // Mã bí mật (hash secret) từ VNPay
        $vnp_HashSecret = "00QVD3MCW74MU0EPKX3YBZ3UR3EX7L2W";

        

        
            // Kiểm tra mã phản hồi của VNPay
            if ($vnp_ResponseCode === '00' && $vnp_TransactionStatus === '00') {
                // Thanh toán thành công
                // Cập nhật trạng thái đơn hàng
                $order = Order::where('codeVNPAY', $vnp_TxnRef)->first();
                if ($order) {
                    // Cập nhật trạng thái đơn hàng thành công
                    $order->status = 'completed'; // Đánh dấu là đã hoàn thành
                   
                    $order->save();
                }
                session()->forget('cart');

                // Redirect đến trang thành công
                return redirect()->route('index')->with('success', 'Thanh toán thành công!');
            } else {
                // Thanh toán thất bại
                $order = Order::where('codeVNPAY', $vnp_TxnRef)->first();
                if ($order) {
                    // Cập nhật trạng thái đơn hàng thành thất bại
                    $order->status = 'failed'; // Đánh dấu là thất bại
                    $order->save();
                }
                session()->forget('cart');
                // Redirect đến trang thất bại
                return redirect()->route('index')->with('error', 'Thanh toán thất bại!');
            }
        
    }

 
    


}

/*

http://localhost:8000/?
vnp_Amount=16000000\
&vnp_BankCode=NCB
&vnp_BankTranNo=VNP14933029
&vnp_CardType=ATM
&vnp_OrderInfo=Thanh+toan+GD%3A1509
&vnp_PayDate=20250430142706
&vnp_ResponseCode=00
&vnp_TmnCode=6ZG2SBOC
&vnp_TransactionNo=14933029
&vnp_TransactionStatus=00
&vnp_TxnRef=1509
&vnp_SecureHash=02f11cd2bd33e30348ec133a11faf993531f2d65978eae9db889f67fe706805916ef2c080d8efd3dbf4fb376901260ccfac5927597f119126adca4d77154fa11
*/