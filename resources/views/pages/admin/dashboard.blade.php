@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - Dashboard')

@section('css')
    @vite(['resources/css/admin/dashboard.css'])
    <!-- Thêm Chart.js qua CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Thêm Font Awesome nếu chưa có (dùng cho các icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Thêm Bootstrap Icons nếu chưa có -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar border-end p-3 min-vh-100" id="leftBar">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset('assets/img/Logo.png') }}" alt="logo" class="img-fluid mynav__logo">
                <button class="btn btn-sm d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" href="{{ route('admin.index') }}">
                        <i class="fa-solid fa-inbox text-primary"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./userManagement.html">
                        <i class="fa-solid fa-user text-warning"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./authorManagement.html">
                        <i class="fa-solid fa-feather text-success"></i>
                        <span>Tác giả</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./productManagement.html">
                        <i class="fa-solid fa-gift text-info"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.order')}}">
                        <i class="fa-solid fa-truck-fast text-danger"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./paymentManagement.html">
                        <i class="fa-solid fa-cart-shopping text-secondary"></i>
                        <span>Thanh toán</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./contentManagement.html">
                        <i class="fa-solid fa-font text-dark"></i>
                        <span>Nội dung</span>
                    </a>
                </li>
                @auth 
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#">
                            <i class="fa-solid fa-user text-dark"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <!-- Nút đăng xuất -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link d-flex align-items-center" style="border: none; background: none; color: inherit;">
                                <i class="fa-solid fa-sign-out-alt text-danger"></i>
                                <span>Đăng xuất</span>
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
        
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="responsive__item mb-5">
                <ul class="nav d-flex">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" href="{{ route('admin.index') }}">
                            <i class="fa-solid fa-inbox text-primary"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="./userManagement.html">
                            <i class="fa-solid fa-user text-warning"></i>
                            <span>Người dùng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="./authorManagement.html">
                            <i class="fa-solid fa-feather text-success"></i>
                            <span>Tác giả</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="./productManagement.html">
                            <i class="fa-solid fa-gift text-info"></i>
                            <span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('admin.order')}}">
                            <i class="fa-solid fa-truck-fast text-danger"></i>
                            <span>Đơn hàng</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="./paymentManagement.html">
                            <i class="fa-solid fa-cart-shopping text-secondary"></i>
                            <span>Thanh toán</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="./contentManagement.html">
                            <i class="fa-solid fa-font text-dark"></i>
                            <span>Nội dung</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Header -->
            <div class="header__item">
                <h2 class="fw-bold">Dashboard</h2>
                <div class="card p-3 bg-white shadow-sm">
                    <span class="text-muted">Thời gian thống kê: <strong class="text-primary">Tháng 5, 2024</strong></span>
                </div>
            </div>
            
            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card p-3 shadow-sm border-left-primary">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Tổng doanh thu</p>
                                <h3 class="value text-primary">{{ number_format($totalRevenue / 1000000, 1) }}<small>tr</small></h3>
                            </div>
                            <i class="bi bi-currency-dollar fs-1 text-primary opacity-25"></i>
                        </div>
                        <span class="trend text-success"><i class="bi bi-arrow-up"></i> 12% so với tháng trước</span>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card p-3 shadow-sm border-left-success">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Sản phẩm đã bán</p>
                                <h3 class="value text-success">{{ $totalProductsSold }}</h3>
                            </div>
                            <i class="bi bi-box-seam fs-1 text-success opacity-25"></i>
                        </div>
                        <span class="trend text-danger"><i class="bi bi-arrow-down"></i> 5% so với tháng trước</span>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card p-3 shadow-sm border-left-warning">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Khách hàng mới</p>
                                <h3 class="value text-warning">{{ $newCustomers }}</h3>
                            </div>
                            <i class="bi bi-people fs-1 text-warning opacity-25"></i>
                        </div>
                        <span class="trend text-success"><i class="bi bi-arrow-up"></i> 8% so với tháng trước</span>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="card stat-card p-3 shadow-sm border-left-info">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-1">Lượt truy cập</p>
                                <h3 class="value text-info"><small>K</small></h3>
                            </div>
                            <i class="bi bi-eye fs-1 text-info opacity-25"></i>
                        </div>
                        <span class="trend text-success"><i class="bi bi-arrow-up"></i> 22% so với tháng trước</span>
                    </div>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="row g-4 mb-4">
                <!-- Orders Chart (Doughnut) -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <span>Thống kê đơn hàng</span> <!-- Sửa lỗi typo "obras>" -->
                                <select class="form-select form-select-sm w-auto">
                                    <option>Tháng 5</option>
                                    <option>Tháng 4</option>
                                </select>
                            </h5>
                            <div class="chart-container" style="height: 300px;">
                                <canvas id="ordersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Revenue Chart (Bar) -->
                <div class="col-lg-6">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Doanh thu theo tháng (2024)</h5>
                            <div class="chart-container" style="height: 300px;">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Orders -->
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
                                @forelse ($recentOrders as $order)
                                    <tr>
                                        <td>#DH-{{ $order->id }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($order->total) }}đ</td>
                                        <td>
                                            @if ($order->status == 'Đơn mới')
                                                <span class="badge bg-primary">{{ $order->status }}</span>
                                            @elseif ($order->status == 'Đang xử lý')
                                                <span class="badge bg-warning">{{ $order->status }}</span>
                                            @elseif ($order->status == 'Đã hoàn thành')
                                                <span class="badge bg-success">{{ $order->status }}</span>
                                            @elseif ($order->status == 'Đã hủy')
                                                <span class="badge bg-danger">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Không có đơn hàng nào.</td>
                                    </tr>
                                @endforelse
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
    const orderStats = $orderStats [
        'Đơn mới' ,
        'Đang xử lý' ,
        'Đã hoàn thành' ,
        'Đã hủy';
    ];
    new Chart(document.getElementById('ordersChart'), {
        type: 'doughnut',
        data: {
            labels: ['Đơn mới', 'Đang xử lý', 'Đã hoàn thành', 'Đã hủy'],
            datasets: [{
                data: [
                    orderStats['Đơn mới'] || 0,
                    orderStats['Đang xử lý'] || 0,
                    orderStats['Đã hoàn thành'] || 0,
                    orderStats['Đã hủy'] || 0
                ],
                backgroundColor: [
                    '#4285F4',
                    '#FBBC05',
                    '#34A853',
                    '#EA4335'
                ],
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
    const revenueByMonth = $revenueByMonth ?? [0, 0, 0, 0, 0];
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
            datasets: [{
                label: 'Doanh thu (triệu)',
                data: revenueByMonth,
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