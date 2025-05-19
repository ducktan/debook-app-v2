<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSubscription;
use App\Models\Subscription;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    //
    public function index()
    {
   
        $categories = Category::all();
        $ebooks = Product::where('type', 'ebook')->latest()->take(6)->get();
        $podcasts = Product::where('type', 'podcast')->latest()->take(6)->get();

        return view('pages.user.user', compact('ebooks', 'podcasts','categories'));
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
            // Xóa avatar cũ nếu có
            if ($user->avatar && Storage::disk('public')->exists('images/avatar/' . $user->avatar)) {
                Storage::disk('public')->delete('images/avatar/' . $user->avatar);
            }

            // Lưu avatar mới
            $avatarName = time() . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->storeAs('images/avatar', $avatarName, 'public');

            $user->avatar = $avatarName;
        }

        // Lưu lại thông tin người dùng vào cơ sở dữ liệu
        $user->save();

        // Quay lại trang profile và thông báo thành công
        return redirect()->route('user.profile')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function myProducts()
    {
        $user = Auth::user();
        $products = $user->purchasedProducts;
        return view('pages.user.my_products', compact('products'));
    }

    // Xoá sản phẩm đã mua
    public function destroy($productId)
    {
        // Lấy người dùng hiện tại
        $user = Auth::user();
        
        // Kiểm tra xem sản phẩm có thuộc quyền sở hữu của người dùng không
        $product = $user->purchasedProducts()->find($productId);
    
        if ($product) {
            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $user->purchasedProducts()->detach($productId);
    
            // Đưa thông báo thành công và quay lại trang quản lý sản phẩm
            return redirect()->route('user.myProducts')->with('success', 'Đã xoá ấn phẩm thành công!');
        }
    
        // Nếu sản phẩm không tìm thấy hoặc không phải của người dùng, hiển thị lỗi
        return redirect()->route('user.myProducts')->with('error', 'Không thể tìm thấy ấn phẩm này!');
    }

    public function myOrders()
    {
        $orders = Order::with(['items.product']) // Eager load
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('pages.user.order', compact('orders'));
    }


    


    

   
}
