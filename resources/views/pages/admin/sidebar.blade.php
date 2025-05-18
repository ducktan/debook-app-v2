<nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar border-end p-3 min-vh-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset ('assets/img/Logo.png')}}" alt="logo" class="img-fluid mynav__logo">
                <button class="btn btn-sm d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.index') }}">
                        <i class="fa-solid fa-inbox text-primary"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.users.show') }}">
                        <i class="fa-solid fa-user text-warning"></i>
                        <span>Người dùng</span>
                      
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{route('admin.categories.show')}}">
                        <i class="fa-solid fa-feather text-success"></i>
                        <span>Danh mục sản phẩm</span>
                       
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.products.show') }}">
                        <i class="fa-solid fa-gift text-info"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.comments.show') }}">
                        <i class="fa-regular fa-comments"></i>
                        <span>Bình luận</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{route('admin.orders.show')}}">
                        <i class="fa-solid fa-truck-fast text-danger"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('posts.index') }}">
                        <i class="fa-solid fa-font text-dark"></i>
                        <span>Blog</span>
                    </a>
                </li>
                @auth 
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('user.profile')}}">
                            <i class="fa-solid fa-user text-dark"></i>
                            <span>{{Auth::user()->name}}</span>
                        </a>
                    </li>
                    <!-- Thêm nút đăng xuất -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="border: none; background: none; color: inherit;">Đăng xuất</button>
                        </form>
                    </li>
                    
                @endauth
            </ul>
        </nav>