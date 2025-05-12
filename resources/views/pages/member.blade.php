@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Member')
@section('css')
    @vite(['resources/css/member.css'])
@endsection

@section('content')

<!-- Title Section -->
<section class="DKHV container-fluid DKHV__title" style="margin-bottom: 2rem;">
    <h1>GÓI HỘI VIÊN</h1>
    <p>Nghe và đọc hơn 20,000 nội dung thuộc Kho sách hội viên</p>
</section>

<!-- Payment Section -->
<div class="DKHV__item container">
    <div class="DKHV__title__item">
        <h2>Thanh toán qua Chuyển khoản/Thẻ</h2>
        <p>Sử dụng tài khoản ngân hàng, ví MoMo hoặc thẻ thanh toán quốc tế (Visa, Master)</p>
    </div>

    <div class="pricing-contain row myrow">
        <!-- Loop over each subscription -->
        @foreach ($subscriptions as $subscription)
            <div class="pricing-card {{ $subscription->name === 'DeBook 3 tháng' ? 'popular' : '' }} col-4">
                <!-- Show popular badge for DeBook 3 months -->
                @if ($subscription->name === 'DeBook 3 tháng')
                    <div class="popular-badge">PHỔ BIẾN</div>
                @endif

                <h4>{{ $subscription->name }}</h4>
                <p class="price">{{ number_format($subscription->price, 0, ',', '.') }}đ</p>

                <!-- Display duration with the appropriate unit -->
                <p class="description">
                    {{ $subscription->duration }} 
                    @if ($subscription->duration_unit === 'days')
                        ngày
                    @elseif ($subscription->duration_unit === 'months')
                        tháng
                    @elseif ($subscription->duration_unit === 'years')
                        năm
                    @endif
                    đọc/nghe sách
                </p>

                <a href="{{ route('subscription.confirm', ['id' => $subscription->id]) }}" class="buy-button">Mua gói</a>

            </div>
        @endforeach
    </div>

    <!-- Contact Information -->
    <p>Để biết thêm chi tiết và giải đáp các yêu cầu, vui lòng liên hệ chúng tôi qua email: <a href="mailto:support@debook.vn">support@debook.vn</a> hoặc số điện thoại: <a href="tel:+012345678">012345678</a></p>
</div>

@endsection
