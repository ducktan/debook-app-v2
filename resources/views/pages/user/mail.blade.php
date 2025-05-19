<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng bạn đến với Bản tin của chúng tôi</title>
</head>
<body>
    <h1>Chào bạn, Người đăng ký!</h1>
    <p>Cảm ơn bạn đã đăng ký nhận bản tin của chúng tôi!</p>

    <h2>Đây là một số podcast mới nhất của chúng tôi:</h2>
    <ul>
        @foreach($podcasts as $podcast)
            <li>
                <a href="#">{{ $podcast->title }}</a>
            </li>
        @endforeach
    </ul>

    <p>Chúng tôi hy vọng bạn sẽ thích các podcast này. Hãy chờ đón những bản tin mới nhất!</p>
</body>
</html>
