@extends('layouts.app')

@section('title', 'Debook - Trang chủ')
@section('css')
    @vite(['resources/css/index.css'])
@endsection

@section('content')
     <!-- Banner -->
  <style>
    /* Nút sticky mở podcast */
  


    .div-container {
  width: 100%;
  height: 300px; /* Chiều cao div */
  display: flex;
  justify-content: center;
  align-items: center;
}

.div-container img {
  height: 100%; /* Chiều cao của ảnh bằng với chiều cao div */
  width: auto; /* Đảm bảo chiều rộng của ảnh không bị kéo dài */
}

  .play-button {
    margin: 10px;
    background-color: rgb(179, 175, 124);
    color: white;
    padding: 5px 10px;
    font-size: 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    z-index: 999;
  }

  .audio-player {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top: 1px solid #ccc;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
    padding: 10px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transform: translateY(100%);
    transition: transform 0.3s ease-in-out;
    z-index: 1000;
    height: 10%;
  }

  .audio-player.show {
    transform: translateY(0);
  }

  .track-info {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 1;
    height: 48px;
    width:48px;
  }

  .track-cover {
 
    border-radius: 8px;
    max-height: 100%;
  width: auto;
  object-fit: cover;

  }

  .track-title {
    font-weight: bold;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .track-artist {
    font-size: 12px;
    color: #666;
  }

  .controls {
    display: flex;
    align-items: center;
    gap: 10px;
    flex: 2;
    justify-content: center;
  }

  .icon-btn {
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
  }

  .progress-bar {
    flex: 3;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  #seekBar {
    width: 100%;
    height: 4px;
    background: #ccc;
    border-radius: 4px;
    cursor: pointer;
    appearance: none;
  }

  #seekBar::-webkit-slider-thumb {
    appearance: none;
    width: 10px;
    height: 10px;
    background: #333;
    border-radius: 50%;
  }

  #currentTime, #duration {
    font-size: 12px;
    color: #555;
  }

  .right-icons {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  #volume {
    width: 60px;
  }

  .close-btn {
    position: absolute;
    top: 5px;
    right: 10px;
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
  }
</style>


  </style>
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
            <div class="category__item col-6 col-md-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            
            <div class="category__item col-6 col-md-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            <div class="category__item col-6 col-md-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            <div class="category__item col-6 col-md-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
          </div>





          
        </div>
        <div class="tab-pane fade" id="podcast" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="category__list row">
            <div class="category__item col-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            
            
            <div class="category__item col-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            <div class="category__item col-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
          </div>

        </div>
        <div class="tab-pane fade" id="blog" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
          <div class="category__list row">
            <div class="category__item col-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            
            <div class="category__item col-3">
              <div class="card">
                  
                </div>
                <div class="card-body">
                  <h5 class="card-title">SÁCH VĂN HỌC</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              </div>
              
            </div>
            
            
              
            </div>
          </div>

        </div>
      </div>
      </section>
  










 
  <!-- Audio Player -->
  <div class="audio-player container" id="audioPlayer">
    <button class="close-btn" onclick="document.getElementById('audioPlayer').style.display='none'">✖</button>
    <div class="track-info">
      <img src="" alt="Album Art" class="track-cover" >
      <div>
        <div class="track-title"></div>
        <div class="track-artist"></div>
      </div>
    </div>

    <audio id="audio" src="./amthanh/CheHo-WxrdieGillLucin3x-9070141.mp3"></audio>

    <div class="controls">
      <button onclick="toggleSpeed()" class="icon-btn" id="speed">1.0x</button>
      <button onclick="skip(-15)" class="icon-btn"><i class="fas fa-undo-alt"></i></button>
      <button onclick="playPause()" class="icon-btn"><i id="playIcon" class="fas fa-play"></i></button>
      <button onclick="skip(15)" class="icon-btn"><i class="fas fa-redo-alt"></i></button>
      <span id="currentTime">00:00</span>
      <div class="progress-bar">
        <input type="range" id="seekBar" min="0" value="0">
      </div>
      <span id="duration">03:20</span>

      <div class="right-icons">
        <i class="fas fa-volume-up icon-btn" id="volumeIcon"></i>
        <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
      </div>
</div>

  </div>

  <!-- book read tram create -->
 <section class="book container section">
  <div class="book__list row" style="margin: 0;">
    @foreach ($books as $book)
      <div class="card col-3" style="width: 15rem; padding: 0;">
        <img src="{{ asset($book->image_path) }}" class="card-img-top" alt="book">
        <div class="card-body">
          <h5 class="card-title">{{ $book->title }} - {{ $book->author }} - Tặng kèm Bookmark</h5>
          <div class="card-price">
            <p class="card-text">{{ number_format($book->price, 0, ',', '.') }}đ</p>

            <!-- Nút đọc sách: chuyển trang -->
            <a href="{{ route('books.read', ['id' => $book->id]) }}" class="btn btn-primary read-button">
              Đọc sách
            </a>

            <div class="card-promotion">
              -{{ round(100 - ($book->price / $book->original_price * 100)) }}%
            </div>
          </div>
          <del>{{ number_format($book->original_price, 0, ',', '.') }}đ</del>
          <div class="card-star" style="color: rgb(255, 205, 68);">
            <i class="fa fa-star"></i><i class="fa fa-star"></i>
            <i class="fa fa-star"></i><i class="fa fa-star"></i>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>







<!-- Tram create podcast--> 

 <section class="book container section">
  <div class="book__list row" style="margin: 0;">
  @foreach ($books as $book)
  <div class="card col-3" style="width: 15rem; padding: 0;">
    <img src="{{ asset($book->image_path) }}" class="card-img-top" alt="book">
    <div class="card-body">
      <h5 class="card-title">{{ $book->title }} - {{ $book->author }} - Tặng kèm Bookmark</h5>
      <div class="card-price">
        <p class="card-text">{{ number_format($book->price, 0, ',', '.') }}đ</p>

        <!-- Nút nghe podcast -->
        <button class="play-button" data-audio="{{ asset($book->audio_path) }}">🎧 Nghe Podcast</button>

        <div class="card-promotion">
          -{{ round(100 - ($book->price / $book->original_price * 100)) }}%
        </div>
      </div>
      <del>{{ number_format($book->original_price, 0, ',', '.') }}đ</del>
      <div class="card-star" style="color: rgb(255, 205, 68);">
        <i class="fa fa-star"></i><i class="fa fa-star"></i>
        <i class="fa fa-star"></i><i class="fa fa-star"></i>
      </div>
    </div>
  </div>
  @endforeach
</div>
 </section>

      
      <!-- Book -->

      <section class="book container section">
        <p class="title">SÁCH NỔI BẬT</p>
        <div class="book__list row" style="margin: 0;">
          <div class="card col-3" style="width: 15rem; padding: 0;">
            <img src="{{ asset($book->image_url) }}" class="card-img-top" alt="book">
            <div class="card-body">
              <h5 class="card-title">Đôi mắt - Nam Cao - Tặng kèm Bookmark</h5>
             <div class="card-price">
              <p class="card-text">39.000đ</p>
             
              <div class="card-promotion">-75%</div>
             </div> 
             <del>150.000đ</del>
             <div class="card-star" style="color: rgb(255, 205, 68);">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>  
             </div>
            </div>
          </div>
  
          <div class="card col-3" style="width: 15rem; padding: 0;">
              <img src="{{ asset('assets/img/book2.jpg') }}" class="card-img-top" alt="book">
            <div class="card-body">
              <h5 class="card-title">Đôi mắt - Nam Cao - Tặng kèm Bookmark</h5>
             <div class="card-price">
              <p class="card-text">39.000đ</p>
             

              <div class="card-promotion">-75%</div>
             </div> 
             <del>150.000đ</del>
             <div class="card-star" style="color: rgb(255, 205, 68);">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>  
             </div>
            </div>
          </div>
  
          <div class="card col-3" style="width: 15rem; padding: 0;">
              <img src="{{ asset('assets/img/book2.jpg') }}" class="card-img-top" alt="book">
            <div class="card-body">
              <h5 class="card-title">Đôi mắt - Nam Cao - Tặng kèm Bookmark</h5>
             <div class="card-price">
              <p class="card-text">39.000đ</p>
            
              <div class="card-promotion">-75%</div>
             </div> 
             <del>150.000đ</del>
             <div class="card-star" style="color: rgb(255, 205, 68);">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>  
             </div>
            </div>
          </div>
  
          <div class="card col-3" style="width: 15rem; padding: 0;">
              <img src="{{ asset('assets/img/book2.jpg') }}" class="card-img-top" alt="book">
            <div class="card-body">
              <h5 class="card-title">Đôi mắt - Nam Cao - Tặng kèm Bookmark</h5>
             <div class="card-price">
              <p class="card-text">39.000đ</p>
      
              <div class="card-promotion">-75%</div>
             </div> 
             <del>150.000đ</del>
             <div class="card-star" style="color: rgb(255, 205, 68);">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>  
             </div>
            </div>
          </div>
  
       
        </div>
      </section>
  


      <!-- Podcast -->
  
      <section class="book container section">
        <p class="title">PODCAST</p>
        <div class="book__list row" style="margin: 0;">
          <div class="card col-3" style="width: 15rem; padding: 0;">
            <img src="{{ asset($podcast->image_url) }}" class="card-img-top" alt="podcast">
            <div class="card-body">
              <h5 class="card-title">Đôi mắt - Nam Cao - Tặng kèm Bookmark</h5>
             <div class="card-price">
              <p class="card-text">39.000đ</p>
           
              <div class="card-promotion">-75%</div>
             </div> 
             <del>150.000đ</del>
             <div class="card-star" style="color: rgb(255, 205, 68);">
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>  
             </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>

  
  
      <!-- Playlist -->
  
      <section class="playlist container section">
        <p class="title">PLAYLIST YÊU THÍCH</p>
        
        <div class="row playlist__row">
          <div class="playlist__item col-md-3 col-6">
            <div class="playlist__img"></div>
            <div class="playlist__content">
              <h5 class="playlist__title">Trạm dừng cảm xúc</h5>
              <p class="playlist__author">Podcast chữa lành</p>
            </div>
          </div>
  
          <div class="playlist__item col-md-3 col-6">
            <div class="playlist__img"></div>
            <div class="playlist__content">
              <h5 class="playlist__title">Trạm dừng cảm xúc</h5>
              <p class="playlist__author">Podcast chữa lành</p>
            </div>
          </div>
  
          <div class="playlist__item col-md-3 col-6">
            <div class="playlist__img"></div>
            <div class="playlist__content">
              <h5 class="playlist__title">Trạm dừng cảm xúc</h5>
              <p class="playlist__author">Podcast chữa lành</p>
            </div>
          </div>
  
          <div class="playlist__item col-md-3 col-6">
            <div class="playlist__img"></div>
            <div class="playlist__content">
              <h5 class="playlist__title">Trạm dừng cảm xúc</h5>
              <p class="playlist__author">Podcast chữa lành</p>
            </div>
          </div>
  
          
        </div>
        
      </section>






  <!--   thêm  -->





<script>


document.querySelectorAll('.play-button').forEach(function (btn) {
  btn.addEventListener('click', function () {
    const audioPlayer = document.getElementById('audioPlayer');
    audioPlayer.classList.add('show');
  });
});


  const audio = document.getElementById('audio');
  const seekBar = document.getElementById('seekBar');
  const currentTimeEl = document.getElementById('currentTime');
  const durationEl = document.getElementById('duration');
  const playIcon = document.getElementById('playIcon');
  const speedBtn = document.getElementById('speed');
  const volumeIcon = document.getElementById('volumeIcon');
  let speed = 1.0;

  function playPause() {
    if (audio.paused) {
      audio.play();
      playIcon.classList.replace('fa-play', 'fa-pause');
    } else {
      audio.pause();
      playIcon.classList.replace('fa-pause', 'fa-play');
    }
  }

  function skip(seconds) {
    audio.currentTime += seconds;
  }

  function toggleSpeed() {
    speed += 0.25;
    if (speed > 2) speed = 1.0;
    audio.playbackRate = speed;
    speedBtn.innerText = speed.toFixed(1) + 'x';
  }

  audio.ontimeupdate = () => {
    seekBar.max = audio.duration;
    seekBar.value = audio.currentTime;
    currentTimeEl.textContent = formatTime(audio.currentTime);
    durationEl.textContent = formatTime(audio.duration);
  };

  seekBar.oninput = (e) => {
    audio.currentTime = e.target.value;
  };

  document.getElementById('volume').oninput = (e) => {
    const volume = e.target.value;
    audio.volume = volume;

    if (volume == 0) {
      volumeIcon.className = 'fas fa-volume-mute icon-btn';
    } else if (volume < 0.5) {
      volumeIcon.className = 'fas fa-volume-down icon-btn';
    } else {
      volumeIcon.className = 'fas fa-volume-up icon-btn';
    }
  };

  // 👉 Xử lý tất cả các nút play-button
  const playButtons = document.querySelectorAll('.play-button');
  playButtons.forEach(button => {
    button.addEventListener('click', function () {
      const audioSrc = this.getAttribute('data-audio');
      audio.src = audioSrc;
      audio.play();
      playIcon.classList.replace('fa-play', 'fa-pause');
      document.getElementById('audioPlayer').style.display = 'block';
    });
  });

  function closePlayer() {
    const audioPlayer = document.getElementById('audioPlayer');
    audio.pause();
    playIcon.classList.replace('fa-pause', 'fa-play');
    audioPlayer.classList.remove('show');
    audioPlayer.style.display = 'none';
  }

  function formatTime(seconds) {
    const min = Math.floor(seconds / 60).toString().padStart(2, '0');
    const sec = Math.floor(seconds % 60).toString().padStart(2, '0');
    return `${min}:${sec}`;
  }

</script>


  
      <!-- Contact -->
      <section class="contact container-fluid section">
      
          <div class="contact__text">
            <p>Điền thông tin ngay để nhận thông báo nhé!</p>
            <form>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </section>
  

   

@endsection
