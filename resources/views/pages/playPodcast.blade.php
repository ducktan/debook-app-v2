@extends('layouts.app')

@section('title', $product->title)

@section('css')
    <style>
        body {
            background: linear-gradient(135deg, #f3f4f6, #ffffff);
        }
        .podcast-container {
            max-width: 960px;
            margin: 0 auto;
            padding-top: 40px;
        }
        .cover-shadow {
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            border-radius: 12px;
        }
        .btn-listen {
            background-color: #00c58e;
            color: white;
            border-radius: 999px;
            padding: 12px 24px;
            font-weight: 600;
        }
        .btn-listen:hover {
            background-color: #00a67d;
        }
        .rating-stars {
            color: #facc15;
        }
        .quote-box {
            background-color: #e0f7f1;
            border-left: 4px solid #00c58e;
            padding: 16px;
            border-radius: 8px;
            font-style: italic;
        }
        .audio-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffffff;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            padding: 10px 20px;
            z-index: 1000;
        }
        .audio-controls i {
            font-size: 1.2rem;
            cursor: pointer;
            margin: 0 8px;
        }
    </style>
@endsection

@section('content')
<div class="podcast-container">
    <div class="row align-items-center mb-4">
        <div class="col-md-4 text-center">
            <img src="{{ asset($product->image_url) }}" class="img-fluid cover-shadow" alt="Podcast cover">
        </div>
        <div class="col-md-8">
            <h3 class="fw-bold">{{ $product->title }}</h3>
            <div class="d-flex align-items-center mb-2">
                <span class="rating-stars me-2">{{$product->rating}} ★</span>
                <span class="text-muted">• {{ $product->comments_count }} đánh giá</span>
            </div>
            <p class="mb-1"><strong>Tác giả:</strong> {{ $product->author }}</p>
           
            <button class="btn btn-listen" id="startBtn">
                <i class="fas fa-play me-2"></i> Nghe podcast
            </button>
        </div>
    </div>

    <div class="quote-box mt-3">
        <p>
            “{{$product->description}}”
        </p>
    </div>
</div>

<div class="audio-bar d-none" id="playerBar">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="{{ asset($product->image_url) }}" alt="Podcast" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;" class="me-2">
            <div>
                <div class="fw-bold small">{{ $product->title }}</div>
                <div class="text-muted small">{{ $product->channel ?? 'Trạm dừng cảm xúc' }}</div>
            </div>
        </div>
        <div class="audio-controls d-flex align-items-center">
            <span id="speedBtn">1.0x</span>
            <i class="fas fa-backward" onclick="seek(-15)"></i>
            <i id="playPauseBtn" class="fas fa-play" onclick="togglePlay()"></i>
            <i class="fas fa-forward" onclick="seek(15)"></i>
            <span id="timeNow" class="mx-2 small">00:00</span>
            <input type="range" id="seekBar" min="0" value="0" step="1">
            <span id="duration" class="ms-2 small">--:--</span>
        </div>
    </div>
</div>

<audio id="audio" src="{{ asset($product->file_url) }}"></audio>

<script>
    const audio = document.getElementById('audio');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const seekBar = document.getElementById('seekBar');
    const timeNow = document.getElementById('timeNow');
    const duration = document.getElementById('duration');
    const speedBtn = document.getElementById('speedBtn');
    let speed = 1.0;

    document.getElementById('startBtn').onclick = () => {
        document.getElementById('playerBar').classList.remove('d-none');
        audio.play();
        playPauseBtn.classList.replace('fa-play', 'fa-pause');
    };

    function togglePlay() {
        if (audio.paused) {
            audio.play();
            playPauseBtn.classList.replace('fa-play', 'fa-pause');
        } else {
            audio.pause();
            playPauseBtn.classList.replace('fa-pause', 'fa-play');
        }
    }

    function seek(seconds) {
        audio.currentTime += seconds;
    }

    speedBtn.onclick = () => {
        speed += 0.25;
        if (speed > 2) speed = 1.0;
        audio.playbackRate = speed;
        speedBtn.textContent = speed.toFixed(1) + 'x';
    };

    function formatTime(sec) {
        const m = Math.floor(sec / 60).toString().padStart(2, '0');
        const s = Math.floor(sec % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    audio.ontimeupdate = () => {
        seekBar.max = audio.duration;
        seekBar.value = audio.currentTime;
        timeNow.textContent = formatTime(audio.currentTime);
        duration.textContent = formatTime(audio.duration);
    };

    seekBar.oninput = () => {
        audio.currentTime = seekBar.value;
    };
</script>
@endsection
