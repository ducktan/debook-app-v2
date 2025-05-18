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
                                <h3 class="value text-primary">250.8<small>tr</small></h3>
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
                                <h3 class="value text-success">1,240</h3>
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
                                <h3 class="value text-warning">320</h3>
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
                                <h3 class="value text-info">50.8<small>K</small></h3>
                            </div>
                            <i class="bi bi-eye fs-1 text-info opacity-25"></i>
                        </div>
                        <span class="trend text-success"><i class="bi bi-arrow-up"></i> 22% so với tháng trước</span>
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
                                <tr>
                                    <td>#DH-1001</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>20/05/2024</td>
                                    <td>450,000đ</td>
                                    <td><span class="badge bg-success">Hoàn thành</span></td>
                                </tr>
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
    new Chart(document.getElementById('ordersChart'), {
        type: 'doughnut',
        data: {
            labels: ['Đơn mới', 'Đang xử lý', 'Đã hoàn thành', 'Đã hủy'],
            datasets: [{
                data: [120, 90, 200, 30],
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
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
            datasets: [{
                label: 'Doanh thu (triệu)',
                data: [40, 60, 80, 120, 250],
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