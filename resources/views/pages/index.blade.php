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

{{-- AI --}}
  <button id="chatbot-toggler">
        <span class="material-symbols-rounded">mode_comment</span>
        <span class="material-symbols-rounded">close</span>
    </button>
    <div class="chatbot-popup">
        <!-- Chatbot Header -->
        <div class="chat-header">
            <div class="header-info">
            <svg class="chatbot-logo" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 1024 1024">
                <path
                d="M738.3 287.6H285.7c-59 0-106.8 47.8-106.8 106.8v303.1c0 59 47.8 106.8 106.8 106.8h81.5v111.1c0 .7.8 1.1 1.4.7l166.9-110.6 41.8-.8h117.4l43.6-.4c59 0 106.8-47.8 106.8-106.8V394.5c0-59-47.8-106.9-106.8-106.9zM351.7 448.2c0-29.5 23.9-53.5 53.5-53.5s53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5-53.5-23.9-53.5-53.5zm157.9 267.1c-67.8 0-123.8-47.5-132.3-109h264.6c-8.6 61.5-64.5 109-132.3 109zm110-213.7c-29.5 0-53.5-23.9-53.5-53.5s23.9-53.5 53.5-53.5 53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5zM867.2 644.5V453.1h26.5c19.4 0 35.1 15.7 35.1 35.1v121.1c0 19.4-15.7 35.1-35.1 35.1h-26.5zM95.2 609.4V488.2c0-19.4 15.7-35.1 35.1-35.1h26.5v191.3h-26.5c-19.4 0-35.1-15.7-35.1-35.1zM561.5 149.6c0 23.4-15.6 43.3-36.9 49.7v44.9h-30v-44.9c-21.4-6.5-36.9-26.3-36.9-49.7 0-28.6 23.3-51.9 51.9-51.9s51.9 23.3 51.9 51.9z"
                />
            </svg>
            <h2 class="logo-text">Chatbot</h2>
            </div>
            <button id="close-chatbot" class="material-symbols-rounded">keyboard_arrow_down</button>
        </div>
        <!-- Chatbot Body -->
        <div class="chat-body">
            <div class="message bot-message">
            <svg class="bot-avatar" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 1024 1024">
                <path
                d="M738.3 287.6H285.7c-59 0-106.8 47.8-106.8 106.8v303.1c0 59 47.8 106.8 106.8 106.8h81.5v111.1c0 .7.8 1.1 1.4.7l166.9-110.6 41.8-.8h117.4l43.6-.4c59 0 106.8-47.8 106.8-106.8V394.5c0-59-47.8-106.9-106.8-106.9zM351.7 448.2c0-29.5 23.9-53.5 53.5-53.5s53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5-53.5-23.9-53.5-53.5zm157.9 267.1c-67.8 0-123.8-47.5-132.3-109h264.6c-8.6 61.5-64.5 109-132.3 109zm110-213.7c-29.5 0-53.5-23.9-53.5-53.5s23.9-53.5 53.5-53.5 53.5 23.9 53.5 53.5-23.9 53.5-53.5 53.5zM867.2 644.5V453.1h26.5c19.4 0 35.1 15.7 35.1 35.1v121.1c0 19.4-15.7 35.1-35.1 35.1h-26.5zM95.2 609.4V488.2c0-19.4 15.7-35.1 35.1-35.1h26.5v191.3h-26.5c-19.4 0-35.1-15.7-35.1-35.1zM561.5 149.6c0 23.4-15.6 43.3-36.9 49.7v44.9h-30v-44.9c-21.4-6.5-36.9-26.3-36.9-49.7 0-28.6 23.3-51.9 51.9-51.9s51.9 23.3 51.9 51.9z"
                />
            </svg>
            <!-- prettier-ignore -->
            <div class="message-text"> Xin chào 👋<br /> Tôi có thể giúp gì cho bạn hôm nay? </div>
            </div>
        </div>
        <!-- Chatbot Footer -->
        <div class="chat-footer">
            <form action="#" class="chat-form">
            <textarea placeholder="Message..." class="message-input" required></textarea>
            <div class="chat-controls">
                <button type="button" id="emoji-picker" class="material-symbols-outlined">sentiment_satisfied</button>
                <div class="file-upload-wrapper">
                <input type="file" id="file-input" hidden />
                <img src="#" />
                <button type="button" id="file-upload" class="material-symbols-rounded">attach_file</button>
                <button type="button" id="file-cancel" class="material-symbols-rounded">close</button>
                </div>
                <button type="submit" id="send-message" class="material-symbols-rounded">arrow_upward</button>
            </div>
            </form>
        </div>
    </div>
      

   

@endsection

@section('js')
    @vite(['resources/js/chatbot.js'])
@endsection