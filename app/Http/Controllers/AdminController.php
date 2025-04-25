<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Orders;
use app\Models\Order_items;
use app\Models\User;
use app\Models\Visit;
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
        $totalVisits = DB::table('visits')
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
            'totalVisits',
            'orderStats',
            'revenueByMonth',
            'recentOrders'
        ));
    }
}
