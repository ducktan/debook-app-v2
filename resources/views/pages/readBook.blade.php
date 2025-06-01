@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Debook - Read Book')

@section('css')
    @vite(['resources/css/readBook.css'])
@endsection

@section('content')
<div class="container mt-4">
    <!-- Tiêu đề -->
    <div class="title-container">
        <div class="title__text">
            <h1>{{ $book->title }}</h1>
            <h4>Tác giả: {{ $book->author }}</h4>
        </div>
        <div class="title__button">
            <button class="back-button" onclick="history.back()">
                <i class="fa-solid fa-person-walking-arrow-loop-left"></i>
            </button>
        </div>
    </div>

    <!-- Nội dung -->
    <div class="read-container">
        <p style="white-space: pre-line;">
            {{ $book->content }}
        </p>
    </div>

    <!-- Nút điều hướng 
    <div class="nav-buttons">
        <button onclick="prevPage()">⟨ Trang trước</button>
        <button onclick="nextPage()">Trang tiếp ⟩</button>
    </div>
--> 
</div>
@endsection

@section('scripts')
<script>
    function prevPage() {
        window.history.back();
    }

    function nextPage() {
        // Cập nhật khi có tính năng phân trang chương sách
        alert("Tính năng này đang phát triển");
    }
</script>
@endsection
