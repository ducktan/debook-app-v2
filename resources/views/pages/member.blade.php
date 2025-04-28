@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Member')
@section('css')
    @vite(['resources/css/member.css'])
@endsection


@section('content')






<section class="DKHV container-fluid DKHV__title" style="margin-bottom: 2rem;">
    <h1>GÓI HỘI VIÊN</h1>
    <p>Nghe và đọc hơn 20,000 nội dung thuộc Kho sách hội viên</p>
</section>

<div class="DKHV__item container">
    <div class="DKHV__title__item">
      <h2>Thanh toán qua Chuyển khoản/Thẻ</h2>
      <p>Sử dụng tài khoản ngân hàng, ví MoMo hoặc thẻ thanh toán quốc tế (Visa, Master)</p>
    </div>

    <div class="pricing-contain row myrow">
        @foreach ($subscriptions as $subscription)
            @if($subscription->durationUnit != 'days') <!-- Chỉ hiển thị gói không có đơn vị "days" -->
                <div class="pricing-card {{ $subscription->name == 'DeBook 3 tháng' ? 'popular' : '' }} col-4">
                    @if($subscription->name == 'DeBook 3 tháng')
                        <div class="popular-badge">PHỔ BIẾN</div>
                    @endif
                    <h4>{{ $subscription->name }}</h4>
                    <p class="price">{{ number_format($subscription->price, 0, ',', '.') }}đ</p>
                    <p class="description">{{ $subscription->duration }} {{ $subscription->duration_unit == 'days' ? 'ngày' : ($subscription->duration_unit == 'months' ? 'tháng' : 'năm') }} đọc/nghe sách</p>
                    <a href="{{ route('payment', ['id' => $subscription->id]) }}" class="buy-button">Mua gói</a>
                </div>
            @endif
        @endforeach
    </div>
    <p> Để biết thêm chi tiết và giải đáp các yêu cầu bạn vui lòng liên hệ chúng tôi thông qua support@debook.vn hoặc 012345678<p></p>
</div>



  
@endsection

