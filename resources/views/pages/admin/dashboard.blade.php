@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - Dashboard')
@section('css')
    @vite(['resources/css/admin/dashboard.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('pages.admin.sidebar')
        
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
           @include('pages.admin.resItem')

            <!-- Header -->
            <div class="header__item">
                <h2 class="fw-bold">Dashboard</h2>
                <div class="card p-3 bg-white shadow-sm">
                    <span class="text-muted">Thời gian thống kê: <strong class="text-primary">{{ now ()}}</strong></span>
                </div>
            </div>
            
            <!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card stat-card p-3 shadow-sm border-left-primary">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Tổng doanh thu</p>
                    <h3 class="value text-primary">
                        {{ number_format($totalRevenue / 1_000_000, 1) }}<small>tr</small>
                    </h3>
                </div>
                <i class="bi bi-currency-dollar fs-1 text-primary opacity-25"></i>
            </div>
            <span class="trend {{ $revenueGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                <i class="bi bi-arrow-{{ $revenueGrowth >= 0 ? 'up' : 'down' }}"></i> 
                {{ abs($revenueGrowth) }}% so với tháng trước
            </span>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stat-card p-3 shadow-sm border-left-success">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Sản phẩm đã bán</p>
                    <h3 class="value text-success">{{ number_format($totalProductsSold) }}</h3>
                </div>
                <i class="bi bi-box-seam fs-1 text-success opacity-25"></i>
            </div>
            <span class="trend {{ $productsSoldTrend >= 0 ? 'text-success' : 'text-danger' }}">
                <i class="bi bi-arrow-{{ $productsSoldTrend >= 0 ? 'up' : 'down' }}"></i> 
                {{ abs($productsSoldTrend) }}% so với tháng trước
            </span>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stat-card p-3 shadow-sm border-left-warning">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Khách hàng mới</p>
                    <h3 class="value text-warning">{{ number_format($newCustomers) }}</h3>
                </div>
                <i class="bi bi-people fs-1 text-warning opacity-25"></i>
            </div>
            <span class="trend {{ $newCustomersGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                <i class="bi bi-arrow-{{ $newCustomersGrowth >= 0 ? 'up' : 'down' }}"></i> 
                {{ abs($newCustomersGrowth) }}% so với tháng trước
            </span>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stat-card p-3 shadow-sm border-left-info">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-muted mb-1">Lượt truy cập</p>
                    <h3 class="value text-info">{{ number_format($totalVisits / 1000, 1) }}<small>K</small></h3>
                </div>
                <i class="bi bi-eye fs-1 text-info opacity-25"></i>
            </div>
            <span class="trend {{ $visitsGrowth >= 0 ? 'text-success' : 'text-danger' }}">
                <i class="bi bi-arrow-{{ $visitsGrowth >= 0 ? 'up' : 'down' }}"></i> 
                {{ abs($visitsGrowth) }}% so với tháng trước
            </span>
        </div>
    </div>
</div>

            
            <!-- Charts Row -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <span>Thống kê đơn hàng</span>
                                <select class="form-select form-select-sm w-auto">
                                    <option>Tháng 5</option>
                                    <option>Tháng 4</option>
                                </select>
                            </h5>
                            <div class="chart-container">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Doanh thu theo tháng (2024)</h5>
                            <div class="chart-container">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders (Example) -->
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Đơn hàng gần đây</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Ngày</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->codeVNPAY }}</td>
                                        <td>{{ $order->user->full_name ?? 'Ẩn danh' }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>{{ number_format($order->total, 0, ',', '.') }}đ</td>
                                        <td>
                                            @if ($order->status === 'completed')
                                                <span class="badge bg-success">Hoàn thành</span>
                                            @elseif ($order->status === 'pending')
                                                <span class="badge bg-warning text-dark">Chờ xử lý</span>
                                            @else
                                                <span class="badge bg-danger">Đã huỷ</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                <!-- Thêm các dòng khác -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    // Orders Chart (Doughnut)
    const orderStats = @json($orderStats);
    const revenueByMonth = @json($revenueByMonth);

    new Chart(document.getElementById('ordersChart'), {
        type: 'doughnut',
        data: {
            labels: ['pending', 'completed', 'cancel'],
            datasets: [{
                data: [
                    orderStats.pending || 0,
                    orderStats.completed || 0,
                    orderStats.cancel || 0
                ],
                backgroundColor: ['#FBBC05', '#34A853', '#EA4335'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 20
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw} đơn (${context.parsed}%)`;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    // Revenue Chart (Bar)
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
            datasets: [{
                label: 'Doanh thu (triệu)',
                data: [
                    revenueByMonth[1] || 0,
                    revenueByMonth[2] || 0,
                    revenueByMonth[3] || 0,
                    revenueByMonth[4] || 0,
                    revenueByMonth[5] || 0
                ],
                backgroundColor: '#34A853',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + 'tr';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Doanh thu: ${context.raw} triệu`;
                        }
                    }
                }
            }
        }
    });

    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.getElementById('leftBar').classList.toggle('d-none');
    });
</script>
  
@endsection