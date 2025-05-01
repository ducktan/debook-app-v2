<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\UserSubscription;
use App\Models\Subscription;
use Carbon\Carbon;



class UserController extends Controller
{
    //
    public function index()
    {
        return view('pages.user.user');
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu nhập vào
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Không được trùng email của người khác
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation cho avatar
        ]);

        // Cập nhật thông tin người dùng
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        // Xử lý thay đổi avatar nếu có
        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu tồn tại trong thư mục public/assets/img/avatars
            if ($user->avatar && file_exists(public_path('assets/img/avatars/' . $user->avatar))) {
                unlink(public_path('assets/img/avatars/' . $user->avatar)); // Xóa file cũ
            }

            // Tạo tên mới cho ảnh avatar
            $avatarName = time() . '.' . $request->file('avatar')->extension();

            // Lưu ảnh vào thư mục public/assets/img/avatars
            $request->file('avatar')->move(public_path('assets/img/avatars'), $avatarName);

            // Cập nhật đường dẫn avatar vào cơ sở dữ liệu
            $user->avatar = $avatarName;
        }

        // Lưu lại thông tin người dùng vào cơ sở dữ liệu
        $user->save();

        // Quay lại trang profile và thông báo thành công
        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công!');
    }
    //

        public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);  // Quan hệ 1-n với bảng user_subscriptions
    }
  /* public function showUserDashboard()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();  // Lấy thông tin người dùng đã đăng nhập


        // Tính toán số ngày còn lại
    $endDate = Carbon::parse($user->end_date); // Giả sử end_date là ngày hết hạn của gói
    $currentDate = Carbon::now();
    
    // Tính số ngày còn lại
    $daysRemaining = $endDate->diffInDays($currentDate);
    


        // Lấy thông tin subscription của người dùng có trạng thái 'active'
        $subscription = $user->subscriptions()->where('status', 'active')->first();

        // Truyền dữ liệu vào view
        return view('dashboard', compact('subscription', 'user','daysRemaining'));
    }
  */
        public function showUserDashboard()
{
    // Lấy thông tin người dùng hiện tại
    $user = Auth::user();  // Lấy thông tin người dùng đã đăng nhập

    // Lấy thông tin subscription của người dùng có trạng thái 'active'
    $userSubscription = $user->subscriptions()->where('status', 'active')->first();


    // Tính toán số ngày còn lại
    $endDate = Carbon::parse($userSubscription->end_date); // Giả sử end_date là ngày hết hạn của gói
    $currentDate = Carbon::now();
    
    // Tính số ngày còn lại
    $daysRemaining = $endDate->diffInDays($currentDate, false); // Thêm false để lấy số ngày âm nếu hết hạn

    // Nếu ngày còn lại là số âm, có thể là hết hạn
    if ($daysRemaining < 0) {
        $daysRemaining = 0;
    }

    
    // Truyền dữ liệu vào view
    return view('dashboard', compact('subscription', 'user', 'daysRemaining'));
}

    
   
}
