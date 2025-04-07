@extends('layouts.master', ['hideHeaderFooter' => false])

@section('title', 'Debook - Podcast')
@section('css')
    @vite(['resources/css/podcast.css'])
@endsection


@section('content')

<div class="podcast-header p-container">
    <h1>Podcast</h1>
    <div class="label">DEBOOK ĐỀ XUẤT</div>
    <div class="select-wrapper container">
        <select class="styled-select">
            <option>Chọn thể loại</option>
            <option>Văn học</option>
            <option>Podcast thanh niên</option>
            <option>Phật giáo - Tâm linh</option>
            <option>Tâm lí chữa lành</option>
        </select>
    </div>
</div>



<section>
    <div class="p-container fixCode">
        <div class="podcast-content">
            <!-- <div class="label">DEBOOK ĐỀ XUẤT</div> -->
            <h2 id="title">San sẻ chuyện học</h2>
            <p id="description">Hãy coi "chuyện đó" là một trò chơi lành mạnh, có lợi cho sức khỏe, không ảnh hưởng tới ai và tham gia cuộc chơi một cách hào hứng...</p>
        </div>
    
        <div class="slider">
            <div class="slides">
                <div class="slide"><img src="./IMG/playlist1.jpg" alt="Podcast Cover 1"></div>
                <div class="slide"><img src="./IMG/playlist1.jpg" alt="Podcast Cover 2"></div>
                <div class="slide"><img src="./IMG/playlist1.jpg" alt="Podcast Cover 3"></div>
            </div>
            <button class="prev" onclick="prevSlide()">&#10094;</button>
            <button class="next" onclick="nextSlide()">&#10095;</button>
        </div>
    </div>
    <script> /*script thuật toán chuyển content*/
        let index = 0;
            const titles = [
                "San sẻ chuyện học",
                "Trạm dừng cảm xúc",
                "Hành trình khám phá"
            ];

            const descriptions = [
                "Hãy coi 'chuyện đó' là một trò chơi lành mạnh, có lợi cho sức khỏe, không ảnh hưởng tới ai và tham gia cuộc chơi một cách hào hứng...",
                "Một phút dừng lại, lắng nghe cảm xúc của bản thân và trân trọng những khoảnh khắc nhỏ trong cuộc sống.",
                "Cùng nhau bước đi trên con đường khám phá tri thức, chinh phục những thử thách và phát triển bản thân mỗi ngày."
            ];

            function updateSlide() {
                const slides = document.querySelector(".slides");
                slides.style.transform = `translateX(-${index * 100}%)`;

                // Thay đổi nội dung text
                document.getElementById("title").textContent = titles[index];
                document.getElementById("description").textContent = descriptions[index];

                // Hiệu ứng mượt khi đổi nội dung
                const content = document.querySelector(".podcast-content");
                content.style.opacity = 0;
                setTimeout(() => {
                    content.style.opacity = 1;
                }, 300);
            }

            function nextSlide() {
                const totalSlides = document.querySelectorAll(".slide").length;
                index = (index + 1) % totalSlides;
                updateSlide();
            }

            function prevSlide() {
                const totalSlides = document.querySelectorAll(".slide").length;
                index = (index - 1 + totalSlides) % totalSlides;
                updateSlide();
            }

    </script>
</section>


<!--phần hiện danh sách mới nhất-->
<section>
     
      <div class="podcast-section">
        <h2>Mới nhất</h2>
          <div class="podcast-list">
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 1">
                  <p>Thanh âm cảm xúc</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 2">
                  <p>San sẻ "18+"</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 3">
                  <p>Sách hay đọc ngay</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 4">
                  <p>The Mediteria</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 5">
                  <p>Blog Tâm Lý Học Podcast</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 6">
                  <p>Tốt đời đẹp đạo</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 7">
                  <p>Podcast 7</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 8">
                  <p>Podcast 8</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 9">
                  <p>Podcast 9</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 10">
                  <p>Podcast 10</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 11">
                  <p>Podcast 11</p>
              </div>
              <div class="podcast-item">
                  <img src="./IMG/playlist1.jpg" alt="Podcast 12">
                  <p>Podcast 12</p>
              </div>
          </div>
  
  
  
  
</section>
<!-- phần hiện line top 10 tuần này -->
<section>

<div class="podcast-section">
  <h2>Top 10 tuần này</h2>
  <div class="podcast-list">
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 1">
          <p>Thanh âm cảm xúc</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 2">
          <p>San sẻ "18+"</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 3">
          <p>Sách hay đọc ngay</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 4">
          <p>The Mediteria</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 5">
          <p>Blog Tâm Lý Học Podcast</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 6">
          <p>Tốt đời đẹp đạo</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 7">
          <p>Podcast 7</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 8">
          <p>Podcast 8</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 9">
          <p>Podcast 9</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 10">
          <p>Podcast 10</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 11">
          <p>Podcast 11</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 12">
          <p>Podcast 12</p>
      </div>
  </div>
</section>

<!-- Tập mới ra mắt -->
<section>
<div class="podcast-section">
  <h2>Tập mới ra mắt</h2>
  <div class="podcast-list">
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 1">
          <p>Thanh âm cảm xúc</p>
         
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 2">
          <p>San sẻ "18+"</p>
          
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 3">
          <p>Sách hay đọc ngay</p>
   
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 4">
          <p>The Mediteria</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 5">
          <p>Blog Tâm Lý Học Podcast</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 6">
          <p>Tốt đời đẹp đạo</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 7">
          <p>Podcast 7</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 8">
          <p>Podcast 8</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 9">
          <p>Podcast 9</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 10">
          <p>Podcast 10</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 11">
          <p>Podcast 11</p>
      </div>
      <div class="podcast-item">
          <img src="./IMG/playlist1.jpg" alt="Podcast 12">
          <p>Podcast 12</p>
         
      </div>
  </div>
</section>

  

  
@endsection

