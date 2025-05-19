@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Debook - Read Book')
@section('css')
    @vite(['resources/css/readBook.css'])
@endsection

<div class="container mt-4">
    <!-- Tiêu đề -->
    <div class="title-container">
        <div class="title__text">
            <h1>{{ $product->title }}</h1>
            <p class="title__author">Tác giả: {{ $product->author }}</p>
        </div>
        <div class="title__button">
            <button class="back-button" onclick="history.back()">
                <i class="fa-solid fa-person-walking-arrow-loop-left"></i>
            </button>
        </div>
    </div>

    <!-- PDF Reader -->
    <div id="pdf-viewer" class="pdf-container">
        <canvas id="pdf-canvas"></canvas>
    </div>

    <!-- Nav buttons -->
    <div class="nav-buttons">
        <button onclick="prevPage()">⟨ Trang trước</button>
        <button onclick="nextPage()">Trang tiếp ⟩</button>
    </div>
</div>

<script>
    // URL file PDF, bạn có thể thay thế bằng URL của file PDF trong cơ sở dữ liệu
    var pdfUrl = @json(asset('storage/file/' . $product->file_url));// Đảm bảo rằng $product->pdf_url chứa đường dẫn đến file PDF

    // Khởi tạo PDF.js
    var pdfDoc = null,
        pageNum = 1,
        pageIsRendering = false,
        pageNumIsPending = null;
    
    // Hiển thị trang PDF
    function renderPage(num) {
        pageIsRendering = true;

        pdfDoc.getPage(num).then(function(page) {
            var canvas = document.getElementById("pdf-canvas");
            var ctx = canvas.getContext("2d");

            var viewport = page.getViewport({ scale: 1.5 });
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            page.render({
                canvasContext: ctx,
                viewport: viewport
            }).promise.then(function() {
                pageIsRendering = false;
                if (pageNumIsPending !== null) {
                    renderPage(pageNumIsPending);
                    pageNumIsPending = null;
                }
            });
        });

        document.getElementById("page_num").textContent = num;
    }

    // Tải file PDF
    function loadPdf() {
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            pdfDoc = pdf;
            renderPage(pageNum);
        });
    }

    // Trang tiếp theo
    function nextPage() {
        if (pageNum < pdfDoc.numPages) {
            pageNum++;
            renderPage(pageNum);
        }
    }

    // Trang trước
    function prevPage() {
        if (pageNum > 1) {
            pageNum--;
            renderPage(pageNum);
        }
    }

    // Tải PDF khi trang được load
    window.onload = loadPdf;
</script>

@section('content')
@endsection
