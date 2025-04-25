<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


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


    

   
}
