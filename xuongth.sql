-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 12, 2025 lúc 05:20 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `xuongth`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author` varchar(11) NOT NULL,
  `is_visible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `image`, `created_at`, `author`, `is_visible`) VALUES
(10, 'điện thoạiegrhjhjjsưdefsdgbfnb', '<p>qswevfdbv</p>\r\n<p>qưqefwrgf</p>\r\n<p>sưdafsdbgvnb</p>', 'uploads/1743781669_download (1).jpg', '2025-04-04 15:47:49', 'Author Name', 1),
(11, 'Trung Quốc áp thuế 34% trả đũa Mỹ', '<h1 class=\"title-detail\">Trung Quốc &aacute;p thuế 34% trả đũa Mỹ</h1>\r\n<p class=\"description\">Trung Quốc sẽ &aacute;p thuế 34% với to&agrave;n bộ h&agrave;ng h&oacute;a của Mỹ từ ng&agrave;y 10/4, động th&aacute;i trả đũa trước ch&iacute;nh s&aacute;ch thuế quan gần đ&acirc;y của &ocirc;ng Trump.</p>\r\n<article class=\"fck_detail \">\r\n<p class=\"Normal\">Ng&agrave;y 4/4, Bộ T&agrave;i ch&iacute;nh Trung Quốc th&ocirc;ng b&aacute;o sẽ &aacute;p thuế nhập khẩu bổ sung 34% l&ecirc;n to&agrave;n bộ h&agrave;ng Mỹ. Thuế n&agrave;y c&oacute; hiệu lực từ ng&agrave;y 10/4, nhằm đ&aacute;p trả ch&iacute;nh s&aacute;ch thuế của Tổng thống Mỹ Donald Trump.</p>\r\n<p class=\"Normal\">Trung Quốc cũng bổ sung 11 c&ocirc;ng ty Mỹ v&agrave;o \"danh s&aacute;ch thực thể kh&ocirc;ng đ&aacute;ng tin\", với l&yacute; do vi phạm c&aacute;c quy định thị trường. Bộ Thương mại nước n&agrave;y c&ograve;n đưa th&ecirc;m 16 doanh nghiệp Mỹ v&agrave;o danh s&aacute;ch hạn chế xuất khẩu, đồng thời &aacute;p dụng kiểm so&aacute;t xuất khẩu với 7 kim loại li&ecirc;n quan đến đất hiếm.</p>\r\n<p class=\"Normal\">C&aacute;ch đ&acirc;y hai ng&agrave;y, &ocirc;ng Trump c&ocirc;ng bố &aacute;p thuế nhập khẩu đối ứng với to&agrave;n bộ đối t&aacute;c thương mại. Mức &aacute;p dụng với Trung Quốc kể từ ng&agrave;y 9/4 l&agrave; 34%. Tổng cộng trong nhiệm kỳ 2 của &ocirc;ng Trump, h&agrave;ng Trung Quốc đ&atilde; bị &aacute;p th&ecirc;m thuế 54%.</p>\r\n<p class=\"Normal\"><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"https://anhnail.vn/wp-content/uploads/2024/11/anh-meme-bat-ngo-1.webp\" alt=\"\" width=\"400\" height=\"356\"></p>\r\n<p class=\"Normal\">Sau khi &ocirc;ng Trump th&ocirc;ng b&aacute;o thuế n&agrave;y, Bộ Thương mại Trung Quốc đ&atilde; th&uacute;c giục Mỹ \"ngay lập tức\" hủy bỏ thuế nhập khẩu đối ứng v&agrave; \"giải quyết bất đồng với c&aacute;c đối t&aacute;c thương mại th&ocirc;ng qua đối thoại c&ocirc;ng bằng\". Nước n&agrave;y tuy&ecirc;n bố \"sẽ c&oacute; biện ph&aacute;p đ&aacute;p trả\".</p>\r\n<div id=\"sis_outstream_container\" data-set=\"dfp\"></div>\r\n<p class=\"Normal\">Bộ T&agrave;i ch&iacute;nh Trung Quốc chỉ tr&iacute;ch việc &ocirc;ng Trump &aacute;p th&ecirc;m 34% thuế nhập khẩu l&ecirc;n h&agrave;ng Trung Quốc. Họ cho rằng đ&acirc;y l&agrave; \"h&agrave;nh động kh&ocirc;ng tu&acirc;n thủ c&aacute;c quy tắc thương mại quốc tế, l&agrave;m tổn hại nghi&ecirc;m trọng lợi &iacute;ch v&agrave; đe dọa sự ph&aacute;t triển kinh tế v&agrave; ổn định sản xuất, cũng như chuỗi cung ứng to&agrave;n cầu\".</p>\r\n<p class=\"Normal\">Tr&ecirc;n&nbsp;<em>Fox News</em> ng&agrave;y 2/4, Bộ trưởng T&agrave;i ch&iacute;nh Mỹ Scott Bessent khuyến c&aacute;o c&aacute;c quốc gia bị &aacute;p thuế đối ứng n&ecirc;n \"b&igrave;nh tĩnh ngồi lại, đừng trả đũa\". V&igrave; việc n&agrave;y sẽ chỉ khiến \"t&igrave;nh h&igrave;nh leo thang\".</p>\r\n</article>', 'uploads/1743783642_anh-meme-63 - Copy.jpg', '2025-04-04 16:20:42', 'ưdefsrgfhg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Công Nghệ Thông Tin'),
(3, 'Maketing');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `lesson_id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(40, 7, 63, 'hay đấy', '2025-04-05 00:58:36', '2025-04-05 00:58:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_value` varchar(255) NOT NULL,
  `usage_limit` varchar(255) NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `video` text NOT NULL,
  `status` varchar(50) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lessons`
--

INSERT INTO `lessons` (`id`, `subject_id`, `title`, `video`, `status`) VALUES
(7, 1, 'Bài 2', 'https://youtu.be/qiyTDxBjmIw?list=PLIiLuIrSErz46J2oRpuTMXuVTHkwDabfD', '[New 100%]'),
(8, 1, 'Bài 3', 'https://youtu.be/U7_Cs1x0RL0?si=zNkjzvfPsyoSYktO', 'aaaaaaaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `progress`
--

CREATE TABLE `progress` (
  `id` int(50) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `subjects_id` int(50) DEFAULT NULL,
  `completed_lessons` varchar(255) DEFAULT NULL,
  `progress_percentage` varchar(255) DEFAULT NULL,
  `total_lessons` int(50) DEFAULT NULL,
  `video_time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `progress`
--

INSERT INTO `progress` (`id`, `user_id`, `subjects_id`, `completed_lessons`, `progress_percentage`, `total_lessons`, `video_time`) VALUES
(1, 63, 1, '1', '50', 2, '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `tests_id` int(11) NOT NULL,
  `questions_text` varchar(255) NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `tests_id`, `questions_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(8, 6, 'câu 2: 3+1=?', '2', '5', '4', '6', 'c');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `total_lessons` int(50) DEFAULT NULL,
  `user_quantity` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `category_id`, `user_id`, `name`, `image`, `price`, `sku`, `status`, `description`, `total_lessons`, `user_quantity`) VALUES
(1, 1, 63, 'PHP Cơ Bản', 'https://i.pinimg.com/736x/33/75/a8/3375a8fca0a82a2bfab486547d95a98e.jpg', 200000, 'PHP001', 'active', 'ádasdas', 2, 6),
(3, 1, 63, 'PHP SUPERHERO', 'https://th.bing.com/th/id/OIP.qF-5pDFdeBN8DhoN2tlBcQHaD3?rs=1&pid=ImgDetMain', 120000, 'akml', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 1),
(4, 1, 63, 'CSS SUPERHERO', 'https://albertraluy.github.io/A5-reglas/img/CSS-Logo.png', 120000, 'akml123', 'active', 'Không Tiền Thì Cook', NULL, 1),
(5, 3, 63, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 0),
(6, 3, 63, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 0),
(7, 3, 63, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 1),
(8, 1, 63, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'activeasdas', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', NULL, 1),
(10, 1, 63, 'YTHANH ÊBAN', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 200000, 'sdasdasdzcsascfassadasdsd', 'active', 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvv', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `lessons_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tests`
--

INSERT INTO `tests` (`id`, `lessons_id`, `title`) VALUES
(6, 7, 'Bài 1'),
(7, 8, 'bài 1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(250) NOT NULL,
  `role` enum('admin','user','quanly') DEFAULT 'user',
  `phone` int(11) DEFAULT NULL,
  `kinhnghiem` varchar(255) DEFAULT NULL,
  `mota` varchar(255) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `bangcap` varchar(255) DEFAULT NULL,
  `truonghoc` varchar(255) DEFAULT NULL,
  `namhoc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `image`, `password`, `created_at`, `name`, `role`, `phone`, `kinhnghiem`, `mota`, `diachi`, `bangcap`, `truonghoc`, `namhoc`) VALUES
(57, 'phamminhtu28055@gmail.com', NULL, '$2y$10$15uE26mNHnTK9ua6o/ygKuZllUg0iNvo8zVLREdIFEUpXqH4ge7m2', '2025-03-10 10:49:10', 'Phạm Minh Tú', 'admin', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'heilpmtu@gmail.com', NULL, '$2y$10$jUe.dKHi/19dMX395at84eWHVxPA1REgmLkqff..H0DRRqWSupA12', '2025-03-13 15:51:15', 'Phạm Minh Tú', 'admin', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'ebanythanh1@gmail.com', '67e6079715fe0.png', '$2y$10$EjWtHpXt7H7gZ5X.uJToVe008JOUda7R3sb.49PN4ruPv/o2t84S.', '2025-03-15 03:35:15', 'YTHANH ÊBAN', 'admin', 337937493, 'aaaaaaaaaaaaaaa', NULL, 'buôn cuôr đăng b', 'aaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa'),
(65, 'ebanythanh2@gmail.com', NULL, '$2y$10$3arLaG5D.s6HEHgyIxI/PeRHpm58TN4DfFHoqq8zuxC9XqpUOJvQ6', '2025-03-26 23:22:04', 'YTHANH ÊBAN', 'user', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'ebanythanh24@gmail.com', NULL, '$2y$10$yPZ9AdM1/eqb4GzIlGARI.jar/Ka/Tm3daRt1dqQ1vzyY4g2glmSS', '2025-03-28 13:33:24', 'YTHANH ÊBAN', 'user', 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_subjects`
--

CREATE TABLE `user_subjects` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pttt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_subjects`
--

INSERT INTO `user_subjects` (`id`, `subject_id`, `user_id`, `categories_id`, `name`, `image`, `price`, `sku`, `description`, `status`, `pttt`) VALUES
(21, 1, 63, 1, 'PHP Cơ Bản', 'https://i.pinimg.com/736x/33/75/a8/3375a8fca0a82a2bfab486547d95a98e.jpg', 2000000, 'PHP001', 'ádasdas', 'Đã Tham Gia', 'cod'),
(30, 4, 63, 1, 'CSS SUPERHERO', 'https://albertraluy.github.io/A5-reglas/img/CSS-Logo.png', 120000, 'akml123', 'Không Tiền Thì Cook', 'Đã Tham Gia', 'cod'),
(33, 7, 63, 3, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Đã Tham Gia', 'vnpay'),
(34, 8, 63, 1, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Đã Tham Gia', 'vnpay'),
(35, 3, 63, 1, 'PHP SUPERHERO', 'https://th.bing.com/th/id/OIP.qF-5pDFdeBN8DhoN2tlBcQHaD3?rs=1&pid=ImgDetMain', 120000, 'akml', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Đã Tham Gia', 'cod');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_id` (`lesson_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Chỉ mục cho bảng `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Chỉ mục cho bảng `user_subjects`
--
ALTER TABLE `user_subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT cho bảng `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `user_subjects`
--
ALTER TABLE `user_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_ibfk_3` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
