 <!-- Header -->
     
 <header class="container-fluid px-0 myheader">
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="150" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/') }}">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    </li>
                    @php
                        $cart = session('cart', []);
                        $cartCount = array_sum(array_column($cart, 'quantity'));
                    @endphp


                    <li class="nav-item position-relative">
                        <a class="nav-link active" aria-current="page" href="{{ url('/cart') }}">
                            <i class="fas fa-shopping-cart me-2"></i>
                            @if ($cartCount > 0)
                                <span class="position-absolute top-0 start-100 move__it badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>

                    <li class="nav-item position-relative">
                        <a class="nav-link" aria-current="page" href="{{ url('/products') }}">
                           <i class="fa-solid fa-book"></i>
                            
                        </a>
                    </li>


                    
                    
                    {{-- Nếu chưa đăng nhập --}}
                    @guest
                    <li class="nav-item line__fi"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
                    <li class="nav-item line__fi"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
                    @endguest

                    @auth
                        
                    <li class="nav-item line__fi"><a class="nav-link" href="{{ Auth::user()->utype === 'ADM' ? route('admin.index') : route('user.profile') }}">
                    {{Auth::user()->name}}    
                    </a></li>

                    <!-- Thêm nút đăng xuất -->
                    <li class="nav-item line__fi">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="border: none; background: none; color: inherit;">Đăng xuất</button>
                        </form>
                    </li>

                    @endauth
                    
                   

                    
                </ul>
                
                
                <div class="d-flex align-items-center flex-wrap gap-2 form">
                    <form class="d-flex flex-grow-1 position-relative myform" role="search" id="myform" autocomplete="off">
                        <input class="form-control me-2" type="search" placeholder="Search"
                            aria-label="Search" name="query" id="search-box">
                        <button class="btn btn-outline-success" type="submit">Search</button>

                        <!-- Kết quả tìm kiếm hiển thị tại đây -->
                        <div id="search-results" class="position-absolute bg-white border w-100 z-3" 
                            style="top: 100%; left: 0; display: none; max-height: 300px; overflow-y: auto;">
                        </div>
                    </form>

                    


                    

                    <div class="icon__search">
                      <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </nav>

    <div class="header__category container">

        @foreach ($categories as $category)
        <a href="{{ route('categories.show', $category->slug) }}" class="header__category-item">
            {{ $category->name }}
        </a>
        @endforeach
    
      
      <a href="{{ route('blog')}}">Blog</a>
    </div>
</header>
       