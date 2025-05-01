<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class AdminController extends Controller
{
    ////
    public function index()
    {
        return view('pages.admin.dashboard');
    }
    public function User(Request $request)
    {
        $query = User::query();

        // Tìm kiếm theo từ khóa
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                ->orWhere('full_name', 'like', "%$keyword%");
            });
        }

        // Lọc theo loại tài khoản
        if ($request->has('utype') && in_array($request->utype, ['ADM', 'USR'])) {
            $query->where('utype', $request->utype);
        }

        $users = $query->orderBy('id', 'DESC')->paginate(10);
        return view('pages.admin.userSetting', compact('users'));
    }


    public function add_User()
    {
        return view('pages.admin.userAdd');
    } 

    public function user_Store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'utype' => 'required|in:ADM,USR',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|string|max:20',
            'full_name' => 'nullable|string|max:255',
        ]);

        try {
            // Tạo user mới
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->utype = $validated['utype'];
            $user->password = Hash::make(Str::random(12)); // Tạo password ngẫu nhiên 12 ký tự
            
            // Các trường không bắt buộc
            if ($request->filled('phone')) {
                $user->phone = $validated['phone'];
            }
            
            if ($request->filled('full_name')) {
                $user->full_name = $validated['full_name'];
            }

            // Xử lý upload avatar
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $filename = time() . '_' . Str::slug($user->name) . '.' . $avatar->getClientOriginalExtension();
                
                // Lưu ảnh với Intervention Image
                $image = Image::make($avatar)->fit(200, 200);
                $image->save(public_path('uploads/avatars/' . $filename));
                
                $user->avatar = 'uploads/avatars/' . $filename;
            }

            $user->save();

            return redirect()
                ->route('admin.userSetting')
                ->with('success', 'Thêm người dùng thành công! Mật khẩu tạm thời đã được tạo tự động.');
        }
        catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function user_edit($id)
    {
        $user = User::findOrFail($id);
    return view('pages.admin.userEdit', compact('user'));
    }
    public function user_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'utype' => 'required|in:ADM,USR',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|string|max:20',
            'full_name' => 'nullable|string|max:255',
        ]);
        try {
        
            $user = User::findOrFail($id);
            if (!$user) {
                return redirect()->back()->with('error', 'Người dùng không tồn tại.');
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->utype = $request->utype;
            $user->password = Hash::make(Str::random(12)); // Tạo password ngẫu nhiên 12 ký tự
            
            // Các trường không bắt buộc
            if ($request->filled('phone')) {
                $user->phone = $request->phone;
            }
            
            if ($request->filled('full_name')) {
                $user->full_name = $request->full_name;
            }

            // Xử lý upload avatar
            if ($request->hasFile('avatar')) {
                if (File::exists(public_path($user->avatar))) {
                    File::delete(public_path($user->avatar));
                }
                
                $avatar = $request->file('avatar');
                $filename = time() . '_' . Str::slug($user->name) . '.' . $avatar->getClientOriginalExtension();
                
                // Lưu ảnh với Intervention Image
                $image = Image::make($avatar)->fit(200, 200);
                $image->save(public_path('uploads/avatars/' . $filename));
                
                $user->avatar = 'uploads/avatars/' . $filename;
            }

            $user->save();

            return redirect()->route('admin.userSetting')->with('success', 'Cập nhật thành công!');
        }
        catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function user_delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return back()->with('error', 'Người dùng không tồn tại.');
        }

        // Xóa avatar nếu có
        if ($user->avatar && File::exists(public_path($user->avatar))) {
            File::delete(public_path($user->avatar));
        }

        $user->delete();

        return redirect()->route('admin.userSetting')->with('success', 'Xóa người dùng thành công.');
    }

    public function products(Request $request)
    {
        $query = Product::with('category');

        // Lọc theo từ khóa
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%$keyword%")
                  ->orWhere('author', 'like', "%$keyword%")
                  ->orWhere('description', 'like', "%$keyword%");
            });
        }

        // Lọc theo loại sản phẩm
        if ($request->has('type') && in_array($request->type, ['ebook', 'podcast'])) {
            $query->where('type', $request->type);
        }

        // Lọc theo danh mục
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->orderBy('created_at', 'DESC')->paginate(10);
        $categories = Category::all();

        return view('pages.admin.productSetting', compact('products', 'categories'));
    }

    public function product_create()
    {
        $categories = Category::all();
        return view('pages.admin.products.create', compact('categories'));
    }

    public function product_store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'type' => 'required|in:ebook,podcast',
            'category_id' => 'nullable|exists:categories,id',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'file' => 'nullable|file|mimes:pdf,mp3,epub|max:10240', // 10MB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer|min:0',
            'language' => 'nullable|string|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        try {
            $product = new Product();
            $product->fill($validated);

            // Xử lý upload file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug($product->title) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('products/files', $fileName, 'public');
                $product->file_url = $filePath;
            }

            // Xử lý upload ảnh
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $fileName = time() . '_' . Str::slug($product->title) . '.' . $image->getClientOriginalExtension();
                
                // Lưu ảnh với Intervention Image
                $image = Image::make($image)->fit(400, 400);
                $image->save(public_path('uploads/products/' . $fileName));
                
                $product->image_url = 'uploads/products/' . $fileName;
            }

            $product->save();

            return redirect()->route('admin.products')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function product_edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('pages.admin.products.edit', compact('product', 'categories'));
    }

    public function product_update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'type' => 'required|in:ebook,podcast',
            'category_id' => 'nullable|exists:categories,id',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'file' => 'nullable|file|mimes:pdf,mp3,epub|max:10240',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer|min:0',
            'language' => 'nullable|string|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->fill($validated);

            // Xử lý file mới
            if ($request->hasFile('file')) {
                // Xóa file cũ nếu có
                if ($product->file_url) {
                    Storage::disk('public')->delete($product->file_url);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug($product->title) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('products/files', $fileName, 'public');
                $product->file_url = $filePath;
            }

            // Xử lý ảnh mới
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ nếu có
                if ($product->image_url && File::exists(public_path($product->image_url))) {
                    File::delete(public_path($product->image_url));
                }

                $image = $request->file('image');
                $fileName = time() . '_' . Str::slug($product->title) . '.' . $image->getClientOriginalExtension();
                
                $image = Image::make($image)->fit(400, 400);
                $image->save(public_path('uploads/products/' . $fileName));
                
                $product->image_url = 'uploads/products/' . $fileName;
            }

            $product->save();

            return redirect()->route('admin.products')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function product_delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return back()->with('error', 'Sản phẩm không tồn tại.');
        }

        // Xóa file
        if ($product->file_url) {
            Storage::disk('public')->delete($product->file_url);
        }

        // Xóa ảnh
        if ($product->image_url && File::exists(public_path($product->image_url))) {
            File::delete(public_path($product->image_url));
        }

        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Xóa sản phẩm thành công.');
    }
}
