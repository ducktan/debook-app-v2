@extends('layouts.master', ['hideHeaderFooter' => false])

@section('title', 'Debook - Danh sách sản phẩm')
@section('css')
    @vite(['resources/css/product.css'])
@endsection

@section('content')

</section>
  
<main class="container my-4">
    <div class="row g-4">
        <!-- Filters -->
        <aside class="col-lg-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3 filter-title"> <i class="fas fa-filter me-2"></i> Bộ lọc tìm kiếm </h5>
                    
                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Giá</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price1">
                            <label class="form-check-label" for="price1">Dưới 50.000đ</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price2">
                            <label class="form-check-label" for="price2">50.000 - 100.000đ</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="price3">
                            <label class="form-check-label" for="price3">Trên 100.000đ</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted mb-3">Định dạng</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ebook">
                            <label class="form-check-label" for="ebook">Sách điện tử</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="audiobook">
                            <label class="form-check-label" for="audiobook">Sách nói</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="audiobook">
                            <label class="form-check-label" for="audiobook">Podcast</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="audiobook">
                            <label class="form-check-label" for="audiobook">Blog</label>
                        </div>
                    </div>

                <div class="filter-section">
                    <h6 class="text-muted mb-3">Đánh giá</h6>
                        <ul>
                            <li><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></a></li>
                            <li><a href="#"><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Product List -->
        <section class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="text-muted">Hiển thị 120 kết quả</div>
                <select class="form-select w-auto">
                    <option>Sắp xếp theo</option>
                    <option>Phổ biến nhất</option>
                    <option>Giá tăng dần</option>
                    <option>Giá giảm dần</option>
                </select>
            </div>

            <div class="row g-4">
                <!-- Product Item -->
                <div class="product-list">
                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 1">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">200.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </p>
                        </div>
                    </div>
                    
                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>

                    <div class="product-card">
                        <img src="IMG/bookIMG.png" alt="Product 2">
                        <div class="product-info">
                            <h3> Hoàng tử bé </h3>
                            <p>Mô tả ngắn về sản phẩm</p>
                            <p class="price">150.000đ</p>
                            <p class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </p>
                        </div>
                    </div>
               

            </div>

            <!-- Pagination -->
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Trước</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Sau</a>
                    </li>
                </ul>
            </nav>
        </section>
    </div>
</main>
@endsection