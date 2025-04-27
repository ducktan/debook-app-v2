@extends('layouts.app', ['hideHeaderFooter' => true])
@section('title', 'Debook - Thông tin tài khoản')
@section('css')
    @vite(['resources/css/user.css'])
@endsection
@section('content')

<section class="user section container">

    <div class="user__responsive">
        <div class="user__information">
            <h3>{{ Auth::user()->full_name ?? 'NULL' }}</h3>
            <div class="user__avatar"></div>
        </div>
        <div class="user__status">
            <i class="fa-solid fa-crown"></i>
            <p>{{ Auth::user()->utype ?? 'NULL' }}</p>
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
                <h3>{{ Auth::user()->full_name ?? 'NULL' }}</h3>
                <div class="user__avatar">
                    @if (Auth::user()->avatar)
                        <img src="{{ asset('assets/img/avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="img-fluid">
                    @else
                        <img src="{{ asset('assets/img/default-avt.jpg') }}" alt="Default Avatar" class="img-fluid">
                    @endif

                    
                </div>
            </div>
            <div class="user__status">
                <i class="fa-solid fa-crown"></i>
                <p>{{ Auth::user()->utype ?? 'NULL' }}</p>
            </div>

            <div class="user__register">
                <a href="{{route('member')}}">
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
                        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Dòng này sẽ giả lập phương thức PUT -->
                        
                            <div class="form__item">
                                <label for="name__login" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="name__login" value="{{Auth::user()->name}}" disabled>
                            </div>
                            <div class="form__item">
                                <label for="name__ID" class="form-label">ID người dùng</label>
                                <input type="text" class="form-control" id="name__ID" value="{{ Auth::user()->id }}" disabled>
                            </div>
                            <div class="form__item">
                                <label for="fullname" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="fullname" value="{{ Auth::user()->full_name ?? 'NULL' }}" name="full_name">
                            </div>
                            <div class="form__item">
                                <label for="mail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="mail" value="{{ Auth::user()->email ?? 'NULL' }}" name="email">
                            </div>
                            <div class="form__item">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" value="{{ Auth::user()->phone ?? 'NULL' }}" name="phone">
                            </div>
                            <div class="form__item">
                                <label for="phone" class="form-label">Avatar</label>
                                <input type="file" name="avatar" accept="image/*" class="form-control" />
                            </div>
                            <div class="user__form__button d-flex">
                                <button class="btn btn-outline-success" style="margin-right: 1rem;" type="submit">Cập nhật</button>
                                <button class="btn btn-outline-success">Huỷ</button>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-5 user__avatar__change">





                       
                        












                        
                    </div>
                </div>

                <hr>

                
            </div>

        </div>
    </div>

 </section>

@endsection