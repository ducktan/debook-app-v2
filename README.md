# Web Debook – Nền tảng sách điện tử, podcast và cộng đồng sáng tạo

**Web debook** là nền tảng đọc sách điện tử kết hợp âm nhạc thư giãn, nghe podcast, tương tác cộng đồng và hỗ trợ bán nội dung do người dùng tạo ra. Trang web cung cấp trải nghiệm đọc – nghe – cảm nhận hiện đại, dành cho cả người dùng lẫn quản trị viên.

---

## 🚀 Tính năng chính

### 👤 A. Người dùng Website

- **Tài khoản người dùng**:
  - Đăng ký / Đăng nhập / Quên mật khẩu
  - Đăng nhập bằng tài khoản Google/Facebook 
  - Cập nhật thông tin cá nhân

- **Khám phá sản phẩm**:
  - Duyệt và tìm kiếm sách, podcast
  - Xem thông tin chi tiết sản phẩm
  - Lọc theo tên, giá.

- **Giỏ hàng & Thanh toán**:
  - Thêm sản phẩm vào giỏ
  - Hỗ trợ thanh toán VNPAY

- **Gói hội viên**:
  - Mua và quản lý quyền truy cập sách đặc biệt (VIP)

- **Nội dung điện tử**:
  - Quản lý sách & nội dung đã mua
  - Đọc sách trực tuyến (file PDF)
  - Nghe podcast

- **Đăng nội dung cá nhân**:
  - Đăng bài blog cá nhân
  - Xem các blog của người khác

- **Tương tác**:
  - Đánh giá, bình luận sản phẩm

---

### 🛠️ B. Quản trị viên (Admin)

- **Quản lý người dùng**:


- **Quản lý sản phẩm, danh mục sản phẩm**:


- **Quản lý đơn hàng**:



- **Thống kê – Báo cáo**:
 



---

## 📂 Cài đặt dự án

### Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM

### Các bước cài đặt

```bash
# 1. Clone source code
git clone https://github.com/ducktan/debook.git
cd debook

# 2. Cài đặt thư viện backend
composer install

# 3. Cài đặt frontend
npm install && npm run dev

# 4. Tạo file môi trường
cp .env.example .env
php artisan key:generate

# 5. Cấu hình database trong file .env rồi chạy
php artisan migrate --seed

# 6. Khởi động server
php artisan serve
```

---

## 🔐 Tài khoản demo

```text
Admin:
Email: acc-demo-1@debook.vn
Mật khẩu: 12345678

```

---

## 🧱 Công nghệ sử dụng

- Laravel 12
- MySQL
- Bootstrap
- JavaScript, AJAX
- Chart.js
- VNPAY

---

## 👨‍💻 Tác giả

- Nhóm 1 - IS207.P21 (HK2 - 24 - 25)

---

