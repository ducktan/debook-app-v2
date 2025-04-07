@extends('layouts.app')
@section('title', 'Debook - Thông tin tài khoản')
@section('css')
    @vite(['resources/css/user.css'])
@endsection
@section('content')

<section class="user section container">

    <div class="user__responsive">
        <div class="user__information">
            <h3>Tấn Nguyễn Đức</h3>
            <div class="user__avatar"></div>
        </div>
        <div class="user__status">
            <i class="fa-solid fa-crown"></i>
            <p>Thành viên VIP</p>
        </div>

        <hr>
        <div class="user__tab__item d-flex g-5">
            <div class="user__item">
                <i class="fa-solid fa-user"></i>
                <p><a href="">Quản lý tài khoản</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-book"></i>
                <p><a href="">Tủ sách cá nhân</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-cart-shopping"></i>
                <p><a href="">Quản lý đơn hàng</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-money-bill"></i>
                <p><a href="">Lịch sử giao dịch</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-headset"></i>
                <p><a href="">Hỗ trợ khách hàng</a></p>
            </div>
        </div>
        
    </div>
    <div class="user__row row">
        <div class="col-xl-3 col-lg-4  user__col" id="user__tab">
            <div class="user__information">
                <h3>Tấn Nguyễn Đức</h3>
                <div class="user__avatar"></div>
            </div>
            <div class="user__status">
                <i class="fa-solid fa-crown"></i>
                <p>Thành viên VIP</p>
            </div>

            <div class="user__register">
                <a href="./member.html">
                    <p>Trở thành Hội viên</p>
                </a>
                
            </div>
            <hr>

            <div class="user__item">
                <i class="fa-solid fa-user"></i>
                <p><a href="">Quản lý tài khoản</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-book"></i>
                <p><a href="">Tủ sách cá nhân</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-cart-shopping"></i>
                <p><a href="">Quản lý đơn hàng</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-money-bill"></i>
                <p><a href="">Lịch sử giao dịch</a></p>
            </div>
            <div class="user__item">
                <i class="fa-solid fa-headset"></i>
                <p><a href="">Hỗ trợ khách hàng</a></p>
            </div>
        </div>
        <div class="col-xl-7 col-lg-8 col-12 user__col">
            <h2>Quản lý thông tin tài khoản</h2>
            <hr>

            <div class="user__form">
                <div class="user__form__row row">
                    <div class="col-7 user__form__infor">
                        <form action="">
                            <div class="form__item">
                                <label for="name__login" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="name__login" value="{{Auth::user()->name}}" disabled>
                            </div>
                            <div class="form__item">
                                <label for="name__ID" class="form-label">ID người dùng</label>
                                <input type="text" class="form-control" id="name__ID" value="{{ Auth::user()->id }}" disabled>
                            </div>
                            <div class="form__item">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" value="{{ Auth::user()->full_name ?? 'NULL' }}">

                            </div>
                               
                            <div class="form__item">
                                <label for="mail" class="form-label">Email</label>
                                <input type="mail" class="form-control" id="mail" value="{{ Auth::user()->email ?? 'NULL' }}">
                            </div>

                            <div class="form__item">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="phone" class="form-control" id="phone" value="{{ Auth::user()->phone ?? 'NULL' }}">
                            </div>

                        </form>
                    </div>
                    <div class="col-5 user__avatar__change">
                        <div class="user__avt__display"></div>
                        <button class="btn">Thay ảnh</button>
                    </div>
                </div>

                <hr>

                <div class="user__form__button d-flex">
                    <button class="btn btn-outline-success" style="margin-right: 1rem;">Cập nhật</button>
                    <button class="btn btn-outline-success">Huỷ</button>
                </div>
            </div>

        </div>
    </div>

 </section>

@endsection