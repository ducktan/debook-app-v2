<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;




use Illuminate\Http\Request;

class AdminController extends Controller
{
    //// User
    public function index()
    {
        return view('pages.admin.dashboard');
    }
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('pages.admin.userSetting', compact('users'));
    }

    public function search(Request $request)
    {
        $query = User::query();

        if ($request->has('q') && $request->q) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('full_name', 'like', "%$search%");
            });
        }

        $users = $query->take(20)->get(); // lấy tối đa 20 kết quả

        return response()->json($users);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'utype' => 'required|in:ADM,USR,VIP',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'utype' => $request->utype,
        ]);

        return response()->json(['message' => 'Người dùng đã được thêm thành công!']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Xoá người dùng thành công.']);
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Cập nhật thông tin cơ bản
        $user->name = $request->name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->utype = $request->utype;

        // Nếu có upload avatar
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

        $user->save();

        return redirect()->route('admin.users.show')->with('success', 'Cập nhật thông tin người dùng thành công!');
    }




    // CATEGORY
    public function categories()
    {
        $cateItem = Category::latest()->paginate(10);
        return view('pages.admin.categoryAdmin', compact('cateItem'));
    }

    public function storeCategory(Request $request)
    {
       

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('images/categories', $imageName, 'public');
        }

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?? Str::slug($request->name),
            'description' => $request->description,
            'image_url' => $imageName,
        ]);

        return response()->json(['message' => 'Danh mục đã được thêm thành công!']);
    }

    public function destroyCate ($id)
    {
        $category = Category::findOrFail($id);

        // Nếu có ảnh thì xoá luôn ảnh (nếu cần)
        if ($category->image_url) {
            Storage::disk('public')->delete('images/categories/' . $category->image_url);
        }

        $category->delete();

        return response()->json(['message' => 'Đã xoá danh mục thành công!']);
    }

    public function updateCate(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            // Xoá ảnh cũ nếu có
            if ($category->image_url && Storage::disk('public')->exists('images/categories/' . $category->image_url)) {
                Storage::disk('public')->delete('images/categories/' . $category->image_url);
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('images/categories', $imageName, 'public');

            $category->image_url = $imageName;
        }


        $category->save();

        return response()->json(['success' => true]);
    }

    // CHƯA LÀM SEARCH

    // PRODUCT
    public function showProducts()
    {
        $proItems = Product::latest()->paginate(10);
        return view('pages.admin.productSetting', compact('proItems'));
    }




    // COMMENT 




    // BLOG



    // ORDER 




}
