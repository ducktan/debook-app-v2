@extends('layouts.app')

@section('title', 'Xác nhận đăng ký hội viên')

@section('content')
<div class="container">
    <h2>Xác nhận đăng ký hội viên</h2>
    
    <div class="card p-4 mb-4">
        <h4>{{ $subscription->name }}</h4>
        <p>Giá: {{ number_format($subscription->price, 0, ',', '.') }}đ</p>
        <p>Thời hạn: {{ $subscription->duration }} 
            @switch($subscription->duration_unit)
                @case('days') ngày @break
                @case('months') tháng @break
                @case('years') năm @break
            @endswitch
        </p>
    </div>

    <form action="{{ route('subscription.pay') }}" method="POST">
        @csrf
        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
        <button type="submit" class="btn btn-success">Thanh toán</button>
    </form>
</div>
@endsection
