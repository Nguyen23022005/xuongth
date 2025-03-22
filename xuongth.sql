-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 22, 2025 lúc 04:56 AM
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
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_session` varchar(255) DEFAULT NULL,
  `subject_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL CHECK (`price` >= 0),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `cart_session`, `subject_id`, `price`, `created_at`, `updated_at`) VALUES
(11, 62, 'a3ep9aj0jcgbkkbs6qsra2tq5n', 1, 0.00, '2025-03-14 13:50:20', '2025-03-14 13:50:20'),
(12, NULL, '84f8nr6l2qfe7u6lla67spmvd4', 1, 0.00, '2025-03-15 03:18:06', '2025-03-15 03:18:06'),
(13, NULL, 'nansnc8rnuasa6364p1a7nlr3v', 1, 0.00, '2025-03-15 03:20:21', '2025-03-15 03:20:21'),
(14, NULL, '33v2nknla35fv9n9dr8t901cks', 1, 0.00, '2025-03-15 04:16:27', '2025-03-15 04:16:27'),
(15, 62, '33v2nknla35fv9n9dr8t901cks', 2, 0.00, '2025-03-15 04:18:43', '2025-03-15 04:18:43'),
(16, NULL, 'btpfeejn1j0rfg020pbc02kadf', 1, 0.00, '2025-03-15 05:26:13', '2025-03-15 05:26:13'),
(17, NULL, 'btpfeejn1j0rfg020pbc02kadf', 2, 0.00, '2025-03-15 05:38:03', '2025-03-15 05:38:03'),
(18, NULL, '8rsmd5n9btledki0odv9rdfuc7', 1, 0.00, '2025-03-15 06:21:47', '2025-03-15 06:21:47'),
(19, 66, 'v6n30pgses25q6eg82ocrq9oia', 2, 0.00, '2025-03-15 06:22:39', '2025-03-15 06:22:39'),
(31, NULL, 'p3jjhepfcreqnjvvko8kqfre6d', 2, 0.00, '2025-03-15 12:52:33', '2025-03-15 12:52:33'),
(34, NULL, 'aotgtgo1iu7e6grr5m0265u0bh', 2, 0.00, '2025-03-16 19:27:14', '2025-03-16 19:27:14'),
(41, 70, 'rmrhg496qmc2mbu4ar4fpa7cn6', 2, 0.00, '2025-03-21 14:46:48', '2025-03-21 14:46:48'),
(42, 68, '1328196g6ar1j1f47bfctqtc2k', 2, 0.00, '2025-03-22 03:00:22', '2025-03-22 03:00:22');

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
(6, 1, 'Bài 1', 'https://youtu.be/k4sT_wHTBoM?list=PLIiLuIrSErz49oqgyDkGA84zRfVPWi1fm&t=4', 'ádsa'),
(7, 1, 'Bài 2', 'https://youtu.be/qiyTDxBjmIw?list=PLIiLuIrSErz46J2oRpuTMXuVTHkwDabfD', '[New 100%]'),
(8, 1, 'Bài 3', 'https://youtu.be/U7_Cs1x0RL0?si=zNkjzvfPsyoSYktO', 'aaaaaaaa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `session_id`, `total_price`, `status`, `created_at`) VALUES
(1, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 07:58:33'),
(2, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 07:58:47'),
(3, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 07:59:18'),
(4, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 07:59:50'),
(5, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 08:00:40'),
(6, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 08:01:56'),
(7, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 2000000.00, 'pending', '2025-03-15 08:05:22'),
(8, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 08:06:01'),
(9, NULL, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 08:08:15'),
(10, 68, 'see4nlr8lb3cuiqf0ub32612p2', 2000000.00, 'pending', '2025-03-15 08:09:01'),
(11, 68, 'see4nlr8lb3cuiqf0ub32612p2', 13245678.00, 'pending', '2025-03-15 08:12:51'),
(12, NULL, 'aotgtgo1iu7e6grr5m0265u0bh', 13245678.00, 'pending', '2025-03-16 19:25:36'),
(13, NULL, 'aotgtgo1iu7e6grr5m0265u0bh', 2000000.00, 'pending', '2025-03-16 19:27:04'),
(14, 68, 'bs8a76ikmj7o5f3gi8kge0gna9', 13245678.00, 'completed', '2025-03-16 19:29:09'),
(15, NULL, 'ot277vbis21nvq7s5n2mchstmg', 13245678.00, 'pending', '2025-03-17 03:30:36'),
(16, 68, 'ca9gtnaccakhhiqmieeucj8qjh', 15245678.00, 'pending', '2025-03-17 14:07:17'),
(17, NULL, 'rmrhg496qmc2mbu4ar4fpa7cn6', 2000000.00, 'pending', '2025-03-21 14:14:21'),
(18, 70, 'rmrhg496qmc2mbu4ar4fpa7cn6', 2000000.00, 'completed', '2025-03-21 14:45:31'),
(19, NULL, '0pm7u6kms4qka1snbhgtesn118', 120000.00, 'pending', '2025-03-22 03:20:53'),
(20, 65, '0pm7u6kms4qka1snbhgtesn118', 120000.00, 'pending', '2025-03-22 03:22:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `subject_id`, `price`) VALUES
(1, 1, 2, 13245678.00),
(2, 2, 2, 13245678.00),
(3, 3, 2, 13245678.00),
(4, 4, 2, 13245678.00),
(5, 5, 2, 13245678.00),
(6, 6, 2, 13245678.00),
(7, 7, 1, 2000000.00),
(8, 8, 2, 13245678.00),
(9, 9, 2, 13245678.00),
(10, 10, 1, 2000000.00),
(11, 11, 2, 13245678.00),
(12, 12, 2, 13245678.00),
(13, 13, 1, 2000000.00),
(14, 14, 2, 13245678.00),
(15, 15, 2, 13245678.00),
(16, 16, 1, 2000000.00),
(17, 16, 2, 13245678.00),
(18, 17, 1, 2000000.00),
(19, 18, 1, 2000000.00),
(20, 19, 8, 120000.00),
(21, 20, 8, 120000.00);

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
(1, 1, '1+1=?', '2', '5', '3', '1', 'a'),
(2, 1, 'câu 2: 3+1=?', '2', '4', '3', '1', 'b'),
(3, 1, 'câu 2: 3+2=?', '2', '5', '3', '1', 'b');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `category_id`, `name`, `image`, `price`, `sku`, `status`, `description`) VALUES
(1, 3, 'PHP Cơ Bản', 'https://i.pinimg.com/736x/33/75/a8/3375a8fca0a82a2bfab486547d95a98e.jpg', 2000000, 'PHP001', 'active', 'ádasdas'),
(3, 3, 'PHP SUPERHERO', 'https://th.bing.com/th/id/OIP.qF-5pDFdeBN8DhoN2tlBcQHaD3?rs=1&pid=ImgDetMain', 120000, 'akml', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(4, 1, 'CSS SUPERHERO', 'https://albertraluy.github.io/A5-reglas/img/CSS-Logo.png', 120000, 'akml123', 'active', 'Không Tiền Thì Cook'),
(5, 3, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(6, 3, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(7, 3, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(8, 1, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'activeasdas', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa');

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
(1, 6, 'Giáo Sư'),
(2, 6, 'Bài 2'),
(3, 6, 'Bài 3'),
(4, 6, 'Bài 4');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(250) NOT NULL,
  `role` enum('admin','user','quanly') DEFAULT 'user',
  `phone` int(11) NOT NULL,
  `image` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `name`, `role`, `phone`, `image`) VALUES
(57, 'phamminhtu28055@gmail.com', '$2y$10$15uE26mNHnTK9ua6o/ygKuZllUg0iNvo8zVLREdIFEUpXqH4ge7m2', '2025-03-10 10:49:10', 'Phạm Minh Tú', 'admin', 0, ''),
(62, 'heilpmtu@gmail.com', '', '2025-03-13 15:51:15', 'Phạm Minh Tú', 'admin', 337241001, 'uploads/67de330c23b94.jpg'),
(63, 'ebanythanh1@gmail.com', '$2y$10$EjWtHpXt7H7gZ5X.uJToVe008JOUda7R3sb.49PN4ruPv/o2t84S.', '2025-03-15 03:35:15', 'YTHANH ÊBAN', 'admin', 0, ''),
(64, 'nguyenhvpk03793@gmail.com', '', '2025-03-22 02:44:21', 'Hoàng Văn Nguyễn', 'user', 337241001, 'uploads/67de24ecc0e30.jpg'),
(65, 'nguyenvitas7@gmail.com', '$2y$10$hVtzoLvme.lHQ10XBG77z.S2S3eGua9pcnBCPp43H56miT2ndQHZ2', '2025-03-22 03:22:11', 'gấu nâu', 'user', 0, '');

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
(1, 4, 63, 1, 'CSS SUPERHERO', 'https://albertraluy.github.io/A5-reglas/img/CSS-Logo.png', 120000, 'akml123', 'Không Tiền Thì Cook', 'Đã Tham Gia', 'cod'),
(2, 4, 63, 1, 'CSS SUPERHERO', 'https://albertraluy.github.io/A5-reglas/img/CSS-Logo.png', 120000, 'akml123', 'Không Tiền Thì Cook', 'Đã Tham Gia', 'cod'),
(3, 8, 63, 1, 'MAKETING SUPERHERO', 'https://dprintworldwide.com/wp-content/uploads/2018/04/marketing-with-posters.jpg', 120000, 'akml4565678777454', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Đã Tham Gia', 'cod'),
(4, 3, 63, 3, 'PHP SUPERHERO', 'https://th.bing.com/th/id/OIP.qF-5pDFdeBN8DhoN2tlBcQHaD3?rs=1&pid=ImgDetMain', 20000, 'akml', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'Đã Tham Gia', 'cod');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carts_user` (`user_id`),
  ADD KEY `fk_carts_subject` (`subject_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `subject_id` (`subject_id`);

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
-- Chỉ mục cho bảng `user_subjects`
--
ALTER TABLE `user_subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT cho bảng `user_subjects`
--
ALTER TABLE `user_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
