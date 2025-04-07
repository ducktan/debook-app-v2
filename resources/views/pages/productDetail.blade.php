@extends('layouts.master', ['hideHeaderFooter' => false])

@section('title', 'Debook - Chi tiêt sản phẩm')
@section('css')
    @vite(['resources/css/productDetail.css'])
@endsection

@section('content')

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row g-5">
            <!-- Product Gallery (Bên trái) -->
            <div class="col-lg-6">
                <div class="main-image mb-3">
                    <img src="IMG/bookIMG.png" class="img-fluid rounded-3 shadow" alt="Sách Hoàng Tử Bé">
                </div>
                <div class="thumbnail-grid row g-2">
                    <div class="col-3">
                        <img src="IMG/bookIMG.png" class="img-fluid rounded-2 cursor-pointer" alt="Thumbnail 1">
                    </div>
                    <div class="col-3">
                        <img src="IMG/bookIMG.png" class="img-fluid rounded-2 cursor-pointer" alt="Thumbnail 2">
                    </div>
                    <div class="col-3">
                        <img src="IMG/bookIMG.png" class="img-fluid rounded-2 cursor-pointer" alt="Thumbnail 3">
                    </div>
                    <div class="col-3">
                        <img src="IMG/bookIMG.png" class="img-fluid rounded-2 cursor-pointer" alt="Thumbnail 4">
                    </div>
                </div>
            </div>

            <!-- Product Info (Bên phải) -->
            <div class="col-lg-6">
                <h1 class="mb-3">Hoàng Tử Bé</h1>
                <div class="book-info mb-3">
                    <div class="text-muted">Tác giả: Antoine de Saint-Exupéry</div>
                    <div class="text-muted">Nhà xuất bản: Nhà xuất bản Kim Đồng</div>
                </div>
                <div class="rating mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                    <span class="ms-2">(4.5/5)</span>
                </div>

                <!-- Giá sản phẩm -->
                <div class="price-section mb-4">
                    <span class="h3 text-success">200.000đ</span>
                    <del class="text-muted ms-2">250.000đ</del>
                </div>

                <!-- Chọn định dạng -->
                <div class="format-select mb-4">
                    <h5>Chọn định dạng:</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-success active">Sách điện tử</button>
                        <button type="button" class="btn btn-outline-success">Sách nói</button>
                        <button type="button" class="btn btn-outline-success">PDF Premium</button>
                    </div>
                </div>

                <!-- Số lượng -->
                <div class="quantity-selector mb-4">
                    <h5>Số lượng:</h5>
                    <div class="input-group w-25">
                        <button class="btn btn-outline-success" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-success" type="button">+</button>
                    </div>
                </div>

                <!-- Nút Thêm vào giỏ hàng và Mua ngay -->
                <button class="btn btn-success btn-lg me-3 rounded-pill">
                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ hàng
                </button>
                <button class="btn btn-warning btn-lg rounded-pill">
                    Mua ngay
                </button>
                <!-- Tóm tắt sách -->
                <div class="book-summary">
                    <h5 class="summary-title">Tóm tắt sách</h5>
                    <p class="summary-text">
                        "Hoàng Tử Bé" là tác phẩm kinh điển kể về cuộc gặp gỡ giữa một phi công bị rơi máy bay ở sa mạc Sahara với một cậu bé đến từ tiểu tinh cầu B612. Qua câu chuyện đầy chất thơ và triết lý, tác giả đưa chúng ta đến với những bài học sâu sắc về tình yêu, tình bạn và ý nghĩa thực sự của cuộc sống...
                    </p>
                    <a href="#" class="read-more">Đọc thêm <i class="fas fa-chevron-down"></i></a>
                </div>
            </div>
        </div>
    </main>
<!-- Phần Đánh giá -->
<section class="reviews-section mt-5">
    <div class="container">
        <h2 class="mb-4">Đánh giá sản phẩm</h2>
        
        <!-- Tổng quan đánh giá -->
        <div class="review-summary row mb-5">
            <div class="col-md-4 text-center">
                <div class="average-rating mb-2">
                    <span class="display-4 text-warning">4.5</span>
                </div>
                <div class="stars mb-3">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                </div>
                <p class="text-muted">Dựa trên 128 đánh giá</p>
            </div>
            <div class="col-md-8">
                <div class="rating-bars">
                    <div class="rating-bar mb-2">
                        <span class="me-2">5 <i class="fas fa-star text-warning"></i></span>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ms-2">75%</span>
                    </div>
                    <div class="rating-bar mb-2">
                        <span class="me-2">4 <i class="fas fa-star text-warning"></i></span>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ms-2">15%</span>
                    </div>
                    <div class="rating-bar mb-2">
                        <span class="me-2">3 <i class="fas fa-star text-warning"></i></span>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 7%;" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ms-2">7%</span>
                    </div>
                    <div class="rating-bar mb-2">
                        <span class="me-2">2 <i class="fas fa-star text-warning"></i></span>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 2%;" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ms-2">2%</span>
                    </div>
                    <div class="rating-bar mb-2">
                        <span class="me-2">1 <i class="fas fa-star text-warning"></i></span>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 1%;" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="ms-2">1%</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Nút viết đánh giá -->
        <button class="btn btn-success mb-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#reviewModal">
            <i class="fas fa-pen me-2"></i>Viết đánh giá
        </button>
        
        <!-- Danh sách đánh giá -->
        <div class="review-list">
            <!-- Đánh giá 1 -->
            <div class="review-item card mb-4">
                <div class="card-body">
                    <div class="review-header d-flex justify-content-between mb-3">
                        <div class="user-info d-flex align-items-center">
                            <img src="IMG/signin-image.jpg" alt="User Avatar" class="rounded-circle me-3" width="40" height="40">
                            <div>
                                <h6 class="mb-0">Nguyễn Văn A</h6>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="ms-2 text-muted">2 ngày trước</span>
                                </div>
                            </div>
                        </div>
                        <div class="review-actions">
                            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    <div class="review-content">
                        <h5 class="mb-2">Sách hay, nội dung ý nghĩa</h5>
                        <p class="mb-2">Tôi rất thích cuốn sách này, nội dung sâu sắc và hình ảnh minh họa đẹp. Đây là một tác phẩm kinh điển mà mọi người nên đọc ít nhất một lần trong đời.</p>
                        <div class="review-images d-flex mt-3">
                            <img src="IMG/bookIMG.png" class="img-thumbnail me-2" width="80" height="80" alt="Review image 1">
                            <img src="IMG/bookIMG.png" class="img-thumbnail me-2" width="80" height="80" alt="Review image 2">
                        </div>
                    </div>
                    <div class="review-footer mt-3 d-flex justify-content-between">
                        <div class="helpful-count">
                            <button class="btn btn-sm btn-outline-success"><i class="far fa-thumbs-up me-1"></i> Hữu ích (12)</button>
                        </div>
                        <div class="report">
                            <button class="btn btn-sm btn-outline-danger">Báo cáo</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Đánh giá 2 -->
            <div class="review-item card mb-4">
                <div class="card-body">
                    <div class="review-header d-flex justify-content-between mb-3">
                        <div class="user-info d-flex align-items-center">
                            <img src="IMG/signup-image.jpg" alt="User Avatar" class="rounded-circle me-3" width="40" height="40">
                            <div>
                                <h6 class="mb-0">Trần Thị B</h6>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                    <span class="ms-2 text-muted">1 tuần trước</span>
                                </div>
                            </div>
                        </div>
                        <div class="review-actions">
                            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                    </div>
                    <div class="review-content">
                        <h5 class="mb-2">Sách đẹp nhưng giá hơi cao</h5>
                        <p class="mb-2">Nội dung sách rất hay nhưng tôi nghĩ giá hơi cao so với chất lượng giấy và bìa sách. Tuy nhiên đây vẫn là một cuốn sách đáng đọc.</p>
                    </div>
                    <div class="review-footer mt-3 d-flex justify-content-between">
                        <div class="helpful-count">
                            <button class="btn btn-sm btn-outline-success"><i class="far fa-thumbs-up me-1"></i> Hữu ích (5)</button>
                        </div>
                        <div class="report">
                            <button class="btn btn-sm btn-outline-danger">Báo cáo</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Xem thêm đánh giá -->
            <div class="text-center mt-4">
                <button class="btn btn-outline-success rounded-pill">Xem thêm đánh giá <i class="fas fa-chevron-down ms-2"></i></button>
            </div>
        </div>
    </div>
</section>

<!-- Modal viết đánh giá -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Viết đánh giá của bạn</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-4">
                        <label class="form-label">Đánh giá của bạn</label>
                        <div class="rating-input">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="5 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 sao"><i class="fas fa-star"></i></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reviewTitle" class="form-label">Tiêu đề đánh giá</label>
                        <input type="text" class="form-control" id="reviewTitle" placeholder="Ví dụ: Sách rất hay, đáng đọc">
                    </div>
                    <div class="mb-3">
                        <label for="reviewContent" class="form-label">Nội dung đánh giá</label>
                        <textarea class="form-control" id="reviewContent" rows="5" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm này"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh (tối đa 3 ảnh)</label>
                        <div class="image-upload d-flex">
                            <div class="upload-box me-2 border rounded d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; cursor: pointer;">
                                <i class="fas fa-plus fa-2x text-muted"></i>
                                <input type="file" class="d-none" accept="image/*" multiple>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-success">Gửi đánh giá</button>
            </div>
        </div>
    </div>
</div>
   

@endsection