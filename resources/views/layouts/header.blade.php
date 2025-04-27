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
                    <form class="d-flex flex-grow-1 myform" role="search" id="myform">
                        <input class="form-control me-2" type="search" placeholder="Search" 
                               aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
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
        <a href="#" class="header__category-item">
            {{ $category->name }}
        </a>
        @endforeach
      
      <a href="">Blog</a>
    </div>
</header>
       