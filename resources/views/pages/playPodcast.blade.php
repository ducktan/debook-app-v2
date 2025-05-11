@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Play Podcast')
@section('css')
    @vite(['resources/css/playPodcast.css'])
@endsection


@section('content')

<div class="podcast-container container">
    <div class="podcast-heade row">
        <div class="podcast-image col-md-6 col-12 mb-3">
            <img src="./IMG/playlist1.jpg" alt="Podcast Cover">
            
        </div>
        <div class="podcast-info col-md-6 col-12">
            <h1>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</h1>
            <div class="rating d-flex">
                <span class="score">5.0</span> 
                <div class="card-star" style="color: rgb(255, 205, 68);">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>  
                   </div>
                <span class="reviews">• 1 đánh giá</span>
            </div>
            <div class="trending">
                <span class="badge">#1</span> trong Top xu hướng Podcast
            </div>
            <p class="author">Tác giả: <strong>Vô danh tiểu tốt</strong></p>
            <div class="actions">
                <button class="follow-btn"><i class="fas fa-bell"></i> Theo dõi</button>
                <button class="share-btn"><i class="fas fa-share-alt"></i></button>
            </div>
            <div class="description">
                <p>"Vỗ Về Những Đứa Trẻ Đang Tập Lớn" là nơi chúng mình chia sẻ những câu chuyện khác nhau trong hành trình trưởng thành từ tình yêu, đến ước mơ và cả những khó khăn thử thách...Vỗ Về Những Đứa Trẻ Đang Tập Lớn" là nơi chúng mình chia sẻ những câu chuyện khác nhau trong hành trình trưởng thành từ tình yêu, đến ước mơ và cả những khó khăn thử thách..Vỗ Về Những Đứa Trẻ Đang Tập Lớn" là nơi chúng mình chia sẻ những câu chuyện khác nhau trong hành trình trưởng thành từ tình yêu, đến ước mơ và cả những khó khăn thử thách...Vỗ Về Những Đứa Trẻ Đang Tập Lớn" là nơi chúng mình chia sẻ những câu chuyện khác nhau trong hành trình trưởng thành từ tình yêu, đến ước mơ và cả những khó khăn thử thách..</p>
                <a href="#" class="see-more">Xem thêm</a>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const description = document.querySelector(".description");
                    const seeMoreBtn = document.querySelector(".see-more");
            
                    seeMoreBtn.addEventListener("click", function (event) {
                        event.preventDefault(); // Ngăn trang tải lại
                        description.classList.toggle("expanded");
            
                        if (description.classList.contains("expanded")) {
                            seeMoreBtn.textContent = "Thu gọn";
                        } else {
                            seeMoreBtn.textContent = "Xem thêm";
                        }
                    });
                });
            </script>
            
        </div>
    </div>

    <div class="episode-list">
        <h2>Danh sách tập (11)</h2>
        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>


        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>


        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>

        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>

        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>


        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>



        <div class="episode">
            <div class="episode-image">
                <img src="./IMG/playlist1.jpg" alt="Episode Cover">
            </div>
            <div class="episode-info">
                <a href="#" class="episode-title">Vẽ 2 chữ định mệnh</a>
                <p><strong>Vỗ Về Những Đứa Trẻ Đang Tập Lớn</strong> | 20/03/2025</p>
                <p>Chào mừng bạn đến với podcast "Vỗ về những đứa trẻ tập lớn". Trong tập này, chúng ta sẽ cùng khám phá khái niệm "định...</p>
            </div>
            <div class="episode-stats">
                <i class="fas fa-headphones"></i> 4,5K
                <button id="playButton" class="play-button">
                    <i class="fas fa-play"></i>
                </button>
            </div>
        </div>
    </div>



</div>



<!-- phần play podcast -->

<div class="audio-player container" id="audioPlayer">
<div class="track-info">
    <img src="./IMG/playlist1.jpg" alt="Album Art" class="track-cover">
    <div>
        <div class="track-title">Cậu là chính cậu và th...</div>
        <div class="track-artist">Vỗ Về Những Đứa Trẻ Đang Tập Lớn</div>
    </div>
</div>

<audio id="audio" src="./img/CheHo-WxrdieGillLucin3x-9070141.mp3"></audio>

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
      <i class="fas fa-list icon-btn"></i>
      <i class="fas fa-user-friends icon-btn"></i>
      <i class="fas fa-volume-up icon-btn"></i>
      <input type="range" id="volume" min="0" max="1" step="0.01" value="1">
    </div>
</div>
</div>

<script>
const audio = document.getElementById('audio');
const seekBar = document.getElementById('seekBar');
const currentTimeEl = document.getElementById('currentTime');
const durationEl = document.getElementById('duration');
const playIcon = document.getElementById('playIcon');
const speedBtn = document.getElementById('speed');
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
};

seekBar.oninput = (e) => {
audio.currentTime = e.target.value;
};

document.getElementById('volume').oninput = (e) => {
audio.volume = e.target.value;
};

function formatTime(seconds) {
const min = Math.floor(seconds / 60).toString().padStart(2, '0');
const sec = Math.floor(seconds % 60).toString().padStart(2, '0');
return `${min}:${sec}`;
}
const volumeIcon = document.querySelector('.fa-volume-up'); // Chọn icon volume

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




        document.getElementById('playButton').addEventListener('click', function () {
        document.getElementById('audioPlayer').style.display = 'flex';
    });



</script>

  

  
@endsection

