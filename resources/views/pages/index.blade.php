@extends('layouts.app')

@section('title', 'Debook - Trang chủ')
@section('css')
    @vite(['resources/css/index.css'])
@endsection

@section('content')


  
     <!-- Banner -->
      <section class="banner container-fluid bg-dark banner section">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('assets/img/banner1.png') }}" class="d-block w-100" alt="banner1">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/img/banner2.png') }}" class="d-block w-100" alt="banner2">
            </div>
            <div class="carousel-item">
              <img src="{{ asset('assets/img/banner3.jpg') }}" class="d-block w-100" alt="banner3">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        
      </section>
  
      <!-- Category --> 
    <section class="category container section">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#book-cate" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Danh mục sách</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#podcast" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Podcast</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#blog" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Blog</button>
        </li>
      </ul>


      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="book-cate" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
          <div class="category__list row">
            @foreach($categories as $category)
            <div class="category__item col-6 col-md-3">
                <a href="{{ route('categories.show', $category->slug) }}" class="card-link">
                    <div class="card" style="background-image: url('{{ asset('storage/images/categories/' . $category->image_url ?? 'assets/img/Logo.png') }}');">
                        <!-- Nội dung card sẽ không bị thay đổi do a bọc ngoài -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->description }}</p>
                    </div>
                </a>
            </div>
        @endforeach
        
          </div> <!-- thêm cái này -->
      </div>
      
      <div class="tab-pane fade" id="podcast" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="category__list row">
            @foreach($podcasts as $podcast)
            <div class="category__item col-6 col-md-3">
                <a href="{{ route('products.show', $podcast->id) }}" class="text-decoration-none text-reset">
                    <div class="card" style="background-image: url('{{ asset('storage/images/products/'. ($podcast->image_url ?? 'assets/img/Logo.png')) }}');"></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $podcast->title }}</h5>
                        <p class="card-text">{{ $podcast->description }}</p>
                    </div>
                </a>
            </div>
            @endforeach
          </div>

      </div>
      
      <div class="tab-pane fade" id="blog" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
       <div class="category__list row">
          @foreach($blogs as $blog)
          <div class="category__item col-3">
              <div class="card" style="background-image: url('{{ asset('storage/' . ($blog->image_url ?? 'default-blog.png')) }}'); height: 200px; background-size: cover; background-position: center;"></div>
              <div class="card-body">
                  <h5 class="card-title">{{ $blog->title }}</h5>
                  <p class="card-text">{{ Str::limit(strip_tags($blog->content), 100) }}</p>
              </div>
          </div>
          @endforeach
        </div>
      </div> 
      
        
      </div>
  </section>
  
      <!-- Book -->
      <!-- SÁCH NỔI BẬT -->
    <section class="book container section">
  <p class="title">SÁCH NỔI BẬT</p>
  <div class="book__list row" style="margin: 0;">
    @foreach($ebooks as $book)
      <div class="card col-3" style="width: 15rem; padding: 0;">
        <a href="{{ route('products.show', $book->id) }}">
          <img src="{{ asset('storage/images/products/'. $book->image_url) }}" class="card-img-top" alt="book">
        </a>
        <div class="card-body">
          <a href="{{ route('products.show', $book->id) }}" style="text-decoration:none; color: inherit;">
            <h5 class="card-title">{{ $book->title }}</h5>
          </a>
          <div class="card-price">
            <p class="card-text">{{ number_format($book->price, 0, ',', '.') }}đ</p>
          </div>
          <div class="card-star" style="color: rgb(255, 205, 68);">
            @php
              $avgRating = round($book->rating);
            @endphp
            @for($i = 0; $i < $avgRating; $i++)
              <i class="fa fa-star"></i>
            @endfor
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>


    <!-- PODCAST -->
    <!-- PODCAST -->
<section class="book container section">
  <p class="title">PODCAST</p>
  <div class="book__list row" style="margin: 0;">
    @foreach($podcasts as $podcast)
      <div class="card col-3" style="width: 15rem; padding: 0;">
        <a href="{{ route('products.show', $podcast->id) }}">
          <img src="{{ asset('storage/images/products/'. $podcast->image_url) }}" class="card-img-top" alt="podcast">
        </a>
        <div class="card-body">
          <a href="{{ route('products.show', $podcast->id) }}" style="text-decoration:none; color: inherit;">
            <h5 class="card-title">{{ $podcast->title }}</h5>
          </a>
          <div class="card-price">
            <p class="card-text">{{ number_format($podcast->price, 0, ',', '.') }}đ</p>
          </div>
          <div class="card-star" style="color: rgb(255, 205, 68);">
            @php
              $avgRating = round($podcast->rating);
            @endphp
            @for($i = 0; $i < $avgRating; $i++)
              <i class="fa fa-star"></i>
            @endfor
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>


  
  
      <!-- Playlist -->
  <section class="playlist container section">
    <p class="title">LỜI HAY Ý ĐẸP</p>

    <div class="row playlist__row">
        @forelse($fiveStarComments as $comment)
            <div class="playlist__item col-md-3 col-6">
                <div class="playlist__img" style="background-image: url('{{ asset('storage/images/avatar/' . ($comment->user->avatar ?? 'default-avatar.png')) }}'); background-size: cover; background-position: center; height: 150px; border-radius: 8px;"></div>
                <div class="playlist__content">
                    <h5 class="playlist__title">{{ $comment->user->name ?? 'Người dùng ẩn danh' }}</h5>
                    <p class="playlist__author" style="font-style: italic; font-size: 0.9rem;">{{ Str::limit($comment->content, 100) }}</p>
                    <div style="color: #FFC107;">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Chưa có bình luận 5 sao nào.</p>
        @endforelse
    </div>
</section>

  
      <!-- Contact -->
      <section class="contact container-fluid section">
        <div class="contact__text">
          <p>Điền thông tin ngay để nhận thông báo nhé!</p>
      
          <form action="{{ route('subscribe') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
              <div id="emailHelp" class="form-text">Chúng tôi sẽ không chia sẻ email của bạn với ai khác.</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      
          @if(session('success'))
              <script>
                  alert("{{ session('success') }}");
              </script>
          @endif
      
        </div>
      </section>
      

   

@endsection
