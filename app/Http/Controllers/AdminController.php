<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Order;
use app\Models\OrderItem;
use app\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả đơn hàng
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->get();

        // Lấy dữ liệu thống kê
        $totalRevenue = DB::table('orders')->sum('total');
        $totalProductsSold = DB::table('order_items')->sum('quantity');
        $newCustomers = DB::table('users')
            ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->count();

        // Thống kê đơn hàng theo trạng thái
        $orderStats = [
            'Đơn mới' => DB::table('orders')->where('status', 'Đơn mới')->count(),
            'Đang xử lý' => DB::table('orders')->where('status', 'Đang xử lý')->count(),
            'Đã hoàn thành' => DB::table('orders')->where('status', 'Đã hoàn thành')->count(),
            'Đã hủy' => DB::table('orders')->where('status', 'Đã hủy')->count(),
        ];

        // Doanh thu theo tháng
        $revenueByMonth = [];
        for ($month = 1; $month <= 5; $month++) {
            $revenueByMonth[] = DB::table('orders')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', 2024)
                ->sum('total') / 1000000;
        }

        $recentOrders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->orderBy('orders.created_at', 'desc')
            ->take(5)
            ->get();

        // Truyền dữ liệu vào view
        return view('pages.admin.dashboard', compact(
            'orders',
            'totalRevenue',
            'totalProductsSold',
            'newCustomers',
            'orderStats',
            'revenueByMonth',
            'recentOrders'
        ));
    }
    public function index2(Request $request)
    {
        $query = Order::with(['items', 'user']);

        if ($request->has('trang_thai') && $request->trang_thai) {
            $query->where('status', $request->trang_thai);
        }

        if ($request->has('ngay_bat_dau') && $request->ngay_bat_dau) {
            $query->whereDate('created_at', '>=', $request->ngay_bat_dau);
        }

        if ($request->has('ngay_ket_thuc') && $request->ngay_ket_thuc) {
            $query->whereDate('created_at', '<=', $request->ngay_ket_thuc);
        }

        if ($request->has('tim_kiem') && $request->tim_kiem) {
            $tim_kiem = $request->tim_kiem;
            $query->where(function ($q) use ($tim_kiem) {
                $q->where('id', 'like', "%$tim_kiem%")
                  ->orWhere('codeVNPAY', 'like', "%$tim_kiem%")
                  ->orWhereHas('user', function ($q) use ($tim_kiem) {
                      $q->where('name', 'like', "%$tim_kiem%")
                        ->orWhere('email', 'like', "%$tim_kiem%");
                  });
            });
        }

        $don_hang = $query->latest()->paginate(10);

        // Đảm bảo $don_hang luôn có giá trị, ngay cả khi rỗng
        if (!$don_hang) {
            $don_hang = collect([])->paginate(10);
        }

        return view('admin.orderSetting', compact('don_hang'));
    }

    public function create()
    {
        $users = User::all();
        return view('pages.admin.addOrder', compact('users'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'codeVNPAY' => 'nullable|string|max:255',
            'trang_thai' => 'required|in:cho_xac_nhan,da_xac_nhan,dang_giao,da_giao,da_huy',
            'tong_tien' => 'required|numeric|min:0',
            'san_pham' => 'required|array',
            'san_pham.*.ten' => 'required|string|max:255',
            'san_pham.*.gia' => 'required|numeric|min:0',
            'san_pham.*.so_luong' => 'required|integer|min:1',
        ]);
        $order = Order::create([
            'user_id' => $validated['user_id'],
            'total' => $validated['total'],
            'codeVNPAY' => $validated['codeVNPAY'],
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $redirectParams = [
            'trang_thai' => $request->old('trang_thai', $request->input('trang_thai')),
            'ngay_bat_dau' => $request->old('ngay_bat_dau', $request->input('ngay_bat_dau')),
            'ngay_ket_thuc' => $request->old('ngay_ket_thuc', $request->input('ngay_ket_thuc')),
            'tim_kiem' => $request->old('tim_kiem', $request->input('tim_kiem')),
        ];
        DB::beginTransaction();
        try {
            $don_hang = Order::create([
                'user_id' => $validated['user_id'],
                'codeVNPAY' => $validated['codeVNPAY'],
                'status' => $validated['trang_thai'],
                'total' => $validated['tong_tien'],
            ]);

            foreach ($validated['san_pham'] as $san_pham) {
                OrderItem::create([
                    'order_id' => $don_hang->id,
                    'product_name' => $san_pham['ten'],
                    'price' => $san_pham['gia'],
                    'quantity' => $san_pham['so_luong'],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.orderSetting')->with('thanh_cong', 'Đơn hàng đã được tạo.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('loi', 'Có lỗi xảy ra khi tạo đơn hàng.');
        }
    }
    public function updateStatus(Request $request, Order $don_hang)
    {
        $validated = $request->validate([
            'trang_thai' => 'required|in:cho_xac_nhan,da_xac_nhan,dang_giao,da_giao,da_huy',
        ]);

        $don_hang->update(['status' => $validated['trang_thai']]);
        return response()->json(['thong_bao' => 'Cập nhật trạng thái thành công']);
    }
    public function destroy(Order $don_hang)
    {
        $don_hang->delete();
        return redirect()->route('admin.orderSetting')->with('thanh_cong', 'Đơn hàng đã được xóa.');
    }
    public function orderShow(){

        return view('pages.admin.orderSetting');

    }

}


