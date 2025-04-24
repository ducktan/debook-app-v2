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
      <div class="pricing-card popular col-4">
          <div class="popular-badge">PHỔ BIẾN</div>
          <h4>DeBook 3 tháng</h4>
          <p class="price">99.000đ</p>
          <p class="description">90 ngày đọc/nghe sách</p>
          <a href="#" class="buy-button">Mua gói</a>
      </div>
    
      <div class="pricing-card col-4">
          <h4>DeBook 6 tháng</h4>
          <p class="price">179.000đ</p>
          <p class="description">183 ngày đọc/nghe sách</p>
          <a href="#" class="buy-button">Mua gói</a>
      </div>
    
      <div class="pricing-card col-4" >
          <h4>DeBook 12 tháng</h4>
          <p class="price">329.000đ</p>
          <p class="description">365 ngày đọc/nghe sách</p>
          <a href="#" class="buy-button">Mua gói</a>
      </div>
    </div>
</div>

<div class="DKHV__item container">
  <div class="DKHV__title__item">
    <h2>Hoặc thanh toán quá SMS</h2>
  </div>

  <div class="pricing-contain row myrow">
    <div class="pricing-card popular col-4">
        <div class="popular-badge">PHỔ BIẾN</div>
        <h4>DeBook 1 ngày</h4>
        <p class="price">2.000đ</p>
        <p class="description">2 ngày đọc/nghe sách</p>
        <a href="#" class="buy-button">Mua gói</a>
    </div>
  
    <div class="pricing-card col-4">
        <h4>DeBook 7 ngày</h4>
        <p class="price">7.000đ</p>
        <p class="description">7 ngày đọc/nghe sách</p>
        <a href="#" class="buy-button">Mua gói</a>
    </div>
  
    <div class="pricing-card col-4">
        <h4>DeBook 30 ngày</h4>
        <p class="price">30.000đ</p>
        <p class="description">30 ngày đọc/nghe sách</p>
        <a href="#" class="buy-button">Mua gói</a>
    </div>
    <div class="pricing-card col-4">
      <h4>DeBook 3 tháng</h4>
      <p class="price">85.000đ</p>
      <p class="description">90 ngày đọc/nghe sách</p>
      <a href="#" class="buy-button">Mua gói</a>
    </div>
  </div>
  <p> Để biết thêm chi tiết và giải đáp các yêu cầu bạn vui lòng liên hệ chúng tôi thông qua support@debook.vn hoặc 012345678<p></p>
</div>






  
@endsection

