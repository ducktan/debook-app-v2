

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán - {{ $subscription->name }}</title>

    <style>
        /* Tổng quan */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color:#b1ba78bc;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color:#10794f;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Thông tin gói đăng ký */
        .info {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #e74c3c;
        }

        .duration {
            font-size: 16px;
            color: #555;
        }

        /* Form thanh toán */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="hidden"] {
            display: none;
        }
        /* Thông tin người đăng ký */
        .user-info {
            background-color:rgba(163, 163, 163, 0.69);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        button {
            padding: 15px 25px;
            font-size: 18px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        /* Thông báo flash (nếu có) */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>Thanh toán cho gói: {{ $subscription->name }}</h2>

        

        <div class="user-info">
            <h3>Thông tin người đăng ký</h3>
            <p><strong>Tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        <div class="info">
            <p><strong>Giá:</strong> {{ number_format($subscription->price, 0, ',', '.') }}đ</p>
            <p class="duration"><strong>Thời gian:</strong> {{ $subscription->duration }} {{ $subscription->duration_unit == 'days' ? 'ngày' : ($subscription->duration_unit == 'months' ? 'tháng' : 'năm') }} đọc/nghe sách</p>
            <p><strong>Ngày bắt đầu:</strong> {{ $startDate->format('d/m/Y') }}</p>
            <p><strong>Ngày kết thúc:</strong> {{ $endDate->format('d/m/Y') }}</p>
        </div>

        <!-- Form thanh toán -->
        <form action="{{ route('processPayment') }}" method="POST">
            @csrf
            <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
            <input type="hidden" name="price" value="{{ $subscription->price }}">
            <button type="submit">Thanh toán ngay</button>
        </form>
    </div>

    <script>
                    const formData = new FormData();
            formData.append('subscription_id', 1); // ID gói đăng ký người dùng chọn

            fetch('/process-payment', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message); // Hiển thị thông báo thành công
                })
                .catch(error => {
                    console.error('Error:', error);
                });

    </script>
</body>
</html>
