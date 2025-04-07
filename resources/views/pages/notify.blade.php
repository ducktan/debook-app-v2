@extends('layouts.master', ['hideHeaderFooter' => false])

@section('title', 'Debook - Thông báo')
@section('css')
    @vite(['resources/css/notify.css'])
@endsection


@section('content')

<section class="notification-section">
    <div class="container">
        <div class="notification-panel">
            <h2 class="notification-title">THÔNG BÁO</h2>
            <div class="notification-tabs">
      
                <button class="tab active" data-tab="all">Tất cả <span class="badge">6</span></button>
                <button class="tab" data-tab="payments">Thanh toán</button>
                <a href="#" class="mark-all-read"><i class="fas fa-check"></i>&nbsp Đánh dấu tất cả đã đọc </a>
            </div>
            <div class="notification-content">
                <h3>Hôm nay</h3>
                <div class="notification-item unread">
                    <div class="notification__item">
                      <i class="fa-solid fa-bookmark"></i>
                    </div>
                   
                    <div class="notification-details">
                        <p>Nguyễn Thị Lan đã đặt sách "Đắc Nhân Tâm" với tác giả Nguyễn Văn A vào</p>
                        <span class="notification-meta">Đơn hàng mới - 12/03/2025 @ 14:00.</span>
                    </div>
                </div>
                <div class="notification-item unread">
                  <div class="notification__item">
                    <i class="fa-solid fa-bookmark"></i>
                  </div>
                    <div class="notification-details">
                        <p>Trần Văn Hùng đã đổi lịch đọc sách "Sapiens" sang...</p>
                        <span class="notification-meta">Đã điều chỉnh - 14/03/2025 @ 16:45.</span>
                    </div>
                </div>
                <div class="notification-item unread">
                  <div class="notification__item">
                    <i class="fa-solid fa-bookmark"></i>
                  </div>
                    <div class="notification-details">
                        <p>Lê Thị Mai đã đăng ký đọc sách mới "Nhà Giả Kim" với danh mục sách.</p>
                        <span class="notification-meta">Đăng ký sách mới - 12/03/2025 @ 10:00.</span>
                    </div>
                </div>
                <div class="notification-item">
                  <div class="notification__item clock">
                    <i class="fa-solid fa-clock" style="color: orange;"></i>
                  </div>
                    <div class="notification-details">
                        <p>Nhà xuất bản đã cập nhật lịch phát hành sách cho tuần này.</p>
                        <span class="notification-meta">Nhắc nhở lịch - 12/03/2025 @ 15:00.</span>
                    </div>
                </div>
                <div class="notification-item">
                  <div class="notification__item">
                    <i class="fa-solid fa-bookmark"></i>
                  </div>
                    <div class="notification-details">
                        <p>Phạm Thị Hồng đã đánh giá sách "Harry Potter" 5 sao...</p>
                        <span class="notification-meta">Đánh giá mới - 12/03/2025 @ 09:00.</span>
                    </div>
                </div>
                <h3>Hôm qua</h3>
                <div class="notification-item">
                  <div class="notification__item">
                    <i class="fa-solid fa-bookmark"></i>
                  </div>
                    <div class="notification-details">
                        <p>Hoàng Thị Ngọc đã đặt sách "Totto-chan" với tác giả Trần Văn B vào</p>
                        <span class="notification-meta">Đơn hàng mới - 12/03/2025 @ 09:00.</span>
                    </div>
                </div>
                <div class="notification-item">
                  <div class="notification__item">
                    <i class="fa-solid fa-bookmark"></i>
                  </div>
                    <div class="notification-details">
                        <p>Đỗ Văn Nam đã đặt lịch đọc "Đừng Bao Giờ Đi Ăn Một Mình" với tác giả Lê Văn C vào</p>
                        <span class="notification-meta">Đơn hàng mới - 12/03/2025 @ 10:00.</span>
                    </div>
                </div>
                <div class="notification-item">
                  <div class="notification__item">
                    <i class="fa-solid fa-bookmark"></i>
                  </div>
                    <div class="notification-details">
                        <p>Vũ Thị Linh đã đặt sách "Nhật Ký Trong Tù" với tác giả Nguyễn Văn D vào</p>
                        <span class="notification-meta">Đơn hàng mới - 12/03/2025 @ 15:00.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  

  
@endsection

