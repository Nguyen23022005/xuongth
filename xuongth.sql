-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 24, 2025 lúc 03:44 PM
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
(7, 1, 'Bài 2', 'https://youtu.be/qiyTDxBjmIw?list=PLIiLuIrSErz46J2oRpuTMXuVTHkwDabfD', '[New 100%]'),
(8, 1, 'Bài 3', 'https://youtu.be/U7_Cs1x0RL0?si=zNkjzvfPsyoSYktO', 'aaaaaaaa');

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
(1, 1, 'PHP Cơ Bản', 'https://i.pinimg.com/736x/33/75/a8/3375a8fca0a82a2bfab486547d95a98e.jpg', 2000000, 'PHP001', 'active', 'ádasdas'),
(3, 1, 'PHP SUPERHERO', 'https://th.bing.com/th/id/OIP.qF-5pDFdeBN8DhoN2tlBcQHaD3?rs=1&pid=ImgDetMain', 120000, 'akml', 'active', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
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
(6, 7, 'Bài 1'),
(7, 8, 'bài 1');

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
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`, `name`, `role`, `phone`) VALUES
(57, 'phamminhtu28055@gmail.com', '$2y$10$15uE26mNHnTK9ua6o/ygKuZllUg0iNvo8zVLREdIFEUpXqH4ge7m2', '2025-03-10 10:49:10', 'Phạm Minh Tú', 'admin', 0),
(62, 'heilpmtu@gmail.com', '$2y$10$jUe.dKHi/19dMX395at84eWHVxPA1REgmLkqff..H0DRRqWSupA12', '2025-03-13 15:51:15', 'Phạm Minh Tú', 'admin', 0),
(63, 'ebanythanh1@gmail.com', '$2y$10$EjWtHpXt7H7gZ5X.uJToVe008JOUda7R3sb.49PN4ruPv/o2t84S.', '2025-03-15 03:35:15', 'YTHANH ÊBAN', 'admin', 0);

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
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

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
