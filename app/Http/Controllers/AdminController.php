<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Support\Facades\Log;



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
        $perPage = 10;
        $proItems = Product::with(['category', 'comments'])
            ->withCount('comments')
            ->paginate($perPage);

        // Gắn rating trung bình mà không làm mất phân trang
        $proItems->getCollection()->transform(function ($product) {
            $product->average_rating = round($product->comments->avg('rating'), 1);
            return $product;
        });

        return view('pages.admin.productSetting', compact('proItems'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publication_date' => 'nullable|date',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|integer',
            'language' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'file' => 'nullable|file',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('file', 'public'); // lưu file và trả về đường dẫn
            $validated['file_url'] = basename($filePath); // chỉ lấy tên file thôi
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $validated['image_url'] = basename($imagePath); // chỉ lấy tên file
        }

        $validated['rating'] = 0;

        Product::create($validated);

        return response()->json(['message' => 'Sản phẩm đã được thêm thành công!']);

    }
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        // Xoá file nếu muốn (ảnh + file), ví dụ:
        if ($product->image_url) {
            Storage::disk('public')->delete('images/products/' . $product->image_url);
        }
        if ($product->file_url) {
            Storage::disk('public')->delete('file/' . $product->file_url);
        }

        $product->delete();

        return response()->json(['message' => 'Sản phẩm đã được xoá thành công!']);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'type' => 'required|string|in:ebook,podcast',
            'category_id' => 'required|exists:categories,id',
            'publication_date' => 'nullable|date',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|integer|min:0',
            'language' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'file' => 'nullable|file|max:10240', // max 10MB
        ]);

        // Cập nhật ảnh nếu có upload mới
        if ($request->hasFile('image')) {
            // Xoá ảnh cũ nếu có
            if ($product->image_url) {
                Storage::delete('public/images/products/' . $product->image_url);
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/products', $imageName);
            $product->image_url = $imageName;
        }

        // Cập nhật file nếu có upload mới
        if ($request->hasFile('file')) {
            if ($product->file_url) {
                Storage::delete('public/files/products/' . $product->file_url);
            }

            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public/files/products', $fileName);
            $product->file_url = $fileName;
        }

        // Cập nhật dữ liệu khác
        $product->fill([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'type' => $validated['type'],
            'category_id' => $validated['category_id'],
            'publication_date' => $validated['publication_date'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
            'language' => $validated['language'],
            'description' => $validated['description'],
        ]);

        $product->save();

         return response()->json([
            'message' => 'Cập nhật sản phẩm thành công!',
            'product' => $product
        ]);
    }



    // COMMENT 
    public function showComments()
    {
        $comments = Comment::with('user', 'product')->latest()->paginate(10);
        return view('pages.admin.commentAdmin', compact('comments'));
    }
    public function destroyComment (Comment $comment)
    {
        try {
            Log::info('Deleting comment ID: ' . $comment->id);
            $comment->delete();

            return response()->json([
                'message' => 'Bình luận đã xoá thành công.',
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Đã có lỗi xảy ra khi xoá.',
                'status' => 'error'
            ], 500);
        }
    }



    // ORDER 
   public function showOrders()
    {
        // Lấy tổng số đơn
        $total = Order::count();

        // Đếm số đơn theo trạng thái
        $pending = Order::where('status', 'pending')->count();
        $completed = Order::where('status', 'completed')->count();
        $cancelled = Order::where('status', 'cancelled')->count();

        // Truyền dữ liệu sang view
        $stats = [
            'total' => $total,
            'pending' => $pending,
            'completed' => $completed,
            'cancelled' => $cancelled,
        ];

        // Lấy danh sách đơn (có phân trang)
        $orders = \App\Models\Order::with('user', 'items')->orderBy('created_at', 'desc')->paginate(15);

        return view('pages.admin.orderSetting', compact('stats', 'orders'));
    }

    public function showOItems($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('pages.admin.order_detail', compact('order'));
    }
    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Đã xóa đơn hàng thành công']);
    }

    public function complete(Order $order)
    {
        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Đơn hàng không ở trạng thái chờ xác nhận'], 400);
        }

        $order->status = 'completed';
        $order->save();

        return response()->json(['message' => 'Đơn hàng đã được xác nhận']);
    }







    // DASHBOARD




}
