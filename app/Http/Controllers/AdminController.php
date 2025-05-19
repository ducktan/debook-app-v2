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
use Illuminate\Support\Facades\DB;

use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;



use Illuminate\Http\Request;

class AdminController extends Controller
{
    //// User
    public function index()
    {
        // Thống kê đơn hàng theo trạng thái
        $orderStats = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Doanh thu từng tháng (chỉ tính đơn completed)
        $revenueByMonth = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->select(
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('SUM(order_items.price * order_items.quantity) as total')
            )
            ->groupBy(DB::raw('MONTH(orders.created_at)'))
            ->pluck('total', 'month');

        // Tổng doanh thu tháng hiện tại (ví dụ tháng 5)
        $currentMonth = date('m');
        $totalRevenue = $revenueByMonth->get($currentMonth, 0);

        // Tổng sản phẩm đã bán (đơn completed)
        $totalProductsSold = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->sum('order_items.quantity');

        // Khách hàng mới trong tháng hiện tại
        $newCustomers = User::whereMonth('created_at', $currentMonth)->count();

        // Lượt truy cập giả định (bạn cần thay bằng dữ liệu thật nếu có)
        $totalVisits = 50800; // ví dụ số liệu cứng

        // Các đơn gần đây
        $recentOrders = Order::latest()->take(5)->get();

        // Ví dụ về tăng trưởng (tính đơn giản)
        // Lấy doanh thu tháng trước (tháng hiện tại - 1)
        $lastMonth = $currentMonth - 1 <= 0 ? 12 : $currentMonth - 1;
        $lastMonthRevenue = $revenueByMonth->get($lastMonth, 0);
        $revenueGrowth = $lastMonthRevenue == 0 ? 100 : round((($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2);

        // Tương tự sản phẩm đã bán tăng giảm (giả định)
        $lastMonthProductsSold = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->whereMonth('orders.created_at', $lastMonth)
            ->sum('order_items.quantity');
        $productsSoldTrend = $lastMonthProductsSold == 0 ? 100 : round((($totalProductsSold - $lastMonthProductsSold) / $lastMonthProductsSold) * 100, 2);

        // Khách hàng mới tăng giảm (giả định)
        $lastMonthNewCustomers = User::whereMonth('created_at', $lastMonth)->count();
        $newCustomersGrowth = $lastMonthNewCustomers == 0 ? 100 : round((($newCustomers - $lastMonthNewCustomers) / $lastMonthNewCustomers) * 100, 2);

        // Lượt truy cập tăng giảm (giả định)
        $visitsGrowth = 22; // bạn có thể thay bằng tính toán thực tế

        return view('pages.admin.dashboard', [
            'orderStats' => $orderStats,
            'revenueByMonth' => $revenueByMonth,
            'recentOrders' => $recentOrders,
            'totalRevenue' => $totalRevenue,
            'totalProductsSold' => $totalProductsSold,
            'newCustomers' => $newCustomers,
            'totalVisits' => $totalVisits,
            'revenueGrowth' => $revenueGrowth,
            'productsSoldTrend' => $productsSoldTrend,
            'newCustomersGrowth' => $newCustomersGrowth,
            'visitsGrowth' => $visitsGrowth,
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new ReportExport, 'report.xlsx');
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
            if ($product->image_url && Storage::disk('public')->exists('images/products/' . $product->image_url)) {
                Storage::disk('public')->delete('images/products/' . $product->image_url);
            }

            // Lưu ảnh mới
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('images/products', $imageName, 'public');

            $product->image_url = $imageName;
        }


        

       
        // Cập nhật file nếu có upload mới
        if ($request->hasFile('file')) {
            // Xoá file cũ nếu có
            if ($product->file_url && Storage::disk('public')->exists('file/' . $product->file_url)) {
                Storage::disk('public')->delete('file/' . $product->file_url);
            }

            // Lưu file mới
            $fileName = time() . '.' . $request->file('file')->extension();
            $request->file('file')->storeAs('file', $fileName, 'public');

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







    



}
