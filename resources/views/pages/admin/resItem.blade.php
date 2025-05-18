<div class="responsive__item mb-5">
                <ul class="nav d-flex">
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
                            <span>Nội dung</span>
                        </a>
                    </li>
                </ul>
            </div>