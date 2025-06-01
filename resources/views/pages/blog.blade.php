@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Blog')
@section('css')
    @vite(['resources/css/blog.css'])
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
                         @foreach($posts as $post)
        <div class="card mb-4">
            <div class="row g-0">
                @if ($post->thumbnail)
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid rounded-start" alt="Ảnh bài viết">
                    </div>
                @endif

                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                        </h5>
                        <p class="card-text"><small class="text-muted">
                            Đăng ngày {{ $post->created_at->format('d/m/Y') }} bởi {{ $post->author }}
                        </small></p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <p class="card-text">
                            <i class="bi bi-heart-fill text-danger"></i> {{ $post->likes }} lượt thích |
                            <i class="bi bi-eye-fill text-secondary"></i> {{ $post->views }} lượt xem
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
      
      <!-- Tiêu đề modal -->
      <div class="modal-header">
        <a class="modal-title fs-5" id="exampleModalLabel">Thêm blog</a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Form thêm bài viết -->
      <div class="modal-body">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" id="review-form" class="d-flex flex-wrap gap-2 align-items-end border p-3 rounded">
          @csrf

          <div class="flex-grow-1">
            <label for="title" class="form-label">Tiêu đề:</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>

          <div class="flex-grow-1">
            <label for="excerpt" class="form-label">Mô tả ngắn:</label>
            <input type="text" class="form-control" id="excerpt" name="excerpt">
          </div>

          <div class="flex-grow-1">
            <label for="author" class="form-label">Tác giả:</label>
            <input type="text" class="form-control" id="author" name="author">
          </div>

          <div class="flex-grow-1">
            <label for="content" class="form-label">Nội dung:</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
          </div>

          <!-- Chọn ảnh thumbnail -->
          <div class="flex-grow-1">
            <label for="thumbnail" class="form-label">Ảnh thumbnail:</label>
            <div class="input-group">
              <input type="file" class="form-control d-none" id="thumbnail" name="thumbnail" accept="image/*">
              <button type="button" class="btn btn-success" onclick="document.getElementById('thumbnail').click()">Thêm ảnh</button>
            </div>
            <small id="file-chosen" class="text-muted mt-1 d-block">Chưa chọn ảnh</small>
            <img id="preview-image" src="#" alt="Ảnh preview" class="mt-2 rounded img-fluid d-none" style="max-height: 200px;">
          </div>

          <!-- Nút submit -->
          <div class="w-100 text-end mt-3">
            <button type="submit" class="btn btn-success">Thêm bài viết</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- JavaScript xử lý hiển thị tên file và preview ảnh -->
<script>
document.getElementById('thumbnail').addEventListener('change', function() {
  const file = this.files[0];
  const fileChosen = document.getElementById('file-chosen');
  const previewImage = document.getElementById('preview-image');

  if (file) {
    fileChosen.textContent = file.name;

    // Hiển thị ảnh preview
    const reader = new FileReader();
    reader.onload = function(e) {
      previewImage.src = e.target.result;
      previewImage.classList.remove('d-none');
    }
    reader.readAsDataURL(file);
  } else {
    fileChosen.textContent = 'Chưa chọn ảnh';
    previewImage.classList.add('d-none');
    previewImage.src = '#';
  }
});
</script>

  
@endsection