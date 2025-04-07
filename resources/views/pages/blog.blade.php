@extends('layouts.master', ['hideHeaderFooter' => false])

@section('title', 'Debook - Blog')
@section('css')
    @vite(['resources/css/blog.css'])
@endsection
@section('js')
    @vite(['resources/js/blog.js'])
@endsection

@section('content')

</section>
  
<section class="blog-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <!-- Tiêu đề Blog -->
            <div class="col-sm-9 col-12 mb-3">
                <h2 class="text-left mb-0 text-success">BLOG CỘNG ĐỒNG</h2>
            </div>
            <!-- Form thêm bài review -->
            <div class="col-sm-3 col-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Thêm blog  
                </button>
            </div>
        </div>
        <div class="row" id="blog-posts">
            <!-- Book Card 1 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "./blogDetail.html" class="card-title text-success">Khám Phá Vũ Trụ</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>15/03/2025</p>
                                <p class="card-text">Một hành trình đầy thú vị qua các thiên hà và bí mật của vũ trụ bao la.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Nguyễn Văn A</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Card 2 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Bí Mật Của Hạnh Phúc</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>16/03/2025</p>
                                <p class="card-text">Khám phá những nguyên tắc đơn giản nhưng mạnh mẽ để sống một cuộc đời hạnh phúc.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Trần Thị B</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Card 3 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Lập Trình Cho Người Mới Bắt Đầu</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 17/03/2025</p>
                                <p class="card-text">Hướng dẫn từng bước để bắt đầu hành trình lập trình của bạn.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Lê Văn C</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Card 4 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Hành Trình Khám Phá Bản Thân</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 18/03/2025</p>
                                <p class="card-text">Hiểu rõ bản thân để sống một cuộc đời ý nghĩa hơn.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Phạm Thị D</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Card 5 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Nghệ Thuật Sống Tối Giản</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 19/03/2025</p>
                                <p class="card-text">Cách sống đơn giản để tận hưởng cuộc sống trọn vẹn.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Hoàng Văn E</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Book Card 6 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Hành Trình Đến Thành Công</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 20/03/2025</p>
                                <p class="card-text">Bí quyết để đạt được mục tiêu trong cuộc sống.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Nguyễn Thị F</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bài viết ẩn 1 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post hidden">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Bài viết ẩn 1</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 21/03/2025</p>
                                <p class="card-text">Nội dung bài viết ẩn 1.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Tác giả ẩn 1</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bài viết ẩn 2 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post hidden">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Bài viết ẩn 2</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 22/03/2025</p>
                                <p class="card-text">Nội dung bài viết ẩn 2.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Tác giả ẩn 2</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bài viết ẩn 3 -->
            <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post hidden">
                <div class="card h-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="IMG/book2.jpg" class="card-img-top img-fluid custom-img" alt="Book Cover">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href= "#" class="card-title text-success">Bài viết ẩn 3</a>
                                <p class="card-text"><strong>Ngày đăng: </strong>: 23/03/2025</p>
                                <p class="card-text">Nội dung bài viết ẩn 3.</p>
                                <p class="card-text"><strong>Tác giả:</strong> Tác giả ẩn 3</p>
                                <div class="post-meta">
                                    <div class="rating">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <div class="views">
                                        <i class="fas fa-eye"></i> 1234 lượt xem
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="text-center mt-4">
            <button id="load-more" class="btn btn-primary">Xem thêm</button>
        </div>
    </div>
</section>

  

<!-- Modal -->
<div class="modal fade mymodal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="modal-title fs-5" id="exampleModalLabel">Thêm blog</a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="review-form" class="d-flex flex-wrap gap-2 align-items-end border p-3 rounded">
                    <div class="flex-grow-1">
                        <label for="review-title" class="form-label">Tiêu đề:</label>
                        <input type="text" class="form-control" id="review-title" placeholder="Nhập tiêu đề" required>
                    </div>
                    <div class="flex-grow-1">
                        <label for="review-author" class="form-label">Tác giả:</label>
                        <input type="text" class="form-control" id="review-author" placeholder="Nhập tên tác giả" required>
                    </div>
                    <div class="flex-grow-1">
                        <label for="review-content" class="form-label">Nội dung:</label>
                        <textarea class="form-control" id="review-content" placeholder="Nhập nội dung blog" rows="4" required></textarea>
                    </div>
                    <div class="flex-grow-1">
                        <label for="review-image" class="form-label">Ảnh:</label>
                        <input type="file" class="form-control" id="review-image" accept="image/*" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success add__button">Thêm</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-success">Thêm</button>
            </div>
        </div>
    </div>
</div>
  
@endsection