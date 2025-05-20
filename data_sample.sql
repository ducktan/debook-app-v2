--  CATEGORY
INSERT INTO categories (name, slug, description, image_url, created_at, updated_at, deleted_at) VALUES
('Văn học', 'van-hoc', 'Mô tả cho danh mục Văn học', 'cat1.png', NOW(), NOW(), NULL),
('Kỹ năng sống', 'ky-nang-song', 'Mô tả cho danh mục Kỹ năng sống', 'cat2.png', NOW(), NOW(), NULL),
('Tâm lý – Giáo dục', 'tam-ly-giao-duc', 'Mô tả cho danh mục Tâm lý – Giáo dục', 'cat3.png', NOW(), NOW(), NULL),
('Thiếu nhi', 'thieu-nhi', 'Mô tả cho danh mục Thiếu nhi', 'cat1.png', NOW(), NOW(), NULL),
('Kinh tế', 'kinh-te', 'Mô tả cho danh mục Kinh tế', 'cat2.png', NOW(), NOW(), NULL),
('Podcast truyền cảm hứng', 'podcast-truyen-cam-hung', 'Mô tả cho danh mục Podcast truyền cảm hứng', 'cat3.png', NOW(), NOW(), NULL);

-- PRODUCT
INSERT INTO products (
    title, description, author, type, category_id,
    publication_date, price, file_url, image_url,
    duration, language, rating, created_at, updated_at
) VALUES
-- 1
('Bí mật của sự tĩnh lặng', 
 'Một hành trình khám phá sức mạnh của sự im lặng trong thế giới ồn ào.', 
 'Nguyễn Nhật Ánh', 'ebook', 6,
 CURDATE() - INTERVAL 120 DAY, 59.00, 'sample.pdf', 'p1.jpg', 
 0, 'vi', 4.5, NOW(), NOW()),

-- 2
('Dũng cảm sống thật', 
 'Cuốn podcast truyền cảm hứng về việc sống đúng với giá trị bản thân, vượt qua nỗi sợ và định kiến xã hội.', 
 'Lê Hồng Nhung', 'podcast', 17,
 CURDATE() - INTERVAL 90 DAY, 0.00, 'sample.mp3', 'p2.jpg', 
 42, 'vi', 4.2, NOW(), NOW()),

-- 3
('Deep Work - Làm việc sâu để thành công', 
 'Phương pháp làm việc không bị phân tâm giúp bạn đạt hiệu quả vượt trội.', 
 'Cal Newport', 'ebook', 18,
 CURDATE() - INTERVAL 200 DAY, 89.00, 'sample.pdf', 'p3.jpg', 
 0, 'en', 4.8, NOW(), NOW()),

-- 4
('Nuôi dưỡng đứa trẻ bên trong bạn', 
 'Chữa lành tổn thương thời thơ ấu và học cách yêu thương bản thân một cách trọn vẹn.', 
 'Thái Hà', 'ebook', 19,
 CURDATE() - INTERVAL 300 DAY, 65.00, 'sample.pdf', 'p4.jpg', 
 0, 'vi', 4.6, NOW(), NOW()),

-- 5
('Sức mạnh của thói quen', 
 'Tại sao chúng ta làm điều mình làm, và làm sao để thay đổi hành vi một cách bền vững.', 
 'Charles Duhigg', 'ebook', 20,
 CURDATE() - INTERVAL 180 DAY, 79.00, 'sample.pdf', 'p5.jpg', 
 0, 'en', 4.7, NOW(), NOW()),

-- 6
('Tỉnh thức giữa cuộc đời bận rộn', 
 'Podcast nhẹ nhàng giúp bạn dừng lại, hít thở và sống trọn vẹn từng khoảnh khắc.', 
 'Minh Thư', 'podcast', 21,
 CURDATE() - INTERVAL 60 DAY, 0.00, 'sample.mp3', 'p1.jpg', 
 35, 'vi', 4.3, NOW(), NOW()),

-- 7
('The Power of Now', 
 'Khám phá giá trị hiện tại, từ bỏ quá khứ và thôi lo âu về tương lai.', 
 'Eckhart Tolle', 'ebook', 22,
 CURDATE() - INTERVAL 400 DAY, 99.00, 'sample.pdf', 'p2.jpg', 
 0, 'en', 4.9, NOW(), NOW()),

-- 8
('Khởi đầu mới mỗi ngày', 
 'Podcast mang đến năng lượng tích cực và nhắc nhở bạn về giá trị của từng ngày sống.', 
 'Lan Hương', 'podcast', 6,
 CURDATE() - INTERVAL 30 DAY, 0.00, 'sample.mp3', 'p3.jpg', 
 28, 'vi', 4.1, NOW(), NOW()),

-- 9
('Thiền và sự tự do nội tại', 
 'Hành trình đi vào bên trong để tìm sự bình an và hiểu rõ chính mình.', 
 'Thích Nhất Hạnh', 'ebook', 17,
 CURDATE() - INTERVAL 365 DAY, 55.00, 'sample.pdf', 'p4.jpg', 
 0, 'vi', 4.8, NOW(), NOW()),

-- 10
('Podcast: Kể chuyện đêm khuya', 
 'Những câu chuyện nhẹ nhàng giúp bạn thư giãn trước khi ngủ.', 
 'Phạm An', 'podcast', 18,
 CURDATE() - INTERVAL 15 DAY, 0.00, 'sample.mp3', 'p5.jpg', 
 33, 'vi', 4.0, NOW(), NOW());
 
 -- PART 2
 INSERT INTO products (
    title, description, author, type, category_id,
    publication_date, price, file_url, image_url,
    duration, language, rating, created_at, updated_at
) VALUES
-- 11
('Lãnh đạo cấp độ 5', 
 'Khám phá phẩm chất của những nhà lãnh đạo khiêm nhường nhưng cực kỳ quyết đoán trong những tập đoàn vĩ đại.', 
 'Jim Collins', 'ebook', 19,
 CURDATE() - INTERVAL 600 DAY, 250000.00, 'sample.pdf', 'p1.jpg', 
 0, 'vi', 4.9, NOW(), NOW()),

-- 12
('Nghệ thuật đầu tư Dhandho', 
 'Cách đầu tư khôn ngoan và rủi ro thấp dựa trên tư duy kinh doanh truyền thống của người Ấn.', 
 'Mohnish Pabrai', 'ebook', 20,
 CURDATE() - INTERVAL 500 DAY, 3200000.00, 'sample.pdf', 'p2.jpg', 
 0, 'en', 4.7, NOW(), NOW()),

-- 13
('Chạm vào sự bất tử', 
 'Podcast dẫn dắt bạn vào thế giới của triết học, tôn giáo và cái đẹp vượt thời gian.', 
 'Thiền sư Trần Tâm', 'podcast', 21,
 CURDATE() - INTERVAL 300 DAY, 10000.00, 'sample.mp3', 'p3.jpg', 
 58, 'vi', 4.6, NOW(), NOW()),

-- 14
('Xây dựng thương hiệu cá nhân triệu đô', 
 'Làm sao để biến bản thân thành một thương hiệu đáng tin cậy và kiếm tiền từ đó.', 
 'Gary Vaynerchuk', 'ebook', 22,
 CURDATE() - INTERVAL 200 DAY, 8900000.00, 'sample.pdf', 'p4.jpg', 
 0, 'en', 4.8, NOW(), NOW()),

-- 15
('Tái cấu trúc tâm trí', 
 'Một cái nhìn sâu sắc về cách hoạt động của não bộ và làm thế nào để kiểm soát suy nghĩ tiêu cực.', 
 'Daniel Goleman', 'ebook', 6,
 CURDATE() - INTERVAL 450 DAY, 170000.00, 'sample.pdf', 'p5.jpg', 
 0, 'vi', 4.5, NOW(), NOW()),

-- 16
('Giác ngộ giữa phố thị', 
 'Podcast kể lại hành trình đi tìm ý nghĩa sống giữa nhịp sống hiện đại xô bồ.', 
 'Huyền My', 'podcast', 17,
 CURDATE() - INTERVAL 150 DAY, 52000.00, 'sample.mp3', 'p1.jpg', 
 40, 'vi', 4.2, NOW(), NOW()),

-- 17
('Data-Driven Marketing', 
 'Tối ưu chiến lược tiếp thị bằng dữ liệu: công nghệ, AI và hành vi người tiêu dùng.', 
 'Thomas Redman', 'ebook', 18,
 CURDATE() - INTERVAL 100 DAY, 9999999.00, 'sample.pdf', 'p2.jpg', 
 0, 'en', 4.9, NOW(), NOW()),

-- 18
('Sức mạnh của sự trì hoãn có chủ đích', 
 'Phá bỏ định kiến về sự lười biếng và cách biến nó thành công cụ sáng tạo.', 
 'Adam Grant', 'ebook', 19,
 CURDATE() - INTERVAL 50 DAY, 420000.00, 'sample.pdf', 'p3.jpg', 
 0, 'en', 4.6, NOW(), NOW()),

-- 19
('Trí tuệ tài chính cá nhân', 
 'Podcast hướng dẫn từ A-Z về quản lý tài chính cho người mới bắt đầu đến chuyên gia.', 
 'Lâm Quang Nhật', 'podcast', 20,
 CURDATE() - INTERVAL 70 DAY, 205000.00, 'sample.mp3', 'p4.jpg', 
 37, 'vi', 4.4, NOW(), NOW()),

-- 20
('Rework - Tái thiết lập tư duy làm việc', 
 'Tư duy mới mẻ, cắt giảm sự phức tạp, làm ít hơn mà hiệu quả hơn.', 
 'Jason Fried & DHH', 'ebook', 22,
 CURDATE() - INTERVAL 20 DAY, 640000.00, 'sample.pdf', 'p5.jpg', 
 0, 'en', 4.7, NOW(), NOW());
 
 INSERT INTO comments (user_id, product_id, content, rating, created_at, updated_at) VALUES
-- Product 61
(9, 61, 'Bài học đáng giá cho ai đang tìm hướng đi trong nghề nghiệp.', 5, NOW(), NOW()),
(5, 61, 'Đọc xong muốn hành động ngay.', 4, NOW(), NOW()),

-- Product 62
(19, 62, 'Chất lượng bản ghi tốt, nội dung truyền cảm hứng.', 5, NOW(), NOW()),
(15, 62, 'Nghe đi nghe lại nhiều lần vẫn thấy hay.', 5, NOW(), NOW()),

-- Product 63
(16, 63, 'Cần kiên nhẫn để thấm, nhưng rất giá trị.', 4, NOW(), NOW()),
(5, 63, 'Không phù hợp người mới bắt đầu.', 3, NOW(), NOW()),

-- Product 64
(9, 64, 'Bài giảng rõ ràng, cách truyền đạt chuyên nghiệp.', 5, NOW(), NOW()),
(19, 64, 'Cần có kiến thức nền thì mới dễ hiểu.', 4, NOW(), NOW()),

-- Product 65
(15, 65, 'Một trong những cuốn mình tâm đắc nhất năm nay.', 5, NOW(), NOW()),
(16, 65, 'Sẽ giới thiệu cho bạn bè chắc chắn.', 5, NOW(), NOW()),
(5, 65, 'Không hối hận khi mua.', 4, NOW(), NOW()),

-- Product 66
(9, 66, 'Podcast nhẹ nhàng mà sâu sắc, rất dễ đồng cảm.', 5, NOW(), NOW()),
(19, 66, 'Chất giọng phù hợp với chủ đề.', 4, NOW(), NOW()),

-- Product 67
(5, 67, 'Giá cao nhưng đáng với những gì nhận được.', 5, NOW(), NOW()),
(15, 67, 'Nội dung rất “đời”, không màu mè.', 5, NOW(), NOW()),

-- Product 68
(16, 68, 'Một số phần trùng lặp, nhưng vẫn học được nhiều.', 3, NOW(), NOW()),
(9, 68, 'Tác giả dẫn dắt tốt, ví dụ gần gũi.', 4, NOW(), NOW()),

-- Product 69
(19, 69, 'Cảm giác như được “thức tỉnh”.', 5, NOW(), NOW()),
(5, 69, 'Sách hay, in đẹp, trình bày logic.', 5, NOW(), NOW()),

-- Product 70
(15, 70, 'Không phù hợp với mình lắm, nhưng nhiều người sẽ thích.', 3, NOW(), NOW()),
(9, 70, 'Giá cao so với nội dung.', 3, NOW(), NOW()),

-- Product 71
(16, 71, 'Đọc xong muốn thay đổi thói quen ngay.', 5, NOW(), NOW()),
(5, 71, 'Thực tiễn, không lan man.', 4, NOW(), NOW()),

-- Product 72
(19, 72, 'Sách gối đầu giường. Quá hay!', 5, NOW(), NOW()),
(15, 72, 'Có chiều sâu nhưng hơi khó tiếp cận cho người mới.', 4, NOW(), NOW()),

-- Product 73
(9, 73, 'Lắng nghe podcast này mỗi sáng là thói quen của mình.', 5, NOW(), NOW()),
(16, 73, 'Nội dung chất lượng, lồng nhạc rất ổn.', 5, NOW(), NOW()),

-- Product 74
(5, 74, 'Không ngờ lại thích đến vậy. Rất bất ngờ.', 5, NOW(), NOW()),
(19, 74, 'Học được nhiều bài học đáng giá.', 4, NOW(), NOW());


-- ORDER
INSERT INTO orders (user_id, codeVNPAY, status, total, created_at, updated_at) VALUES
(19, 'DEB3008214567', 'completed', 250000, NOW(), NOW()),
(16, 'DEB9831205478', 'pending', 1500000, NOW(), NOW()),
(5,  'DEB6723459831', 'cancelled', 500000, NOW(), NOW()),
(15, 'DEB4589123746', 'completed', 3000000, NOW(), NOW()),
(9,  'DEB2398746512', 'pending', 750000, NOW(), NOW()),
(19, 'DEB1023587465', 'completed', 1200000, NOW(), NOW()),
(16, 'DEB9876543210', 'cancelled', 600000, NOW(), NOW()),
(5,  'DEB4567891234', 'pending', 450000, NOW(), NOW()),
(15, 'DEB1234567890', 'completed', 900000, NOW(), NOW()),
(9,  'DEB6543219876', 'pending', 200000, NOW(), NOW()),

(19, 'DEB5432109876', 'pending', 1750000, NOW(), NOW()),
(16, 'DEB8765432109', 'completed', 2400000, NOW(), NOW()),
(5,  'DEB1928374650', 'cancelled', 700000, NOW(), NOW()),
(15, 'DEB5647382910', 'completed', 3200000, NOW(), NOW()),
(9,  'DEB8374651920', 'pending', 800000, NOW(), NOW()),
(19, 'DEB9112233445', 'completed', 1300000, NOW(), NOW()),
(16, 'DEB6263547890', 'cancelled', 550000, NOW(), NOW()),
(5,  'DEB1827364950', 'pending', 480000, NOW(), NOW()),
(15, 'DEB3748291056', 'completed', 950000, NOW(), NOW()),
(9,  'DEB9183746502', 'pending', 210000, NOW(), NOW()),

(19, 'DEB5147382910', 'completed', 2700000, NOW(), NOW()),
(16, 'DEB8174652039', 'pending', 1600000, NOW(), NOW()),
(5,  'DEB9112736450', 'cancelled', 650000, NOW(), NOW()),
(15, 'DEB7263548190', 'completed', 3100000, NOW(), NOW()),
(9,  'DEB1827364951', 'pending', 820000, NOW(), NOW()),
(19, 'DEB3748291057', 'completed', 1250000, NOW(), NOW()),
(16, 'DEB9183746503', 'cancelled', 600000, NOW(), NOW()),
(5,  'DEB5647382911', 'pending', 470000, NOW(), NOW()),
(15, 'DEB8274652030', 'completed', 980000, NOW(), NOW()),
(9,  'DEB9182736450', 'pending', 220000, NOW(), NOW());

-- ORDER ITEM
INSERT INTO order_items (order_id, product_id, price, quantity, created_at, updated_at) VALUES
(299, 55, 150000, 2, NOW(), NOW()),
(299, 57, 300000, 1, NOW(), NOW()),
(300, 60, 750000, 1, NOW(), NOW()),
(301, 58, 500000, 3, NOW(), NOW()),
(301, 63, 1200000, 1, NOW(), NOW()),
(302, 67, 800000, 2, NOW(), NOW()),
(303, 55, 150000, 1, NOW(), NOW()),
(303, 70, 900000, 1, NOW(), NOW()),
(304, 66, 2200000, 1, NOW(), NOW()),
(305, 74, 10000000, 1, NOW(), NOW()),

(306, 59, 600000, 3, NOW(), NOW()),
(307, 61, 450000, 1, NOW(), NOW()),
(307, 64, 350000, 2, NOW(), NOW()),
(308, 56, 200000, 1, NOW(), NOW()),
(309, 68, 700000, 2, NOW(), NOW()),
(310, 65, 550000, 1, NOW(), NOW()),
(310, 62, 400000, 1, NOW(), NOW()),
(311, 69, 1300000, 1, NOW(), NOW()),
(312, 71, 2600000, 1, NOW(), NOW()),
(312, 55, 150000, 2, NOW(), NOW()),

(313, 73, 8500000, 1, NOW(), NOW()),
(314, 57, 300000, 3, NOW(), NOW()),
(315, 59, 600000, 1, NOW(), NOW()),
(316, 60, 750000, 2, NOW(), NOW()),
(317, 66, 2200000, 1, NOW(), NOW()),
(318, 68, 700000, 2, NOW(), NOW()),
(319, 62, 400000, 1, NOW(), NOW()),
(320, 61, 450000, 1, NOW(), NOW()),
(321, 64, 350000, 1, NOW(), NOW()),
(322, 65, 550000, 3, NOW(), NOW());
